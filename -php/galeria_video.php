<?php
/*Galeria video*/
include("../../includes/conexion.php");
include('../../funciones.php');

$plaza=$_POST["plaza"];

if($plaza=="nacionales")
{$select_app="SELECT * FROM galeria_videos  WHERE estatus='1' ORDER BY fecha DESC limit 1";}
else //por id de la plaza
{$select_app="SELECT * FROM galeria_videos  WHERE estatus='1' and plaza='".$plaza."' ORDER BY fecha DESC limit 1";}

$html='';


$r_app=mysql_query($select_app,$conexion);

function extraer_id($url)
{
$yb=$url; //coloca aqui la url del video

$yb = explode("youtube.com/watch?v=", $yb);//busca la parte donde empieza el id
$yb = explode("&", $yb[1]); // desecha el resto de la urlsi la ay

return $yb[0]; //muestra el id  	
}


while($video=mysql_fetch_array($r_app))
{
	$id_video=extraer_id($video['url_video']);
		$html.='<div id="videogaleria">
		<div class="VideoTituloPrincipal">
        	<strong>'.utf8_encode($video['titulo']).'</strong>
        </div>
            <object width="100%" height="49%">
              <param name="movie" value="http://youtube.com/v/'.$id_video.'?fs=1&amp;hl=es_ES&amp;rel=0&amp;autoplay=0&modestbranding=1"/>
              <param value="true" name="allowFullScreen"/>
              <param value="always" name="allowscriptaccess"/>
              <param value="transparent" name="wmode"/>
              <embed width="100%" height="49%" wmode="transparent"  allowfullscreen="true" allowscriptaccess="always" type="application/x-shockwave-flash" src="http://youtube.com/v/'.$id_video.'?fs=1&amp;hl=es_ES&amp;rel=0&amp;autoplay=0&showinfo=0&modestbranding=1"/>
            </object></div>
		';
}


$html.='<div class="contvideogaleriaimg"> 
      	<div class="contvideogaleriaimg_secundario">';
		if($plaza=="nacionales"){
		$reg="SELECT * FROM galeria_videos WHERE id NOT IN (SELECT max(id) FROM galeria_videos) and estatus='1' ORDER BY fecha DESC";}
		else
		{//and plaza='".$plaza."'
		$reg="SELECT * FROM galeria_videos WHERE id NOT IN (SELECT max(id) FROM galeria_videos where plaza='".$plaza."') and estatus='1' and plaza='".$plaza."' ORDER BY fecha DESC";
		}
		$registros=mysql_query($reg);
		while($video2=mysql_fetch_array($registros))
		{
			$id_video=extraer_id($video2['url_video']);
			$html.='
			 <div class="VideoImagen">
                <a href="http://youtube.com/v/'.$id_video.'" onclick="return cambiarvideo(this.href,this.title)" title="Toma protesta de diputados"> <img src="http://img.youtube.com/vi/'.$id_video.'/0.jpg" />
                  <div class="titulo_video"> <strong>Toma protesta de diputados</strong> </div>
                </a> 
            </div> 
			';
		}
		
		
		
		
$html.='</div></div>';




echo $html;



?>