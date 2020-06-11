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
    var chemin = '<tr><th>'+course['id']+'</th><td>'+course['libelle']+'</td><td>'+course['date']+'</td><td>'+course['nb_tour']+'</td><td>'+course['distance']+'</td><td>'+course['nb_coureur']+'</td><td>'+course['longueur_tour']+'</td><td>'+course['club']+'</td><td><button class="button" name="bouton" id="'+course['id']+'">Voir +</button></td></tr>';
    console.log(chemin);
    return chemin;
}

ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/courses', loadCourse);


// var bouton_course = document.getElementsById('...');
// bouton_course.onclick= document.getElementById('content').style.display='none';

function boutonFind(){
    var bouton = document.querySelector(".button");

    console.log('bouton '+bouton);
}

boutonFind();