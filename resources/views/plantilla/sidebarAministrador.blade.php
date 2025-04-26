<div class="sidebar">
        <nav class="sidebar-nav">
                <ul class="nav">
                        <li class="nav-item">
                                <a class="nav-link" href="{{url('graphics')}}" onclick="event.preventDefault(); document.getElementById('graphics-form').submit();"><i class="fa fa-home"></i>Inicio</a>
                                <form id="graphics-form" action="{{url('graphics')}}" method="GET" style="display: none;">
                                {{csrf_field()}} 
                                </form>
                        </li>
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-eye"></i>Medicion</a>        
                                <ul class="nav-dropdown-items">
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('buscar')}}" onclick="event.preventDefault(); document.getElementById('buscar-form').submit();"><i class="fa fa-plus"></i>Agregar PAciente</a>
                                                <form id="buscar-form" action="{{url('buscar')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('medida')}}" onclick="event.preventDefault(); document.getElementById('medida-form').submit();"><i class="fa fa-circle-o-notch"></i>Pendiente</a>
                                                <form id="medida-form" action="{{url('medida')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('medidasrealizadas')}}" onclick="event.preventDefault(); document.getElementById('medidasrealizadas-form').submit();"><i class="fa fa-check-square-o"></i>Historial</a>
                                                <form id="medidasrealizadas-form" action="{{url('medidasrealizadas')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('paciente')}}" onclick="event.preventDefault(); document.getElementById('paciente-form').submit();"><i class="fa fa-user "></i>Pacientes</a>
                                                <form id="paciente-form" action="{{url('paciente')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>  
                                        

                                </ul>
                        </li>
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-shopping-bag"></i>Ventas</a>        
                                <ul class="nav-dropdown-items">
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('venta/create')}}" onclick="event.preventDefault(); document.getElementById('venta-create-form').submit();"><i class="fa fa-shopping-cart"></i>Agregar</a>
                                                <form id="venta-create-form" action="{{url('venta/create')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('saldo')}}" onclick="event.preventDefault(); document.getElementById('saldo-form').submit();"><i class="fa fa-spinner"></i>por entregar</a>
                                                <form id="saldo-form" action="{{url('saldo')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('entregados')}}" onclick="event.preventDefault(); document.getElementById('entregados-form').submit();"><i class="fa fa-check"></i>Entregados</a>
                                                <form id="entregados-form" action="{{url('entregados')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('cliente')}}" onclick="event.preventDefault(); document.getElementById('cliente-form').submit();"><i class="fa fa-user "></i>Clientes</a>
                                                <form id="cliente-form" action="{{url('cliente')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>                                        
                                </ul>
                        </li>
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-archive"></i>Inventario</a>        
                                <ul class="nav-dropdown-items">
                                                                                        
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('producto')}}" onclick="event.preventDefault(); document.getElementById('producto-form').submit();"><i class="fa fa-tag"></i>Productos en Inventario</a>
                                                <form id="producto-form" action="{{url('producto')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>                       
                                </ul>
                        </li>
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-university"></i>Finanzas</a>        
                                <ul class="nav-dropdown-items">
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('caja')}}" onclick="event.preventDefault(); document.getElementById('caja-form').submit();"><i class="fa fa-usd"></i>Caja</a>
                                                <form id="caja-form" action="{{url('caja')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>                                 
                                </ul>
                        </li>  
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-book"></i>Reportes</a>        
                                <ul class="nav-dropdown-items">
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('ventas')}}" onclick="event.preventDefault(); document.getElementById('ventas-form').submit();"><i class="fa fa-shopping-cart"></i>Ventas</a>
                                                <form id="ventas-form" action="{{url('ventas')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('historia')}}" onclick="event.preventDefault(); document.getElementById('historia-form').submit();"><i class="fa fa-file-text-o "></i>Historias</a>
                                                <form id="historia-form" action="{{url('historia')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('cajas')}}" onclick="event.preventDefault(); document.getElementById('cajas-form').submit();"><i class="fa fa-usd"></i>Caja</a>
                                                <form id="cajas-form" action="{{url('cajas')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>

                                </ul>
                        </li>

                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle"  href="#"><i class="fa fa-credit-card-alt "></i>Facturación</a>        
                                <ul class="nav-dropdown-items">
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('facturacion/create')}}" onclick="event.preventDefault(); document.getElementById('facturacion-create-form').submit();"><i class="fa fa-shopping-cart"></i>Crear</a>
                                                <form id="facturacion-create-form" action="{{url('facturacion/create')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                        <li class="nav-item" style="padding-left: 20px;">
                                                <a class="nav-link" href="{{url('facturacion/lista')}}" onclick="event.preventDefault(); document.getElementById('facturacion-lista-form').submit();"><i class="fa fa-shopping-cart"></i>Lista</a>
                                                <form id="facturacion-lista-form" action="{{url('facturacion/lista')}}" method="GET" style="display: none;">
                                                {{csrf_field()}} 
                                                </form>
                                        </li>
                                </ul>
                        </li>
                </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>