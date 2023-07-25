<?php
	//carga la plantilla con la header y el footer
require_once 'conexion.php';
require_once 'styles.php';
require_once 'functions.php';
require_once 'functionsGeneral.php';
set_time_limit(0);
ini_set("session.cookie_lifetime","50400");
ini_set("session.gc_maxlifetime","50400");
  
session_start();
if(isset($_SESSION['logueado'])){
  if(isset($_GET['q'])){
    $q=$_GET['q'];
    $dbh = new Conexion();
    $sql="SELECT p.codigo,CONCAT_WS(' ',p.paterno,p.materno,p.primer_nombre)as nombre, p.cod_area, p.cod_unidadorganizacional, (select pd.perfil from personal_datosadicionales pd where pd.cod_personal=p.codigo) as perfil, (select pd.admin from personal_datosadicionales pd where pd.cod_personal=p.codigo) as admin
      from personal p
      where p.codigo='$q'";
      //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $stmt->execute();
    $stmt->bindColumn('codigo', $codigo);
    $stmt->bindColumn('nombre', $nombre);
    $stmt->bindColumn('cod_area', $codArea);
    $stmt->bindColumn('cod_unidadorganizacional', $codUnidad);
    $stmt->bindColumn('perfil', $perfil);
    $stmt->bindColumn('admin', $admin);
    while ($rowDetalle = $stmt->fetch(PDO::FETCH_BOUND)) {
      if($perfil==null || $perfil== ""){
        $perfil=0;
      }
      if($admin==null || $admin== ""){
        $admin=0;
      }
      $nombreUnidad=abrevUnidad($codUnidad);
      $nombreArea=abrevArea($codArea);
      $_SESSION['globalUser']=$codigo;
      $_SESSION['globalNameUser']=$nombre; 
      $_SESSION['globalUnidad']=$codUnidad;
      $_SESSION['globalNombreUnidad']=$nombreUnidad;
      $_SESSION['globalArea']=$codArea;
      $_SESSION['globalNombreArea']=$nombreArea;
      $_SESSION['globalPerfil']=$perfil;
      $_SESSION['globalAdmin']=$admin;
    }
  }
	require_once('layouts/layout.php');	
}else{
	if(isset($_GET['q'])){
    $q=$_GET['q'];	 
    require_once 'conexion.php';
    require_once 'functions.php';

    $q=$_GET['q'];
    $dbh = new Conexion();
    $sql="SELECT p.codigo,CONCAT_WS(' ',p.paterno,p.materno,p.primer_nombre)as nombre, p.cod_area, p.cod_unidadorganizacional,(select pd.perfil from personal_datosadicionales pd where pd.cod_personal=p.codigo) as perfil, (select pd.admin from personal_datosadicionales pd where pd.cod_personal=p.codigo) as admin,uo.abreviatura as uo,a.abreviatura as areas
    from personal p join unidades_organizacionales uo on p.cod_unidadorganizacional=uo.codigo join areas a on p.cod_area=a.codigo
    where p.codigo='$q' and p.cod_estadoreferencial=1 and p.cod_estadopersonal<>3";
    //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $stmt->bindColumn('codigo', $codigo);
    $stmt->bindColumn('nombre', $nombre);
    $stmt->bindColumn('cod_area', $codArea);
    $stmt->bindColumn('cod_unidadorganizacional', $codUnidad);
    $stmt->bindColumn('perfil', $perfil);
    $stmt->bindColumn('admin', $admin);
    $stmt->bindColumn('uo', $nombreUnidad);
    $stmt->bindColumn('areas', $nombreArea);
    $loginU=0;
    while ($rowDetalle = $stmt->fetch(PDO::FETCH_BOUND)) {
      if($perfil==null || $perfil== ""){
        $perfil=0;
      }
      if($admin==null || $admin== ""){
        $admin=0;
      }
      // $nombreUnidad=abrevUnidad($codUnidad);
      // $nombreArea=abrevArea($codArea);
      //SACAMOS LA GESTION ACTIVA
      $sqlGestion="SELECT cod_gestion FROM gestiones_datosadicionales where cod_estado=1";
      $stmtGestion = $dbh->prepare($sqlGestion);
      $stmtGestion->execute();
      while ($rowGestion = $stmtGestion->fetch(PDO::FETCH_ASSOC)) {
        $codGestionActiva=$rowGestion['cod_gestion'];
        $sql1="SELECT cod_mes from meses_trabajo where cod_gestion='$codGestionActiva' and cod_estadomesestrabajo=3";
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->execute();
        while ($row1= $stmt1->fetch(PDO::FETCH_ASSOC)) {
          $codMesActiva=$row1['cod_mes'];
        }
      }
      $nombreGestion=nameGestion($codGestionActiva);

      $_SESSION['globalUser']=$codigo;
      $_SESSION['globalNameUser']=$nombre;
      $_SESSION['globalGestion']=$codGestionActiva;
      $_SESSION['globalMes']=$codMesActiva;
      $_SESSION['globalNombreGestion']=$nombreGestion;
      $_SESSION['globalUnidad']=$codUnidad;
      $_SESSION['globalNombreUnidad']=$nombreUnidad;
      $_SESSION['globalArea']=$codArea;
      $_SESSION['globalNombreArea']=$nombreArea;
      $_SESSION['logueado']=1;
      $_SESSION['globalPerfil']=$perfil;
      $_SESSION['globalAdmin']=$admin;

     $host= $_SERVER["HTTP_HOST"];
     require_once('layouts/layout.php');	
    }
	 // header("location:login.php?q=".$q);	
	}else{
    if(isset($_GET['e'])){
      $e=$_GET['e'];
      header("location:login.php?e=$e");  
    }else{
      header("location:login.html");
    }
      
	}

  //header("location:login.html"); 
}
 ?>
