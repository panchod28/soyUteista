<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//cors
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
//librerias
include('simple_html_dom.php');
include('classes/Newsletter.php');
//arreglo de noticias
$myArr = array();
//Si queremos obtener el código html de una pagina web
$html = file_get_html("https://www.uts.edu.co/sitio/revista-soy-uteista/");
$first = $html->find("div[class=entry-content]");
foreach ($first as $key => $element) {  
    //elemento individual de cada noticia
    for ($i=0; $i < 20 ; $i++) { 
        $element->find("div[class=vc_row wpb_row vc_row-fluid]");
        $data = $element->find("div[class=vc_column-inner]")[$i]->find("div[class=wpb_text_column wpb_content_element]")[0];
        //Edicion
        $edicion = $data->find("span[style=font-size: 16pt;]")[0]->plaintext;
        $fecha = $data->find("span")[2]->plaintext;
        $thumbnail_url = $element->find("div[class=wpb_single_image wpb_content_element vc_align_left]")[$i];
        $foto = $thumbnail_url->find("img")[0]->src;
        $url = $thumbnail_url->find("a")[0]->href;
        $news = new Newsletter($edicion, $fecha, $foto, $url);
        array_push($myArr, $news);
    }
}
$datoFinal = new Respuesta(1, $myArr);
echo json_encode($datoFinal, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
