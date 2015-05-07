<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();	
	
	try
	{			
   
		// se não foram passados 8, 9 e 10 parâmetros na requisição, desvia para a mensagem de erro
		// "previne" acesso direto à página
		if((count($_POST)!=7) and (count($_POST)!=8) and (count($_POST)!=9) and (count($_POST)!=10)){
			include("erroUpdate.php");
			die();
		}
		//se existem os parâmetros...
		else{
			
			
		//Caso não troque a Cidade Atual		
		if(isset($_POST['cidade']))
		{
				if($_POST['cidade']!=''){					
					$cidade = htmlspecialchars($_POST['cidade']);	
				}
		}else{
				$cidade = $cidade = $_SESSION['cidade_atual'];
			 }		
		

		
		//captura valores do vetor POST
		//utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
		$nome_completo = htmlspecialchars($_POST['nm_completo']);
		$email = htmlspecialchars($_POST['email']);
		$user_login = htmlspecialchars($_POST['user_login']);
		$senha = htmlspecialchars($_POST['senha']);
		$conf_senha = htmlspecialchars($_POST['conf_senha']);				
		$descricao = htmlspecialchars($_POST['desc']);
		$descricao = str_replace("'", " ", $descricao); //evitar dar erro na inserção
		
		
			/*********** VERIFICAR SE JÁ EXISTE UM LOGIN COM O MESMO NOME PASSADO CADASTRADO ************/
			try
			{
				
				if($_SESSION['nomeUsuario']!=$user_login){			
		   
					// cria instrução SQL parametrizada
					$sql = "SELECT login FROM participantes WHERE login = '$user_login'";
								  
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
							  foreach($resultados as $loginEncontrado){	  	
								?>
									<!-- Mensagem Personalizada -->                        
									<script type="text/javascript">
										$(document).ready(function () {		
											$.noty.consumeAlert({layout: 'bottomCenter', type: 'warning', dismissQueue: true});
											alert("Login <?php echo $loginEncontrado['login']; ?> já existe.");
										});
									</script>                             
								<?php
								
								die();
								
							  }
							}
						
				}//FIM --- if
		  
			}//FIM -- TRY			
			
			
			catch (PDOException $e)
			{
				// caso ocorra uma exceção, a exibe na tela
				echo "Erro!: " . $e->getMessage() . "<br />";
				die();
			}
			/*********** FIM --- VERIFICAÇÃO LOGIN EXISTENTE *****************************************/
				
				
				
		//conferir Senha e Confirmação de Senha caso sejam diferentes, exibe erro
		if($senha!=$conf_senha){
			include("erroConfSenha.php");
			die();
		}					

		
		//##### UPLOAD DA IMAGEM #####//
		
		//Caso não troque a Foto
		if(($_FILES["foto"]["name"])==''){
			$cam_foto = $_SESSION['arquivoFoto'];
		}else{
		
			//strings de tipos e extensoes validas
			$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");
			$temp = explode(".", basename($_FILES["foto"]["name"]));
			$extensao = end($temp);		
			
			if ((in_array($extensao, $permissoes))
			&& (in_array($_FILES["foto"]["type"], $permissoes))
			&& ($_FILES["foto"]["size"] < $_POST["MAX_FILE_SIZE"]))
			  {
			  if ($_FILES["foto"]["error"] > 0)
				{
				echo "<h1>Erro no envio, código: " . $_FILES["foto"]["error"] . "</h1>";
				}
			  else
				{
				  $dirUploads = "../uploads/";
				  $nomeUsuario = $user_login."/";	  
				  
				  if(!file_exists ( $dirUploads ))
						mkdir($dirUploads, 0500);  //permissao de leitura e execucao
				  
				  $caminhoUpload = $dirUploads.$nomeUsuario;
				  if(!file_exists ( $caminhoUpload ))
						mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
						
				  
				  //colhendo tamanho do título da foto, caso for grande, retorna mensagem de erro
				  $tam_tit_foto = strlen($_FILES["foto"]["name"]);			  
				  if($tam_tit_foto>10){
					include('erroArqTitBig.php');
					die();			  
				  }
				  
				  $pathCompleto = $caminhoUpload.basename($_FILES["foto"]["name"]);
				  if(move_uploaded_file($_FILES["foto"]["tmp_name"], $pathCompleto))
					//variável vai receber o caminho aonde a foto foi armazenada no diretório			  
					//preg_replace = retirar acentuação 
					$cam_foto = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', htmlspecialchars($pathCompleto)));					
				  else
					include('erroArmazArq.php');
				}
			  }
			else
			  {
			  include('erroArqInvalido.php');
			  die();
			  }	
		
		}//FIM -- If else $foto==''
		  
		//##### FIM --- UPLOAD DA IMAGEM #####//		

		
	    //abre conexão
		$conexao = conn_mysql();
		
		//acertando o caminho novo da foto
		$cam_foto = str_replace("../", "", $cam_foto);		

		// cria instrução SQL UPDATE
		$SQLUpdate = "UPDATE participantes SET login='$user_login', senha=MD5('$senha'), nomeCompleto='$nome_completo', arquivoFoto='$cam_foto', cidade=$cidade, email='$email', descricao='$descricao' WHERE login='$_SESSION[loginAtual]'";

		//prepara a execução
		$operacaoUpdate = $conexao->prepare($SQLUpdate);					  
		
		//executa a sentença SQL com os parâmetros passados
		$update = $operacaoUpdate->execute();
		
		// fecha a conexão ao banco
		$conexao = null;				
		
		//verifica se o retorno da execução foi verdadeiro ou falso,
		//imprimindo mensagens ao cliente
		if (!$update){
				$arr = $operacaoUpdate->errorInfo();		//mensagem de erro retornada pelo SGBD
				?>
					<!-- Mensagem Personalizada -->                        
					<script type="text/javascript">
						$(document).ready(function () {		
							$.noty.consumeAlert({layout: 'bottomCenter', type: 'error', dismissQueue: true});
							alert("Erro na Operação. <?php echo $arr[2]; ?>"); //deve ser melhor tratado em um caso real
						});
					</script>                             
				<?php
				
				die();					        
		}		
		
		  //atualiza sessões
		  $_SESSION['nomeUsuario'] = $user_login;
		  $_SESSION['nomeCompleto'] = $nome_completo;				

		   
		}//fim If count $_POST
  
	}//fim -- TRY GERAL
	
	
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, a exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br />";
		die();
	}

?>