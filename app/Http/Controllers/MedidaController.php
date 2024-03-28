<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Medida;
use App\Events\MedidaUpdate;
use App\Events\MedidaVenta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;

class MedidaController extends Controller
{
    //
    //
    public function index(Request $request)
    {


        $usuarios=DB::table('users')
        ->orderBy('users.id','desc')
        ->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)
        ->orderBy('pacientes.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();


        return view('medida.index',["usuarios"=>$usuarios,"usuario"=>$usuario,"pacientes"=>$pacientes]);

    }
    public function medidasrealizadas(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        $fecha=date("Y-m-d",strtotime($mytime."+ - 30 days"));

        $medida=DB::table('medidas as m')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')
        ->select('m.id','p.nombre as paciente','p.id as idPaciente','u.nombre as usuario','p.tipo_documento','p.num_documento','m.fecha','u.apellido')
        ->where('m.id','!=','1')
        ->where('m.fecha','>',$fecha)
        ->orderBy('m.id','desc')
        ->get();
        $medidas = $medida->unique('idPaciente');
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)
        ->orderBy('pacientes.id','desc')
        ->get();
        $usuarios=DB::table('users')
        ->orderBy('users.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        return view('medida.medidasrealizadas',["medidas"=>$medidas,"usuarios"=>$usuarios,"usuario"=>$usuario,"pacientes"=>$pacientes]);

    }

    public function recetapdf($id)
    {
        $medidas=DB::table('medidas as m')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')
        ->join('sucursals as s','m.idSucursal','=','s.id')
        ->select('m.id','m.odvle','m.odvlc','m.odvleje','m.odvce','m.odvcc','m.odvceje','m.oivle','m.oivlc','m.oivleje','m.oivce',
        'm.oivcc','m.oivceje','m.dip','m.add','m.indicaciones','m.fecha','u.nombre as especialista','p.nombre as paciente','p.edad as pacienteedad','p.celular as pacientecelular','p.email as pacienteemail','p.ocupacion as pacienteocupacion','s.nombre as sucursal','s.telefono as sucursalcel','s.direccion as direccionsuc')
        ->where('m.id','=',$id)->get();
        $usuarios=DB::table('users')
        ->orderBy('users.id','desc')
        ->get();
        $pacientes=DB::table('pacientes')
        ->orderBy('pacientes.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $ventas=DB::table('ventas as v')
        ->join('pacientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','p.ocupacion as clienteocupacion','p.edad as clienteedad','p.celular as clientecelular','p.email as clienteemail','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal'
        ,'v.acuenta','v.saldo','v.total','v.estado','v.fecha')
        ->where('v.estado','!=','Falta')
        ->get();
        $pdf= \PDF::loadView('pdf.recetapdf',['medidas' => $medidas,'ventas' => $ventas,])->setPaper([0, 0, 200.77, 566.93], 'portrait');
        return $pdf->stream('recetapdf'.$id.'.pdf');
    }
    public function create()
    {

        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)
        ->orderBy('pacientes.id','desc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();


        return view('medida.create',["usuario"=>$usuario,"pacientes"=>$pacientes]);
    }

    public function edit($id)
    {
        $fechamedicion = Carbon::now()->toDateString();

        $medidas=DB::table('medidas')
        ->where('medidas.id','=',$id)
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        foreach($medidas as $medida){
            $id_paciente=$medida->idPaciente;
        }
        $paciente=DB::table('pacientes')
        ->where('pacientes.id','=',$id_paciente)
        ->get();
        $medidasanteriores=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
        ->select('m.id','m.odvle','m.odvlc','m.odvleje','m.odvce','m.odvcc','m.odvceje','m.oivle','m.oivlc','m.oivleje','m.oivce',
        'm.oivcc','m.oivceje','m.dip','m.add','m.indicaciones','m.fecha','u.nombre as especialista','p.nombre as paciente','s.nombre as sucursal')
        ->where('m.idPaciente','=',$id_paciente)->orderBy('m.id','desc')->get();
        return view('medida.edit',["fechamedicion"=>$fechamedicion,"medidas"=>$medidas,"usuario"=>$usuario,"medidasanteriores"=>$medidasanteriores,"paciente"=>$paciente]);
    }
    public function show($id)
    {

        $medidas=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
        ->select('m.id','m.odvle','m.odvlc','m.odvleje','m.odvce','m.odvcc','m.odvceje','m.oivle','m.oivlc','m.oivleje','m.oivce',
        'm.oivcc','m.oivceje','m.dip','m.add','m.indicaciones','m.fecha','u.nombre as especialista','p.nombre as paciente','s.nombre as sucursal')
        ->where('m.idPaciente','=',$id)->orderBy('m.id','desc')->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $paciente=Paciente::where('id','=',$id)->first();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)
        ->orderBy('pacientes.id','desc')
        ->get();

        return view('medida.show',["medidas"=>$medidas,"usuario"=>$usuario,"paciente"=>$paciente,"pacientes"=>$pacientes]);
    }

    public function store(Request $request)
    {
        if($request->id_paciente==''){
            $requ=\Validator::make($request->all(), [
                'nombre' => 'required',
                'tipo_documento' => 'nullable',
                'num_documento' => 'nullable|unique:pacientes',
                'edad' => 'nullable',
                'celular' => 'nullable|numeric|digits:9',
                'email' => 'nullable|email',
                'tipo' => 'nullable',
                'fecha_nac' => 'nullable',
                'ocupacion' => 'nullable',
            ]);
            if ($requ->fails())
            {
                return Redirect::back()->with('error_code', 7)->withErrors($requ->errors())->withInput();

            }

            $pacientes= new Paciente();
            $pacientes->nombre = $request->nombre;
            $pacientes->tipo_documento = $request->tipo_documento;
            $pacientes->num_documento = $request->num_documento;
            $pacientes->edad = $request->edad;
            $pacientes->celular = $request->celular;
            $pacientes->email = $request->email;
            $pacientes->fecha_nac = $request->fecha_nac;
            $pacientes->tipo = $request->tipo;
            $pacientes->ocupacion = $request->ocupacion;
            $pacientes->save();

            $mytime= Carbon::now('America/Lima');

            $medidas= new Medida();
            $medidas->odvle =           0;
            $medidas->odvlc =           0;
            $medidas->odvleje =         0;
            $medidas->odvce =           0;
            $medidas->odvcc =           0;
            $medidas->odvceje =         0;
            $medidas->oivle =           0;
            $medidas->oivlc =           0;
            $medidas->oivleje =         0;
            $medidas->oivce =           0;
            $medidas->oivcc =           0;
            $medidas->oivceje =         0;
            $medidas->dip =             0;
            $medidas->add =             0;
            $medidas->indicaciones =    0;
            $medidas->fecha =           $mytime->toDateTimeString();
            $medidas->idUsuario =   \Auth::user()->id;
            $medidas->idVendedor =   \Auth::user()->id;
            $medidas->idPaciente =   $pacientes->id;
            $medidas->idSucursal =  \Auth::user()->idSucursal;
            $medidas->estado = "Pendiente";
            $medidas->save();
        }else{

            $mytime= Carbon::now('America/Lima');

            $medidas= new Medida();
            $medidas->odvle =           0;
            $medidas->odvlc =           0;
            $medidas->odvleje =         0;
            $medidas->odvce =           0;
            $medidas->odvcc =           0;
            $medidas->odvceje =         0;
            $medidas->oivle =           0;
            $medidas->oivlc =           0;
            $medidas->oivleje =         0;
            $medidas->oivce =           0;
            $medidas->oivcc =           0;
            $medidas->oivceje =         0;
            $medidas->dip =             0;
            $medidas->add =             0;
            $medidas->indicaciones =    0;
            $medidas->fecha =           $mytime->toDateTimeString();
            $medidas->idUsuario =   \Auth::user()->id;
            $medidas->idVendedor =   \Auth::user()->id;
            $medidas->idPaciente =   $request->id_paciente;
            $medidas->idSucursal =  \Auth::user()->idSucursal;
            $medidas->estado = "Pendiente";
            $medidas->save();
        }

        return Redirect::to("medida");
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [

            'odvle' =>         'nullable|max:8',
            'odvlc' =>         'nullable|max:8',
            'odvleje' =>       'nullable|max:8',
            'odvce' =>          'nullable|max:8',
            'odvcc' =>         'nullable|max:8',
            'odvceje' =>        'nullable|max:8',
            'oivle' =>          'nullable|max:8',
            'oivlc' =>          'nullable|max:8',
            'oivleje' =>        'nullable|max:8',
            'oivce' =>          'nullable|max:8',
            'oivcc' =>           'nullable|max:8',
            'oivceje' =>         'nullable|max:8',
            'dip' =>             'nullable|max:8',
            'add' =>             'nullable|max:8',
            'indicaciones' =>    'nullable|max:256',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        if($request->odvle=="")
        {
            $request->odvle='-';
        }
        if($request->odvlc=="")
        {
            $request->odvlc='-';
        }   if($request->odvleje=="")
        {
            $request->odvleje='-';
        }   if($request->odvce=="")
        {
            $request->odvce='-';
        }

        if($request->odvcc=="")
        {
            $request->odvcc='-';
        }
        if($request->odvceje=="")
        {
            $request->odvceje='-';
        }   if($request->oivle=="")
        {
            $request->oivle='-';
        }   if($request->oivlc=="")
        {
            $request->oivlc='-';
        }

        if($request->oivleje=="")
        {
            $request->oivleje='-';
        }
        if($request->oivce=="")
        {
            $request->oivce='-';
        }   if($request->oivcc=="")
        {
            $request->oivcc='-';
        }   if($request->oivceje=="")
        {
            $request->oivceje='-';
        }

        if($request->dip=="")
        {
            $request->dip='-';
        }
        if($request->add=="")
        {
            $request->add='-';
        }   if($request->indicaciones=="")
        {
            $request->indicaciones='-';
        }

        $medidas = [

        'odvle' =>           $request->odvle,
        'odvlc' =>           $request->odvlc,
        'odvleje' =>         $request->odvleje,
        'odvce' =>           $request->odvce,
        'odvcc' =>           $request->odvcc,
        'odvceje' =>         $request->odvceje,
        'oivle' =>           $request->oivle,
        'oivlc' =>           $request->oivlc,
        'oivleje' =>         $request->oivleje,
        'oivce' =>           $request->oivce,
        'oivcc' =>           $request->oivcc,
        'oivceje' =>         $request->oivceje,
        'dip' =>             $request->dip,
        'add' =>             $request->add,
        'indicaciones' =>    $request->indicaciones,
        'fecha' =>           $request->fechamedicion,
        'idUsuario' =>   \Auth::user()->id,
        'estado' =>    'Registrado',
        ];
        DB::table('medidas')->where('id',$request->id_enviar)->update($medidas);
        broadcast(new MedidaUpdate($request->id_enviar));
        broadcast(new MedidaVenta($request->id_enviar));
        return redirect()->to("medida/recetapdf/{$request->id_enviar}");
    }
    public function destroy(Request $request)
    {
        $medidas= Medida::findOrFail($request->id_medida);
        if($medidas->estado=="1"){
            $medidas->estado= '0';
            $medidas->save();
            return redirect()->back()->with('success','Medida Eliminado Correctamente!');
        }else{
            $medidas->estado= '1';
            $medidas->save();
            return redirect()->back()->with('success','Medida Activado Correctamente!');
        }
    }

    public function prueba()
    {
        $medida=DB::table('medidas as m')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario','p.tipo_documento','p.num_documento','m.idPaciente')
        ->where('m.estado','=','Pendiente')
        ->orderBy('m.id','asc')
        ->get();
        $medidas = $medida->unique('idPaciente');
        return $medidas;
    }
    public function prueba2()
    {
        $medidas=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','p.num_documento','p.tipo_documento','p.celular','p.email','m.idPaciente')->orderBy('m.id','desc')->distinct()->get(['idPaciente']);
        return $medidas;
    }

    public function delete($id)
    {
        DB::table('medidas')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
    public function autocomplete(Request $request)
    {
        $data = Paciente::select("nombre","id")
        ->where("nombre","like","%{$request->term}%")->where('id','>','1')
        ->pluck('nombre');
        return response()->json($data);
    }

    public function guardareditar(Request $request)
    {
        $requ=\Validator::make($request->all(), [

            'odvle' =>         'nullable|max:5',
            'odvlc' =>         'nullable|max:5',
            'odvleje' =>       'nullable|max:5',
            'odvce' =>          'nullable|max:5',
            'odvcc' =>         'nullable|max:5',
            'odvceje' =>        'nullable|max:5',
            'oivle' =>          'nullable|max:5',
            'oivlc' =>          'nullable|max:5',
            'oivleje' =>        'nullable|max:5',
            'oivce' =>          'nullable|max:5',
            'oivcc' =>           'nullable|max:5',
            'oivceje' =>         'nullable|max:5',
            'dip' =>             'nullable|max:5',
            'add' =>             'nullable|max:5',
            'indicaciones' =>    'nullable|max:256',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        if($request->odvle=="")
        {
            $request->odvle='-';
        }
        if($request->odvlc=="")
        {
            $request->odvlc='-';
        }   if($request->odvleje=="")
        {
            $request->odvleje='-';
        }   if($request->odvce=="")
        {
            $request->odvce='-';
        }

        if($request->odvcc=="")
        {
            $request->odvcc='-';
        }
        if($request->odvceje=="")
        {
            $request->odvceje='-';
        }   if($request->oivle=="")
        {
            $request->oivle='-';
        }   if($request->oivlc=="")
        {
            $request->oivlc='-';
        }

        if($request->oivleje=="")
        {
            $request->oivleje='-';
        }
        if($request->oivce=="")
        {
            $request->oivce='-';
        }   if($request->oivcc=="")
        {
            $request->oivcc='-';
        }   if($request->oivceje=="")
        {
            $request->oivceje='-';
        }

        if($request->dip=="")
        {
            $request->dip='-';
        }
        if($request->add=="")
        {
            $request->add='-';
        }   if($request->indicaciones=="")
        {
            $request->indicaciones='-';
        }

        $medidas = [

        'odvle' =>           $request->odvle,
        'odvlc' =>           $request->odvlc,
        'odvleje' =>         $request->odvleje,
        'odvce' =>           $request->odvce,
        'odvcc' =>           $request->odvcc,
        'odvceje' =>         $request->odvceje,
        'oivle' =>           $request->oivle,
        'oivlc' =>           $request->oivlc,
        'oivleje' =>         $request->oivleje,
        'oivce' =>           $request->oivce,
        'oivcc' =>           $request->oivcc,
        'oivceje' =>         $request->oivceje,
        'dip' =>             $request->dip,
        'add' =>             $request->add,
        'indicaciones' =>    $request->indicaciones,
        'idUsuario' =>   \Auth::user()->id,
        'estado' =>    'Registrado',
        ];


        DB::table('medidas')->where('id',$request->id_enviar)->update($medidas);


        return Redirect::to("medida/".$request->idPaciente);
    }

    public function editar($id)
    {

        $medidas=DB::table('medidas')
        ->where('medidas.id','=',$id)
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        foreach($medidas as $medida){
            $id_paciente=$medida->idPaciente;
        }
        $paciente=DB::table('pacientes')
        ->where('pacientes.id','=',$id_paciente)
        ->get();
        return view('medida.editar',["medidas"=>$medidas,"usuario"=>$usuario,"paciente"=>$paciente]);
    }

}
