
    
ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);


//Affichage des infos du coureur
function loadCycliste(coureurs){
    var div = document.getElementById('tbody');
    var valide='';
    if(div != null){
        div.innerHTML='';
        for(const coureur of coureurs){
            //console.log(coureur);
            if(coureur['valide']){
                valide='<option required>1</option> <option>0</option>';
            }else{
               valide='<option required>0</option> <option>1</option>';
            }
            var element = document.createElement('tr');
            element.innerHTML=  '<td>'+coureur['mail']+'</td>'
                            +'<td><input required type="text" id="nom_'+coureur['mail']+'" value="'+coureur['nom'].trim()+'"></td>'
                            +'<td><input required type="text" id="prenom_'+coureur['mail']+'" value="'+coureur['prenom'].trim()+'"></td>'
                            +'<td><input required type="text" id="date_'+coureur['mail']+'" value="'+coureur['date_naissance']+'"></td>'
                            +'<td><input required type="text" id="num_'+coureur['mail']+'" value="'+coureur['num_licence']+'"></td>'
                            +'<td> <select id="club_'+coureur['mail']+'"><option selected>'+coureur['club'].trim()+'</option> </select> </td>'
                            +'<td> <select id="code_'+coureur['mail']+'"><option selected>'+coureur['code_insee'].trim()+'</option> </select> </td>'
                            +'<td> <select id="valide_'+coureur['mail']+'">'+valide+'</select> </td>'
                            +'<td>'+coureur['categorie']+'</td>'
                            +'<td>'+coureur['categorie_categorie_valeur']+'</td>';
                              
            ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/clubs', (clubs)=>{
                for(const club of clubs){
                    var c=document.getElementById('club_'+coureur['mail']);
                    if(club['club']!=coureur['club'].trim()){
                        var element = document.createElement('option');
                        element.innerHTML = club['club'];
                        c.append(element);
                    }
                }
            });

            ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/code_insee', (codes)=>{
                for(const code of codes){
                    var c=document.getElementById('code_'+coureur['mail']);
                    if(code['code_insee']!=coureur['code_insee'].trim()){
                        var element = document.createElement('option');
                        element.innerHTML = code['code_insee'];
                        c.append(element);
                    }
                }
            });

            div.append(element); 
        }
    }
}



var element = document.getElementById('Modifier');
if(element != null){
    element.onclick=modifierCyclistes;
}


function modifierCyclistes(){
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', UdapteCyclistes);
}


function UdapteCyclistes(cyclistes) {
    for(const cycliste of cyclistes){

        var nom=document.getElementById('nom_'+cycliste['mail']).value;
        var prenom=document.getElementById('prenom_'+cycliste['mail']).value;
        var num=document.getElementById('num_'+cycliste['mail']).value;
        var date=document.getElementById('date_'+cycliste['mail']).value;
        var club=document.getElementById('club_'+cycliste['mail']).value;
        var code=document.getElementById('code_'+cycliste['mail']).value;
        var valide=document.getElementById('valide_'+cycliste['mail']).value;
        
        var param = 'mail='+cycliste['mail']+' & nom='+nom+' & prenom='+prenom+' & num_licence='+num+' & date='+date+' & club='+club+' & code='+code+' & valide='+valide;
        ajaxRequest('PUT', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes/',() => {

        },param);
    }
    alert('Vous avez modifié des informations sur les cyclistes.');
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);
}



/*ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/in1',(cycliste)=>{
    console.log(cycliste);
});*/

