<?php
/*slide miniaturas*/
include("../../includes/conexion.php");
include('../../funciones.php'); 

$html="";
$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Miniaturas' AND estatus='1' ORDER BY id DESC";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlideMiniaturas=$f_ar['titulo'];
		$Id_SeccionSlideMiniaturas=$f_ar['id_seccion'];
		$AutorSlideMiniaturas=$f_ar['autor'];
		$NotaSlideMiniaturas=$f_ar['nota'];
		$Fecha_CreacionSlideMiniaturas=$f_ar['fecha_creacion'];
		
		$TituloSlideMiniaturas=utf8_encode($TituloSlideMiniaturas);
		$AutorSlideMiniaturas=utf8_encode($AutorSlideMiniaturas);
		$NotaSlideMiniaturas=utf8_encode($NotaSlideMiniaturas);
		
		$TituloSlideMiniaturas=substr($TituloSlideMiniaturas,0,100)."...";
		$imagen=extraer_imagen($NotaSlideMiniaturas);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideMiniaturas."'";
	
	
		
		$html.='<div class="ContSlideMiniaturas">
					<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
						<div class="SlideMiniaturasImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'"></div>
					  <div class="SlideMiniaturasContenido">'.$TituloSlideMiniaturas.'</div>
					</a>
				</div>
		';
endwhile;


echo $html;

?>