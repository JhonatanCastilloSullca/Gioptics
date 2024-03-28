<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;

class BuscarController extends Controller
{
    public function index(Request $request)
    {
        if($request){

            $sql=trim($request->get('buscarTexto'));
            $id_paciente=0;
            $pacientes=DB::table('pacientes')
            ->where('pacientes.nombre','=',$sql)
            ->get();
            foreach($pacientes as $paciente){
                $id_paciente=$paciente->id;
            }
            $medidas=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
            ->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
            ->select('m.id','m.odvle','m.odvlc','m.odvleje','m.odvce','m.odvcc','m.odvceje','m.oivle','m.oivlc','m.oivleje','m.oivce',
            'm.oivcc','m.oivceje','m.dip','m.add','m.indicaciones','m.fecha','u.nombre as especialista','p.nombre as paciente','s.nombre as sucursal')
            ->where('m.idPaciente','=',$id_paciente)->orderBy('m.id','desc')->get();
        }

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        return view('buscar.index',["usuario"=>$usuario,"pacientes"=>$pacientes,"buscarTexto"=>$sql,"medidas"=>$medidas]);
    }
}
