<?php
ob_start();
setcookie("loginYearbook", '', time()-42000); 
setcookie("loginAutomatico", '', time()-42000); 

//redireciona para erro personalizado
header("Location: index.php?op=erroLogin");
?>