<?php
//include("functionsGeneral.php");

$globalUserX=$_SESSION['globalUser'];
//echo $globalUserX;
$globalPerfilX=$_SESSION['globalPerfil'];
$globalNameUserX=$_SESSION['globalNameUser'];
$globalNombreUnidadX=$_SESSION['globalNombreUnidad'];
$globalNombreAreaX=$_SESSION['globalNombreArea'];

$menuModulo=$_SESSION['modulo'];
switch ($menuModulo) {
  case 1:
   $nombreModulo="HOME";
   $estiloMenu="celestebebe";
  break;
}

?>
<div class="sidebar" data-color="purple" data-background-color="<?=$estiloMenu?>" data-image="assets/img/sidebar-1.jpg">
  <div class="sidebar-wrapper">
    <div class="user" style="background: #FF5733;">
      <div class="photo" style="width:50px !important;height:50px !important;" >
        <img src="assets/img/default-avatar.png" />
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <b><span><?=$globalNameUserX;?></span></b>
        </a>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.php?opcion=homeModulo">
          <p> <?=$nombreModulo?></p>
        </a>
      </li>  
      <!-- TABLAS RRHH-->
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
          <i class="material-icons" style="color: #9C27B0;">room</i>
          <p> Ubicación
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="pagesExamples">
          <ul class="nav">     
            <li class="nav-item ">
              <a class="nav-link" href="http://10.10.1.14/cobofar_reportes/mapas/home_mapa_init.php">
                <span class="sidebar-mini"> C </span>
                <span class="sidebar-normal"> Competencia</span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://10.10.1.14/cobofar_reportes/pages/competencia.php">
                <span class="sidebar-mini"> S </span>
                <span class="sidebar-normal"> Sucursales</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
     
      <!--TRANSACCIONES RRHH-->
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#transacc">
          <i class="material-icons" style="color: orange;">insert_chart</i>
          <p> Graficos 
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="transacc">
          <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="graficos_financieros/ingresos_gastos_gra.php?cod_area=80&gestion=2022" target="_blank">
                  <span class="sidebar-mini"> AIG </span>
                  <span class="sidebar-normal"> Análisis Ingresos & Gastos</span>
                </a>
            </li>            
          </ul>
        </div>
      </li>
      <!--REPORTES RRHH-->
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#reportesConta">
          <i class="material-icons" style="color: #4FC3F7;">text_snippet</i>
          <p> Reportes 
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="reportesConta">
          <ul class="nav">                
            <li class="nav-item ">
                <a class="nav-link" href="?opcion=rankingSucursalesIE&gestion=2022"  style="background:#dab6aa; color:#584f4c;font-weight:bold;">
                  <span class="sidebar-mini"> RSA </span>
                  <span class="sidebar-normal">Ranking de Sucursales Anual</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="?opcion=rankingSucursalesMes&gestion=2022&mes=1"  style="background:#dab600; color:#584f4c;font-weight:bold;">
                  <span class="sidebar-mini"> RSA </span>
                  <span class="sidebar-normal">Ranking de Sucursales Mensual</span>
                </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
