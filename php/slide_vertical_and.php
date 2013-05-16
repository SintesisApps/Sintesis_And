<?php
/*slide  vertical*/
include("../../includes/conexion.php");
include('../../funciones.php'); 

$contador_seccion=0;
$array_secciones = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
$html="";
	//$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Vertical' AND estatus='1' ORDER BY id DESC LIMIT 0,3 ";
	$cont_art=0;
	$cont_pub=0;
	$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Vertical' and estatus='1'
							UNION
				SELECT * FROM app_publicidad where posicion='slide-vertical' and  dispositivo='ios' and estatus='1' 
				ORDER BY orden ASC";
						
						
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];
	
	if($id_articulo_app==0)//publicidad
	{
		if($cont_pub<3)
		{
			$html.='
			<div > 
            <div class="PublicidadSlideVertical">
                <img src="'.$url_dominio_.'/images/imagenes-publicidad/'.$f_app['ruta'].'">
            </div>
        </div>
			';
			$cont_pub++;	
		}
		
		
	}
	else
	{
		
		$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

		$r_ar=mysql_query($select_ar,$conexion);
		
		while($f_ar=mysql_fetch_assoc($r_ar)):
		
		
		
		
			$TituloSlideVertical=$f_ar['titulo'];
			$SumarioSlideVertical=$f_ar['sumario'];
			$Id_SeccionSlideVertical=$f_ar['id_seccion'];
			$AutorSlideVertical=$f_ar['autor'];
			$NotaSlideVertical=$f_ar['nota'];
			$Fecha_CreacionSlideVertical=$f_ar['fecha_creacion'];
	
			$TituloSlideVertical=utf8_encode($TituloSlideVertical);
			$SumarioSlideVertical=utf8_encode($SumarioSlideVertical);
			$AutorSlideVertical=utf8_encode($AutorSlideVertical);
			$NotaSlideVertical=utf8_encode($NotaSlideVertical);
	
			$TituloSlideVertical=substr($TituloSlideVertical,0,30)."...";
			$SumarioSlideVertical=substr($SumarioSlideVertical,0,100)."...";
			$imagen=extraer_imagen($NotaSlideVertical);
			$imagen=utf8_decode($imagen);
		endwhile;
		
		//columnista
		if($Id_SeccionSlideVertical==7)
		{
			$c_co="SELECT * FROM columnistas WHERE nombre_completo LIKE '%".$AutorSlideVertical."%'";
						$r_co=mysql_query($c_co,$conexion);
						while($f_co=mysql_fetch_assoc($r_co)):
							$id_columnista=$f_co['id'];
							$nombre_columnista=$f_co['nombre_completo'];
							$foto=$f_co['foto'];
						
							$nombre_columnista=utf8_encode($nombre_columnista);
							$foto=utf8_encode($foto);
						endwhile;
						$ruta_img="imagenes-columnistas/".$foto;	
		}
		else
		{
								$ruta_img="imagenes-articulos/".$imagen;	
		}
		
	

		//end Colum
	
		$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideVertical."'";
	
		$r_se=mysql_query($select_se,$conexion);
		while($f_se=mysql_fetch_assoc($r_se)):
			$SeccionSlideVertical=$f_se['seudonimo'];
			$SeccionSlideVertical=strtolower(utf8_encode($SeccionSlideVertical));
	
		endwhile;
		
		if($array_secciones[$Id_SeccionSlideVertical]=='0')
		{
		
			$html.='<div><a href="#nota" onclick="LeerNota('.$id_nota_app.')">
						<div class="SlideVerticalArticulo">
							<div class="SlideVerticalSeccion"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
							<div class="SlideVerticalImagen"  ><img src="'.$url_dominio_.'/images/'.$ruta_img.'" height="160" width="296"  > </div>
							<div class="SlideVerticalContenido">
							  <div class="SlideVerticalTitulo">'.$TituloSlideVertical.'</div>
							  <div class="SlideVerticalAutor">'.$AutorSlideVertical.'</div>
							  <div class="SlideVerticalFecha">'.$Fecha_CreacionSlideVertical.'</div>
							 
							</div>
						</div>
					</a></div>
					<div > 
				
			</div>';
		 		$array_secciones[$Id_SeccionSlideVertical]='1';
		}
		
		$cont_art++;
		
		
	}
	
	
	


	
				// <div class="SlideVerticalSumario">'.$SumarioSlideVertical.'</div>
		endwhile;
		
		echo $html;

?>