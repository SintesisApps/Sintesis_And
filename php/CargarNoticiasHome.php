<?php
include("../../includes/conexion.php");
include('../../funciones.php'); 
//Slide Principal

$html.='<!--Slide Principal-->
    <div  class="SlidePrincipal ContenedorSlidePrincipal" >
	
	';
	$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Principal' AND estatus='1' ORDER BY id DESC";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlidePrincipal=$f_ar['titulo'];
		$SumarioSlidePrincipal=$f_ar['sumario'];
		$Id_SeccionSlidePrincipal=$f_ar['id_seccion'];
		$AutorSlidePrincipal=$f_ar['autor'];
		$NotaSlidePrincipal=$f_ar['nota'];
		$Fecha_CreacionSlidePrincipal=$f_ar['fecha_creacion'];
		
		$TituloSlidePrincipal=utf8_encode($TituloSlidePrincipal);
		$SumarioSlidePrincipal=utf8_encode($SumarioSlidePrincipal);
		$AutorSlidePrincipal=utf8_encode($AutorSlidePrincipal);
		$NotaSlidePrincipal=utf8_encode($NotaSlidePrincipal);
		
		$imagen=extraer_imagen($NotaSlidePrincipal);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$select_se="SELECT seccion FROM secciones WHERE id='".$Id_SeccionSlidePrincipal."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlidePrincipal=$f_se['seccion'];
		$SeccionSlidePrincipal=utf8_encode($SeccionSlidePrincipal);
	endwhile;
	
$html.='
	<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
      <div class="ContenedorContenidoPrincipal">
        <div class="SlidePrincipalImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
        <div class="SlidePrincipalContenido">
          <div class="SlidePrincipalTitulo">'.$TituloSlidePrincipal.'</div>
          <div class="SlidePrincipalSeccion">'.$SeccionSlidePrincipal.'</div>
          <div class="SlidePrincipalAutor">'.$AutorSlidePrincipal.'</div>
          <div class="SlidePrincipalFecha">'.$Fecha_CreacionSlidePrincipal.'</div>
          <div class="SlidePrincipalSumario">'.$SumarioSlidePrincipal.'</div>
        </div>
      </div>
      </a>
	';
endwhile;

$html.='    </div>
    <!--Slide Principal-->';
    
$html.='

<!--Slide Miniaturas-->
<div class="ContenedorSlideMiniaturas" onselectstart="return false;">
      <div  id="mouseSwipeScroll">
        ';
		
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
	
	
$html.='<div class="panelSwipe SubContenedorSlideMiniaturas">
				<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
					<div class="SubContenedorSlideMiniaturas">
					  <div class="SlideMiniaturasImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'"></div>
					  <div class="SlideMiniaturasContenido">
						<h2>'.$TituloSlideMiniaturas.'</h2>
					  </div>
					</div>
				</a>
		</div>
		';
endwhile;

$html.='</div>
</div>
<!--Slide Miniaturas--> 



<!--Slide Vertical-->

    <div class="ContenedorSlideVertical" style="height:550px;-webkit-overflow-scrolling:touch;"  onselectstart="return false;">
      <div >
			<div >';
				
				$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Vertical' AND estatus='1' ORDER BY id DESC LIMIT 0,3 ";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];


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

	$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideVertical."'";

	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlideVertical=$f_se['seudonimo'];
		$SeccionSlideVertical=strtolower(utf8_encode($SeccionSlideVertical));

	endwhile;
	
				$html.='<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
					<div class="SlideVerticalArticulo">
						<div class="SlideVerticalSeccion"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
						<div class="SlideVerticalImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
						<div class="SlideVerticalContenido">
						  <div class="SlideVerticalTitulo">'.$TituloSlideVertical.'</div>
						  <div class="SlideVerticalAutor">'.$AutorSlideVertical.'</div>
						  <div class="SlideVerticalFecha">'.$Fecha_CreacionSlideVertical.'</div>
						  <div class="SlideVerticalSumario">'.$SumarioSlideVertical.'</div>
						</div>
					</div>
				</a>
				
				<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
					<div class="SlideVerticalArticulo">
						<div class="SlideVerticalSeccion"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
						<div class="SlideVerticalImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
						<div class="SlideVerticalContenido">
						  <div class="SlideVerticalTitulo">'.$TituloSlideVertical.'</div>
						  <div class="SlideVerticalAutor">'.$AutorSlideVertical.'</div>
						  <div class="SlideVerticalFecha">'.$Fecha_CreacionSlideVertical.'</div>
						  <div class="SlideVerticalSumario">'.$SumarioSlideVertical.'</div>
						</div>
					</div>
				</a>';
		endwhile;
		$html.='</div>
      </div>
</div>
<!--Slide Vertical-->
    
    <!--Slide Medio-->
    <div class="ContenedorSlideMedio SlideMedio" >';
      
	  $select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Medio' AND estatus='1' ORDER BY id DESC LIMIT 5 ";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlideMedio=$f_ar['titulo'];
		$SumarioSlideMedio=$f_ar['sumario'];
		$Id_SeccionSlideMedio=$f_ar['id_seccion'];
		$AutorSlideMedio=$f_ar['autor'];
		$NotaSlideMedio=$f_ar['nota'];
		$Fecha_CreacionSlideMedio=$f_ar['fecha_creacion'];
		
		$TituloSlideMedio=utf8_encode($TituloSlideMedio);
		$SumarioSlideMedio=utf8_encode($SumarioSlideMedio);
		$AutorSlideMedio=utf8_encode($AutorSlideMedio);
		$NotaSlideMedio=utf8_encode($NotaSlideMedio);
		
		$imagen=extraer_imagen($NotaSlideMedio);
		$imagen=utf8_decode($imagen);
	endwhile;
	
	$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideMedio."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlideMedio=$f_se['seudonimo'];
		$SeccionSlideMedio=strtolower(utf8_encode($SeccionSlideMedio));
	endwhile;
$html.='<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
				<div style="height:525px">
					<div class="SlideMedioSeccion"><img src="imagenes/iconos/secciones/'.$SeccionSlideMedio.'.png"></div>
					<div class="SlideMedioImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
					<div class="SlideMedioContenido">
						<div class="SlideMedioTitulo">'.$TituloSlideMedio.'</div>
						<div class="SlideMedioAutor">'.$AutorSlideMedio.'</div>
						<div class="SlideMedioFecha">'.$Fecha_CreacionSlideMedio.'</div>
						<div class="SlideMedioSumario">'.$SumarioSlideMedio.'</div>
					</div>
			</div>
		</a>';
      endwhile;
	  
$html.='</div>
    <!--Slide Medio--> 
	
	 <!--Publicidad-->
    <div class="ContenedorPublicidadMedioDerecha" >
      <div ><img src="imagenes/publicidad/publi1.png"></div>
    </div>
    <!--Publicidad--> 
	
	

<div class="wrapper page">
 
  <script>
      jQuery(document).ready(function($) {
		  
 $(document).bind("dragstart", function() { return false; });

	$("#mouseSwipeScroll").swipe({
    TYPE:"mouseSwipe",
    HORIZ: true
  });
  
  $("#mouseSwipe1").swipe({
    TYPE:"mouseSwipe",
    HORIZ: false,
    SNAPDISTANCE:20,
    DURATION:250,
    EASING:"swing",
    ARROWS:false,
    FADEARROWS:true,
    PAGENUM:"#pagenum1"
  });


  $(".SlidePrincipal").royalSlider({
    autoHeight: false,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  $(".SlideMiniaturas").royalSlider({
    autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  
  
  $(".SlideMedio").royalSlider({
    autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  $(".simple-vertical").royalSlider({
    arrowsNav: false,
    arrowsNavAutoHide: false,
    fadeinLoadedSlide: true,
    controlNavigation: "none",
    imageScaleMode: "fill",
    imageAlignCenter:true,
    loop: false,
    loopRewind: false,
    numImagesToPreload: 4,
    slidesOrientation: "vertical",
    keyboardNavEnabled: true,
    video: {
      autoHideArrows:true,
      autoHideControlNav:true
    },  

    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 850
  });
  
  
  
  });
  
  

    </script> 
</div>';


echo $html;
?>