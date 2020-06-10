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
    var velo = '<tr><td>'+coureur['mail']+'</td><td><input type="text" value="'+coureur['nom']+'"></td><td><input type="text" value="'+coureur['prenom']+'"></td><td><input type="text" value="'+coureur['club']+'"></td><td><input type="text" value="'+coureur['date_naissance']+'"></td><td><input type="text" value="'+coureur['num_licence']+'"></td><td>'+coureur['categorie']+'</td><td>'+coureur['categorie_categorie_valeur']+'</td><td><button class="button" name="btnSub" id="'+coureur['mail']+'">Valider</button></td></tr>'
    console.log(velo);
    return velo;
}


ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes', loadCycliste);



// ajaxRequest('PUT', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes/%27', modifyCycliste);




var element = document.getElementById('cl@team.gt');

var myFunction = function() {
    print('Vous avez cliqué !');
};

element.onclick= ajaxRequest('PUT', 'http://prj-cir2-web-api.monposte/php/api.php/cyclistes/%27', myFunction);;




// $('#comment-list').on('click', '.mod', () => {
// 	ajaxRequest('PUT', 'php/request.php/comments/' + 
// 		$(event.target).closest('.mod').attr('value'), () => {
// 			ajaxRequest('GET', 'php/request.php/comments/?id='+$('#photo').attr('photoid'), loadComments);
// 		}, 'comment=' + prompt('Nouveau commentaire: '));
// });


