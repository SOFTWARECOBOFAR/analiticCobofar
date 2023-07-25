<?php 
//header('Content-Type: text/html; charset=iso-8859-1');
  require_once 'functions.php';
  //require_once 'functionsGeneral.php';
	include("head.php");
  include("librerias.php");// se debe cambiar a la parte posterior
?>    
    <div class="">
      <div class="wrapper">
      <?php 
          $_SESSION['modulo']=1;//solo hay un modulo
          // $tipoLogin=obtenerValorConfiguracion(-10);
          $tipoLogin=1;
          if(!isset($_GET['opcion'])){
            $_GET['opcion']="homeModulo";
          }
          if(!isset($_GET['q'])){
            if($tipoLogin==1){
              include("menu.php");
            }else{
              include("menuService.php");
            }
            include("cabecera.php");
          }
          require_once('routing.php');       
      ?>  
      </div><!-- el div que abre se encuentra dentro de cabecera al principio de NavBar Como en la documentación-->    
    </div>
   </div> 
<?php 
  //poner aqui librerias
if(!isset($_GET['opcion'])){
  ?><script type="text/javascript">
           $(document).ready(function(e) { 
               $("#minimizeSidebar").click()
               $("#minimizeSidebar").addClass("d-none");
             });
    </script><?php
}else{
  if(isset($_GET['q'])){
    ?><script type="text/javascript">
           $(document).ready(function(e) { 
               $("#minimizeSidebar").click()
               $("#minimizeSidebar").addClass("d-none");
             });
    </script><?php
  }
}
?>