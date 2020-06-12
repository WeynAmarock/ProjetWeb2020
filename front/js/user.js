ajaxRequest('GET', 'http://prj-cir2-web-api.monposte/php/api.php/user/', loadUser);

function loadUser(user){
    var utilisateur = '<h3 id="co">'+user['nom']+' '+user['prenom']+' '+user['mail']+'</h3>';
    $('#user').append(utilisateur);
}