<?php

	require_once("../conexao.php");
	require_once("../authSession.php");	

	//Cadastra as operações em um vetor
	$vet_op = array("home", "atualizar", "success", "desligar", "external");
	
       
	   //Verifica as operações, caso não exista, retorna a um erro
       if(isset($_GET['op'])){	  		
            
            $op = $_GET['op'];
            
            //Caso a operação exista, chama a página home.php
            if ($op==$vet_op[0])
            {
                include('home.php');
                     
            }//FIM -- If
			
			
			
            //Caso operação para atualizar o perfil e derecionar p/ página com a mensagem de confirmação
            if ($op==$vet_op[1])
            {  
                //rotina para Atualizar o Usuário gravando no Banco
                include('editarUser.php');            
			
				?>			
					<script language= "JavaScript">
                        location.href="index.php?op=success";
                    </script>				
				<?php					
					  
            }//FIM -- If success 
			
			
			
			//Mensagem de confirmação de atualização do perfil
			if($op==$vet_op[2])
			{
			    
				include('home.php');
				
				?>      
					<script type="text/javascript">				
						$(document).ready(function () {		
							$.noty.consumeAlert({layout: 'bottomCenter', type: 'success', dismissQueue: true});
							alert("Seu Perfil foi atualizado com sucesso.");
							$.noty.consumeAlert({layout: 'bottomCenter', type: 'success', dismissQueue: true});
							alert("<?php echo "<div id='redir'></div>" ?>");							
					
						});
					</script>
                    
				<?php				
			
			}
			
			
			//Mensagem de pergunta para Deletar o perfil
			if($op==$vet_op[3])
			{
			    
				include('home.php');
				
				?>      
					<script type="text/javascript">
                    
                        function generate(layout) {
                            var n = noty({
                                text        : 'Ficaremos tristes com sua saída. Deseja realmente excluir seu perfil?',
                                type        : 'alert',
                                dismissQueue: true,
                                layout      : layout,
                                theme       : 'defaultTheme',
                                buttons     : [
                                    {addClass: 'btn btn-primary', text: 'Sim', onClick: function ($noty) {
                                        $noty.close();
                                        location.href="deletarPerfil.php";
                                    }
                                    },
                                    {addClass: 'btn btn-danger', text: 'Não', onClick: function ($noty) {
                                        $noty.close();
                                        noty({dismissQueue: true, force: true, layout: layout, theme: 'defaultTheme', text: 'Oba! Que bom que você não fez isso!', type: 'success'});
										location.href="index.php?op=home";
                                    }
                                    }
                                ]
                            });
                            console.log('html: ' + n.options.id);
                        }
                    
                        function generateAll() {
                            generate('top');
                        }
                    
                        $(document).ready(function () {
                    
                            generateAll();
                    
                        });
                    
                    </script>
				<?php				
			
			}
			
			
			
			 //Verifica a operação de acesso externo, ao clicar em uma foto de miniatura
			 //de um perfil na página de login
			 if(isset($_GET['op'])){
				 
				 if(isset($_GET['id'])){	  		
				  
					  $op = $_GET['op'];
					  $id = $_GET['id'];
					  
					  //Caso a operação exista, chama a página home.php
					  if ($op==$vet_op[4])
					  {
						  include('perfilUser.php');
							   
					  }
					  
				 }//FIM -- isset($_GET['id']
			 }//FIM -- isset($_GET['op']
			
						
			
						
            if(($op!=$vet_op[0])and($op!=$vet_op[1])and($op!=$vet_op[2])and($op!=$vet_op[3])and($op!=$vet_op[4]))
            {
                //se não existir a operação, desloga do sistema
                include('logoutErroModulo.php');
            }
			
       
	   }//FIM -- isset($_GET['op'])
?>	      