//----------------------------------------------------------
//Função captura um objeto
//----------------------------------------------------------
function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}


//-----------------------
//Cria um objeto em Ajax
//-----------------------
function Get_ObjAjax(){
  try {
    // Firefox, Opera 8.0+, Safari
    return new XMLHttpRequest();
  }
  catch (e) {
    // Internet Explorer
    try {
      return new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
      try {
        return new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e) {
        alert("O sistema utiliza tecnologia AJAX, o seu browser não suporta esta tecnologia.\n Faça uma atualização!");
        return false;
      }
    }
  }
}

//-----------------------------------------------------------------------------------------
//Chama o carregamento de uma página em AJAX
// input: url - página a ser chamada.
//        campo_dados - campo a ser carregado: ser o id começar com "txt" carrega o texto; 
//                      caso contrário, carrega um valor para o campo.
//-----------------------------------------------------------------------------------------
function ajaxFunction(url, campo_dados){
  var xmlHttp = Get_ObjAjax();

  if(xmlHttp){
	  xmlHttp.onreadystatechange = function() {

          getObj('loading').innerHTML = '<img src="../imagens/carregando.gif" border="0" >';
          //getObj('loading').innerHTML = 'Carregando...';

		  if(xmlHttp.readyState==4) {
			
			getObj(campo_dados).innerHTML = xmlHttp.responseText;
			

            getObj('loading').innerHTML = '';
		  }
	  }
  }

  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);

}