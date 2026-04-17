<?php
//cors
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET");
header("Allow: GET");
//cantidad
//librerias
include('simple_html_dom.php');
include('classes/News.php');
//arreglo de noticias
$notallowed = array("&hellip;", "&#8221;", "&#8220;", "&amp;", "hellip;", "#8211;");
$myArr = array();
//Si queremos obtener el código html de una pagina web
$html = file_get_html("https://www.uts.edu.co/sitio/noticias/");
$first = $html->find("div[class=blog-loop-inner blog-masonry blog-loop-view-list]");
foreach ($first as $key => $element) {
    for ($i=0; $i < 20 ; $i++) {
        //elemento individual de cada noticia
        $data = $element->find('div[class=post-inner]')[$i];
        //thumbnail and url
        $thumb_info = $data->find("div[class=post-thumbnail]")[0];
        //url new
        $url = $thumb_info->find('a', 0)->href;
        //url foto
        $foto = $thumb_info->find("img")[0]->src;
        //date new
        $date = $data->find("div[class=post-meta date]")[0]->find('a')[0]->plaintext;
        //description new
        //verify if description exist
        if (!empty($data->find("div[class=the-excerpt]")[0]->find('p')[0]->plaintext)) {
            $descripcion = str_ireplace($notallowed, '', htmlspecialchars($data->find("div[class=the-excerpt]")[0]->find('p')[0]->plaintext));
        }else{
            $descripcion = "";
        }
        //title new
        $titulo = str_ireplace($notallowed, '', $data->find("h4[class=entry-title]")[0]->find('a')[0]->plaintext);
        //categoria new
        $categoria = $data->find("div[class=post-meta post-category]")[0]->find('a')[0]->plaintext;
        $news = new News($categoria, $titulo, $descripcion, $date, $foto, $url);
        array_push($myArr, $news);
    }
}
$datoFinal = new Respuesta(1, $myArr, count($myArr));
echo json_encode($datoFinal, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>

