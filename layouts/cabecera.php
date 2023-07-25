<?php 
if(isset($_GET['q'])){
   $q=$_GET['q'];
   $url= $_GET["opcion"];
  $urlListGestionTrabajo="#";
  $urllistUnidadOrganizacional="#";
  $urmesCurso="#";
  $urmesCurso2="#";
}else{
  $urlListGestionTrabajo="index.php?opcion=listGestionTrabajo";
  $urllistUnidadOrganizacional="index.php?opcion=listUnidadOrganizacional";
  $urmesCurso="index.php?opcion=mesCurso";
  $urmesCurso2="index.php?opcion=mesCurso2"; 
}
?>
<div class="main-panel">
<!-- Navbar -->
      <nav class="navbar navbar-expand-sm navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid" style="background: #27305A" >
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-sm btn-just-icon btn-white btn-fab " style="background:#FF5733 !important;color:#fff;">
                <i class="material-icons text_align-center visible-on-sidebar-regular" >more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
            <?php 
              $globalNombreGestion=$_SESSION['globalNombreGestion'];
              // $globalMes=$_SESSION['globalMes'];
              $globalNombreUnidad=$_SESSION['globalNombreUnidad'];
              $globalNombreArea=$_SESSION['globalNombreArea'];
              $fechaSistema=date("d/m/Y");
              $horaSistema=date("H:i");
            ?>
            
            <a href="<?=$add_menu?>index.php"><img class="img-responsive" src="assets/img/farmacias_bolivia1.gif" width="300" height="60" alt="#" /></a>
            <!-- <h6 style="color:#FFFFFF;">Gesti&oacute;n Trabajo: </h6>&nbsp;<h4 class="text-danger font-weight-bold"><a title="Cambiar Gestión de Trabajo" style="color:#FF0000;" href='<=$urlListGestionTrabajo?>' >[<=$globalNombreGestion;?>]</a></h4> -->
            &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;
            <!-- <h6 style="color:#FFFFFF;">Unidad: </h6>&nbsp;<h4 class="text-danger font-weight-bold"><a title="Cambiar Oficina de Trabajo" style="color:#FF0000; " href='<=$urllistUnidadOrganizacional?>' >[ <=$globalNombreUnidad;?> ]</a></h4> &nbsp;&nbsp; <h6 style="color:#FFFFFF;">Area: </h6>&nbsp;<h4 class="text-danger font-weight-bold"><a title="Aceptar Solicitud" style="color:#FF0000; " href='#' >[ <=$globalNombreArea;?> ]</a></h4> -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              
<?php
require_once 'conexion.php';
require_once 'functions.php';
require_once 'functionsGeneral.php';

//verificar si hay bonos indefinidos
// bonosIndefinidos();

//enviar alertas a correos
//enviarNotificacionesSistema(1);

$fechaActual=date("Y-m-d");
$html="";
$contMonedas=0;

if($contMonedas==0){
  $html='<label class="dropdown-item">No hay Notificaciones</label>';
  // $numeroNot='';  
  $numeroNot='<span class="notification" >'.$contMonedas.'</span>'; 
}else{
 $numeroNot='<span class="notification">'.$contMonedas.'</span>'; 
}

 
if(!isset($_GET['q'])){
 ?>

              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons" style="color:#FFFFFF;">notifications</i>
                  <?=$numeroNot?>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?=$html?>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons" style="color:#FFFFFF;">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Salir</a>
                </div>
              </li>
              <?php
               } ?>
            </ul>
          </div>
        </div>
      </nav>
<!-- End Navbar -->