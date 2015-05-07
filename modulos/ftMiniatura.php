<?php
	
	require_once("conexao.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();		
		
	/*********** BUSCAR OS 7 PRIMEIROS USUARIOS NA ORDEM DO SQL ************/
	try
	{			
   
		// cria instrução SQL parametrizada, pesquisa os 7 registros primeiros para armazenar a foto Thumbnail
		$sql = "SELECT login, arquivoFoto FROM participantes ORDER BY login LIMIT 7";
					  
		//prepara a execução
		$operacao = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$pesquisar = $operacao->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;				
																										   
				// listando o login para fazer a seleção
				if (count($resultados)>0){
				  foreach($resultados as $ftEncontrada){	  	
					?>
                        <span class="blue">&nbsp;</span>
                         <figure><a href="home/index.php?id=<?php echo $ftEncontrada['login']; ?>&op=external"><img src="<?php echo $ftEncontrada['arquivoFoto']; ?>" title="<?php echo $ftEncontrada['login']; ?>" height="75" width="64"></a></figure>
                        <span class="orange">&nbsp;</span>                           
					<?php					
										
				  }
				}																					 
  
	}//FIM -- TRY			
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}
	/*********** FIM --- BUSCAR OS 7 PRIMEIROS USUARIOS NA ORDEM DO SQL *****************************************/
	

	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();		
		
	/*********** CASO NÃO TENHA 7 USUARIOS CADASTRADOS NA TABELA, ARMAZENA UMA FOTO DE USUARIOS INEXISTENTE ************/
	try
	{			
   
		// cria instrução SQL parametrizada, pesquisa os 7 registros primeiros para armazenar a foto Thumbnail
		$sql = "SELECT count(*) as QTD FROM participantes";
					  
		//prepara a execução
		$operacaoUsIn = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$armazUsIn = $operacaoUsIn->execute();
		
		//captura TODOS os resultados obtidos
		$resultadosUsIn = $operacaoUsIn->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;				
																										   
		//variável cont
		$cont = 0;
				
				// listando o login para fazer a seleção
				if (count($resultadosUsIn)>0){
				  foreach($resultadosUsIn as $UsuarioIn){
					if($UsuarioIn['QTD']<7){
				    
					//Calcula o Resultado do QTD do Select Menos -7
					$userCalc = 7 - $UsuarioIn['QTD'];
					 
					   //Enquanto a variável CONT for diferente de userCalc,
					   //vai exibir as imagens de User Inexistente
					   while($cont!=$userCalc){							  	
						  ?>
							  <span class="blue">&nbsp;</span>
							  <a href=""><figure><img src="imagens/user_ine.png" title="Usuário Não Encontrado" height="75" width="64"></figure></a>
							  <span class="orange">&nbsp;</span>                           
						  <?php
						$cont++;					   
					   }//fim -- While
					   
					   
					}//fim -- if < 7
				  }//fim -- foreach
				}//fim -- if count																					 
  
	}//FIM -- TRY			
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}
	/*********** FIM --- CASO NÃO TENHA 7 USUARIOS CADASTRADOS NA TABELA, ARMAZENA UMA FOTO DE USUARIOS INEXISTENTE ********/	
				
?>