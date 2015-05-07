<?php
 function conn_mysql(){
	 
  $servidor = 'us-cdbr-azure-northcentral-a.cleardb.com';
  $porta = 3306;
  $banco = "yearbookgzagodb";
  $usuario = "b759630275613b";
  $senha = "217eed5b";
  $charset = "utf8";  
  
	$conn = new PDO("mysql:host=$servidor;
					 port=$porta;
					 dbname=$banco;
  				     charset=$charset", 					  
					 
					 $usuario, 
					 $senha);  					 
	return $conn;
   }
?>