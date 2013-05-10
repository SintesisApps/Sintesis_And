<?php
	function Conectarse() 
	{ 
	   if (!($link=mysql_connect("localhost","root","root"))) 
	   { 
		  echo "Error conectando a la base de datos."; 
		  exit(); 
	   } 
	   if (!mysql_select_db("prue_apps",$link)) 
	   { 
		  echo "Error seleccionando la base de datos."; 
		  exit(); 
	   } 
	   return $link; 
	}
	$link=Conectarse();
	
	//Consulta de datos
	if(isset($_POST['accion'])){
		if($_POST['accion'] == 'leer'){
			$arr = array();
			$i=0;
			$query = mysql_query("SELECT * FROM registros",$link);
			while($res = mysql_fetch_array($query)){
				$arr[$i] = array(
					'id' => $res['id'],
					'dat1' => $res['dat1'],
					'dat2' => $res['dat2'],
				);
				$i++;
			}
			
			echo json_encode($arr);
		}
	}else{
		echo 0;
	}
?>