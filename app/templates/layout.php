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

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo 'bootstrap/css/'.config::$bootstrap_min_css ?>" rel="stylesheet" />

        <!-- Font Awesome CSS 
        <link href="css/font-awesome.min.css" rel="stylesheet"> -->
		
		<!-- Custom CSS animaciones-->
        <link href="<?php echo 'css/'.config::$animate_css ?>" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="<?php echo 'css/'.config::$style_css ?>" rel="stylesheet" />

        <!-- Custom Fonts 
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'> -->        
    </head>
    
    <body>
        
        <!-- Start Main Body Section MENU-->
        <div class="mainbody-section text-center" id="menu-index">
            <div class="container">
                <div class="row" id="menu"><!--DIV CONTIENE MENU-->
                    
                    <div class="col-md-3">
                        
                        <div class="menu-item blue">
                           <a href="index.php?url=listaCliente"><img src="images/icono-clientes.png"/><br><b>CLIENTES</b></a>
                        </div>
                        
                        <div class="menu-item blue">
                            <a href="index.php?url=listContact"><img src="images/icono-agenda.png"/><br><b>CONTACTOS</b></a> 
                        </div>
                        
						
						<div class="menu-item blue responsive">
                             <a href="index.php?url=Proveedores"><img src="images/icono-instructores.png"/><br><b>PROVEEDORES</b></a>                     
                        </div>
                     							
                        <div class="menu-item blue responsive">
                             <a href="index.php?url=listaProducto"><img src="images/icono-videos.png"/><br><b>PRODUCTOS</b></a> 
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                        <!-- Start Carousel Section -->
                        <div class="home-slider">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="padding-bottom: 30px;">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                               <!-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>*-->
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner"><br>
                                    <div class="item active">
                                    <br><br><br><br>
                                       <!-- <img src="images/about-03.jpg" class="img-responsive" alt="">-->
                                        <a href="./"><img src="images/logoDigitalMind.png" class="img-responsive" alt="Página Principal" title="Página Principal" /></a>
                                    <br><br><br><br>
                                    </div>
                                    <!---<div class="item">
                                        <img src="images/about-02.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="images/about-01.jpg" class="img-responsive" alt="">
                                    </div>-->
                                </div>

                            </div>
                        </div>
                        <!-- Start Carousel Section -->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="menu-item blue responsive">
                                    <a href="index.php?url=listaFam"><img src="images/icono-lineas.png"/><br><b>FAMILIAS</b></a>                    
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="menu-item blue responsive">
									<a href="index.php?url=listaMarca"><img src="images/icono-cursos.png"/><br><b>MARCAS</b></a> 
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-3">
                        
                        <div class="menu-item blue">
                            <a href="index.php?url=listaLinea"><img src="images/icono-lineas2.png"/><br><b>LÍNEAS</b></a> 
                        </div>
                        
                        <div class="menu-item blue">
                             <a href="./status"><img src="images/icono-casa.png"/><br><b>STATUS</b></a> 
                        </div>
                        
                        <div class="menu-item blue">
                            <a href="index.php?url=menuTransacciones"><img src="images/icono-money.png"/><br><b>TRANSACCIONES</b></a> 
                        </div>
                        
                        <div class="menu-item blue">
                            <a href="./configuracion"><img src="images/icono-configuraciones.png"/><br><b>CONFIGURACIÓN</b></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Body Section -->
    </body>
</html>
