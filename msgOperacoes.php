<?php

	  //Cadastra as operações em um vetor
	  $vet_op = array("erroLogin", "acessoNegado", "erroModulo");

      //Captura a operação ERRO LOGIN
       if(isset($_GET['op'])){	  		
			
			$op = $_GET['op'];
			
			//Caso a mensagem seja de ERRO, retorna uma mensagem personalizada
			if ($op==$vet_op[0])
			{
			  
			  ?>
				  <script type="text/javascript">
					  $(document).ready(function () {		
						  $.noty.consumeAlert({layout: 'bottomCenter', type: 'error', dismissQueue: true});
						  alert("Não é possível realizar o login.");
				  
					  });
				  </script>
              <?php     
    	  
			}//FIM -- If success
       }	   
	   
       //Captura a operação ACESSO NEGADO
       if(isset($_GET['op'])){	
			
			$op = $_GET['op'];
			
			//Caso a mensagem seja de ERRO, retorna uma mensagem personalizada
			if ($op==$vet_op[1])
			{
				include('acessoNegado.php');
				     
			}//FIM -- If success
       }
	   
	   
       //Captura a operação ERRO MODULO dentro do Sistema
       if(isset($_GET['op'])){	  		
			
			$op = $_GET['op'];
			
			//Caso a mensagem seja de ERRO, retorna uma mensagem personalizada
			if ($op==$vet_op[2])
			{
				include('home/erroModulo.php');
				     
			}//FIM -- If success
       }	   
	   
	   
       //Verifica as operações, caso não exista, retorna a um erro
       if(isset($_GET['op'])){	  		
			
			$op = $_GET['op'];
			
			//Caso a mensagem seja de ERRO, retorna uma mensagem personalizada
			if (($op!=$vet_op[0])and($op!=$vet_op[1])and($op!=$vet_op[2]))
			{
				include('erroModulo.php');
				     
			}//FIM -- If success
       }	
?>	      