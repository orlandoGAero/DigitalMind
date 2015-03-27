<?php
    /**
     *  El archivo config es utilizado para mandar a llarmar todas las librerias que se ocupan en el sistema como son la conexión a la Base de Datos,
	 * los estilos CSS y jquery.
     */
    class config {
        
        static public $mvc_db_hostname = "localhost";
		static public $mvc_db_user = "root";
		static public $mvc_db_pass = "";
		static public $mvc_db_name = "digitalmind";
		//CSS
		static public $style_css = "style.css";
		static public $estilos_css = "estilos.css";
		static public $style_table_css = "style-table.css";
		static public $bootstrap_min_css = "bootstrap.min.css";
		static public $styles_menu_css = "styles-menu.css";
		static public $animate_css = "animate.css";
		static public $style_valid_invalid_css = "style-valid-invalid.css";
		
		//JS
		static public $jquery162_min_js = "jquery-1.6.2.min.js";
		static public $jquery_lksMenu_js = "jquery.lksMenu.js";
		static public $tinyTableSorter_js = "tinyTableSorter.js";
		static public $paging_js = "paging.js";
    }
    
?>