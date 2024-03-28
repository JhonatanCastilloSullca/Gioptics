<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema G-Optics Expeditions">
    <meta name="keyword" content="Sistema G-Optics">
    <title>Sistema G-Optics</title>
    <!-- Icons -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    
    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/styletable.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('img/favicon2.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img/favicon2.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img/favicon2.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('img/favicon2.png')}}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    @livewireStyles
    
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header id="headerprint"  class="app-header navbar" style="padding-right: 20px;">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!--PONER LOGO-->
        
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
            <img src="{{asset('img/favicon3.png')}}"  width="70px"  alt="admin@bootstrapmaster.com">
        
        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @foreach($usuario as $user)
                        <span class="d-md-down-none">Usuario Activo: <b>{{$user->nombre}}</b> en: <b>{{$user->sucursal}}</b></span>
                    @endforeach
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="{{route('logout')}}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        {{ csrf_field() }} 
                      
                    </form>
                </div>
            </li>
        </ul>
    </header>

    
    <div class="app-body">

       
        @if(Auth::user()->rol=="Gerencia")
            @include('plantilla.sidebarGerencia')
        @elseif(Auth::user()->rol=="Especialista")
            @include('plantilla.sidebarOptometra')
        @elseif(Auth::user()->rol=="Asesor de Venta")
            @include('plantilla.sidebarVendedor')
        @elseif(Auth::user()->rol=="Administrador de Tienda")
            @include('plantilla.sidebarAministrador')
        @else
        @endif
        @yield('contenido')
        <!-- /Fin del contenido principal -->


    <button class="btn-flotante btn-danger" type="button" data-toggle="modal" data-target="#cerrardsesion"><i class="fa fa-arrow-right fa-2x" style="padding-top:3px;color:#fff;border-color:#fff0" ></i>
        
    </button>
    <footer id="footerprint" class="app-footer">
   
        <span style="text-transform:capitalize;text-align:right;font-size:14px"><a href="http://www.ideascusco.com/">|</a>  G-Optics &copy; 2022</span>
    </footer>
    <!-- Inicio del modal Cambiar Estado del Proveedor -->
    <div class="modal fade" id="cerrardsesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document" style="padding-top: 15%;">
            <div class="modal-content">
                
                <div class="modal-body">
                    <form  action="{{route('logout')}}" method="POST">
                        {{csrf_field()}} 
            

                        <p>¿DESEA CONFIRMAR CERRAR SESIÓN?</p>
                        <div class="botonescerrar" style="float: right;">
                        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> ACEPTAR</button>
                        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> CANCELAR</button>
                        </div>

                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
    <!-- Fin del modal Eliminar -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Bootstrap and necessary plugins -->
    
    <!--<script src="{{asset('js/popper.min.js')}}"></script></script>-->
    <!--<script src="{{asset('js/bootstrap.min.js')}}"></script>-->
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-autocomplete.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    @stack('scripts')
    @livewireScripts

      
<script>

    
$( document ).ready(function() {
    $('input').attr('autocomplete','off');
});

$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });




    </script>


</body>

</html>