<?php
	
	require_once("../conexao.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
	
	//captura o idEstado do <SELECT>
	$codigo = $_GET['codigo'];	
	
	try
	{			
   
		// cria instrução SQL parametrizada
		$sql = "SELECT idCidade, idEstado, nomeCidade FROM cidades WHERE idEstado = $codigo order by nomeCidade";
					  
		//prepara a execução
		$operacao = $conexao->prepare($sql);							  			  

		//executa a sentença SQL
		$pesquisar = $operacao->execute();
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
		?>
		
        <p>&nbsp;</p>
        
        <p>
            <label>Cidade</label>
          <p>
            <select id="cidade" name="cidade" class="select-cidade" required>
                <option value="">-- Escolha uma Cidade --</option>
            
        <?php			
																										   
				// listando todos os estados para fazer a seleção
				if (count($resultados)>0){
				  foreach($resultados as $cidadesEncontradas){	  	
					echo "<option value='".$cidadesEncontradas['idCidade']."'>".htmlspecialchars($cidadesEncontradas['nomeCidade'])."</option>";
				  }
				}
				else{
					echo"<option value=''>Nenhuma Cidade Encontrada!</option>";
				}
	   ?>
           </select> 
         </p>
       </p>              
       
       <?php        
  
	}
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}

?>