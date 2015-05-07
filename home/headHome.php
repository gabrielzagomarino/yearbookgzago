<?php
	require_once("../authSession.php");
?>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Yearbook .:: Atividade Aberta 05</title>
<link rel="stylesheet" href="../css/estilo.css"/>
<link rel="stylesheet" href="../css/perfil.css"/>
<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

<!-- bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!--Mensagens em Ajax -->
<link rel="stylesheet" type="text/css" href="../css/buttons.css"/>
<script src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.noty.packaged.min.js"></script>        

<!-- Validação -->
<script type="text/javascript" src="js/validar.js"></script>

<!-- Script Ajax --> 
<script type="text/javascript" src="js/ajax-gz.js"></script>

<!-- Timer de Redirecionamento -->
<script type="text/javascript">    
     function Redireciona(tempo, url, onde, msg) {
         var NovaMsg = msg.replace('!tempo', tempo);
         document.getElementById(onde).innerHTML = NovaMsg;
         tempo--;
         if (tempo == 2)
             location.href = url;
         var nr = 'setTimeout("Redireciona(' + tempo + ',\'' + url + '\',\'' + onde + '\',\'' + msg + '\')",1000)';
         eval(nr);
     }
</script>   