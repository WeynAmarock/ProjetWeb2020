//Affichage des infos du coureur
function loadCycliste(coureurs){
    var cycliste = "";

    coureurs.forEach(coureur =>{
        // console.table(coureur);
        cycliste = fillCoureur(coureur);
        $('#coureurs').append(cycliste);
    });

}



function fillCoureur(coureur){
    var velo = '<tr><td>'+coureur['mail']+'</td><td><input type="text" value="'+coureur['nom']+'"></td><td><input type="text" value="'+coureur['prenom']+'"></td><td><input type="text" value="'+coureur['club']+'"></td><td><input type="text" value="'+coureur['date_naissance']+'"></td><td><input type="text" value="'+coureur['num_licence']+'"></td><td>'+coureur['categorie']+'</td><td>'+coureur['categorie_categorie_valeur']+'</td></tr>'
    console.log(velo);
    return velo;
}


ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);

