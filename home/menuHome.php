<?php
	require_once("../authSession.php");
?>

  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>    
        
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                       
          <form class="navbar-form navbar-left" role="search" name="buscaform" id="buscaform" action="javascript:ajaxFunction('buscaUser.php?busca_user='+buscaform.buscaUser.value,'carrega_pagina')" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Pesquise..." name="buscaUser" id="buscaUser">
            </div>
            <button type="submit" class="btn-busca">&nbsp;</button>
          </form>                    
          
          <ul class="nav navbar-nav navbar-right" id="lk-home">        
                <li>
                  <span class="icon-home"></span>
                  <a href="javascript:ajaxFunction('home.php','carrega_pagina')" title="Página Inicial">Página Inicial</a>
                </li>
                
                <li>
                  <span class="icon-perfil"></span>
                  <a href="javascript:ajaxFunction('perfil.php','carrega_pagina')" title="Visualizar Perfil">
                      <?php echo $_SESSION['nomeUsuario']; ?>
                  </a>
                </li>
                
                <li><span class="icon-logout"></span><a href="logout.php" title="Sair do Yearbook">Sair</a></li>
          </ul>
        
      </div><!-- /.navbar-collapse -->
      
    </div><!-- /.container-fluid -->
  </nav>