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

        <!-- Bootstrap Core CSS -->
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

        <script type="text/javascript" src="js/scriptmenuhorizontal.js"></script>
        
        <!-- DataTables CSS 
        <link rel="stylesheet" type="text/css" href="css/dataTables.css">
        
        <!-- DataTables jquery 
        <script type="text/javascript" charset="UTF-8" src="js/jquery-1.10.2.js"></script>
        
        <!-- DataTables 
		<script type="text/javascript" charset="UTF-8" src="js/dataTables.js"></script>

        <!-- Funcion obtener datos JSON 
        <script type="text/javascript" charset="UTF-8" src="js/functions.js"></script>  -->
        
        <!-- Listas desplegables -->
    	 <link rel="stylesheet" href="css/estilos.css" />
		 <script type="text/javascript" src="js/jquery.lksMenu.js"></script>

        <!-- Template js 
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jqBootstrapValidation.js"></script>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        
    </head>
    

    <body>
        
        <?php include 'menu_h.html' ?>
        
        <!-- Start Main Body Section MENU-->
        <div class="mainbody-section text-center" id="menu-index">
            <div class="container">
                <!--  <div class="row" id="menu"><!--DIV CONTIENE MENU-->
                     <div><?php echo $contenido ?></div>
                <!--  </div>-->
            </div>
        </div>
        <!-- End Main Body Section -->
        

    </body>
    
</html>