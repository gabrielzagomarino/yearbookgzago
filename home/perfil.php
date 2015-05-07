<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//Capturando o login do usuário
	$myUser = htmlspecialchars($_SESSION['nomeUsuario']);		
		
	/*********** BUSCAR INFORMAÇÕES DO PERFIL ************/
	try
	{			
   
		// cria instrução SQL parametrizada
		$sql = "SELECT p.login, p.nomeCompleto, p.arquivoFoto, c.nomeCidade, e.sigaEstado,
					   p.email, p.descricao
					   
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
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
?>	
	
        <!-- Perfil -->
        <section class="box-perfil">
        
        <?php       						
																										   
				// listando as informações prévias do Perfil
				if (count($resultados)>0){
				  foreach($resultados as $perfilEncontrado){	  	
					?> 
                      <div class="box-img">
                         <figure>
                           <img src="../<?php echo $perfilEncontrado['arquivoFoto']; ?>" title="<?php echo $perfilEncontrado['login']; ?>" alt="<?php echo $perfilEncontrado['login']; ?>" width="240" height="320">
                         </figure>
                      </div>
                      
                       <div class="box-desc">
                       
                        <!-- botao Editar -->
                        <div class="btn-alinha">
                           <form name="editperfil" action="javascript:ajaxFunction('editar.php?id=<?php echo $perfilEncontrado['login']; ?>','carrega_pagina')" method="post">
                               <button type="submit" title="Editar seu Perfil" class="button">
                                   <span>
                                       <span>Editar seu Perfil</span>
                                   </span>
                              </button>
                           </form>
                        </div>
                        <!--Fim - botao voltar -->  
                                                                                               
                       
                         <p class="nm-perfil"><?php echo $perfilEncontrado['nomeCompleto']; ?></p>
                         <p>
                         	<span class="dest">Login: &nbsp;</span>
                            <?php echo $perfilEncontrado['login']; ?>
                         </p>
                         <p>
                            <span class="dest">Cidade / Estado: &nbsp;</span>
                                 <?php echo $perfilEncontrado['nomeCidade']; ?> / <?php echo $perfilEncontrado['sigaEstado']; ?>
                         </p>
                         <p>
                            <span class="dest">E-mail: &nbsp;</span>
                                 <a href="mailto:<?php echo $perfilEncontrado['email']; ?>"><?php echo $perfilEncontrado['email']; ?></a>
                         </p>
                         <p>
                            <span class="dest">Descrição: &nbsp;</span>
                                 <?php echo $perfilEncontrado['descricao']; ?>
                        </p>
                                                
                        <!-- botao Editar -->
                        <div class="btn-alinha">
                           <form name="excperfil" action="index.php?op=desligar" method="post">
                               <button type="submit" title="Excluir seu Perfil" class="button-del">
                                   <span>
                                       <span>Excluir seu Perfil</span>
                                   </span>
                               </button>
                           </form>
                        </div>
                        <!--Fim - botao voltar -->                        
                        
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
	/*********** FIM --- BUSCA INFO PERFIL SQL *****************************************/
	
?>        
        </section>
        <!-- Fim Perfil -->      