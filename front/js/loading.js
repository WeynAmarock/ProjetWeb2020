//Affichage des infos du coureur
function loadCycliste(coureurs){
    var cycliste = "";

    coureurs.forEach(coureur =>{
        console.log(coureur);
        cycliste = fillCoureur(coureur);
        $('#coureurs').append(cycliste);
    });

}

function fillCoureur(coureur){
    var velo = '<tr><td><input type="text" value="'+coureur['nom']+'"></td><td><input type="text" value="'+coureur['prenom']+'"></td><td><input type="text" value="'+coureur['club']+'"></td><td><input type="text" value="'+coureur['mail']+'"></td><td><input type="text" value="'+coureur['date_naissance']+'"></td><td><input type="text" value="'+coureur['num_licence']+'"></td></tr>'
    console.log(velo);
    return velo;
}

ajaxRequest('GET', 'php/request.php/cyclistes', loadCycliste);

