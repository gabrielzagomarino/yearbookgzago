<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//Capturando o login do usuário
	$idUser = htmlspecialchars($_GET['id']);		
		
	/*********** BUSCAR INFORMAÇÕES DO PERFIL ************/
	try
	{			
   
		// cria instrução SQL parametrizada
		$sql = "SELECT p.login, p.nomeCompleto, p.arquivoFoto, c.nomeCidade, e.sigaEstado,
					   p.email, p.descricao
					   
					   FROM participantes p, cidades c, estados e
					   
				WHERE p.cidade = c.idCidade
				AND   c.idEstado = e.idEstado
				
				AND   p.login = '$idUser'";
					  
		//prepara a execução
		$operacao = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$pesquisar = $operacao->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
?>		
        <!-- Perfil -->
        <div class="container">
        <div class="row">
           <div class="col-md-12">         
        
              <section class="box-perfil">
              
			      <div class="row">              
              
              <?php       						
                                                                                                                 
                      // listando as informações prévias do Perfil
                      if (count($resultados)>0){
                        foreach($resultados as $perfilEncontrado){	  	
                          ?> 

                            <div class="col-md-3">
                              <div class="box-img">
                                <a class="thumbnail">
                                   <figure>
                                     <img src="../<?php echo $perfilEncontrado['arquivoFoto']; ?>" title="<?php echo $perfilEncontrado['login']; ?>" alt="<?php echo $perfilEncontrado['login']; ?>">
                                   </figure>                                
                                </a>
                              </div>  
                            </div>
                            
                            
                            <div class="col-md-8">
                               <div class="box-desc">
                                 <p class="nm-perfil"><?php echo strip_tags($perfilEncontrado['nomeCompleto']); ?></p>
                                 <p>
                                    <span class="dest">Login: &nbsp;</span>
                                    <?php echo strip_tags($perfilEncontrado['login']); ?>
                                 </p>
                                 <p>
                                    <span class="dest">Cidade / Estado: &nbsp;</span>
                                         <?php echo strip_tags($perfilEncontrado['nomeCidade']); ?> / <?php echo $perfilEncontrado['sigaEstado']; ?>
                                 </p>
                                 <p>
                                    <span class="dest">E-mail: &nbsp;</span>
                                         <a href="mailto:<?php echo $perfilEncontrado['email']; ?>"><?php echo $perfilEncontrado['email']; ?></a>
                                 </p>
                                 <p>
                                    <span class="dest">Descrição: &nbsp;</span>
                                         <?php echo strip_tags($perfilEncontrado['descricao']); ?>
                                </p>
                               </div> 
                            </div>                  
                  
                          <?php					
                                              
                        }
                      }else{
                          //caso não exista o perfil
                          include('logoutErroModulo.php');
                      }
        
          }//FIM -- TRY			
          
          
          catch (PDOException $e)
          {
              // caso ocorra uma exceção, a exibe na tela
              echo "Erro!: " . $e->getMessage() . "<br />";
              die();
          }
          /*********** FIM --- BUSCAR BUSCA INFO PERFIL *****************************************/
          
      ?>  
      
			      </div><!-- FIM - row -->  
                              
              </section>
        
          </div>
        </div>  
        </div>         
        <!-- Fim Perfil -->