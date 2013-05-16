<?php
//Crear thumbnial de PDF

//Crear thumbnial de PDF



//Convertir el Día del Ingles a Español 
function dia($dia){
	
	if ($dia=="Monday") $dia="LUNES";
	if ($dia=="Tuesday") $dia="MARTES";
	if ($dia=="Wednesday") $dia="MIÉRCOLES";
	if ($dia=="Thursday") $dia="JUEVES";
	if ($dia=="Friday") $dia="VIERNES";
	if ($dia=="Saturday") $dia="SABADO";
	if ($dia=="Sunday") $dia="DOMINGO";
	
	return $dia;
}

//Convertir el Mes del Ingles a Español 
function mes($mes){
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Septiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";
	
	return $mes;
}

//Sacar mes del número de mes

function mes_numero($mes){
	if ($mes=="01") $mes="Enero";
	if ($mes=="02") $mes="Febrero";
	if ($mes=="03") $mes="Marzo";
	if ($mes=="04") $mes="Abril";
	if ($mes=="05") $mes="Mayo";
	if ($mes=="06") $mes="Junio";
	if ($mes=="07") $mes="Julio";
	if ($mes=="08") $mes="Agosto";
	if ($mes=="09") $mes="Septiembre";
	if ($mes=="10") $mes="Octubre";
	if ($mes=="11") $mes="Noviembre";
	if ($mes=="12") $mes="Diciembre";
	
	return $mes;
}


//Quitar Tags HTML a Texto


function de_Html_a_Text($html){ 

$html=strip_tags($html); 
$buscar = array('@<style[^>]*?>.*?</style>@siU',    // elimina codigo CSS 
                '@<script[^>]*?>.*?</script>@si',  // elimina el JAVASCRIPT 
               '@<[\\/\\!]*?[^<>]*?>@si',          // elimina las tags de HTML 
               '@<![\\s\\S]*?--[ \\t\\n\\r]*>@'    // elimina las multilineas y tambien los CDATA 
); 


$Texto = preg_replace($buscar, '', $html); 
$Texto = str_replace('&quot;', '', $Texto); // las Comilla 
$Texto = str_replace('&nbsp;',' ',$Texto); // los espacios 
$Texto = str_replace('\\','',$Texto); 
$Texto = str_replace('"','',$Texto); 
////$Texto = str_replace('{aca_el_br}','<br />',$Texto);  
return $Texto; 
}  

function seleccionar_css_seccion($id_seccion){
	if($id_seccion==1):
		$css="metropoli";
	
	elseif($id_seccion==2):
		$css="nacion";
	elseif($id_seccion==3):
		$css="orbe";
	elseif($id_seccion==4):
		$css="per_capita";
	elseif($id_seccion==5):
		$css="cronos";
	elseif($id_seccion==6):
		$css="circus";
	elseif($id_seccion==7):
		$css="vox";
	elseif($id_seccion==8):
		$css="tecno";
	endif;
	
	return $css;
	}
	
	
//Función para Extraer una imagen de un texto
function extraer_imagen($cadena){
	
	$maximo= strlen ($cadena); 
	$ide= "imagenes-articulos/"; 
	$ide2= 'alt=""'; 
	$total= strpos($cadena,$ide); 
	$total2= stripos($cadena,$ide2); 
	$total3= ($maximo-$total2-0); 
	$imagen= substr ($cadena,$total+19,-$total3-2); 
	
	$imagen=utf8_encode($imagen);
		
		return $imagen;				
	}

function extraer_nota($cadena){
	
	$maximo= strlen ($cadena); 
	$ide= '<img src="http://166.78.193.53/images/imagenes-articulos/"'; 
	$ide2= 'alt=""'; 
	$total= strpos($cadena,$ide); 
	$total2= stripos($cadena,$ide2); 
	$total3= ($maximo-$total2-0); 
	$nota= substr ($cadena,$total+19,-$total3-2); 
	
	$nota=utf8_encode($nota);
		
		return $nota; 			
	}

//Crear Tags con Algún texto

function getMetaKeywords($text) {
    // Limpiamos el texto
    $text = strip_tags($text);
    $text = strtolower($text);
    $text = trim($text);
    $text = preg_replace('/[^a-zA-Z-á-é-í-ó-ú-ñ]/', ' ', $text);
    // extraemos las palabras
    $match = explode(" ", $text);
    // contamos las palabras
    $count = array();
    if (is_array($match)) {
        foreach ($match as $key => $val) {
            if (strlen($val)>5) {
                if (isset($count[$val])) {
                    $count[$val]++;
                } else {
                    $count[$val] = 1;
                }
            }
        }
    }
    // Ordenamos los totales
    arsort($count);
    $count = array_slice($count, 0, 10);
    return implode(", ", array_keys($count));
}
//Crear Tags con Algún texto



//Imprimir la Publicidad, ya sea imágen o Flash (Valores: Nombre del archivo,código embedido, url, ancho, alto)
function imprimir_publicidad($archivo,$codigo,$url_destino,$ancho,$alto){
	$exten = explode(".", $archivo);
	$res="";
	//$url_dominio_="http://localhost:8888/sintesis";
	
	$url_dominio_="http://166.78.193.53";
	$extension = end($exten);
	
	
	if($archivo):
			if($extension=="swf"):
			$res='<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$ancho.'">
						  <param name="movie" value="'.$url_dominio_.'/images/imagenes-publicidad/'.$archivo.'" />
						  <param name="quality" value="high" />
						  <param name="wmode" value="opaque" />
						  <param name="swfversion" value="6.0.65.0" />
						  <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
						  <param name="expressinstall" value="Scripts/expressInstall.swf" />
						  <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
						  <!--[if !IE]>-->
						  <object type="application/x-shockwave-flash" data="'.$url_dominio_.'/images/imagenes-publicidad/'.$archivo.'" width="'.$ancho.'" >
							<!--<![endif]-->
							<param name="quality" value="high" />
							<param name="wmode" value="opaque" />
							<param name="swfversion" value="6.0.65.0" />
							<param name="expressinstall" value="Scripts/expressInstall.swf" />
							<!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
							<div>
							  <h4>El contenido de esta p&aacute;gina requiere una versi&oacute;n m&aacute;s reciente de Adobe Flash Player.</h4>
							  <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" width="112" height="33" /></a></p>
							</div>
							<!--[if !IE]>-->
						  </object>
						  <!--<![endif]-->
					  </object>
					  ';
			
			else:
			if(!$alto):
			$size = getimagesize('images/imagenes-publicidad/'.$archivo);
			$alto=$size[1];
			endif;
				if($url_destino && $archivo):
					$res='<a href="'.$url_destino.'" target="new">
						<img src="'.$url_dominio_.'/images/imagenes-publicidad/'.$archivo.'" width="'.$ancho.'" height="'.$alto.'" border="0" >
					</a>';
				elseif($archivo):
					$res='<img src="'.$url_dominio_.'/images/imagenes-publicidad/'.$archivo.'" width="'.$ancho.'" height="'.$alto.'" border="0" >';
				endif;
			endif;
	elseif($codigo):
		$res=$codigo;
	endif;
	return $res;
	}
//Imprimir la Publicidad, ya sea imágen o Flash (Valores: Nombre del archivo,código embedido, url, ancho, alto)


//Funcion para detectar la Ruta relativa de archivos

function url_relativa(){

$url_ant=$_SERVER['REQUEST_URI'];
   $num_diagonales_raiz=1;
   $total_url=strlen($url_ant);
   $count_diag=0;
   $url_relativa="";
   for($td=0;$td<$total_url;$td++):
   		if($url_ant[$td]=="/"):
			$count_diag=$count_diag+1;		
			if($count_diag>$num_diagonales_raiz):
				$url_relativa=$url_relativa."../";
			else:
				$url_relativa="./";
			endif;
		endif;
   endfor;
   
return $url_relativa;
}
   //Funcion para detectar la Ruta relativa de archivos

	
//Función de URL¡s Amigables
function urls_amigables($url) {

// Tranformamos todo a minusculas
$url = strtolower($url);

//Rememplazamos caracteres especiales latinos
$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
$repl = array('a', 'e', 'i', 'o', 'u', 'n');
$url = str_replace ($find, $repl, $url);

// Añaadimos los guiones
$find = array(' ', '&', '\r\n', '\n', '+'); 
$url = str_replace ($find, '-', $url);

// Eliminamos y Reemplazamos demás caracteres especiales
$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
$repl = array('', '-', '');
$url = preg_replace ($find, $repl, $url);
return $url;

}

//Función de URL¡s Amigables






?>