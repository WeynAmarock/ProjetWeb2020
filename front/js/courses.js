//Pour les informations de course

ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses', loadCourse);

function loadCourse(courses){
    var parcours = "";
    $('#courses').innerHTML='';
    
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
    display(id)
});

//#---------------------------------------------------------------------------------#//
//#-----------------Affichage des données de la course selectionnée-----------------#//
//#---------------------------------------------------------------------------------#// 
function display(id){
    var inscrit = document.getElementById('inscrits');
    var non_inscrit = document.getElementById('non_inscrits');
    inscrit.innerHTML = "";
    non_inscrit.innerHTML = "";
    console.log(inscrit);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/course/'+id, loadRace);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/in'+id, loadCoureurInscrit);
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/no'+id, loadCoureurNonInscrit);
}
function affichage(){
    document.getElementById('content').style.display='none';
    document.getElementById('content_bis').style.display='block';
}

function loadRace(course){
    var parcours = fillRace(course);
    $('#race').html(parcours);

}

function fillRace(course){
    var chemin = '<tr id="course_selected" value="'+course['id']+'"><th>'+course['id']+'</th><td>'+course['libelle']+'</td><td>'+course['date']+'</td><td>'+course['nb_tour']+'</td><td>'+course['distance']+'</td><td>'+course['nb_coureur']+'</td><td>'+course['longueur_tour']+'</td><td>'+course['club']+'</td></tr>';
    return chemin;
}

//#---------------------------------------------------------------------------------#//
//#----------Chargement et récupération des coureurs inscrits/non-inscrits----------#//
//#---------------------------------------------------------------------------------#// 

function loadCoureurInscrit(cyclistes){
    var humain = "";
    $('#inscrits').innerHTML='';
    cyclistes.forEach(coureur =>{
        humain = fillInscrit(coureur);
        $('#inscrits').append(humain);
    });
}

function fillInscrit(coureur){
    var humain = '<tr><td>'+coureur['nom']+'</td><td>'+coureur['prenom']+'</td><td class="mail">'+coureur['mail']+'</td><td><input type="checkbox" id="'+coureur['mail']+'" checked></td></tr>';
    return humain;
}

//#---------------------------------------------------------------------------------#//

function loadCoureurNonInscrit(cyclistes){
    var humain = "";
    cyclistes.forEach(coureur =>{
        humain = fillNonInscrit(coureur);
        $('#non_inscrits').append(humain);
    });
}

function fillNonInscrit(coureur){
    var humain = '<tr><td>'+coureur['nom']+'</td><td>'+coureur['prenom']+'</td><td>'+coureur['mail']+'</td><td><input type="checkbox" id="'+coureur['mail']+'"></td></tr>';
    return humain;
}


//#---------------------------------------------------------------------------------#//
//#----------------------------------Bouton Retour----------------------------------#//
//#---------------------------------------------------------------------------------#// 

$('#btnRetour').click(() =>{
    var inscrit = document.querySelector("#inscrits");
    var non_inscrit = document.querySelector("#non_inscrits");
    document.getElementById('content').style.display='block';
    document.getElementById('content_bis').style.display='none';
    inscrit.innerHTML = "";
    non_inscrit.innerHTML = "";

  });

//#---------------------------------------------------------------------------------#//
//#-----------------------Ajout Suppression des inscriptions------------------------#//
//#---------------------------------------------------------------------------------#// 

$('#btnCourse').click(() =>{
    
    var id = $('#course_selected').attr('value');
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            addCoureur(id,$(this).attr('id'));
        }
        else{
            supprCoureur(id, $(this).attr('id'));        
        }
    });
    
    display(id);

});


function addCoureur(id, mail){
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/in'+id, (coureurs)=>{
        // console.log(coureurs);
        if(coureurs=='vide'){
            ajaxRequest('POST', 'http://prj-cir2-web-api.monposte/php/api.php/courses/', ()=>{
                    console.log('test.Ajout');
                },'id='+id+' & mail='+mail);
        }else{
            var i = 0;
            coureurs.forEach(coureur =>{
                if(mail == coureur['mail']){
                    i++;
                }
            });
            if(i == 0){
                ajaxRequest('POST', 'http://prj-cir2-web-api.monposte/php/api.php/courses/', ()=>{
                    //console.log('test.Ajout');
                },'id='+id+' & mail='+mail);
            }
        }
        
    });

}

function supprCoureur(id, mail){
    ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses/in'+id, (coureurs)=>{
        if(coureurs!='vide'){
            var i = 0;
            coureurs.forEach(coureur =>{
                if(mail == coureur['mail']){
                    i++;
                }
            });
            if(i){
                ajaxRequest('DELETE', 'http://prj-cir2-web-api.monposte/php/api.php/courses/'+id+mail, ()=>{
                });
            }
        }  
    });
}

