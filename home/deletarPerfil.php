<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//Capturando o login do usuário
	$myUser = htmlspecialchars($_SESSION['nomeUsuario']);
	
	try
	{			
   
		// se não foram passados mais que 0 parâmetro na requisição, desvia para a mensagem de erro
		// "previne" acesso direto à página
		if(count($_POST)!=0){
			include("erroDelete.php");
			die();
		}
		//se existem os parâmetros...
		else{		

		
	    //abre conexão
		$conexao = conn_mysql();	

		// cria instrução SQL UPDATE
		$SQLDelete = "DELETE FROM participantes WHERE login = '$myUser'";

		//prepara a execução
		$operacaoDelete = $conexao->prepare($SQLDelete);					  
		
		//executa a sentença SQL com os parâmetros passados
		$delete = $operacaoDelete->execute();
		
		// fecha a conexão ao banco
		$conexao = null;				
		
		//verifica se o retorno da execução foi verdadeiro ou falso,
		//imprimindo mensagens ao cliente
		if (!$delete){
				$arr = $operacaoDelete->errorInfo();		//mensagem de erro retornada pelo SGBD
				?>
					<!-- Mensagem Personalizada -->                        
					<script type="text/javascript">
						$(document).ready(function () {		
							$.noty.consumeAlert({layout: 'bottomCenter', type: 'error', dismissQueue: true});
							alert("Erro na Operação. <?php echo $arr[2]; ?>"); //deve ser melhor tratado em um caso real
						});
					</script>                             
				<?php
				
				die();					        
		}		
		
		  //deslogando do sistema
		  include('logout.php');				

		   
		}//fim If count $_POST
  
	}//fim -- TRY GERAL
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}

?>