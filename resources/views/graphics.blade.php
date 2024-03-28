@extends('home')
@section('contenido')

    
<main class="main">
            <!-- Breadcrumb -->
            <ol>
            </ol>
            <div class="container">
                <div class="row">
                    <!--
                    <div class="col-lg-12 col-xs-12">
                        <div class="card btndash">
                            
                            
                            <div class="buttons-page-tools">
                                
                                <div class="page-tools px-2">
                                    <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90" data-toggle="modal" data-target="#abrirmodalPaciente">
                                    <span class="d-none d-sm-inline mr-1">
                                    Ingresar Medida
                                    </span>
                                    <i class="fa fa-eye text-110 w-2 h-2"></i>
                                    </button>                                
                                </div> 
                                <div class="page-tools px-2">
                                    <a href="venta/create">
                                        <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
                                        <span class="d-none d-sm-inline mr-1">
                                        Ingresar Venta
                                        </span>
                                        <i class="fa fa-shopping-cart text-110 w-2 h-2"></i>
                                        </button>
                                    </a>                           
                                </div>   
                                <div class="page-tools px-2">
                                    <a href="/saldo">
                                        <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
                                        <span class="d-none d-sm-inline mr-1">
                                        Entregar Venta
                                        </span>
                                        <i class="fa fa-shopping-cart text-110 w-2 h-2"></i>
                                        </button>
                                    </a>                            
                                </div> 
                                <div class="page-tools px-2">
                                    <a href="compra/create">
                                        <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
                                        <span class="d-none d-sm-inline mr-1">
                                        Agregar Compra
                                        </span>
                                        <i class="fa fa-cubes text-110 w-2 h-2"></i>
                                        </button>
                                    </a>                             
                                </div>  
                                <div class="page-tools px-2">
                                    <a href="/saldoc">
                                        <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
                                        <span class="d-none d-sm-inline mr-1">
                                        Saldos Pendientes
                                        </span>
                                        <i class="fa fa-usd text-110 w-2 h-2"></i>
                                        </button>
                                    </a>                               
                                </div> 
                                <div class="page-tools px-2">
                                    <a href="/producto">
                                        <button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
                                        <span class="d-none d-sm-inline mr-1">
                                        Lista de Productos
                                        </span>
                                        <i class="fa fa-tag text-110 w-2 h-2"></i>
                                        </button>
                                    </a>                                 
                                </div> 

                            </div>
                                                        
                        </div>
                    </div>
                            -->

                    <div class="col-xl-12">
                        <!-- compras - meses -->
                        <div class="card card-chart ">
                            <div class="card-header">
                                <h4 class="text-center ">Estadisticas</h4>
                            </div>
                                                                    
                        </div>
                    </div>
                    <div class="col-lg-12 col-xs-12 dashmont">
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-long-arrow-right"></i> Ingresos</span>
                            <div class="count">{{$ingresos}}</div>
                            <span class="count_bottom"> Del dia</span>
                        </div> 
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-long-arrow-left"></i> Egresos </span>
                            <div class="count">{{$egresos}}</div>
                            <span class="count_bottom"> Del dia</span>
                           
                        </div> 
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-usd"></i> Caja Neto</span>
                            <div class="count">{{$ingresos-$egresos}}</div>
                            <span class="count_bottom"> Del dia</span>
                        </div> 
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-shopping-basket "></i> Productos </span>
                            <div class="count"> {{$cantidadproductos}}</div>
                            <span class="count_bottom"> Vendidos</span>
                        </div>  
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            @foreach($clientesatendidos as $cat)
                            <span class="count_top"><i class="fa fa-long-arrow-left"></i> Clientes  </span>
                            <div class="count">{{$cat->clientes}} </div>
                            <span class="count_bottom"> Atendidos</span>
                            @endforeach
                        </div>                                                 
                    </div>
                
                <div class="col-xl-12">
                        <!-- compras - meses -->
                        <div class="card card-chart ">
                            <div class="card-header">
                                <h4 class="text-center ">Ventas Semanales Asesores</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart ">
                                    <canvas id="canvas-1" width="400" height="100" >                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>
                    </div><!--col-md-6-->                
                    <div class="col-md-6">                    
                        <!-- ventas - meses -->                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Ventas Semanales Productos</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="canvas-2" >                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>                                            
                    </div><!-- col-md-6 -->
                    <div class="col-md-6">                    
                        <!-- ventas - meses -->                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Mediciones Semanales</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="canvas-3">                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>                
                    </div><!-- col-md-6 -->
                    <div class="col-xl-12">
                        <!-- compras - meses -->
                        <div class="card card-chart ">
                            <div class="card-header">
                                <h4 class="text-center ">Ingresos y Egresos Semanales</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart ">
                                    <canvas id="canvas-4" width="400" height="100" >                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>
                    </div><!--col-md-6-->                
                    <div class="col-md-6">                    
                        <!-- ventas - meses -->                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Ventas por Sucursales</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="canvas-5" >                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>                                            
                    </div><!-- col-md-6 -->
                    <div class="col-md-6">                    
                        <!-- ventas - meses -->                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Ventas por Categorias</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="canvas-6">                                                
                                    </canvas>
                                </div>
                            </div>                                        
                        </div>                
                    </div><!-- col-md-6 -->
                </div><!--row-->    
                    <!--Inicio del modal actualizar-->
            <div class="modal fade" id="abrirmodalPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Paciente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            
                            <form action="{{route('medida.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('medida.form')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
                
            </div>
            @push ('scripts')
                <script src="{{asset('js/Chart.min.js')}}"></script>

                <script>                

                    const random = () => Math.round(Math.random() * 100);
                    const lineChart = new Chart(document.getElementById('canvas-2'), {
                        type: 'line',
                        data: {
                            labels: [<?php foreach ($productossemanales as $pro)
                                            { 
                                
                                        echo '"'.$pro->nombre.'",';} ?>],
                            datasets: [{
                                label: 'Productos Semanales',
                                backgroundColor: 'rgba(220, 220, 220, 0.2)',
                                borderColor: 'rgba(220, 220, 220, 1)',
                                pointBackgroundColor: 'rgba(220, 220, 220, 1)',
                                pointBorderColor: '#fff',
                                data: [<?php foreach ($ventassemanales as $ven)
                                            { 
                                
                                        echo ''. $ven->total.',';}?>]
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    const barChart = new Chart(document.getElementById('canvas-1'), {
                        type: 'bar',
                        data: {
                            labels: [<?php foreach ($ventassemanales as $ven)
                                            { 
                                
                                        echo '"'.$ven->nombre.'",';} ?>],
                            datasets: [{
                                label: 'Ventas Semanales Asesores',
                                backgroundColor: 'rgba(212, 230, 166, 1)',
                                borderColor: 'rgba(220, 220, 220, 0.8)',
                                highlightFill: 'rgba(220, 220, 220, 0.75)',
                                highlightStroke: 'rgba(220, 220, 220, 1)',
                                data: [<?php foreach ($ventassemanales as $ven)
                                            { 
                                
                                        echo ''. $ven->total.',';} ?>]
                            }]
                        },
                        options: {
                            
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    const doughnutChart = new Chart(document.getElementById('canvas-3'), {
                        type: 'doughnut',
                        data: {
                            labels: [<?php foreach ($medicionsemanales as $med)
                                            { 
                                
                                        echo '"'.$med->nombre.'",';} ?>],
                            datasets: [{
                                data: [<?php foreach ($medicionsemanales as $med)
                                            { 
                                
                                        echo '"'.$med->medicion.'",';} ?>],
                                backgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB'],
                                hoverBackgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB']
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                    <?php $cont1=1;?>
                    <?php $cont2=1;?>
                    const radarChart = new Chart(document.getElementById('canvas-4'), {
                        type: 'radar',
                        data: {
                            labels: [<?php for ($cont=1;$cont<8;$cont++)
                                            { setlocale(LC_TIME, "spanish"); 
                                
                                        echo '"'. utf8_encode(strftime('%A',strtotime($fechas[$cont]))).'",';} ?>],
                            datasets: [{
                                label: 'Ingresos',
                                backgroundColor: 'rgba(220, 220, 220, 0.2)',
                                borderColor: 'rgba(220, 220, 220, 1)',
                                pointBackgroundColor: 'rgba(220, 220, 220, 1)',
                                pointBorderColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220, 220, 220, 1)',
                                data: [<?php for ($cont=1;$cont<8;$cont++){
                                                foreach ($ingresossemanales as $ing)
                                                {
                                                    if($fechas[$cont]==$ing->fecha){
                                                        echo '"'.$ing->total.'",';
                                                    }
                                                }
                                            }
                                         ?>]
                            }, {
                                label: 'Egresos',
                                backgroundColor: 'rgba(151, 187, 205, 0.2)',
                                borderColor: 'rgba(151, 187, 205, 1)',
                                pointBackgroundColor: 'rgba(151, 187, 205, 1)',
                                pointBorderColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(151, 187, 205, 1)',
                                data: [<?php for ($cont=1;$cont<8;$cont++){
                                                foreach ($egresossemanales as $egr)
                                                {
                                                    if($fechas[$cont]==$egr->fecha){
                                                        echo '"'.$egr->total.'",';
                                                    }
                                                }
                                            }
                                         ?>]
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    const pieChart = new Chart(document.getElementById('canvas-5'), {
                        type: 'pie',
                        data: {
                            labels: [<?php foreach ($ventassucursales as $vents)
                                            {
                                                echo '"'.$vents->nombre.'",';
                                            }
                                         ?>],
                            datasets: [{
                                data: [<?php foreach ($ventassucursales as $vents)
                                            {
                                                echo '"'.$vents->total.'",';
                                            }
                                         ?>],
                                backgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB'],
                                hoverBackgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB']
                            }]
                        },
                        options: {
                        }
                    });
                    const polarAreaChart = new Chart(document.getElementById('canvas-6'), {
                        type: 'polarArea',
                        data: {
                            labels: [<?php foreach ($categoriassemanales as $cat)
                                            {
                                                echo '"'.$cat->nombre.'",';
                                            }
                                         ?>],
                            datasets: [{
                                data: [<?php foreach ($categoriassemanales as $cat)
                                            {
                                                echo '"'.$cat->total.'",';
                                            }
                                         ?>],
                                backgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB']
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                    
                </script>
                @endpush
        
                
        </main>

@endsection