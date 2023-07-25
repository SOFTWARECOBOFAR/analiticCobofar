<?php

// require_once 'layouts/bodylogin2.php';
// require_once 'styles.php';
require_once 'functions.php';
require_once 'functionsGeneral.php';
require_once 'conexion.php';
 $dbh = new Conexion();
if(isset($_GET['gestion'])){
    $nombre_gestion = $_GET['gestion'];
}else{
    $nombre_gestion = 2022;
}
?>
<!-- <link rel="stylesheet" href="librerias/style.css"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->
<!-- <script src="./librerias/Chart.bundle.min.js.descarga"></script> -->
<!-- <script type="text/javascript" src="./librerias/chartjs-plugin-labels.js"></script> -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header <?=$colorCard;?> card-header-icon">
          <h4 class="card-title"> <img  class="card-img-top"  src="assets/img/favicon.png" style="width:100%; max-width:50px;">RANKING DE SUCURSALES<br></h4>
          <div class="row">
            <label class="col-sm-1 col-form-label">Gestion</label>
            <div class="col-sm-1">
                <div class="form-group">
                    <select name="cod_gestion" id="cod_gestion" class="selectpicker form-control form-control-sm" data-style="btn btn-primary"  data-show-subtext="true" data-live-search="true" required="true" onChange="cambiarGestionRanking();">
                        <?php 
                        $sqlGestion = "select codigo,nombre from gestiones where cod_estado=1 order by nombre";
                        $stmtGestion = $dbh->query($sqlGestion);
                        while ($rowGestion = $stmtGestion->fetch()){ ?>
                            <option <?=($nombre_gestion==$rowGestion["codigo"])?"selected":"";?> value="<?=$rowGestion["codigo"];?>"><?=$rowGestion["nombre"];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body ">
          <div class="table-responsive">
        
            <table class='table table-bordered table-condensed' >
                <tr>
                    <th>Nro</th>
                    <th>Sucursal</th>
                    <th>Monto</th>
                    <th>-</th>
                </tr>
                <?php 

                 //Ranking Areas
                $sqlRanking="select er.cod_area,a.nombre,IFNULL(sum(er.ingreso),0) - IFNULL(sum(er.egreso),0)as resultado
                from estado_resultados er join areas a on er.cod_area=a.codigo
                where er.gestion=$nombre_gestion and a.bandera_r=1
                GROUP BY er.cod_area
                order by resultado desc";
                $stmtRanking = $dbh->prepare($sqlRanking);
                $stmtRanking->execute();
                $indice_ranking=1;
                while ($row = $stmtRanking->fetch(PDO::FETCH_ASSOC)) {
                    $cod_areaR=$row['cod_area'];
                    $nombreR=$row['nombre'];
                    $resultadoR=$row['resultado'];
                    ?>
                    <tr>
                        <td><?=$indice_ranking;?></td>
                        <td class="text-left"><?=$nombreR?></td>
                        <td class="text-right"><?=formatNumberDec($resultadoR)?></td>
                        <td  class="td-actions text-right">    
                            <a href='graficos_financieros/ingresos_gastos_gra.php?cod_area=<?=$cod_areaR?>&gestion=<?=$nombre_gestion?>' target="_blank" rel="tooltip" class="btn btn-primary">
                              <i class="material-icons" title="VER ANÁLISIS DE INGRESOS Y GASTOS">analytics</i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $indice_ranking++;                
                } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
