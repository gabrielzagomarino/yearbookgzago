<?php
	
	require_once("conexao.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();

?>
	
<!doctype html>
<html lang="pt-br">
<head>
	<?php
	  //Head Cadastro
	  include('headCadastro.php');
    ?>
</head>

<body class="cadastro">

    <!-- Cabeçalho -->
	<?php
	  //Menu Cadastro
	  include('menuCadastro.php');
	?>    
    <!-- Fim -- Cabeçalho -->


    <!-- Imagens thumbnail --> 
    <div class="thumbnail">
    	<?php include('modulos/ftMiniatura.php'); ?>
    </div>
    <!-- FIM -- Imagens thumbnail -->


	<?php
	  //Formulário de Cadastro
	  include('formCadastro.php');
	?>


	<?php
    
    //Captura a operação passada na página
     if(isset($_GET['op'])){	  		
          
          $op = $_GET['op'];
          
          //Caso a mensagem seja de confirmação, retorna uma mensagem personalizada
          if ($op=='record')
          { 
              
              //rotina para inserir o Usuário gravando no Banco
              include('modulos/inserirUser.php');
          
          ?>      
              <script type="text/javascript">
                  $(document).ready(function () {		
                      $.noty.consumeAlert({layout: 'bottomCenter', type: 'success', dismissQueue: true});
                      alert("Usuário cadastrado com sucesso.");
              
                  });
              </script>      
     <?php 		  
          }//FIM -- If success
     }  

 
       //Verifica a operação, caso não exista, retorna a um erro
       if(isset($_GET['op'])){	  		
			
			$op = $_GET['op'];
			
			//Caso a mensagem seja de ERRO, retorna uma mensagem personalizada
			if ($op!='record')
			{
				include('erroModulo.php');
				     
			}//FIM -- If success
       }
	   	    
    ?>

</body>
</html>