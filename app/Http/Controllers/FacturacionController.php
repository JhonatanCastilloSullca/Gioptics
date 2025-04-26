<?php

namespace App\Http\Controllers;

use App\Exports\FacturacionExports;
use App\Models\Cliente;
use App\Models\Company;
use App\Models\Documento;
use App\Models\DocumentoSunat;
use App\Models\Venta;
use App\Services\SunatService;
use Greenter\Report\XmlUtils;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class FacturacionController extends Controller
{
    public function create()
    {
        return view('facturacion.create');
    }

    public function lista(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $nume_documento2 = $request->searchNroDocumento;
        $searchResponsable2 = $request->searchResponsable;
        $searchCliente2 = $request->searchCliente;
        $searchDocumento2 = $request->searchDocumento;

        $ventas = Venta::where('factura',1);
        
        if ($request->filled('searchFechaInicio')) {
            $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
            $ventas = $ventas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
        }
        if ($request->filled('searchCliente')) {
            $ventas = $ventas->where('idCliente', $request->searchCliente);
        }
        $ventas = $ventas->get();
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchNroDocumento && !$request->searchResponsable && !$request->searchCliente && !$request->searchDocumento){
            $ventas = Venta::where('factura',1)->whereDate('fecha',now())->orderBy('fecha','desc')->get();
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }
        $documentos = Documento::get();
        $clientes = Cliente::all();
        $i=0;
        return view('facturacion.lista',compact('documentos','i','ventas', 'clientes','fechaFin2','fechaInicio2','nume_documento2','searchResponsable2','searchCliente2','searchDocumento2'));
    }

    public function ticketpdf($ventaId)
    {
        $formatear = new NumeroALetras();
        $compania = Company::find(1);
        $venta = Venta::findOrFail($ventaId);
        $igv= number_format(($venta->total /1.18) * 0.18,2);
        $fecha = date("Y-m-d",strtotime($venta->fecha));
        $mensaje = $compania->ruc.'|'.$venta->documento->codSunat.'|'.$venta->documento->serie.'|'.$venta->nume_doc.'|'.$igv.'|'.$venta->total.'|'.$fecha.'|'.$venta->cliente->sunat.'|'.$venta->cliente->num_documento;
        $qrcode = base64_encode(\QrCode::size(100)->generate($mensaje));

        $letrasnumeros = $formatear->toInvoice($venta->total,2,'SOLES');
        if($venta->documento->nombre == "NOTA DE VENTA"){
            $pdf = \PDF::loadView('pdf.notaventa', ['venta' => $venta, 'qrcode' => $qrcode , 'letrasnumeros' => $letrasnumeros])
            ->setPaper([0, 0, 200.77, 566.93], 'portrait')
            ->setOptions([
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0
            ]);
        }elseif($venta->documento->nombre == "NOTA DE CRÉDITO"){
            $pdf = \PDF::loadView('pdf.notacredito', ['venta' => $venta, 'qrcode' => $qrcode , 'letrasnumeros' => $letrasnumeros])
            ->setPaper([0, 0, 200.77, 566.93], 'portrait')
            ->setOptions([
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0
            ]);
        }else{
            $pdf = \PDF::loadView('pdf.factura', ['venta' => $venta, 'qrcode' => $qrcode , 'letrasnumeros' => $letrasnumeros])
            ->setPaper([0, 0, 200.77, 566.93], 'portrait')
            ->setOptions([
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0
            ]);
        }
        return $pdf->stream('Ticket-' . $venta->nume_doc . '.pdf');
    }

    public function descargarXml($id)
    {
        $modelo = DocumentoSunat::where('venta_id',$id)->first();
        $venta=Venta::find($id);
        $contenidoXml = $modelo->xml;
        $nombre = $venta->documento?->serie.'-'.$venta->nume_doc;
        $headers = [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename='.$nombre.'.xml',
        ];
        return response()->make($contenidoXml, 200, $headers);
    }

    public function destroyfactura(Request $request)
    {
        try{
            DB::beginTransaction();
            $venta= Venta::findOrFail($request->id_venta_2);
            

            $mytime= Carbon::now('America/Lima');
            if($venta->documento->nombre == 'FACTURA ELECTRÓNICA'){
                $documento = Documento::where('nombre','NOTA DE CRÉDITO')->where('serie','LIKE','%F%')->where('sucursal_id',\Auth::user()->sucursal->id)->first();
            }else{
                $documento = Documento::where('nombre','NOTA DE CRÉDITO')->where('serie','LIKE','%B%')->where('sucursal_id',\Auth::user()->sucursal->id)->first();
            }
            $documento->cantidad = $documento->incremento + $documento->cantidad;
            $documento->save();
            $note = new Venta();
            $note->idSucursal = \Auth::user()->sucursal->id;
            $note->idUsuario = \Auth::user()->id;
            $note->idCliente = $venta->cliente->id;
            $note->documento_id = $documento->id;
            $note->idMedios = 1;
            $note->nume_doc = $documento->cantidad;
            $fechaConHoraActual = Carbon::parse($request->fecha);
            $note->fecha = $fechaConHoraActual;
            $note->descuento = 0;
            $note->acuenta = 0;
            $note->saldo = 0;
            $note->total = $venta->total;
            $note->observacion = '';
            $note->factura = 1;
            $note->estado = '1';
            $note->descripcion = $request->descripcion;
            $note->code_note = $request->type_anular;
            $note->factura_id = $venta->id;
            $note->save();

            $company = Company::find(1);
            $totales = collect([
                'MtoOperGravadas' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'MtoIGV' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'TotalImpuestos' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'ValorVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'SubTotal' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
                'MtoImpVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
            ]);

            $sunat = new SunatService();
            $see = $sunat->getSee($company);
            $invoice = $sunat->getNote($company,$documento,$venta,$totales,$note);
            $result = $see->send($invoice);
            $response['xml'] = $see->getFactory()->getLastXml();
            $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
            $response['sunatResponse'] = $sunat->sunatResponse($result);
            $documentoSunat = DocumentoSunat::create([
                'xml' => $response['xml'],
                'hash' => $response['hash'],
                'respuesta' => $response['sunatResponse']['success'],
                'codeError' => $response['sunatResponse']['error']['code'] ?? null,
                'messageError' => $response['sunatResponse']['error']['message'] ?? null,
                'cdrZip' => $response['sunatResponse']['cdrZip'] ?? null,
                'codeCdr' => $response['sunatResponse']['cdrResponse']['code'] ?? null,
                'descripcionCdr' => $response['sunatResponse']['cdrResponse']['descripcion'] ?? null,
                'notesCdr' => isset($response['sunatResponse']['cdrResponse']['notes'])
                                ? json_encode($response['sunatResponse']['cdrResponse']['notes'])
                                : null,
                'venta_id' => $note->id,
            ]);
            if($response['sunatResponse']['success']){
                $note->sunat = 1;
                $note->save();
                $venta->sunat = 2;
                $venta->save();
            }else{
                $note->sunat = 0;
                $note->save();
            }
            DB::commit();
            return back()
                ->with('success','Documento Anulado Correctamente!');

        }catch(Exception $e){
            DB::rollBack();
        }
    }
    
    public function enviarfactura(Venta $venta)
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
            $documento = Documento::find($venta->documento_id);

            $company = Company::find(1);
            $totales = collect([
                'MtoOperGravadas' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'MtoIGV' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'TotalImpuestos' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'ValorVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'SubTotal' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
                'MtoImpVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
            ]);

            $sunat = new SunatService();
            $see = $sunat->getSee($company);
            $invoice = $sunat->getInvoice($company,$documento,$venta,$totales);
            $result = $see->send($invoice);
            $response['xml'] = $see->getFactory()->getLastXml();
            $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
            $response['sunatResponse'] = $sunat->sunatResponse($result);
            $documentoSunat = DocumentoSunat::firstOrCreate([
                'venta_id' => $venta->id,
            ],[
                'xml' => $response['xml'],
                'hash' => $response['hash'],
                'respuesta' => $response['sunatResponse']['success'],
                'codeError' => $response['sunatResponse']['error']['code'] ?? null,
                'messageError' => $response['sunatResponse']['error']['message'] ?? null,
                'cdrZip' => $response['sunatResponse']['cdrZip'] ?? null,
                'codeCdr' => $response['sunatResponse']['cdrResponse']['code'] ?? null,
                'descripcionCdr' => $response['sunatResponse']['cdrResponse']['descripcion'] ?? null,
                'notesCdr' => isset($response['sunatResponse']['cdrResponse']['notes'])
                                ? json_encode($response['sunatResponse']['cdrResponse']['notes'])
                                : null,
            ]);
            if($response['sunatResponse']['success']){
                $venta->sunat = 1;
                $venta->save();
            }else{
                $venta->sunat = 0;
                $venta->save();
            }
            DB::commit();
            return back()
                ->with('success','Factura Enviada Correctamente!');

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function reporte(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $nume_documento2 = $request->searchNroDocumento;
        $searchResponsable2 = $request->searchResponsable;
        $searchCliente2 = $request->searchCliente;
        $searchDocumento2 = $request->searchDocumento;

        $ventas = Venta::where('factura',1);
        
        if ($request->filled('searchFechaInicio')) {
            $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
            $ventas = $ventas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
        }
        if ($request->filled('searchCliente')) {
            $ventas = $ventas->where('idCliente', $request->searchCliente);
        }
        $ventas = $ventas->get();
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchNroDocumento && !$request->searchResponsable && !$request->searchCliente && !$request->searchDocumento){
            $ventas = Venta::where('factura',1)->whereDate('fecha',now())->orderBy('fecha','desc')->get();
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }
        
        return Excel::download(new FacturacionExports($ventas,$fechaFin2,$fechaInicio2,$nume_documento2,$searchResponsable2,$searchCliente2,$searchDocumento2), 'reporte-facturacion.xlsx');
    }
}
