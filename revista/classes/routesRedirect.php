<?php
class routesRedirect {

  public static function getCurrentNavigation()
  {
    return "https://".$_SERVER['HTTP_HOST']."/";
  }
  public static function rootDir()
  {
    $explode = explode("/", dirname(__FILE__,2));
    return $explode[4];
  }

  public static function redirectLogin()
  {
    
    header("Location:".self::getCurrentNavigation().self::rootDir()."/index.php");
  }

  public static function redirectDashboard()
  {
    header("Location:".self::getCurrentNavigation().self::rootDir()."/dashboard.php");
  }

  public static function redirectLoadData()
  {
    header("Location:".self::getCurrentNavigation().self::rootDir()."/ingresarRevista.php");
  }

  public static function redirectGetData()
  {
    header("Location:".self::getCurrentNavigation().self::rootDir()."/listarRevista.php");
  }
}
?>
