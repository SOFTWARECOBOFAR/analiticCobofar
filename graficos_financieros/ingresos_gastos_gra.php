<?php

require_once '../layouts/bodylogin2.php';
require_once '../styles.php';
require_once '../functions.php';
require_once '../functionsGeneral.php';
require_once '../conexion.php';
$dbh = new Conexion();

// $nombre_gestion=2022;
if(isset($_GET['cod_area']) || isset($_GET['gestion'])){
    $cod_area = $_GET['cod_area'];
    $nombre_gestion = $_GET['gestion'];
    $cod_ingreso=4000;
    $cod_egreso=5000;
?>
<script>
    var arraymeses=[];
    var arrayingresos=[];
    var arrayegresos=[];
    
    var arrayPesajePor=[];
    // var arrayPesajeMonto=[];
    var arrayPesajeNom=[];
    arrayPesajePor.push(<?=formatNumberDec(100)?>);//el primer valor es 100
    arrayPesajeNom.push('TOTAL GASTOS');
</script>
<?php

$sqlEgresosIngresos="select er.gestion,er.mes,sum(er.ingreso) as ingreso,sum(er.egreso)as egreso,
(select sum(ef.egreso) from estado_resultados ef where ef.cod_area=er.cod_area and ef.cod_cuenta_n1=$cod_egreso and ef.gestion=er.gestion and ef.mes=er.mes and ef.estado_cuenta='CF')as costo_fijo,(select sum(ev.egreso) from estado_resultados ev where ev.cod_area=er.cod_area and ev.cod_cuenta_n1=$cod_egreso and ev.gestion=er.gestion and ev.mes=er.mes and ev.estado_cuenta='CV')as costo_variable
from estado_resultados er
where er.cod_area=$cod_area and er.gestion=$nombre_gestion 
GROUP BY er.mes,er.gestion";//and er.mes<>1
// echo $sqlEgresosIngresos;
$stmt = $dbh->prepare($sqlEgresosIngresos);
$stmt->execute();
$cont_prom=0;
$suma_ingresos=0;
$suma_egresos=0;
$suma_costo_fijo=0;
$suma_costo_variable=0;
$arraycomparativomensual=[];
$arrayMeses=[];
$montoIngAnt=0;
$montoEgreAnt=0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cont_prom++;
    //$cod_cuenta_n1=$row['cod_cuenta_n1'];
    // $gestion=$row['gestion'];
    $mes=$row['mes'];
    $ingreso=$row['ingreso'];
    $egreso=$row['egreso'];
    $resultado=$ingreso-$egreso;    
    $suma_ingresos+=$ingreso;
    $suma_egresos+=$egreso;
    $costo_fijo=$row['costo_fijo'];
    $costo_variable=$row['costo_variable'];
    $suma_costo_fijo+=$costo_fijo;
    $suma_costo_variable+=$costo_variable;
    $por_ingreso=0;
    $por_egreso=0;
    if($montoIngAnt>0 && $ingreso>0){
        $por_ingreso=(($ingreso/$montoIngAnt)-1)*100;        
    }
    if($montoEgreAnt>0 && $egreso>0){
        $por_egreso=(($egreso/$montoEgreAnt)-1)*100;
    }
    $montoIngAnt=$ingreso;
    $montoEgreAnt=$egreso;
    
    $cant_personas=0;
    $arraycomparativomensual[$mes]=[$ingreso,$egreso,$resultado,$por_ingreso,$por_egreso,$cant_personas,$mes];
    $arrayMeses[]=abrevMes($mes)."/".$nombre_gestion;
    ?>
    <script>
        arrayingresos.push(<?=$ingreso?>);
        arraymeses.push('<?=abrevMes($mes)."/".$nombre_gestion?>');
        arrayegresos.push(<?=$egreso?>);
    </script>
    <?php
} 

//promedios por dia y mes
// echo $cont_prom;
// $cont_prom=16;
if($suma_ingresos>0){
    $prom_ing_mes=round($suma_ingresos/$cont_prom,2);
    $prom_ing_dia=round($prom_ing_mes/30,2);
}else{
    $prom_ing_mes=0;
    $prom_ing_dia=0;
}

if($suma_egresos>0){
    $prom_egre_mes=round($suma_egresos/$cont_prom,2);
    $prom_egre_dia=round($prom_egre_mes/30,2);
}else{
    $prom_egre_mes=0;
    $prom_egre_dia=0;
}
if($suma_costo_fijo>0){
    $prom_costo_fijo=$suma_costo_fijo/$cont_prom;
    $prom_costo_variable=$suma_costo_variable/$cont_prom;
}else{
    $prom_costo_fijo=0;
    $prom_costo_variable=0;
}

$total_ing_egre=$suma_ingresos+$suma_egresos;
$resultado_total=$suma_ingresos-$suma_egresos;
if($resultado_total>=0){
    $estilo_resultado='style="color:green"';
}else{
    $estilo_resultado='style="color:red"';
}

//% de variacion
if($suma_ingresos>0){
    $por_var_ing=round($suma_ingresos*100/$total_ing_egre,2);
    $por_var_egre=round($suma_egresos*100/$total_ing_egre,2);
}else{
    $por_var_ing=0;
    $por_var_egre=0;
}


//punto de equilibrio
// =(M28/(1-(N28/L28)))
if($prom_costo_fijo>0){
    $punto_equil_mes=round(($prom_costo_fijo/(1-($prom_costo_variable/$prom_ing_mes))),2);
    $punto_equil_dia=round($punto_equil_mes/30,2);
}else{
    $punto_equil_mes=0;
    $punto_equil_dia=0;
}


//PESAJE DE GASTOS
$arrayPesajeMonto[]=$suma_egresos;
$sqlPesaje="SELECT ev.cod_cuenta_n4,ev.cuenta_n4,sum(ev.egreso)as monto
from estado_resultados ev
where ev.cod_area=$cod_area and ev.cod_cuenta_n1=$cod_egreso and ev.gestion=$nombre_gestion
GROUP BY ev.cod_cuenta_n4 order by monto desc";
$stmtPesaje = $dbh->prepare($sqlPesaje);
$stmtPesaje->execute();
$sumaPorGastosMen=0;
$sumaMontoGastosMen=0;
while ($row = $stmtPesaje->fetch(PDO::FETCH_ASSOC)) {
    $cod_cuenta_n4_pg=$row['cod_cuenta_n4'];
    $cuenta_n4_pg=$row['cuenta_n4'];
    $monto_pg=$row['monto'];
    $porcentaje_pg=round($monto_pg*100/$suma_egresos,2);
    if($cod_cuenta_n4_pg==5003 || $cod_cuenta_n4_pg== 5009 || $cod_cuenta_n4_pg== 5041 || $cod_cuenta_n4_pg== 5030){//solo estas cuentas serán visibles
        ?>
        <script>
            arrayPesajePor.push(<?=$porcentaje_pg?>);
            arrayPesajeNom.push('<?=$cuenta_n4_pg?>');
        </script>
        <?php
        $arrayPesajeMonto[]=$monto_pg;
    }else{
        $sumaPorGastosMen+=$porcentaje_pg;
        $sumaMontoGastosMen+=$monto_pg;
    }
}
$arrayPesajeMonto[]=$sumaMontoGastosMen;
//cantidad de personas
$sqlPesaje="select mes,cantidad_personal,cantidad_regentes,cantidad_auxiliares from personal_mes where gestion=$nombre_gestion and cod_area=$cod_area";
$stmtPesaje = $dbh->prepare($sqlPesaje);
$stmtPesaje->execute();
$sumaCantidadPer=0;$sumaCantidadReg=0;$sumaCantidadAux=0;
$arrayCantidadPer=[];
while ($row = $stmtPesaje->fetch(PDO::FETCH_ASSOC)) {
    $mesPersonal=$row['mes'];
    $cantidad_personal=$row['cantidad_personal'];
    $cantidad_regentes=$row['cantidad_regentes'];
    $cantidad_auxiliares=$row['cantidad_auxiliares'];
    $sumaCantidadPer+=$cantidad_personal;
    $sumaCantidadReg+=$cantidad_regentes;
    $sumaCantidadAux+=$cantidad_auxiliares;
    $arrayCantidadPer[$mesPersonal]=[$cantidad_personal,$cantidad_regentes,$cantidad_auxiliares];
}
if($sumaCantidadPer>0){
    $promedio_personal=round($sumaCantidadPer/$cont_prom);
    $promedio_regentes=round($sumaCantidadReg/$cont_prom);
    $promedio_auxiliares=round($sumaCantidadAux/$cont_prom);
}else{
    $promedio_personal=0;
    $promedio_regentes=0;
    $promedio_auxiliares=0;
}

//Ranking Areas
$sqlRanking="select er.gestion,er.cod_area,a.nombre,IFNULL(sum(er.ingreso),0) - IFNULL(sum(er.egreso),0)as resultado
from estado_resultados er join areas a on er.cod_area=a.codigo
where er.gestion=$nombre_gestion and a.bandera_r=1
GROUP BY er.gestion,er.cod_area
order by resultado desc";
$stmtRanking = $dbh->prepare($sqlRanking);
$stmtRanking->execute();
$arrayRanking=[];
$indice_ranking=1;
while ($row = $stmtRanking->fetch(PDO::FETCH_ASSOC)) {
    $cod_areaR=$row['cod_area'];
    $nombreR=$row['nombre'];
    $resultadoR=$row['resultado'];
    $arrayRanking[$cod_areaR]=$indice_ranking;
    $indice_ranking++;
}

?>
<script>
arrayPesajePor.push(<?=round($sumaPorGastosMen,2)?>);
arrayPesajeNom.push('OTROS GASTOS MENORES');
</script>

<link rel="stylesheet" href="./librerias/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<!-- <script src="./librerias/Chart.bundle.min.js.descarga"></script> -->
<script type="text/javascript" src="./librerias/chartjs-plugin-labels.js"></script>
<main>

    
    <div class="row">
        <div class="col-md-10">
            <h1>ANÁLISIS DE INGRESOS Y GASTOS</h1>        
        </div>
        <div class="col-md-2">
            <?php if(isset($arrayRanking[$cod_area])){ ?>
            <table>
                <tr>
                   <td><span style="font-size:40px;color:yellow;"><?=$arrayRanking[$cod_area]?></span></td> 
                   <td valign="top">
                    <?php
                    $estiloPlatino="style='display: none;'";
                    $estiloOro="style='display: none;'";
                    $estiloPlata="style='display: none;'";  
                    $estiloBronce="style='display: none;'";  
                    if($arrayRanking[$cod_area]>=1 && $arrayRanking[$cod_area]<=10){ 
                        $estiloPlatino="";
                    }else{
                        if($arrayRanking[$cod_area]>=11 && $arrayRanking[$cod_area]<=20){
                            $estiloOro="";
                        }else{
                            if($arrayRanking[$cod_area]>=21 && $arrayRanking[$cod_area]<=50){
                              $estiloPlata="";  
                            }else{
                                $estiloBronce="";  
                            }   
                        }   
                    }?>
                    <img src="../assets/img/platino.png" width="30px" <?=$estiloPlatino?>>
                    <img src="../assets/img/oro.png" width="30px" <?=$estiloOro?>>
                    <img src="../assets/img/plata.png" width="30px" <?=$estiloPlata?>>
                    <img src="../assets/img/bronce.png" width="30px" <?=$estiloBronce?>>
                   </td> 
                </tr>
            </table>
            <?php }else{ ?>
                <span style="font-size:40px;color:red;">R:0</span>
            <?php }?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7"><p>(CON ANÁLISIS DE VARIACIÓN EN INCREMENTO Y/O DISMINUCIÓN PORCENTUAL) - KPI<br>(Expresado en Bolivianos)</p></div>
        <label class="col-sm-1 col-form-label">Gestion</label>
        <div class="col-sm-1">
            <div class="form-group">
                <select name="cod_gestion" id="cod_gestion" class="selectpicker form-control form-control-sm" data-style="btn btn-primary"  data-show-subtext="true" data-live-search="true" required="true" onChange="cambiarGestionArea_ie();">
                    <?php 
                    $sqlGestion = "select codigo,nombre from gestiones where cod_estado=1 order by nombre";
                    $stmtGestion = $dbh->query($sqlGestion);
                    while ($rowGestion = $stmtGestion->fetch()){ ?>
                        <option <?=($nombre_gestion==$rowGestion["codigo"])?"selected":"";?> value="<?=$rowGestion["codigo"];?>"><?=$rowGestion["nombre"];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <label class="col-sm-1 col-form-label">Sucursal</label>
        <div class="col-sm-2">
            <div class="form-group">
                <select name="cod_sucursal" id="cod_sucursal" class="selectpicker form-control form-control-sm" data-style="btn btn-primary"  data-show-subtext="true" data-live-search="true" required="true" onChange="cambiarGestionArea_ie();">
                    <?php 
                    $sqlAreas = "select codigo,nombre from areas where cod_estado=1 and bandera_r=1 order by nombre";
                    $stmtAreas = $dbh->query($sqlAreas);
                    while ($row = $stmtAreas->fetch()){ ?>
                        <option <?=($cod_area==$row["codigo"])?"selected":"";?> value="<?=$row["codigo"];?>"><?=$row["nombre"];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <section class="cols-1">
        <figure>
            <h2>Gráfico de análisis comparativo mensual :</h2>
            <canvas id="gra_comparativo_mes"  height="300px"></canvas>
            <table id="table table-bordered" width="100%" border="1" bordercolor="#00CC66" >
                <tr><td></td>
                    <?php foreach ($arrayMeses as $arrayMes){?>
                        <td class="text-center"><b><?=$arrayMes?></b></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td width="6%" valign="top">INGRESO<BR>EGRESO<BR>RESULTADO<BR>% INGRESO<BR>% EGRESO<BR>#PERSONAL<BR>#REGENTES<BR>#AUXILIARES</td>
                    <?php foreach ($arraycomparativomensual as $arraydatos){
                        $ingreso=$arraydatos[0];
                        $egreso=$arraydatos[1];
                        $resultado=$arraydatos[2];
                        $por_ingreso=$arraydatos[3];
                        $por_egreso=$arraydatos[4];
                        $cant_personas=$arraydatos[5];
                        $mesX=$arraydatos[6];
                        if($resultado>0){
                            $estilo_resul="style='font-size:13px;color:#00CC66;'";
                        }elseif($resultado<0){
                            $estilo_resul="style='font-size:13px;color:red;'";
                        }else{
                           $estilo_resul="style='font-size:13px;color:blue;'"; 
                        }

                        if(isset($arrayCantidadPer[$mesX])){
                            $cantidadPersonalMes=$arrayCantidadPer[$mesX][0];
                            $cantidadRegentesMes=$arrayCantidadPer[$mesX][1];
                            $cantidadAuxiliaresMes=$arrayCantidadPer[$mesX][2];
                        }else{
                            $cantidadPersonalMes=0;
                            $cantidadRegentesMes=0;
                            $cantidadAuxiliaresMes=0;
                        }
                        ?>
                        <td width="8%" valign="top" class="text-right"><?=formatNumberDec($ingreso)?><BR><?=formatNumberDec($egreso)?><BR><span <?=$estilo_resul?>><?=formatNumberDec($resultado)?></span><BR><?=formatNumberDec($por_ingreso)?><BR><?=formatNumberDec($por_egreso)?><BR><center><?=$cantidadPersonalMes?><BR><?=$cantidadRegentesMes?><BR><?=$cantidadAuxiliaresMes?></center></td>    
                    <?php } ?>
                </tr>
            </table>
        </figure>
    </section>
    <section class="cols-2">
        <figure class="figure2">
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color: rgba(255,255,255,.03);padding: 10px 10px 30px;width: 100%;">
                        <center><h2>PROMEDIO EN CANTIDAD DEL PERSONAL : </h2><br><span style="font-size:58px;color: yellow;"><?=$promedio_personal?></span><br><span style="font-size:20px;color: orange;"><br>Regentes : <?=$promedio_regentes?><br>Auxiliares: <?=$promedio_auxiliares?></span></center>    
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color: rgba(255,255,255,.03);padding: 10px 10px 30px;width: 100%;">
                        <center><h2>
                            TOTAL INGRESOS :<br><span style="color:#304FFE"><?=formatNumberDec($suma_ingresos)?></span><br>
                            TOTAL EGRESOS :<br><span style="color:orange;"><?=formatNumberDec($suma_egresos)?></span><br>
                            RESULTADO TOTAL :<br><span <?=$estilo_resultado?>><?=formatNumberDec($resultado_total)?></</span>
                        </h2></center>    
                    </div>
                    
                </div>
            </div>
        </figure>
        <figure>
            <h2>Ingresos y Gastos promedio mensual y diario :</h2>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="gra_ing_promedio_mes" height="180px" ></canvas>
                    <center><span style="font-size:17px ;color:rgba(0, 200, 83,1);"><b><?=formatNumberDec($prom_ing_mes)?></b></span></center>
                </div>
               <div class="col-md-6">
                    <canvas id="gra_ing_promedio_dia" height="170px" ></canvas>
                    <center><span style="font-size:17px ;color:rgba(129, 199, 132,1);"><b><?=formatNumberDec($prom_ing_dia)?></b></span></center>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="gra_egre_promedio_mes" height="180px" ></canvas> 
                    <center><span style="font-size:17px ;color:rgba(255, 0, 0,1);"><b><?=formatNumberDec($prom_egre_mes)?></b></span></center>
                </div>
                
               <div class="col-md-6">
                    <canvas id="gra_egre_promedio_dia" height="170px" ></canvas> 
                    <center><span style="font-size:17px ;color:rgba(255, 152, 0,1);"><b><?=formatNumberDec($prom_egre_dia)?></b></span></center>
                </div>
            </div>
        </figure>
        
        <figure class="figure3">
            <div class="row">
                <div class="col-md-12">
                    <h2>Punto de Equilibrio :</h2>
                    <canvas id="gra_punto_equilibrio" height="180px" ></canvas> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                   <h2>Pesaje de Gastos :</h2>
                    <table id="table table-bordered" width="100%" border="1" bordercolor="#00CC66" >
                        <tr>
                            <!-- <td></td> -->
                            <script type="text/javascript">
                                arrayPesajeNom.forEach(function(word) {
                                  //document.write( "<td>"+ word + "</td>" );
                                });
                            </script>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <?php
                            foreach ($arrayPesajeMonto as $value) {?>
                                <td width='15%' valign='top' class='text-right'><?=formatNumberDec($value)?></td>
                            <?php }
                            ?>
                        </tr>
                    </table>
                    <canvas id="gra_pesaje_gastos" height="180px" ></canvas>

                </div>
            </div>
        </figure>
    </section>
</main>

<script >
    
    var gestion=<?=$nombre_gestion?>;
    var ctx=document.getElementById("gra_comparativo_mes").getContext("2d");
    var mychart= new Chart(ctx,{
        type:"bar",
        data:{
            labels:arraymeses,
            datasets:[{
                label:'Ingresos',
                data:arrayingresos,
                backgroundColor:[
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)'
                    ],
                borderColor: [
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)'],
                borderWidth: 1
            },{
                label:'Egresos',
                data:arrayegresos,
                backgroundColor:[
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)'
                    ],
                borderColor: [
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)',
                    'rgba(255, 0, 0,1)'],
                borderWidth: 1

            }]
        },
        options:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZaero:true
                    }
                }]
            },
            plugins: {
              labels: {
                render: 'image'
              }
            }
        }
    });

    var opciones = {
        cutoutPercentage: 90,
        responsive: true,
        tooltips: {
            enabled: false
        },
        plugins: {
              labels: {
                render: 'image'
              }
            }      
    }
    var configGra_ing_x_mes = {
        type: 'doughnut',
        data: {
            labels:['Ingreso Mensual'],
            datasets:[{
                data:[<?=$por_var_ing?>,<?=$por_var_egre?>],
                backgroundColor:[
                    'rgba(0, 200, 83,0.8)',//fuerte
                    'rgba(0, 200, 83,0.2)'
                    ],
                borderColor: [
                    'rgba(0, 200, 83,1)',
                    'rgba(0, 200, 83,1)'
                    ],
                borderWidth:1
            }]
        },
        options: opciones
        ,
        plugins: [{
            id: 'total1',
            beforeDraw: function(chart) {
                const width = chart.chart.width;
                const height = chart.chart.height;
                const ctx = chart.chart.ctx;
                ctx.restore();
                const fontSize = (height / 80).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = 'middle';
                var total1 = '<?=formatNumberDec($por_var_ing)?> %';
                const text = total1;
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 1.8;
                ctx.fillStyle = 'rgba(0, 200, 83,1)';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    };
    var ctx = document.getElementById("gra_ing_promedio_mes").getContext("2d");
    var mychart = new Chart(ctx, configGra_ing_x_mes);

    var configGra_egre_x_mes = {
        type: 'doughnut',
        data: {
            labels:['Egreso Mensual'],
            datasets: [{
                data: [
                    <?=$por_var_egre?>,<?=$por_var_ing?>
                ],
                backgroundColor:[
                'rgba(255, 0, 0,0.8)',
                'rgba(255, 0, 0,0.2)'
                ],
                borderColor: [
                'rgba(255, 0, 0,1)',
                'rgba(255, 0, 0,1)'
                ],
                borderWidth:1
            }]
        },
        options: opciones,
        plugins: [{
            id: 'total',
            beforeDraw: function(chart) {
                const width = chart.chart.width;
                const height = chart.chart.height;
                const ctx = chart.chart.ctx;
                ctx.restore();
                const fontSize = (height / 80).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = 'middle';
                var total = '<?=formatNumberDec($por_var_egre)?> %';
                const text = total;
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 1.8;
                ctx.fillStyle = 'rgba(255, 0, 0,1)';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    };
    var ctx = document.getElementById("gra_egre_promedio_mes").getContext("2d");
    var mychart1 = new Chart(ctx, configGra_egre_x_mes);

    var configGra_ing_x_dia = {
        type: 'doughnut',
        data: {
            labels:['Ingreso por día'],
            datasets:[{
                data:[<?=$por_var_ing?>,<?=$por_var_egre?>],
                backgroundColor:[
                    'rgba(129, 199, 132,0.8)',//fuerte
                    'rgba(129, 199, 132,0.2)'
                    ],
                borderColor: [
                    'rgba(129, 199, 132,1)',
                    'rgba(129, 199, 132,1)'
                    ],
                borderWidth:1
            }]
        },
        options: opciones
        ,
        plugins: [{
            id: 'total1',
            beforeDraw: function(chart) {
                const width = chart.chart.width;
                const height = chart.chart.height;
                const ctx = chart.chart.ctx;
                ctx.restore();
                const fontSize = (height / 80).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = 'middle';
                var total1 = '<?=formatNumberDec($por_var_ing)?> %';
                const text = total1;
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 1.8;
                ctx.fillStyle = 'rgba(129, 199, 132,1)';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    };
    var ctx = document.getElementById("gra_ing_promedio_dia").getContext("2d");
    var mychart = new Chart(ctx, configGra_ing_x_dia);

    var configGra_egre_x_dia = {
        type: 'doughnut',
        data: {
            labels:['Egreso por día'],
            datasets: [{
                data: [
                    <?=$por_var_egre?>,<?=$por_var_ing?>
                ],
                backgroundColor:[
                'rgba(255, 152, 0,0.8)',
                'rgba(255, 152, 0,0.2)'
                ],
                borderColor: [
                'rgba(255, 152, 0,1)',
                'rgba(255, 152, 0,1)'
                ],
                borderWidth:1
            }]
        },
        options: opciones,
        plugins: [{
            id: 'total',
            beforeDraw: function(chart) {
                const width = chart.chart.width;
                const height = chart.chart.height;
                const ctx = chart.chart.ctx;
                ctx.restore();
                const fontSize = (height / 80).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = 'middle';
                var total = '<?=formatNumberDec($por_var_egre)?> %';
                const text = total;
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 1.8;
                ctx.fillStyle = 'rgba(255, 152, 0,1)';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    };
    var ctx = document.getElementById("gra_egre_promedio_dia").getContext("2d");
    var mychart1 = new Chart(ctx, configGra_egre_x_dia);



    var configGra_punto_equi = {
        type:"horizontalBar",
        data:{
            labels:['Punto Eq mes','Ven Prom Mes','Punto Eq dia','Ven Prom dia'],
            datasets:[{
                // label:'s',
                data:[<?=$punto_equil_mes?>,<?=$prom_ing_mes?>,<?=$punto_equil_dia?>,<?=$prom_ing_dia?>],
                backgroundColor:[
                    'rgba(41, 182, 246,0.5)',
                    'rgba(0, 200, 83,0.5)',
                    'rgba(41, 182, 246,0.5)',
                    'rgba(129, 199, 132,0.5)'
                    ],
                borderColor: [
                    'rgba(41, 182, 246,1)',
                    'rgba(0, 200, 83,1)',
                    'rgba(41, 182, 246,1)',
                    'rgba(129, 199, 132,1)'],
                borderWidth: 1
            }]
        },
        options:{
            legend: {
                display: false
            },
            responsive: true
            
        }

    }
    var ctx=document.getElementById("gra_punto_equilibrio").getContext("2d");
    var mychart5 = new Chart(ctx, configGra_punto_equi);
    var configGra_pesaje_gastos = {
        type:"bar",
        data:{
            labels:arrayPesajeNom,
            datasets:[{
                label:'GASTOS',
                data:arrayPesajePor,
                backgroundColor:[
                    'rgba(77, 208, 225,0.5)',
                    'rgba(238, 255, 65,0.5)',
                    'rgba(245, 127, 23,0.5)',
                    'rgba(94, 53, 177,0.5)',
                    'rgba(41, 182, 246,0.5)',
                    'rgba(57, 73, 171,0.5)'
                    ],
                borderColor: [
                    'rgba(77, 208, 225,1)',
                    'rgba(238, 255, 65,1)',
                    'rgba(245, 127, 23,1)',
                    'rgba(94, 53, 177,1)',
                    'rgba(41, 182, 246,1)',
                    'rgba(57, 73, 171,1)'
                    ],
                borderWidth: 1
            }]
        },
        
        options: {
            tooltips: false,
            // responsive: true,
            // legend: {
            //   display: false
            // },
            plugins: {
              labels: {
                // render: 'value',
                render: function (args) {
                  return args.value+' %';
                },
                fontColor: ['yellow', 'yellow', 'yellow','yellow', 'yellow','yellow'],
                precision: 2,
                fontSize: 14,
                fontStyle: 'bold',
                // fontColor: '#000',
                fontFamily: '"Lucida Console", Monaco, monospace'

              }
            }

        },
        

    }
    var ctx=document.getElementById("gra_pesaje_gastos").getContext("2d");
    var mychart6 = new Chart(ctx, configGra_pesaje_gastos);

    
 
</script>

<?php
}else{
    echo "nada";
}
?>