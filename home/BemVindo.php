<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();		
		
	/*********** CONTAGEM TOTAL DE USUÁRIOS ************/
	try
	{			
   
		// cria instrução SQL parametrizada
		$sql = "SELECT count(*) as QTD FROM participantes";
					  
		//prepara a execução
		$operacaoCount = $conexao->prepare($sql);							  			  
   
		//executa a sentença SQL
		$contar = $operacaoCount->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacaoCount->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;    						
																										   
				// listando QTD
				if (count($resultados)>0){
				  foreach($resultados as $totalUsers){	  	
					?>   
					<div class="container">
                        <div class="row">
                           <div class="col-md-12">
                                             
                               <div class="col-md-12">
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                               </div>
                               
                               <header>
                                  <h1>Yearbook</h1>
                                  <p>&nbsp;</p>
                                  <p>&nbsp;</p>
                                  <p>&nbsp;</p>                              
                                  <div class="col-md-12">
                                      <div class="box-intro">
                                        <span>Seja Bem-Vindos!</span>
                                        <p>Estamos altualmente com <b><?php echo $totalUsers['QTD']; ?></b> usuários em nossa rede do <b>Yearbook</b>.</p>
                                        <p>Convide seus amigos para fazer parte!</p>
                                        <p>&nbsp;</p>
                                      </div> 
                                  </div>
                               </header>
                           
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