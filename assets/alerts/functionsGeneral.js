posicionarMenu();
$(window).scroll(function() {    
    posicionarMenu();
});
 
function posicionarMenu() {
    var altura_del_header = $('#cabecera_scroll').outerHeight(true);
    var altura_del_menu = $('.menu').outerHeight(true);
 
    if ($(window).scrollTop() >= altura_del_header){
        $('.menu').addClass('fixed');
        $('.wrapper_caja').css('margin-top', (altura_del_menu) + 'px');
        //poner boron copia
        if($("#segundo_copy").hasClass("d-none")){
          $("#segundo_copy").removeClass("d-none");
        }
    } else {
        $('.menu').removeClass('fixed');
        $('.wrapper_caja').css('margin-top', '0');
        //poner boron copia
        if(!($("#segundo_copy").hasClass("d-none"))){
          $("#segundo_copy").addClass("d-none");
        }
    }
}

function number_format(amount, decimals) {
  amount += ''; // por si pasan un numero en vez de un string
  amount = parseFloat(amount.replace(/[^0-9\.-]/g, '')); // elimino cualquier cosa que no sea numero o punto
  decimals = decimals || 0; // por si la variable no fue fue pasada
  // si no es un numero o es igual a cero retorno el mismo cero
  if (isNaN(amount) || amount === 0) 
      return parseFloat(0).toFixed(decimals);
  // si es mayor o menor que cero retorno el valor formateado como numero
  amount = '' + amount.toFixed(decimals);
  var amount_parts = amount.split('.');
      regexp = /(\d+)(\d{3})/;
  while (regexp.test(amount_parts[0]))
      amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
  return amount_parts.join('.');
}

function nuevoAjax()
{ var xmlhttp=false;
  try {
      xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
  } catch (e) {
  try {
    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
  } catch (E) {
    xmlhttp = false;
  }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
  xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function cambiarGestionArea_ie(){

  var cod_gestion = document.getElementById('cod_gestion').value;
  var cod_sucursal = document.getElementById('cod_sucursal').value;
  window.location.href="ingresos_gastos_gra.php?cod_area="+cod_sucursal+"&gestion="+cod_gestion;
}//unidad_area-cargo
function cambiarGestionRanking(){
  var cod_gestion = document.getElementById('cod_gestion').value;
  window.location.href="index.php?opcion=rankingSucursalesIE&gestion="+cod_gestion;
}//unidad_area-cargo

function cambiarGestionRankingMes(){
  // var cod_gestion = document.getElementById('cod_gestion').value;
  // var mes = document.getElementById('cod_mes').value;
  var cod_gestion=$("#cod_gestion").val();
  var cod_mes=$("#cod_mes").val();
  // alert(cod_mes);
  window.location.href="index.php?opcion=rankingSucursalesMes&gestion="+cod_gestion+"&mes="+cod_mes;
}//unidad_area-cargo

