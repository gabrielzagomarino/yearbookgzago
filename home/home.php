<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();		
		
	/*********** BUSCAR OS 9 PRIMEIROS USUARIOS NA ORDEM DO SQL ************/
	try
	{			
   
		// cria instrução SQL parametrizada, pesquisa os 9 registros primeiros
		$sql = "SELECT login, nomeCompleto, arquivoFoto FROM participantes ORDER BY nomeCompleto LIMIT 9";
					  
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
        
        <div class="container">
        <div class="row">
           <div class="col-md-12">  
                
               <section>
                 <ul>
                 
                 <p>&nbsp;</p>
                 <p>Mostrando somente até <b>9</b> usuários. Para encontrar um deles em toda a rede, utilize a busca na barra do cabeçalho acima.</p> 
                 
                 	<div class="row">                  
                 
              <?php       						
                                                                                                                 
                      // listando as informações prévias do Perfil
                      if (count($resultados)>0){
                        foreach($resultados as $userEncontrado){	  	
                          ?>
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">          
                                  <figure>
                                    <a href="javascript:ajaxFunction('perfilUser.php?id=<?php echo $userEncontrado['login']; ?>','carrega_pagina')" title="<?php echo $userEncontrado['login']; ?>">
                                      <img src="../<?php echo $userEncontrado['arquivoFoto']; ?>" alt="<?php echo $userEncontrado['login']; ?>" title="<?php echo $userEncontrado['login']; ?>" width="240" height="320" />                                      
                                    </a> 
                                  </figure>
                                                                  
                                  <div class="caption">
                                    <h3>
                                      <a href="javascript:ajaxFunction('perfilUser.php?id=<?php echo $userEncontrado['login']; ?>','carrega_pagina')" title="<?php echo $userEncontrado['login']; ?>">
                                          <figcaption><?php echo strip_tags($userEncontrado['nomeCompleto']); ?></figcaption>
                                      </a>
                                    </h3>
                                    
                                      <a href="javascript:ajaxFunction('perfilUser.php?id=<?php echo $userEncontrado['login']; ?>','carrega_pagina')" title="<?php echo $userEncontrado['login']; ?>">                                      
                                    	<p><?php echo strip_tags($userEncontrado['login']); ?></p>
                                      </a>
                                        
                                      <p><a href="javascript:ajaxFunction('perfilUser.php?id=<?php echo $userEncontrado['login']; ?>','carrega_pagina')" title="<?php echo $userEncontrado['login']; ?>" class="btn btn-primary" role="button">Ver Perfil</a></p>
                                    
                                  </div>
                                </div>
                              </div>                
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
          
      ?> 
      
                 	</div><!-- Fim -- row -->  
                                             
                </ul>
               </section>
               
          </div>
        </div>  
        </div>             
        <!-- Fim - Principal -->