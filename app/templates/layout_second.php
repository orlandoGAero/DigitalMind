<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Intranet|Digital Mind</title>
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <!-- Bootstrap Core CSS-->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Custom CSS -->
        <link href="css/animate.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo 'css/'.config::$mvc_style_css ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        
        <!--Style CSS Menu Horizontal mover-->
        <link rel="stylesheet" type="text/css" href="css/styles-menu.css">

        <!--libreria menu fijo -->
       <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
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

        <!-- Template js 
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/contact_me.js"></script>
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <script src="js/script.js"></script>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->       
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
                    <li class=""> <a href="./" alt="Clientes" title="Clientes"><img src="images/icon-cliente-menu.png" />Clientes</a> </li>
                    <li class=""> <a href="./" alt="Contactos" title="Contacto"><img src="images/icon-contacto-menu.png" />Contactos</a> </li>
                    <li class=""> <a href="./" alt="Proveedores" title="Proveedor"><img src="images/icon-proveedor-menu.png" />Proveedores</a> </li>
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
                     <div><?php echo $contenido ?></div>

            </div>
        </div>
        <!-- End Main Body Section --> 

        <footer>
            
        </footer>       

    </body>  
</html> 