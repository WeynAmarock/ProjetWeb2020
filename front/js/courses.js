//Pour les informations de course

ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses', loadCourse);

function loadCourse(courses){
    var parcours = "";
    
    courses.forEach(course =>{
        // console.table(coureur);
        parcours = fillCourse(course);
        $('#courses').append(parcours);
    });

}

function fillCourse(course){
    var chemin = '<tr><th>'+course['id']+'</th><td>'+course['libelle']+'</td><td>'+course['date']+'</td><td>'+course['nb_tour']+'</td><td>'+course['distance']+'</td><td>'+course['nb_coureur']+'</td><td>'+course['longueur_tour']+'</td><td>'+course['club']+'</td><td><button class="button" name="bouton" value='+course['id']+' id="'+course['id']+'">Voir +</button></td></tr>';
    //console.log(chemin);
    return chemin;
}


$('#courses').on('click', 'button', () => {
    //console.log($(event.target).attr('value'));
    var id = $(event.target).attr('value');
    affichage();
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/course/'+id, loadRace);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/in'+id, loadCoureurInscrit);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/no'+id, loadCoureurNonInscrit);
});

///////////////////////////////////////////////////////////////////////////////////////////
////////////////Fonctions d'affichage des données de la course selectionnée////////////////
///////////////////////////////////////////////////////////////////////////////////////////
function affichage(){
    document.getElementById('content').style.display='none';
    document.getElementById('content_bis').style.display='block';
}

function loadRace(course){
    var parcours = fillRace(course);
    //console.log(parcours);
    $('#race').append(parcours);

}

function fillRace(course){
    var chemin = '<tr><th>'+course['id']+'</th><td>'+course['libelle']+'</td><td>'+course['date']+'</td><td>'+course['nb_tour']+'</td><td>'+course['distance']+'</td><td>'+course['nb_coureur']+'</td><td>'+course['longueur_tour']+'</td><td>'+course['club']+'</td></tr>';
    //console.log(chemin);
    return chemin;
}

////////////////////////////////////////////////////////////////////////////////////////

function loadCoureurInscrit(cyclistes){
    var humain = "";
    cyclistes.forEach(coureur =>{
        //console.table(coureur);
        humain = fillInscrit(coureur);
        $('#inscrits').append(humain);
    });
}

function fillInscrit(coureur){
    var humain = '<tr><td>'+coureur['nom']+'</td><td>'+coureur['prenom']+'</td><td>'+coureur['mail']+'</td><td><input type="checkbox" checked></td></tr>';
    return humain;
}

////////////////////////////////////////////////////////////////////////////////////////

function loadCoureurNonInscrit(cyclistes){
    var humain = "";
    cyclistes.forEach(coureur =>{
        //console.table(coureur);
        humain = fillNonInscrit(coureur);
        $('#non_inscrits').append(humain);
    });
}

function fillNonInscrit(coureur){
    var humain = '<tr><td>'+coureur['nom']+'</td><td>'+coureur['prenom']+'</td><td>'+coureur['mail']+'</td><td><input type="checkbox"></td></tr>';
    return humain;
}
