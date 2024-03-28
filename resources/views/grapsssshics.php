@extends('home')
@section('contenido')

    
<main class="main">
            <!-- Breadcrumb -->
            <ol>
            </ol>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2">
                        <div class="card text-white bg-success">
                            <div class="body pb-0" style="padding: 10px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                                </button>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                            </div> 
                        </div>
                    </div>

                
                    <div class="col-lg-3 col-xs-4">
                    <!-- small box -->
                        <div class="card text-white" style="background:#CA664F">
                            <div class="body pb-0" style="padding: 10px;padding-left:25px">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                <i style="padding:15px;padding-top:30px"> <img src="{{asset('img/escritorio.png')}}"  width="55px" height="55px" ></i>
                                </button>
                                @foreach($totales as $total)
                                    <p>
                                    <span class="small-box-footer h7"><i>Brillo:</i> &nbsp;<strong>  {{$total->totalbrillo}}</strong> </span><br>
                                    <span class="small-box-footer h7"><i>Mate: </i> &nbsp; <strong> {{$total->totalmate}}</strong> </span><br>
                                    <span class="small-box-footer h7"><i>Volante:  </i> &nbsp; <strong>{{$total->totalvolante}}</strong></span><br>
                                    <span class="small-box-footer h7" style="font-weight: italic;"> <i>Especiales:</i> &nbsp; <strong>{{$total->totalespeciales}} </strong></span>
                                    </p>
                                @endforeach
                            </div>
                            <div class="chart-wrapper" style="height:30px; background: #B55A46; text-align:center">
                                <a href="{{url('venta')}}" class="small-box-footer h6" > Detalles <i class="fa fa-arrow-circle-right"></i></a>
                            </div> 
                        </div>
                    </div>
                
                <div class="col-lg-3 col-xs-4">
                    <!-- small box -->
                    <div class="card text-white" style="background:#10A669">
                        <div class="body pb-0" style="padding: 10px;padding-left:25px">
                            <button class="btn btn-transparent p-0 float-right" type="button">
                            <i style="padding:15px;padding-top:30px"> <img src="{{asset('img/acabados.png')}}"  width="55px" height="55px" ></i>
                            </button>
                                <p>
                                @foreach($totalacabados as $acabados)
                                    <span class="small-box-footer h7"><i>Boleados:</i> &nbsp; <strong>   {{$acabados->boleados}}</strong> </span><br>
                                    <span class="small-box-footer h7"><i>Linea Doblez: </i> &nbsp; <strong>   {{$acabados->lineadoblez}} </strong></span><br>
                                    <span class="small-box-footer h7"><i>Perforado:  </i> &nbsp;<strong>   {{$acabados->perforado}}</strong></span><br>
                                    <span class="small-box-footer h7" style="font-weight: italic;"> <i>Por Enviar:</i> &nbsp; <strong> {{$acabados->envios}} </strong> </span>
                                @endforeach
                                </p>
                        </div>
                        <div class="chart-wrapper" style="height:30px; background: #00945C; text-align:center">
                            <a href="{{url('detalle')}}" class="small-box-footer h6" > Detalles <i class="fa fa-arrow-circle-right"></i></a>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-xs-4">
                    <!-- small box -->
                    <div class="card text-white" style="background:#6D6EAC">
                        <div class="body pb-0" style="padding: 10px;padding-left:25px">
                            <button class="btn btn-transparent p-0 float-right" type="button">
                            <i style="padding:15px;padding-top:30px"> <img src="{{asset('img/enviados.png')}}"  width="55px" height="55px" ></i>
                            </button>
                            @foreach($totaltarjetas as $tarjetas)
                                <p>
                                <span class="small-box-footer h7"><i>Por Pagar:</i> &nbsp; <strong> {{$tarjetas->porpagar}} </strong></span><br>
                                <span class="small-box-footer h7"><i>Por Entregar: </i> &nbsp; <strong> {{$tarjetas->porentregar}}</strong> </span><br>
                                <span class="small-box-footer h7"></span><br>
                                <span class="small-box-footer h7"></span><br>
                                </p>
                            @endforeach
                        </div>
                        <div class="chart-wrapper" style="height:30px; background: #615F98; text-align:center">
                            <a href="{{url('venta')}}" class="small-box-footer h6" > Detalles <i class="fa fa-arrow-circle-right"></i></a>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-xs-4">
                    <!-- small box -->
                    <div class="card text-white" style="background:#EDA623">
                        <div class="body pb-0" style="padding: 10px;padding-left:25px">
                            <button class="btn btn-transparent p-0 float-right" type="button">
                            <i style="padding:15px;padding-top:30px"> <img src="{{asset('img/banco.png')}}"  width="55px" height="55px" ></i>
                            </button>
                                <p>
                                @foreach($totalbcp as $bcp)
                                    <?php $bcp1= $bcp->acuentabcp+$bcp->saldobcp; ?>
                                    <span class="small-box-footer h7"><i>BCP:</i> &nbsp;<strong> {{$bcp1}}   </strong></span><br>
                                @endforeach
                                @foreach($totalinter as $inter)
                                    <?php $inter1= $inter->acuentainter+$inter->saldointer; ?>
                                    <span class="small-box-footer h7"><i>Interbank: </i> &nbsp; <strong>  {{$inter1}}</strong> </span><br>
                                @endforeach
                                @foreach($totalbbva as $bbva)
                                    <?php $bbva1= $bbva->acuentabbva+$bbva->saldobbva; ?>
                                    <span class="small-box-footer h7"><i>BBVA: </i> &nbsp; <strong>  {{$bbva1}}</strong> </span><br>
                                @endforeach

                                    <span class="small-box-footer h7"></span><br>
                                </p>
                        </div>
                        <div class="chart-wrapper" style="height:30px; background: #D1921C; text-align:center">
                            <a href="{{url('venta')}}" class="small-box-footer h6" > Detalles <i class="fa fa-arrow-circle-right"></i></a>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-12 chart-wrapper" style="height:10px; background: #C3C5CA;">
                            
                </div>
                @foreach($totalefectivo as $efectivo)
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#D8DADE; text-align:center;padding: 10px">
                        <div class="body">
                            <span class="small-box-footer h3"> {{($efectivo->acuentaefectivo)+($efectivo->saldoefectivo)}} </span><br>
                            <span class="small-box-footer h7"> TARJETAS </span>
                        </div>
                    </div>
                    
                </div>
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#D8DADE; text-align:center;padding: 10px">
                        <div class="body">
                            <span class="small-box-footer h3"> {{($efectivo->totalingreso)}} </span><br>
                            <span class="small-box-footer h7"> OTROS INGRESOS </span>
                        </div>
                    </div>
                    
                </div>
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#D8DADE; text-align:center;padding: 10px">
                        <div class="body">
                            <span class="small-box-footer h3"> {{($efectivo->totalsalida)}} </span><br>
                            <span class="small-box-footer h7"> GASTOS</span>
                        </div>
                    </div>
                    
                </div>

                @foreach($totaldisenos as $totalll)
                    <?php $totaldisenoss=($totalll->totaldiseno);?>
                @endforeach
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#B8B8B8; text-align:center;padding: 10px">
                        <div class="body">
                        <?php $totalefectivo=($efectivo->acuentaefectivo+$efectivo->saldoefectivo+$efectivo->totalingreso+$totaldisenoss)- $efectivo->totalsalida;?>
                            <span class="small-box-footer h3"> {{$totalefectivo}} </span><br>
                            <span class="small-box-footer h7"> NETO CAJA</span>
                        </div>
                    </div>
                    
                </div>
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#B8B8B8; text-align:center;padding: 10px">
                        <div class="body">
                            <?php $totaldeposito=$bcp1+$inter1+$bbva1; ?>
                            <span class="small-box-footer h3"> {{$totaldeposito}} </span><br>
                            <span class="small-box-footer h7"> NETO DEPOSITOS </span>
                        </div>
                    </div>
                    
                </div>
                <div class="" style="width:16.66%">
                    
                    <div class="card" style="background:#D8DADE; text-align:center;padding: 10px">
                        <div class="body">
                            <span class="small-box-footer h3"> {{($totalefectivo+$totaldeposito)}} </span><br>
                            <span class="small-box-footer h7"> TOTAL CAJA </span>
                        </div>
                    </div>
                    
                </div>
                
                @endforeach
                <!-- Estadísticas gráficos -->
                    <div class="col-xl-12">
                        <!-- compras - meses -->

                        <div class="card card-chart ">
                            <div class="card-header">
                                <h4 class="text-center ">Ventas Dias por Producto</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart ">
                                    <canvas id="productos" width="400" height="100" >                                                
                                    </canvas>
                                </div>
                            </div>
                                        
                    </div>

                    </div><!--col-md-6-->
                
                    <div class="col-md-6">
                    
                        <!-- ventas - meses -->
                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Ventas Meses</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas" >                                                
                                    </canvas>
                                </div>
                            </div>
                                        
                        </div>
                    

                    </div><!-- col-md-6 -->
                    <div class="col-md-6">
                    
                        <!-- ventas - meses -->
                        
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Venta por dia</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="dias">                                                
                                    </canvas>
                                </div>
                            </div>
                                        
                        </div>
                    

                    </div><!-- col-md-6 -->

                </div><!--row-->


                @push ('scripts')
                <script src="{{asset('js/Chart.min.js')}}"></script>

                    <script>
                    $(function () {
                        /* ChartJS
                        * -------
                        * Here we will create a few charts using ChartJS
                        */

                        //--------------
                        //- AREA CHART -
                        //--------------

                        /**inicio de compras mes */
                        
                        var varDia=document.getElementById('productos').getContext('2d');

                            var charDia = new Chart(varDia, {
                                type: 'bar',
                                data: {
                                    labels: [<?php foreach ($productosmate as $prod)
                                        { 
                                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                    $mes_traducido=strftime('%B',strtotime($prod->mes));
                            
                                    echo '"'. $prod->dia." ".$mes_traducido.'",';} ?>],
                                    datasets: [{
                                        label: 'Mates',
                                        data: [<?php foreach ($productosmate as $prod)
                                            {echo ''. $prod->cantidad.',';} ?>],
                                    
                                        backgroundColor: "#3e95cd",

                                        borderWidth:1
                                    },
                                    {
                                        label: 'Brillos',
                                        data: [<?php foreach ($productosbrillo as $prod2)
                                            {echo ''. $prod2->cantidad.',';} ?>],
                                    
                                        backgroundColor: 'rgba(255, 99, 132, 1)',

                                        borderWidth:1
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

                            /*fin compras mes* */

                            var varDia=document.getElementById('dias').getContext('2d');
                            const random = () => Math.round(Math.random() * 100);
                            const lineChart = new Chart(document.getElementById('canvas-1'), {
                                type: 'line',
                                data: {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                    datasets: [{
                                        label: 'My First dataset',
                                        backgroundColor: 'rgba(220, 220, 220, 0.2)',
                                        borderColor: 'rgba(220, 220, 220, 1)',
                                        pointBackgroundColor: 'rgba(220, 220, 220, 1)',
                                        pointBorderColor: '#fff',
                                        data: [random(), random(), random(), random(), random(), random(), random()]
                                    }, {
                                        label: 'My Second dataset',
                                        backgroundColor: 'rgba(151, 187, 205, 0.2)',
                                        borderColor: 'rgba(151, 187, 205, 1)',
                                        pointBackgroundColor: 'rgba(151, 187, 205, 1)',
                                        pointBorderColor: '#fff',
                                        data: [random(), random(), random(), random(), random(), random(), random()]
                                    }]
                                },
                                options: {
                                    responsive: true
                                }
                            });



                        /**inicio de ventas mes */
                        var varVenta=document.getElementById('ventas').getContext('2d');

                            var charVenta = new Chart(varVenta, {
                                type: 'horizontalBar',
                                data: {
                                    labels: [<?php foreach ($ventasmes as $reg)
                                {
                                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                                    $mes_traducido=strftime('%B',strtotime($reg->mes));
                                    
                                    echo '"'. $mes_traducido.'",';} ?>],
                                    datasets: [{
                                        label: 'Ventas',
                                        data: [<?php foreach ($ventasmes as $reg)
                                        {echo ''. $reg->totalmes.',';} ?>],
                                        backgroundColor: [  'rgba(255, 99, 132, 1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'],
                                        borderColor: 'rgba(54, 162, 235, 0.2)',
                                        borderWidth: 1,
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

                    });

                    /*fin ventas mes* */


                    
                    
                    </script>
                @endpush

            </div>
        
                
        </main>

@endsection