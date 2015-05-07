/*Por: Gabriel Zago ##################################################################*/
/*########################## Função de Retirar a Acentuação ##########################*/
/*####################################################################################*/

function retira_acentos(palavra) {
   com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';
   sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
   nova='';   
      for(i=0;i<palavra.length;i++) {   
       if (com_acento.search(palavra.substr(i,1))>=0) {  
         nova+=sem_acento.substr(com_acento.search(palavra.substr(i,1)),1);   
         }   
          else {   
                 nova+=palavra.substr(i,1);   
               }   
         }   
           return nova;
       }   
	   
/*####################################################################################*/
/*########################## FIM -- Função de Retirar a Acentuação ###################*/
/*####################################################################################*/
	   