<?php

require_once('constants.php');


//----------------------------------------------------------------------------
//--- dbConnect --------------------------------------------------------------
//----------------------------------------------------------------------------
// Crée la connexion à une BDD
// \return Renvoie une erreur ou la base de donnée autrement .
function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
}

//----------------------------------------------------------------------------
//--- dbCreateUser -----------------------------------------------------------
//----------------------------------------------------------------------------
// Crée l'object user
// \param $db La connexion à la BDD
// \param $mail Le mail du user 
// \return L'objet user
function dbCreateUser($db,$mail){
  try{
    $request='SELECT u.mail, u.prenom, u.nom, u.password, u.admin, c.club FROM user u JOIN club c ON u.mail=c.mail WHERE u.mail=:mail';
    $statement=$db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR,255);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_CLASS, 'User');
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $user[0];
}


//----------------------------------------------------------------------------
//--- dbRequestCyclistes -----------------------------------------------------
//----------------------------------------------------------------------------
//Retourne tout les cyclistes 
// \param $db La connexion à la BDD
// \param $club Le club des cyclistes
// \param $admin Vrais si le user est l'admin
// \return Une liste des cyclistes
function dbRequestCyclistes($db,$club,$admin){
  try{
    $request = 'SELECT * FROM cycliste';
    if(!$admin){
      $request = $request.' WHERE club=:club';
    }
    $statement = $db->prepare($request);
    if(!$admin){
      $statement->bindParam(':club', $club, PDO::PARAM_STR,255);
    }
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;     
}

//----------------------------------------------------------------------------
//--- dbRequestCodeInsee -----------------------------------------------------
//----------------------------------------------------------------------------
//Retourne tout les codes INSEE 
//\parma $db La connexion à la BDD
//\return La liste des code INSEE
function dbRequestCodeInsee($db){
  try{
    $request='SELECT code_insee FROM ville';
    $statement = $db->prepare($request);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;  
}

//----------------------------------------------------------------------------
//--- dbRequestClub ----------------------------------------------------------
//----------------------------------------------------------------------------
//Retourne tout les clubs
//\parma $db La connexion à la BDD
//\return La liste des clubs
function dbRequestClub($db){
  try{
    $request='SELECT club FROM club';
    $statement = $db->prepare($request);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;  
}

//----------------------------------------------------------------------------
//--- dbModifyCyclist --------------------------------------------------------
//----------------------------------------------------------------------------
//Modifie les données dans la bdd des cyclistes
// \param $db La connecion à la BDD
// \param $mail Le mail du cycliste à modifier
// \param $nom Le nom à mettre dans la BDD
// \param $prenom Le prenom à mettre dans la BDD
// \param $num_licence Le numéro de licence à mettre dans la BDD
// \param $date La date de naissance à mettre dans la BDD
// \param $club Le nom du club à mettre dans la BDD
// \param $code_insee Le code INSEE à mettre dans la BDD
// \param $valide Si le cycliste est valide à mettre dans la BDD
// \return Renvoie FALSE en cas d'erreur et TRUE autrement 
function dbModifyCyclist($db,$mail,$nom,$prenom,$num_licence,$date,$club,$code_insee,$valide){
  try{
    $request = 'UPDATE cycliste SET nom=:nom, prenom=:prenom, num_licence=:num_licence,
          date_naissance=:date, valide=:valide, club=:club, code_insee=:code_insee
          WHERE mail=:mail';
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR, 255);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR, 100);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR, 100);
    $statement->bindParam(':num_licence', $num_licence, PDO::PARAM_INT);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->bindParam(':valide', $valide, PDO::PARAM_BOOL);
    $statement->bindParam(':club', $club, PDO::PARAM_STR,255);
    $statement->bindParam(':code_insee', $code_insee, PDO::PARAM_INT);
    $statement->execute();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return true;
}

//----------------------------------------------------------------------------
//--- dbRequestRace ----------------------------------------------------------
//----------------------------------------------------------------------------
// Retourne une course 
// \param $db La connexion à la BDD
// \return Une course
function dbRequestRace($db,$id){
  try{
    $request='SELECT * FROM course WHERE id=:id';
    $statement = $db->prepare($request);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result[0];     
}
  


//----------------------------------------------------------------------------
//--- dbRequestRaces ---------------------------------------------------------
//----------------------------------------------------------------------------
//Retourne toutes les courses 
// \param $db La connexion à la BDD.
// \return Une liste de toute les courses
function dbRequestRaces($db){
  try{
    $request = 'SELECT * FROM course';
    $statement = $db->prepare($request);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;     
}

//----------------------------------------------------------------------------
//--- dbRequestClubRace ------------------------------------------------------
//----------------------------------------------------------------------------
//Retourne le club qui organise la course
// \param $db La connexion à la BDD.
// \param $id L'id de la course 
// \return le nom du club 
function dbRequestClubRace($db,$id){
  try{
    $request = 'SELECT club FROM course WHERE id=:id';
    $statement = $db->prepare($request);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result[0];     
}


//----------------------------------------------------------------------------
//--- dbRequestCyclistOnRace -------------------------------------------------
//----------------------------------------------------------------------------
//Retourne les informations sur les cyclistes qui participent à la course
// \param $db La connexion à la BDD
//\param $club Le nom du club du user
//\param $admin Vrai si le user est l'admin
//\param $id L'id de la course 
//Return Le nom, prenom et mail des cyclistes enregistrés dans la course
function dbRequestCyclistOnRace($db,$club,$admin,$id){
  $clubCourse=dbRequestClubRace($db,$id);
  try{
    $request='SELECT cy.nom, cy.prenom, cy.mail FROM participe p 
        JOIN cycliste cy ON p.mail=cy.mail
        WHERE p.id=:id AND cy.valide=1';
    if(!$admin && $clubCourse['club']!=$club){
      $request=$request . ' AND cy.club=:club';
    }
    $statement=$db->prepare($request);
    $statement->bindParam(':id',$id);
    if(!$admin && $clubCourse['club']!=$club){
      $statement->bindParam(':club',$club);
    }
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
    if(!$result){ //Dans le cas ou on supprime toute les personnes d'une course 
      $result="vide";
    }
    return $result;
           
}

//----------------------------------------------------------------------------
//--- dbRequestMailOnRace ----------------------------------------------------
//----------------------------------------------------------------------------
//Retourne le mail des cyclistes dans la course
//\param $db La connexion à la BDD
//\param $club Le nom du club du user
//\param $admin Vrais si le user est l'admin
//\param $id L'identifiant de la course
function dbRequestMailOnRace($db,$club,$admin,$id){
  try{
    $request='SELECT p.mail FROM participe p JOIN cycliste c ON p.mail=c.mail WHERE p.id=:id AND c.valide=1';
    if(!$admin){
      $request=$request . ' AND c.club=:club';
    }
    $statement=$db->prepare($request);
    $statement->bindParam(':id',$id);
    if(!$admin){
      $statement->bindParam(':club',$club);
    }
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
    return $result;     
}


//----------------------------------------------------------------------------
//--- dbRequestCyclistNotOnRace ----------------------------------------------
//----------------------------------------------------------------------------
//Retourne les nom, prenoms, et mail des cyclistes non inscrits à la course
//\param $db La connexion à la BDD
//\param $club Le nom du club
//\param $admin Vrais si le user est l'admin
//\param $id L'identifiant de la course
function dbRequestCyclistNotOnRace($db,$club,$admin,$id){
  $mails=dbRequestMailOnRace($db,$club,$admin,$id);
  try{
    $request='SELECT nom, prenom, mail FROM cycliste WHERE valide=1';
    foreach($mails as $mail){
        $request=$request.' AND mail!=\''.$mail['mail'].'\'';
    }
    if(!$admin){
      $request=$request . ' AND club=:club';
    }
    $statement=$db->prepare($request);
    if(!$admin){
      $statement->bindParam(':club',$club);
    }
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
    return $result;
}


//----------------------------------------------------------------------------
//--- dbAddCyclisteOnRace ----------------------------------------------------
//----------------------------------------------------------------------------
//Ajoute un cycliste dans la course
//\param $db La connexion à la BDD 
//\param $id L'identifiant de la course
//\param $mail le mail du cycliste
// \return Vrais si l'ajout est réusie et faux autrement
function dbAddCyclistOnRace($db,$mail,$id){
  try{
    $request='INSERT INTO participe(mail, id)
      VALUES(:mail,:id)';
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
  }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return true;
}

//----------------------------------------------------------------------------
//--- dbDeleteCyclistOnRace --------------------------------------------------
//----------------------------------------------------------------------------
//Supprime un cycliste de la course
//\param $db La connexion à la BDD 
//\param $mail le mail du cycliste
//\param $id L'identifiant de la course
// \return Vrais si la suppression est réusie et faux autrement
function dbDeleteCyclistOnRace($db,$mail,$id){
  try{
    $request='DELETE FROM participe WHERE mail=:mail AND id=:id';
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
  }
  catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return true;
}


//----------------------------------------------------------------------------
//--- dbRequestEndingRace ----------------------------------------------------
//----------------------------------------------------------------------------
// Retourne les courses terminées, qui ont dépassé la date actuelle 
//\param $db La connexion à la BDD 
// \param $club Le nom du club du user
// \param $admin Boolean, Vrais si le user est l'admin
function dbRequestEndingRace($db,$club,$admin){
  $today= date("Y-m-d");
  try{
    $request='SELECT * FROM course WHERE date>'.$today;
    if(!$admin){
      $request=$request.' AND club=:club';
    }
    $statement = $db->prepare($request);
    if(!$admin){
      $statement->bindParam(':club',$club,PDO::PARAM_STR);
    }
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
}

//----------------------------------------------------------------------------
//--- dbRequestScoreCource ---------------------------------------------------
//----------------------------------------------------------------------------
// Retourne les scores des cyclistes qui ont participés à la course 
//\param $db La connexion à la BDD 
// \param $id Identifiant de la course
function dbRequestScoreCource($db,$id){
  try{
    $request='SELECT p.place, p.dossard, c.nom, c.prenom, c.club, c.num_licence, c.categorie,  c.categorie_valeur, p.point
    FROM participe p JOIN cycliste c ON p.mail=c.mail WHERE p.id=:id ORDER BY p.place';
    $statement=$db->prepare($request);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
}



//----------------------------------------------------------------------------
//--- dbRequestVitesse -------------------------------------------------------
//----------------------------------------------------------------------------
// Retourne le temps indicatif du 1er de la course 
//\param $db La connexion à la BDD 
// \param $id Identifiant de la course
function dbRequestVitesse($db,$id){
  try{
    $request='SELECT  c.distance, p.temps FROM course c JOIN participe p ON c.id=p.id WHERE p.id=:id AND p.place=1';
    $statement=$db->prepare($request);
    $statement->bindParam(':id',$id,PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    $var=$result[0];
    $vitesse=intval($var['distance'])/intval($var['temps']);
    return $vitesse;
}

?>
