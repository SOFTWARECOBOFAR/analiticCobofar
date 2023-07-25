<?php
require_once 'functions.php';
require_once 'functionsGeneral.php';
require_once 'conexion.php';
// tiempo de la sesion por 8 horas

$dbh = new Conexion();
session_start();
date_default_timezone_set('America/La_Paz');
$fechaActual=date('Y-m-d');
$horaActual=date('H:i:s');
$user=$_POST["user"];
$password=$_POST["password"];
$password_mds5=md5($password);
$e=0;
$datos_acceso=obtenerTotalferiados_fechas_ws($user,$password_mds5);

// var_dump($datos_acceso);
if(isset($datos_acceso->estado)){
	if($datos_acceso->estado==true){// activo
	 	$codigo=$datos_acceso->id;
	 	$nombre=$datos_acceso->usuario;
	 	$nombreUnidad=$datos_acceso->nombreUnidad;
	 	$nombreArea=$datos_acceso->nombreArea;
	 	$nombreGestion=$datos_acceso->nombreGestion;
	 	$perfil=1;
	 	$_SESSION['globalUser']=$codigo;
		$_SESSION['globalNameUser']=$nombre;
		$_SESSION['globalNombreGestion']=$nombreGestion;
		$_SESSION['globalNombreUnidad']=$nombreUnidad;
		$_SESSION['globalNombreArea']=$nombreArea;
		$_SESSION['logueado']=1;
		$_SESSION['globalPerfil']=$perfil;
	}else{
		$e=1;
	}
}else{
	$e=1;
}

header("location:index.php?e=$e");  




?>