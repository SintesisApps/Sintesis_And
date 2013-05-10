
<?php
include("../../includes/conexion.php");
include('../../funciones.php'); 


$id=$_POST['id'];
$arr1 = array();
$i=0;
$ContenidoExtra2="";


$select_app="SELECT * FROM app_articulos WHERE id='".$id."'";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$Titulo=$f_ar['titulo'];
		$Sumario=$f_ar['sumario'];
		$Id_Seccion=$f_ar['id_seccion'];
		$Autor=$f_ar['autor'];
		$Nota=$f_ar['nota'];
		$Fecha_Creacion_p=$f_ar['fecha_creacion'];
		
		$Titulo_p=utf8_encode($Titulo);
		$Sumario_p=utf8_encode($Sumario);
		$Autor_p=utf8_encode($Autor);
		//$Nota=utf8_encode($Nota);
		
		$imagen=extraer_imagen($Nota);
		$imagen_p=utf8_decode($imagen);
		/*$Nota=extraer_nota($Nota);
		$Nota=utf8_decode($Nota);*/
		$Nota=strip_tags($Nota);
		$Nota_p=utf8_encode($Nota);
		
		
	endwhile;
	
	$imagen2=$url_dominio_.'/images/imagenes-articulos/'.$imagen;
	$Nota=str_replace($imagen,'',$Nota);
	$Nota=str_replace('<img src="" alt="" />','',$Nota);
	
	
	$imagen2='<img src="'.$imagen.'">';
	
	$select_se="SELECT seccion,seudonimo FROM secciones WHERE id='".$Id_Seccion."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$Seccion=$f_se['seccion'];
		$SeccionSeudonimo=$f_se['seudonimo'];
		$Seccion=utf8_encode($Seccion);
	endwhile;
	
	
	
	
	
endwhile;


$html="back_".$SeccionSeudonimo.'&'.$Seccion.'&'.$imagen.'&'.$Titulo.'&'.$Sumario.'&'.$Autor.'&'.$Fecha_Creacion.'&'.$Nota;

	  
$select_app="SELECT * FROM app_articulos WHERE id!='".$id."' AND plaza='".$plaza_app."' AND estatus =1 ORDER BY id DESC";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];
	
	
	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app." and id_seccion = ".$Id_Seccion;
	
				
				$r_ar=mysql_query($select_ar,$conexion);
				if(mysql_num_rows($r_ar)>0)
				{
				
					if($contador_extras < 1)
					{
						while($f_ar=mysql_fetch_assoc($r_ar)):
						
							
								$Titulo=$f_ar['titulo'];
								$Sumario=$f_ar['sumario'];
								$Id_Seccion=$f_ar['id_seccion'];
								$Autor=$f_ar['autor'];
								$Nota=$f_ar['nota'];
								$Fecha_Creacion=$f_ar['fecha_creacion'];
								
								$Titulo=utf8_encode($Titulo);
								$Sumario=utf8_encode($Sumario);
								$Autor=utf8_encode($Autor);
								$Nota=utf8_encode($Nota);
								
								$imagen=extraer_imagen($Nota);
								$imagen=utf8_decode($imagen);
						endwhile;
						$contador_extras++;
						
					
			
	
		$imagen=$url_dominio_.'/images/imagenes-articulos/'.$imagen;
		$Nota=str_replace($imagen,'',$Nota);
		
	
	$ContenidoExtra.='
				<div class="NotaExtraContenedor">
					<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
						<div class="NotaExtraTitulo borde_'.$SeccionSeudonimo.'">
							'.$Titulo.'
						</div>
					</a>	
				
					
					<div class="NotaExtraImagen">
						<img src="'.$imagen.'">
					</div>
					
					<div class="NotaExtraSumario">
						'.substr($Sumario,0,80).'...
					</div>
					
					<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
					<div class="NotaExtraLeerMas borde_'.$SeccionSeudonimo.'">
						Leer Más
					</div>
					</a>
				</div>
				';
				
				$ContenidoExtra2.="hola<br>";	
				}
				
				}
endwhile;

$html.="&".$ContenidoExtra;
//$arr1["nota_extra"]=$ContenidoExtra;
//echo $html;
$arr1[$i]=array(
	'titulo' => $Titulo_p,
					'sumario' => $Sumario_p,
					'autor' => $Autor_p,
					'nota' => $Nota_p,
					'imagen' => $imagen_p,
					'fecha' => $Fecha_Creacion_p,
	'seccion' => $Seccion,
	'seccion_pseudo' => $SeccionSeudonimo,
	'nota_extra' => $ContenidoExtra,
	
	);
 echo  json_encode($arr1);

?>