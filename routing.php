<?php 
	
	if(isset($_GET['opcion'])){
        if ($_GET['opcion']=='homeModulo') {
			$codModulo=$menuModulo;
			require_once('layouts/homeModulo.php');
		}
		if ($_GET['opcion']=='homeModulo2') {
			$codModulo=$menuModulo;
			require_once('layouts/homeModulo2.php');
		}

		//ingresos y salidas
		if ($_GET['opcion']=='rankingSucursalesIE') {
			require_once('graficos_financieros/ranking_sucursales_ie.php');
		}
		if ($_GET['opcion']=='rankingSucursalesMes') {
			require_once('graficos_financieros/ranking_sucursales_mes.php');
		}

		
	}else{
		//require("paginaprincipal.php");
	}

 ?>