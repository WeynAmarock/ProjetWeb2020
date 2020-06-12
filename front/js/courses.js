ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/classement', loadCourse);

function loadCourse(courses){
    affichageCourse();
    var div = document.getElementById('course_content');
    if(div != null){
        div.innerHTML='';
        for(const course of courses){
            //console.table(course);
            var element = document.createElement('tr');
            element.innerHTML='<td>'+course['id']+'</td>'
                                +'<td>'+course['libelle']+'</td>'
                                +'<td>'+course['date']+'</td>'
                                +'<td>'+course['nb_tour']+'</td>'
                                +'<td>'+course['distance']+'</td>'
                                +'<td>'+course['nb_coureur']+'</td>'
                                +'<td>'+course['longueur_tour']+'</td>'
                                +'<td>'+course['club']+'</td>'
                                +'<td> <button class="button" name="bouton_course" id='+course['id']+'>Classement</button></td>';
            div.append(element);
        }
    }
}


$('#course_content').on('click', 'button', () => {
    var id = $(event.target).attr('id');
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/classement/'+id, loadClassement);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/vitesse/'+id,(vitesse)=>{
        var div1=document.getElementById('vitesse');
        div1.innerHTML('Temps indicatif du premier'+vitesse);
    });
});

function loadClassement(cyclistes){
    affichageClassement();
    var div = document.getElementById('classement_content');
    if(div != null){
        div.innerHTML='';
        for(const cycliste of cyclistes){
            var element = document.createElement('tr');   
            element.innerHTML='<td>'+cycliste['place']+'</td>'
                                +'<td>'+cycliste['dossard']+'</td>'
                                +'<td>'+cycliste['nom']+'</td>'
                                +'<td>'+cycliste['prenom']+'</td>'
                                +'<td>'+cycliste['club']+'</td>'
                                +'<td>'+cycliste['num_licence']+'</td>'
                                +'<td'+cycliste['categorie']+'</td>'
                                +'<td>'+cycliste['categorie_valeur']+'</td>'
                                +'<td>'+cycliste['point']+'</td>';
            div.append(element);
        }
    }
}

function affichageClassement(){
    document.getElementById('course').style.display='none';
    document.getElementById('classement').style.display='block';
}

function affichageCourse(){
    document.getElementById('course').style.display='block';
    document.getElementById('classement').style.display='none';
}



var element = document.getElementById('Retour');
if(element != null){
    element.onclick=affichageCourse;
}

