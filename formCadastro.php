<div id="cadastro">

    <h1>Cadastre no Yearbook</h1>
    
    <p>Em menos de 5 minutos vocês estará conectado.</p>
    <p>Preencha seus dados abaixo:</p>

	<form name="cadform" id="cadform" action="cadastro.php?op=record#b" method="post" class="cadform" enctype="multipart/form-data">
        <p>
            <label>Nome Completo
            	<input type="text" name="nm_completo" id="nm_completo" class="input" maxlength="50" size="20" required="required" placeholder="Digite seu Nome Completo">
            </label>
        </p>
        
        <p>
            <label>Email
            	<input name="email" id="email" class="input" size="20" type="email" maxlength="50" required="required" placeholder="algumacoisa@dominio">
            </label>
        </p>
        
        <p>
            <label>Login
            	<input type="text" name="user_login" id="user_login" class="input" size="20" maxlength="20" required="required" placeholder="Digite um Login" onKeyUp="this.value=retira_acentos(this.value);">
            </label>
        </p>
        
        <p>
            <label>Senha
            	<input type="password" name="senha" id="senha" class="input" size="20" maxlength="50" required="required" placeholder="********">
            </label>
        </p>  
        
        <p>
            <label>Confirme sua Senha
            	<input type="password" name="conf_senha" id="conf_senha" class="input" size="20" maxlength="50" required="required" placeholder="********">
            </label>
        </p> 
        
        <p> 
            <label>Estado</label>
            <p>
                <select id="estado" name="estado" class="select-estado" required onChange="ajaxFunction('modulos/exibeCidades.php?codigo='+cadform.estado.value,'cidades')">
                    <option value="">-- Selecione --</option>
                    
                         <?php 

						  try
						  {	
						  					 
							  //instancia objeto PDO, conectando-se ao mysql
							  $conexao = conn_mysql();						 
						 
							  // cria instrução SQL parametrizada
							  $sql = "SELECT idEstado, sigaEstado FROM estados ORDER BY 1";							  
											
							  //prepara a execução
							  $operacao = $conexao->prepare($sql);							  			  
				
							  //executa a sentença SQL
							  $pesquisar = $operacao->execute();
							  
							  //captura TODOS os resultados obtidos
							  $resultados = $operacao->fetchAll();
							  
							  // fecha a conexão
							  $conexao = null;
												  							  						                             
							  // listando todas as cidades para fazer a seleção
							  if (count($resultados)>0){
							  	foreach($resultados as $estadosEncontrados){	  	
								  echo "<option value='".$estadosEncontrados['idEstado']."'>".$estadosEncontrados['sigaEstado']."</option>";
								}
							  }
							  else{
								  echo"<option value=''>Nenhum Estado Encontrado!</option>";
							  }
							  
						  }
						  
						  
						  catch (PDOException $e)
						  {
							  // caso ocorra uma exceção, a exibe na tela
							  echo "Erro!: " . $e->getMessage() . "<br />";
							  die();
						  }	
						  					  
								
                          ?> 
                          
                </select> 
            </p>
        </p>        
        
        
        <!-- Aonde será carregado o <select> das Cidades a partir da seleção de um estado -->
        <div id='loading'>&nbsp;</div>
        <div id='cidades'></div>                              

		<p>&nbsp;</p>       
        
        
        <p>
            <label>Descrição
            	<textarea name="desc" id="desc" cols="53" rows="5" required="required" maxlength=5000></textarea>
            </label>
        </p>         
        
        <p>&nbsp;</p> 
        
        <p>
            <label>Foto (Recomendado: 240px altura x 320px largura)
            	<input type="hidden" name="MAX_FILE_SIZE" value="500000" >
                <input name="foto" id="foto" type="file">
            </label>
        </p> 
                
        
        <p class="submit" id="b">
            <input type="submit" name="salvar" id="salvar" class="button-primary" value="Cadastre-se" tabindex="100">
        </p>
        
	</form>    

</div>