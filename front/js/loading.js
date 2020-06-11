
ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);


//Affichage des infos du coureur
function loadCycliste(coureurs){
    var div = document.getElementById('tbody');
    div.innerHTML='';
    for(const coureur of coureurs){
        //console.log(coureur);
        var element = document.createElement('tr');
        element.innerHTML=  '<td>'+coureur['mail']+'</td>'
                            +'<td><input type="text" id="nom_'+coureur['mail']+'" value="'+coureur['nom']+'"></td>'
                            +'<td><input type="text" name="prenom_'+coureur['mail']+'" value="'+coureur['prenom']+'"></td>'
                            +'<td><input type="text" name="date_'+coureur['mail']+'" value="'+coureur['date_naissance']+'"></td>'
                            +'<td><input type="text" name="num_'+coureur['mail']+'" value="'+coureur['num_licence']+'"></td>'
                            +'<td><input type="text" name="club_'+coureur['mail']+'" value="'+coureur['club']+'"></td>'
                            +'<td><input type="text" name="valide'+coureur['mail']+'" value="'+coureur['valide']+'"></td>'
                            +'<td>'+coureur['categorie']+'</td>'
                            +'<td>'+coureur['categorie_categorie_valeur']+'</td>';
        div.append(element); 
    }
}

var element = document.getElementById('Modifier');
element.onclick=modifierCyclistes;

//ajaxRequest('PUT', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes/', ()=>{},'mail=cl@team.gt & nom=B    & prenom=Louis    & num_licence=695576 & date=0000-00-00 & club=ABC PLOUESCAT & valide=1');
//mail=dj@taem.com & nom=Cout & prenom=Claude & num_licence='+1234+
//                       ' & date=2000-5-10 & club=ABC PLOUESCAT    & valide='+1);

function modifierCyclistes(){
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', UdapteCyclistes);
}


//Pas fonctionel 
function UdapteCyclistes(cyclistes) {
    for(const cycliste of cyclistes){

        //var ele=document.getElementsByName('prenom_cl@team.gt');
        //console.log(ele);

        var param = 'mail='+cycliste['mail']+' & nom=B & prenom='+cycliste['prenom']+' & num_licence='+cycliste['num_licence']+' & date='+cycliste['date_naissance']+' & club=ABC PLOUESCAT & valide='+cycliste['valide'];
        console.log(param);
        ajaxRequest('PUT', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes/',() => {
 
        },param);
    }
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);
    alert('Vous avez modifié des informations sur les cyclistes.');
}

//Pour les informations de course

function loadCourse(courses){
    var parcours = "";

    courses.forEach(course =>{
        // console.table(coureur);
        parcours = fillCourse(course);
        $('#courses').append(parcours);
    });

}

function fillCourse(course){
    var chemin = '<tr><th>'+course['id']+'</th><td>'+course['libelle']+'</td><td>'+course['date']+'</td><td>'+course['nb_tour']+'</td><td>'+course['distance']+'</td><td>'+course['nb_coureur']+'</td><td>'+course['longueur_tour']+'</td><td>'+course['club']+'</td><td><button class="button" name="btnSub" id="'+course['id']+'">Voir +</button></td></tr>';
    console.log(chemin);
    return chemin;
}

ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses', loadCourse);
ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses', fillCourseName);


//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////NON FONCTIONNEL /////////////////////////////////////////////////////////////////

function fillCourseName(course){
    var name = '<h2>'+course['libelle']+'</h2>';
    $('#course_name').append(name);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
