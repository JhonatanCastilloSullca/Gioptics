@extends('home')
@section('contenido')
<main class="main" >
            <!-- Breadcrumb -->
        
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <h2>Historial Paciente: {{$paciente->nombre}}</h2><br/>
                        <p><b>Numero Documento: </b>{{$paciente->num_documento}} </p> <p><b>Edad: </b>{{$paciente->edad}} </p> <p><b>Ocupacion: </b>{{$paciente->ocupacion}} </p> <p><b>Celular: </b>{{$paciente->celular}} </p> <p><b>Fecha de Nacimiento: </b>{{$paciente->fecha_nac}} </p> <p><b>Email: </b>{{$paciente->email}} </p>
                    </div>
                    @php $cont=1; @endphp
                    @foreach($medidas as $med)
                    <div class="form-group row" style="padding:20px">
                        <div class="col-md-3">
                            <label class="form-control-label" for="num_venta"><b>Fecha de Medicion</b></label>
                            
                            <p>{{date("d/m/Y", strtotime($med->fecha))}}</p>
                        </div>
                        <div class="col-md-3">  

                            <label class="form-control-label" for="nombre"><b>Especialista</b></label>
                            
                            <p>{{$med->especialista}}</p>
                                
                        </div>

                        <div class="col-md-2">  

                            <label class="form-control-label" for="documento"><b>TIENDA</b></label>

                            <p>{{$med->sucursal}}</p>
                        
                        </div>
                        <div class="col-md-1" style="TEXT-ALIGN-LAST: RIGHT"> 
                            <a href="recetapdf/{{$med->id}}" target="_blank"><button type='button' style='font-size: 1rem;' class='btn btn-success btn-sm'><i class='fa fa-download fa-1x'></i>&nbsp;PDF</button></a>
                        </div>
                        <div class="col-md-1" style="TEXT-ALIGN-LAST: RIGHT">
                            @if(Auth::user()->rol=="Gerencia" || Auth::user()->rol=="Especialista") 
                            <a href="editar/{{$med->id}}"><button type='button' style='font-size: 1rem;' class='btn btn-info btn-sm'><i class='fa fa-edit fa-1x'></i>&nbsp;EDITAR</button></a>
                            @else
                            <button type='button' style='font-size: 1rem;' class='btn btn-info btn-sm'><i class='fa fa-edit fa-1x'></i>&nbsp;EDITAR</button>
                            @endif
                        </div>
                        
                        <div class="col-md-1" style="TEXT-ALIGN-LAST: RIGHT"> 
                            @if(Auth::user()->rol=="Gerencia" || Auth::user()->rol=="Especialista")
                            <a href="medidaeliminar/{{$med->id}}"><button type='button' style='font-size: 1rem;' class='btn btn-danger btn-sm'><i class='fa fa-times fa-1x'></i>&nbsp;ELIMINAR</button></a>
                            @else
                            <button type='button' style='font-size: 1rem;' class='btn btn-danger btn-sm'><i class='fa fa-times fa-1x'></i>&nbsp;ELIMINAR</button>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive col-md-12" style="padding-bottom: 20px;">
                        <table id="medidas" class="table table-bordered table-striped table-sm" style="text-align-last: center;vertical-align: middle;">
                            <tbody>
                                <tr class="bg-primary">
                                    <td colspan="7">Medidas Oftalmologicas</td>
                                </tr>
                                <tr class="bg-secondary">
                                    <td rowspan="2"></td>
                                    <td colspan="3">Ojo Derecho</td>
                                    <td colspan="3">Ojo Izquierdo</td>
                                </tr>
                                <tr class="bg-secondary">
                                    <td>Esferico</td>
                                    <td>Cilindro</td>
                                    <td>Eje</td>
                                    <td>Esferico</td>
                                    <td>Cilindro</td>
                                    <td>Eje</td>
                                </tr>
                                <tr>
                                    <td>Para vision de lejos</td>
                                    <td>
                                        {{$med->odvle}}
                                    </td>
                                    <td>
                                        {{$med->odvlc}}
                                    </td>
                                    
                                    <td>
                                        {{$med->odvleje}}
                                    </td>
                                    <td>
                                        {{$med->oivle}}
                                    </td>
                                    <td>
                                        {{$med->oivlc}}
                                    </td>
                                    <td>
                                        {{$med->oivleje}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Para vision de cerca</td>
                                    <td>
                                        {{$med->odvce}}
                                    </td>
                                    <td>
                                        {{$med->odvcc}}
                                    </td>
                                    
                                    <td>
                                        {{$med->odvceje}}
                                    </td>
                                    <td>
                                        {{$med->oivce}}
                                    </td>
                                    <td>
                                        {{$med->oivcc}}
                                    </td>
                                    <td>
                                        {{$med->oivceje}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>DIP</td>
                                    <td>
                                        {{$med->dip}}
                                    </td>
                                    <td rowspan="2" style="vertical-align:middle">Indicaciones</td>
                                    <td colspan="4" rowspan="2">
                                        {{$med->indicaciones}}
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>ADD</td>
                                    <td>
                                        {{$med->add}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @php $cont=$cont+1; @endphp
                    </div>
                    @if($cont==count($medidas))
                        <div style="border-top: 1px solid #c2cfd6; padding-top: 20px;">
                    @else
                        <div >
                    @endif
                    </div>
                    @endforeach               
                </div>
                <div class="col-md-12">
                    <a href="{{URL::previous()}}">
                        <button type="reset" class="btn btn-danger btn-sm" >VOLVER ATRAS
                        </button>
                    </a> 
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        
        </main>

@endsection