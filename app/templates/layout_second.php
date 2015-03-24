<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Intranet|Digital Mind</title>
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <!-- Bootstrap Core CSS-->
        <link href="<?php echo 'bootstrap/css/'.config::$bootstrap_min_css ?>" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="<?php echo 'css/'.config::$style_css ?>" rel="stylesheet" />
        
        <!-- Style CSS Formulario Listas Desplegables -->
        <link rel="stylesheet" href="<?php echo 'css/'.config::$estilos_css ?>" />
        
        <!-- Style CSS Menu Horizontal mover-->
        <link rel="stylesheet" type="text/css" href="<?php echo 'css/'.config::$styles_menu_css ?>" />
        
        <!-- Style CSS Tablas -->
        <link rel="stylesheet" type="text/css" href="<?php echo 'css/'.config::$style_table_css ?>"/>

        <!-- JS libreria menu fijo -->
       <script src="<?php echo 'js/'.config::$jquery162_min_js ?>" type="text/javascript"></script>
            <script>
			    // Llamado cuando se cargue la página
			            posicionarMenu();
			
			            $(window).scroll(function() {    
			                posicionarMenu();
			            });
			
			            function posicionarMenu() {
			                var altura_del_header = $('header').outerHeight(true);
			                var altura_del_menu = $('nav').outerHeight(true);
			
			                if ($(window).scrollTop() >= altura_del_header){
			                    $('nav').addClass('fixed');
			                    $('.content').css('margin-top', (altura_del_menu) + 'px');
			                } else {
			                    $('nav').removeClass('fixed');
			                    $('.content').css('margin-top', '0');
			                }
			            }
			</script>
    </head>

    <body>
 
        <header>
            <div class="banner"><img src="images/banerletras.png"></div>
            <div class="principal">
                <div class="logomundo"><a href="#"><img src="images/mundo-luz.png"></a></div> 
            </div>
        </header>
       
       <div class="fondo-menu" id="navigation">
            <nav class="nav">
                <ul>
                    <li class="active"> <a href="./" alt="Inicio" title="Inicio"><img src="images/home.png"/></a> </li>
                    <li class=""> <a href="index.php?url=listaCliente" alt="Clientes" title="Clientes"><img src="images/icon-cliente-menu.png" />Clientes</a> </li>
                    <li class=""> <a href="index.php?url=listContact" alt="Contactos" title="Contacto"><img src="images/icon-contacto-menu.png" />Contactos</a> </li>
                    <li class=""> <a href="index.php?url=Proveedores" alt="Proveedores" title="Proveedor"><img src="images/icon-proveedor-menu.png" />Proveedores</a> </li>
                    <li class=""> <a href="./" alt="Productos" title="Producto"><img src="images/icon-producto-menu.png" />Productos</a> </li>
                    <li class="has-sub"> <a href="#"><img src="images/avatar.png" />Usuario</a>
                        <ul>
                            <li> <a href="logout.php" alt="Cerrar Sesion" title="Cerrar Sesion">Salir<img src="images/lock.png" /></a> </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div id="mobile-header">
                <a href="#" id=""><img src="images/menu.png"></a>
            </div>
        </div>
        
        <!-- Start Main Body Section-->
        <div class="mainbody-section text-center" id="menu-index">
            <div class="container">          
					<?php echo $contenido ?>
            </div>
        </div>
        <!-- End Main Body Section --> 

        <footer>
            
        </footer>       

    </body>  
</html> 