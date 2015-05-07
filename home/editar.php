<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//Capturando o login do usuário
	$myUser = htmlspecialchars($_GET['id']);		
		
	/*********** BUSCAR INFORMAÇÕES DO PERFIL ************/
	try
	{			
   
		// cria instrução SQL parametrizada
		$sql = "SELECT p.login, p.nomeCompleto, p.arquivoFoto, c.nomeCidade, e.sigaEstado,
					   p.email, p.descricao, p.cidade
					   
					   FROM participantes p, cidades c, estados e
					   
				WHERE p.cidade = c.idCidade
				AND   c.idEstado = e.idEstado
				
				AND   p.login = '$myUser'";
					  
		//prepara a execução
		$operacao = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$pesquisar = $operacao->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
?>	
	
        <!-- Perfil -->
        <section class="box-perfil">            
        
<?php       				
		
		//Formulário de Edição
		include('formEditar.php');
																							 
  
	}//FIM -- TRY			
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}
	/*********** FIM --- BUSCA INFO PERFIL SQL *****************************************/
	
?>        
        </section>
        <!-- Fim Perfil -->
        