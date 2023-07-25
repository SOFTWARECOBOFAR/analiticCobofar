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

if(isset($_GET['mes'])){
    $mes = $_GET['mes'];
}else{
    $mes = 1;
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
          <h4 class="card-title"> <img  class="card-img-top"  src="assets/img/favicon.png" style="width:100%; max-width:50px;">RANKING DE SUCURSALES - MES<br></h4>
          <div class="row">
            <label class="col-sm-1 col-form-label">Gestion</label>
            <div class="col-sm-1">
                <div class="form-group">
                    <select name="cod_gestion" id="cod_gestion" class="selectpicker form-control form-control-sm" data-style="btn btn-primary"  data-show-subtext="true" data-live-search="true" required="true" onChange="cambiarGestionRankingMes();">
                        <?php 
                        $sqlGestion = "select codigo,nombre from gestiones where cod_estado=1 order by nombre";
                        $stmtGestion = $dbh->query($sqlGestion);
                        while ($rowGestion = $stmtGestion->fetch()){ ?>
                            <option <?=($nombre_gestion==$rowGestion["codigo"])?"selected":"";?> value="<?=$rowGestion["codigo"];?>"><?=$rowGestion["nombre"];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <label class="col-sm-1 col-form-label">Mes</label>
            <div class="col-sm-2">
                <div class="form-group">
                    <select name="cod_mes" id="cod_mes" class="selectpicker form-control form-control-sm" data-style="btn btn-primary"  data-show-subtext="true" data-live-search="true" required="true" onChange="cambiarGestionRankingMes();">
                        <option <?=($mes==1)?"selected":"";?> value="1">Enero</option>
                        <option <?=($mes==2)?"selected":"";?> value="2">Febrero</option>
                        <option <?=($mes==3)?"selected":"";?> value="3">Marzo</option>
                        <option <?=($mes==4)?"selected":"";?> value="4">Abril</option>
                        <option <?=($mes==5)?"selected":"";?> value="5">Mayo</option>
                        <option <?=($mes==6)?"selected":"";?> value="6">Junio</option>
                        <option <?=($mes==7)?"selected":"";?> value="7">Julio</option>
                        <option <?=($mes==8)?"selected":"";?> value="8">Agosto</option>
                        <option <?=($mes==9)?"selected":"";?> value="9">Septiembre</option>
                        <option <?=($mes==10)?"selected":"";?> value="10">Octubre</option>
                        <option <?=($mes==11)?"selected":"";?> value="11">Noviembre</option>
                        <option <?=($mes==12)?"selected":"";?> value="12">Diciembre</option>
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
                where er.gestion=$nombre_gestion and er.mes in ($mes) and a.bandera_r=1
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
