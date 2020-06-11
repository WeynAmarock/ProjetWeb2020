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
    if($(event.target).attr('value')==1){
        console.log('test');
    }
});
