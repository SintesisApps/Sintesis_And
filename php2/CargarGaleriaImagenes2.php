<?php
/*Galeria de imagenes*/
include("../../../includes/conexion.php");
include('../../../funciones.php');

echo $html= '<script>

		(function(window, $, PhotoSwipe){
			
			$(document).ready(function(){
				
				var options = {};
				$("#Gallery_gal a").photoSwipe(options);
			
			});
			
			
		}(window, window.jQuery, window.Code.PhotoSwipe));
		
</script>';
		
	/*$select_app="SELECT * FROM galeria_imagenes_contenido";*/
		$select_app="SELECT * FROM galeria_imagenes_contenido,  galerias_imagenes where galeria_imagenes_contenido.id_galeria= galerias_imagenes.id and galerias_imagenes.estatus=1 order by galerias_imagenes.id desc";

$r_app=mysql_query($select_app,$conexion);

while($imagen=mysql_fetch_array($r_app))
{
	//verificamos si el archivo existe
	$ruta="http://166.78.193.53/images/imagenes-galeria/";
	if(file_exists("../../../images/imagenes-galeria/".$imagen['imagen'].""))
	{
		$html.='<li><a href="http://166.78.193.53/images/imagenes-galeria/'.$imagen['imagen'].'"><img src="http://166.78.193.53/images/imagenes-galeria/'.$imagen['imagen'].'" alt="" width="150" height="150" /></a></li>';
	}
	
}

echo $html;

		
?>