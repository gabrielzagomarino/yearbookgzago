<?php
session_start();
	
	require_once("conexao.php");
	
      if(isset($_POST["login"])){		//existe um login enviado via POST (formulário)
            $log = htmlspecialchars($_POST["login"]);
            $senha = htmlspecialchars($_POST["passwd"]);
			if(isset($_POST["lembrarLogin"]))
				$lembrar = htmlspecialchars($_POST["lembrarLogin"]);
			else 
			    $lembrar="";
         
      }
      elseif(isset($_COOKIE["loginAutomatico"])){ 	//existe um cookie com nome senha --> login automático
            $log = htmlspecialchars($_COOKIE["loginYearbook"]);
            $senha = htmlspecialchars($_COOKIE["loginAutomatico"]);
		   }
        else{
	  	       header("Location: erroLogin.php");
               die();
		}         
 try{
		// instancia objeto PDO, conectando no mysql
		$conexao = conn_mysql();
						
		// instrução SQL básica (sem restrição de nome)
		$SQLSelect = 'SELECT * FROM participantes WHERE senha=MD5(?) AND login=?';
				
		//prepara a execução da sentença
		$operacao = $conexao->prepare($SQLSelect);					  
				
		//executa a sentença SQL com o valor passado por parâmetro
		$pesquisar = $operacao->execute(array($senha, $log));
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
		
		// se há zero ou mais de um resultado, login inválido.
		if (count($resultados)!=1){	
			header("Location: erroLogin.php");
            die();
		}   
		else{ // se há um resultado, login confirmado.
			setcookie("loginYearbook", $log, time()+60*60*24*120); //guarda o login por 120 dias a partir de agora
			if(!empty($lembrar)){
 			    setcookie("loginAutomatico", $senha, time()+60*60*24*120); //guarda a senha por 120 dias a partir de agora	
			}
		   $_SESSION['auth']=true;
		   $_SESSION['nomeCompleto'] = $resultados[0]['nomeCompleto'];
		   $_SESSION['nomeUsuario'] = $log;
		   header("Location: home/index.php?op=home");
		   die();
		}
	} //fim -- try
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}
?>