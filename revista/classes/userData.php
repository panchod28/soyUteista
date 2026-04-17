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
      if($user['id_permiso'] == 3){
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

  public static function createNewsletter($id_usuario, $edicion, $date, $foto, $url)
  {
    $conn = Conexion::getInstance()->getConnection();
    $stmt = $conn->prepare('INSERT INTO revista (edicion, date, foto, url, id_usuario) VALUES (?, ?, ?, ?, ?) ');
    $stmt->bind_param( 'ssssi' , $edicion, $date, $foto, $url, $id_usuario );
    $stmt->execute();
  }

  
  public static function getNewsletter($limit, $offset)
  {
    $conn = Conexion::getInstance()->getConnection();
    $stmt = $conn->prepare('SELECT * FROM revista ORDER BY id_revista DESC LIMIT ? OFFSET ?');
    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrayData = [];
    while ($row = $result->fetch_assoc()) {
      $revista = new Revista($row);
      array_push($arrayData, $revista);
    }
    return $arrayData;
  }
}
?>
