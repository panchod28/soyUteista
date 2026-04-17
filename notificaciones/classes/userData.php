<?php

class userData{

  public static function startSession()
  {
    session_start();
  }

  public static function setSession($username, $id_usuario)
  {
    self::startSession();
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['username'] = $username;
  }

  public static function destroySession()
  {
    self::startSession();
    session_destroy();
    routesRedirect::redirectLogin();
  }

  public static function checkSession()
  {
    self::startSession();
    if (validateData::EmptyData()) routesRedirect::redirectLogin();
  }

  public static function validateIfExist()
  {
    self::startSession();
    if (!validateData::EmptyData()) routesRedirect::redirectDashboard();
  }
  
  public static function checkLogin( $username, $password )
  {
	$conn = Conexion::getInstance()->getConnection();
	$stmt = $conn->prepare('SELECT * from usuarios WHERE usuario = ? ');
	$stmt->bind_param( 's' , $username );
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows == 1){
		$user = $result->fetch_assoc();
		if($user['id_permiso'] == 1){
			(password_verify($password, $user["clave"])) 
			?
			(self::setSession($username, $user["id_usuario"])).
			(routesRedirect::redirectDashboard())
			: 
			routesRedirect::redirectLogin();
		}else {
        		routesRedirect::redirectLogin();
		}    
	}else{
      	htmlContent::dataIncorrect();
    	}  
  }

  public static function retrieveLastNew()
  {
    $conn = Conexion::getInstance()->getConnection();
    $stmt = $conn->prepare('SELECT * from getlastdata');
    $stmt->execute();
    $result = $stmt->get_result();
    $lastData = $result->fetch_assoc();
    $notification = new Notification($lastData);
    return $notification;
  }

  
  public static function retrieveNews()
  {
    $array = [];
    $conn = Conexion::getInstance()->getConnection();
    $stmt = $conn->prepare('SELECT * from getdata');
    $stmt->execute(); 
    $result = $stmt->get_result();
    while ($data = $result->fetch_assoc()) {
      $notification = new Notification($data);
      array_push($array, $notification);
    }
    return $array;
  }

  public static function createNotification($id_usuario, $uniq_id, $titulo, $cuerpo = "", $enlace = "")
  {
    $conn = Conexion::getInstance()->getConnection();
 $stmt = $conn->prepare('INSERT INTO notificacion (uniq_id, titulo, cuerpo, link, creado_por) VALUES (?, ?, ?, ?, ?) ');
    $stmt->bind_param( 'ssssi' , $uniq_id, $titulo, $cuerpo, $enlace, $id_usuario );
    $stmt->execute();
  }
}
?>
