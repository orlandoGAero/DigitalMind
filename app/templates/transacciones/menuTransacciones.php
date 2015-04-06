<!--  -->
<?php ob_start() ?>

	<!-- Custom CSS animaciones-->
		<link href="<?php echo 'css/'.config::$animate_css ?>" rel="stylesheet" />
		
		<div>
			<h3 class="azul">Transacciones</h3>
		</div>
        
		<div class="row" id="menu">
			<div class="row">
				<div class="col-md-4">
		            <div class="menu-item responsive">
		            	<a href="index.php?url=transacciones"><img src="images/menu-nueva_trans.png"/><br><b>NUEVA TRANSACCIÓN</b></a>                    
		            </div>
		        </div>
		        
		        <div class="col-md-4">
		            <div class="menu-item responsive">
		            	<a href="index.php?url=listarCompras"><img src="images/menu-compras.png"/><br><b>COMPRAS</b></a>                    
		            </div>
		        </div>
		        
		        <div class="col-md-4">
		            <div class="menu-item responsive">
						<a href="index.php?url=-------"><img src="images/menu-ventas.png"/><br><b>VENTAS</b></a> 
		            </div>
		        </div>
		    </div>
		</div>

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>