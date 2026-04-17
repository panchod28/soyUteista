<?php

class htmlContent{
  public static function alertDanger()
  {
    echo "
    <div class='alert alert-danger' role='alert'>
      Te hacen falta datos, ¡asegúrate de tener todo!
    </div>";
  }

  //bad idea btw still here 
  public static function dataIncorrect()
  {
    echo "
    <div class='alert alert-danger' role='alert'>
      Tu usuario o clave son incorrectos, ¿escribiste bien?
    </div>";
  }
}

?>
