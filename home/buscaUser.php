<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//Capturando o conteúdo digitado na busca
	$buscaUser = htmlspecialchars($_GET['busca_user']);		
		
	/*********** BUSCAR O(S) USER(S) NA ORDEM DO SQL ************/
	try
	{
	
		// se não foram passados 1 parâmetro na requisição, desvia para a mensagem de erro
		// "previne" acesso direto à página
		if(count($_GET)!=1){
			?>
              <p><b>Não foi possível realizar a busca.</b></p>
              <p>&nbsp;<p>
			<?php
            die();
		}
		//se existem os parâmetros...
		else{			
   
		// cria instrução SQL parametrizada, pesquisa os 9 registros primeiros
		$sql = "SELECT login, nomeCompleto, arquivoFoto FROM participantes
		        WHERE  ((nomeCompleto like '%$buscaUser%') or (login like '%$buscaUser%'))
				ORDER BY nomeCompleto";
					  
		//prepara a execução
		$operacao = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$pesquisar = $operacao->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
		?>
        
        <!-- Principal -->
         <section>
           <ul>
           
           <p>&nbsp;</p>             
           
        <?php       						
																										   
				// listando as informações prévias do Perfil
				if (count($resultados)>0){
				
				?>
                	<p>A busca encontrou <b><?php echo count($resultados); ?></b> 
					<?php if(count($resultados)>1){ ?> usuários<?php }else{ ?> usuário <?php } ?> na rede.</p>
                <?php	
					
				  foreach($resultados as $userEncontrado){	  	
					?>                    
                       <li>       
                          <figure>
                            <a href="javascript:ajaxFunction('perfilUser.php?id=<?php echo $userEncontrado['login']; ?>','carrega_pagina')" title="<?php echo $userEncontrado['login']; ?>">
                              <img src="../<?php echo $userEncontrado['arquivoFoto']; ?>" alt="<?php echo $userEncontrado['login']; ?>" title="<?php echo $userEncontrado['login']; ?>" width="240" height="320">
                              <figcaption><?php echo $userEncontrado['nomeCompleto']; ?></figcaption>
                              <p><?php echo $userEncontrado['login']; ?></p>
                            </a> 
                          </figure>       
                       </li>                    
					<?php										
				  }//FIM -- foreach
				
				}//FIM -- if
				else
				{
					?>
						<p><b>Nenhum usuário foi encontrado.</b></p>
                        <p>&nbsp;<p>
                    <?php    
				}
		
		}//FIM -- count $_GET
  
	}//FIM -- TRY			
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}
	/*********** FIM --- BUSCAR OS 7 PRIMEIROS USUARIOS NA ORDEM DO SQL *****************************************/
	
?>
          </ul>
         </section>
        <!-- Fim - Principal -->