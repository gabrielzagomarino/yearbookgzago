<?php
	
	require_once("../conexao.php");
	require_once("../authSession.php");
	//instancia objeto PDO, conectando-se ao mysql
	$conexao = conn_mysql();
		
?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php
	  //Carrega o Head
	  include('headHome.php');
	?>          
</head>
    
<body onLoad="Redireciona(5,'index.php?op=home','redir','Dados sendo carregados em !tempo segundos.');">

  <!-- Cabeçalho/Menu -->
  <div class="header-user">
    <div class="h-user">
 
        <!-- Form de Busca de Pessoas -->
        <?php
		//Página com campo de Busca/Cabeçalho/Links
		include('menuHome.php');
		?>          
        
    </div>
  </div>
  <!-- Fim -- Cabeçalho/Menu -->

    
  <!-- Mensagem de Bem-Vindo -->
      <?php include('BemVindo.php'); ?> 
  <!-- Fim - Mensagem de Bem-Vindo -->        


  <!-- Aonde será carregado as Páginas dentro da HOME -->
  <div id='loading'>&nbsp;</div>
  <div id='carrega_pagina'>
  
      <!-- Msgs Operações -->
         <?php include('msgOperacoes.php');	?> 
      <!-- FIM Msgs Operações -->     
             
  </div>  

    
     <!-- Rodape -->
     <footer>
       <div class="container">
          <p>
              <small>Desenvolvido por <a href="http://www.gabrielzago.com.br" target="_blank">Gabriel Zago</a></small>
          </p>
       </div>  
     </footer>
     <!-- Fim - Rodape -->

</body>
</html>