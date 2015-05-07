<?php
	require_once("../conexao.php");
	require_once("../authSession.php");
?>

<form name="editform" id="editform" action="index.php?op=atualizar" method="post" enctype="multipart/form-data">

    <div class="box-img">
    
      <p><b>Alterar Foto</b> (Recomendado: 240px x 320px)
        <input type="hidden" name="MAX_FILE_SIZE" value="500000" >
        <input name="foto" id="foto" type="file" class="edit-ft">
        
		<?php $_SESSION['arquivoFoto'] = $resultados[0]['arquivoFoto']; ?>
        
      </p>
      
       <figure>
         <img src="../<?php echo $resultados[0]['arquivoFoto']; ?>" title="<?php echo $resultados[0]['login']; ?>" alt="<?php echo $resultados[0]['login']; ?>" width="240" height="320">
       </figure>                      
    </div> 
    
    
     <div class="box-desc">
     
        <p><span class="dest">Nome: </span>
                <input type="text" name="nm_completo" id="nm_completo" class="input" maxlength="50" size="20" required autofocus value="<?php echo $resultados[0]['nomeCompleto']?>">
        </p>  
        
       <p><span class="dest">Email: </span>
                <input type="text" name="email" id="email" class="input" maxlength="50" size="20" required="required" value="<?php echo $resultados[0]['email']?>">
       </p>                                           
     
       <p><span class="dest">Login: </span>
                <input type="text" name="user_login" id="user_login" class="input" maxlength="20" size="20" required="required" value="<?php echo $resultados[0]['login']?>" onKeyUp="this.value=retira_acentos(this.value);">
                
                <?php $_SESSION['loginAtual'] = $resultados[0]['login']; ?>
       </p>
       
       <p><span class="dest">Nova Senha: </span>
                <input type="password" name="senha" id="senha" class="input" maxlength="50" size="20" required="required" placeholder="********">
       </p>
       
       <p><span class="dest">Confirme a Nova Senha: </span>
                <input type="password" name="conf_senha" id="conf_senha" class="input" maxlength="50" size="20" required="required" placeholder="********">
       </p>                                              
       
       <p>
          <span class="dest">Estado: &nbsp;</span>
              <select id="estado" name="estado" class="edit-select-estado" required onChange="ajaxFunction('exibeCidades.php?codigo='+editform.estado.value,'cidades')">
                  <option value="<?php echo $resultados[0]['sigaEstado']?>" disabled="disabled"><?php echo $resultados[0]['sigaEstado']?></option>
                  
                       <?php 

                        try
                        {	
                       
                            // cria instrução SQL parametrizada
                            $sql_est = "SELECT idEstado, sigaEstado FROM estados ORDER BY 1";							  
                                          
                            //prepara a execução
                            $operacaoEst = $conexao->prepare($sql_est);							  			  
              
                            //executa a sentença SQL
                            $pesquisarEst = $operacaoEst->execute();
                            
                            //captura TODOS os resultados obtidos
                            $resultadoEst = $operacaoEst->fetchAll();                                            
                                                                                                                               
                            // listando todas as cidades para fazer a seleção
                            if (count($resultadoEst)>0){
                              foreach($resultadoEst as $estadosEncontrados){	  	
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
              
              <div>
                <span class="dest">Cidade Atual: &nbsp;</span>
                    <select id="cidade_atual" name="cidade_atual" class="edit-select-cidade-dis" disabled="disabled">
                        <option value=""><?php echo $resultados[0]['nomeCidade']; ?></option>
                        
                        <?php $_SESSION['cidade_atual'] = $resultados[0]['cidade']; ?>
                        
                    </select>                               
              </div>
              
              <!-- Aonde será carregado o <select> das Cidades a partir da seleção de um estado -->
              <div id='loading'>&nbsp;</div>
              <div id='cidades'></div>                               
       </p>                       
       
       <p>
          <span class="dest">Descrição:</span>
               <textarea name="desc" id="desc" class="edit-desc" cols="53" rows="6" required="required" maxlength=5000><?php echo $resultados[0]['descricao']?></textarea>
      </p>
                              
      <!-- botao Editar -->      
      
      <div class="btn-alinha" id="b">
         <button title="Salvar Perfil" class="button-save" type="submit">
             <span>
                 <span><a>Salvar Perfil</a></span>
             </span>
        </button>
      </div>
      <!--Fim - botao voltar -->                        
      
    </div> 
                                    
</form>