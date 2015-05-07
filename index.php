<?php
	
	require_once("conexao.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	if(isset($_COOKIE['loginAutomatico'])){
	   header("Location: VerificarLogin.php");
	}
	else if(isset($_COOKIE['loginYearbook']))
		$nomeUser = $_COOKIE['loginYearbook'];
		else $nomeUser="";	

?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php
	  //Head do Index
	  include('headIndex.php');    
    ?>   
</head>

<body class="login">

    <!-- Cabeçalho -->
	<?php
	  //Menu Index
	  include('menuIndex.php');
	?>
    <!-- Fim -- Cabeçalho -->


    <!-- Imagens thumbnail --> 
    <div class="thumbnail">
    	<?php include('modulos/ftMiniatura.php'); ?>
    </div>
    <!-- FIM -- Imagens thumbnail -->


<div id="div-login">

    <h1>Entre no Yearbook</h1>
    
    <p>Insira seus dados de acesso.
     <a href="cadastro.php">Cadastre-se</a> se ainda não tem uma conta.
    </p>

	<form name="loginform" id="loginform" role="form" action="verificarLogin.php" method="post" class="loginform">
        <p>
            <label>Nome de usuário<input type="text" name="login" id="login" class="input" size="20" maxlength="20" required="required" placeholder="Digite um Login" onKeyUp="this.value=retira_acentos(this.value);" value="<?php echo $nomeUser?>"></label>
        </p>
        
        <p>
            <label>Senha<input type="password" name="passwd" id="passwd" class="input" size="20" maxlength="50" required="required" placeholder="********"></label>
        </p>
        
        <p class="forgetmenot">
        	<label><input name="lembrarLogin" value="loginAutomatico" type="checkbox"> Lembrar</label>
        </p>
        
        <p class="submit">
            <input type="submit" name="logar" id="logar" class="button-primary" value="Logar" tabindex="100">
        </p>
	</form>
    
    
	  <?php      
	  	//Mensagem Personalizadas das Operações
		include('msgOperacoes.php');	          
      ?>    
    
</div>

</body>
</html>