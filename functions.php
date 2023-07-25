<?php
  require_once 'conexion.php';
  // require_once 'conexion_externa.php';
  //Enviar correo con funcion Enviar
  require_once 'notificaciones_sistema/PHPMailer/send.php';
  require_once 'notificaciones_sistema/PHPMailer/PHPMailer/src/Exception.php';
  require_once 'notificaciones_sistema/PHPMailer/PHPMailer/src/PHPMailer.php';
  require_once 'notificaciones_sistema/PHPMailer/PHPMailer/src/SMTP.php';

  date_default_timezone_set('America/La_Paz');

  function callService($parametros, $url){
    $parametros=json_encode($parametros);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    curl_close ($ch);
    return $remote_server_output;   
  }

  function nameMes($month){
    setlocale(LC_TIME, 'es_ES');
    $monthNum  = $month;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = strftime('%B', $dateObj->getTimestamp());
    return $monthName;
  }

  function abrevMes($month){
    if($month==1){    return ("Ene");   }
    if($month==2){    return ("Feb");  }
    if($month==3){    return ("Mar");  }
    if($month==4){    return ("Abr");  }
    if($month==5){    return ("May");  }
    if($month==6){    return ("Jun");  } 
    if($month==7){    return ("Jul");  }
    if($month==8){    return ("Ago");  }
    if($month==9){    return ("Sep");  }
    if($month==10){    return ("Oct");  }         
    if($month==11){    return ("Nov");  }         
    if($month==12){    return ("Dic");  }
  }
  function nombreMes($month){
    if($month==1){    return ("Enero");   }
    if($month==2){    return ("Febrero");  }
    if($month==3){    return ("Marzo");  }
    if($month==4){    return ("Abril");  }
    if($month==5){    return ("Mayo");  }
    if($month==6){    return ("Junio");  } 
    if($month==7){    return ("Julio");  }
    if($month==8){    return ("Agosto");  }
    if($month==9){    return ("Septiembre");  }
    if($month==10){    return ("Octubre");  }         
    if($month==11){    return ("Noviembre");  }         
    if($month==12){    return ("Diciembre");  }             
  }

  function nombreDia($month){
    if($month==1){    return ("Lunes");   }
    if($month==2){    return ("Martes");  }
    if($month==3){    return ("Miercoles");  }
    if($month==4){    return ("Jueves");  }
    if($month==5){    return ("Viernes");  }
    if($month==6){    return ("Sabado");  } 
    if($month==7){    return ("Domingo");  }    
  }

  function obtenerValorConfiguracion($codigo){
    require_once 'conexion.php';
    $dbh = new Conexion();
    $valor="";
    $sql = "select valor_configuracion from configuraciones where id_configuracion=$codigo";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $stmt->bindColumn('valor_configuracion', $valor);
    while ($rowDetalle = $stmt->fetch(PDO::FETCH_BOUND)) {
      $valor=$valor;
    }    
    return $valor;
  }
  function obtenerTotalferiados_fechas_ws($user,$password){
    $direccion=obtenerValorConfiguracion(1);//direccion des servicio web
    // $direccion="http://10.10.1.14/financieroCOBOFAR/wsifin/";
    $sIde = "bolfincobo";
    $sKey = "rrf656nb2396k6g6x44434h56jzx5g6";
    $parametros=array("sIdentificador"=>$sIde, "sKey"=>$sKey, 
      "accion"=>"VerificarDatosPersonal", 
      "u"=>$user,
      "p"=>$password);
    $parametros=json_encode($parametros);
    // abrimos la sesiรณn cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$direccion."ws_login_ifin.php");
    // indicamos el tipo de peticion: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // definimos cada uno de los parรกmetros
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
    // recibimos la respuesta y la guardamos en una variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    curl_close ($ch);
    $respuesta=json_decode($remote_server_output);  
    return json_decode($remote_server_output);
  }
  
?>