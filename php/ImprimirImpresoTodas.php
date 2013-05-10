<?php
$plaza=$_GET['plaza'];

if($plaza=="nacional"):
	$ImagenesPortadas= CrearImagendeImpresoAPP("../../portadas/SECCION B/","../ImpresoPortadas/Nacional/");
elseif($plaza=="puebla"):
	$ImagenesPortadas= CrearImagendeImpresoAPP("../../portadas/SECCIÓN A/PUEBLA/","../ImpresoPortadas/Puebla/");
elseif($plaza=="tlaxcala"):
	$ImagenesPortadas= CrearImagendeImpresoAPP("../../portadas/SECCIÓN A/TLAXCALA/","../ImpresoPortadas/Tlaxcala/");
elseif($plaza=="hidalgo"):
	$ImagenesPortadas= CrearImagendeImpresoAPP("../../portadas/SECCIÓN A/HIDALGO/","../ImpresoPortadas/Hidalgo/");
elseif($plaza=="oaxaca"):
	$ImagenesPortadas= CrearImagendeSemanariosAPP("../../portadas/SEMANARIOS/OAXACA/","../ImpresoPortadas/Oaxaca/");
elseif($plaza=="chiapas"):
	$ImagenesPortadas= CrearImagendeSemanariosAPP("../../portadas/SEMANARIOS/Tuxtla/","../ImpresoPortadas/Chiapas/");
elseif($plaza=="yucatan"):
	$ImagenesPortadas= CrearImagendeSemanariosAPP("../../portadas/SEMANARIOS/Yucatan/","../ImpresoPortadas/Yucatan/");
elseif($plaza=="arte_cultura"):
elseif($plaza=="velocidad"):
elseif($plaza=="recorridos"):
elseif($plaza=="NYT"):
endif;

function CrearImagendeImpresoAPP($path,$RutaImagen){

//Eliminar Imagenes pasadas
$directorio=dir($RutaImagen);
while ($archivo = $directorio->read()):
	if($archivo!="." OR $archivo!=".."):
		if (strtolower(substr($archivo, -3) == "jpg") && substr($archivo,0,8)!=date("dmY") && file_exists($RutaImagen.$archivo)):
			unlink($RutaImagen.$archivo);
		endif;
	endif;

endwhile;
$directorio->close();
//Eliminar Imagenes pasadas

$directorio=dir($path);

while ($archivo = $directorio->read()):
 set_time_limit(0);
	if($archivo!="." OR $archivo!=".." ):
	
		if (strtolower(substr($archivo, -3) == "pdf")):
			$archivofecha=substr($archivo,0,8);
			
			if($archivofecha==date("dmY")):
				
					$pdf=$archivo;
					
					  $file_extension = explode(".", $pdf[0]);
					  $file_extension = array_pop($file_extension);
					  $archivo=str_replace(".pdf","",$archivo);
					  
					   if(!file_exists($RutaImagen.$archivo.".jpg")):
							  $img = new imagick($path.$pdf."[0]");
							  $img->setCompression(Imagick::COMPRESSION_JPEG);
							  $img->setCompressionQuality(70);
							  $img->setImageFormat("jpg");
							  $img->thumbnailImage(340, 0);
							  //$img->writeImages($RutaImagen.$archivo.".jpg", true);
						endif;
						
						$html.="&".$archivo;
					
			endif;
		endif;
	endif;
endwhile;
$directorio->close();

return $html;
}

$ImagenesPortadas= explode("&",$ImagenesPortadas);

for($i=0;$i<count($ImagenesPortadas);$i++):
	echo $ImagenesPortadas[$i]."<br>";
endfor;

$html='<div class="PlazaImpreso">
        '.$plaza.'
        </div>
       <img src="imagenes/portada.jpg" width="100%"/>
       <div class="FlechaArriba">
        <a href="javascript:;" onClick="';
		
$html.="$('.ContenedorImagen').css('bottom','30px');";
$html.='">
            <img src="imagenes/flechaazul.png">
         </a>
        </div>
       <div class="ContenedorImagen">
   		 	<div class="Flecha">
            <a href="javascript:;" onClick="';
$html.="$('.ContenedorImagen').css('bottom','-250%');";
$html.='">
         		<img src="imagenes/flechaazul.png">
             </a>
         	</div>
         
             <div  class="MasImpreso" >
                <div  class="SubContenedorMasImpreso">
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                  <div class="ImagenMasImpreso"><img src="imagenes/portada.jpg"></div>
                </div>
             </div>
             
   		</div>';

?>