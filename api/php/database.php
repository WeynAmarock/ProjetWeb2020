<?php

require_once('constants.php');


//----------------------------------------------------------------------------
//--- dbConnect --------------------------------------------------------------
//----------------------------------------------------------------------------
// Create the connection to the database.
// \return False on error and the database otherwise.
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
// Create the object user 
// \param $db The connected database.
// \param $mail The mail of the user
// \return The object user
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
//Get all cyclistes 
// \param $db The connected database.
// \param $club The cyclists club
// \param $admin True if the user is the admin 
// \return The list of the cyclists
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

//Code Insee non fonctionnel
function dbModifyCyclist($db,$mail,$nom,$prenom,$num_licence,$date,$club,$valide){
  try{
    $request = 'UPDATE cycliste SET nom=:nom, prenom=:prenom, num_licence=:num_licence,
          date_naissance=:date, valide=:valide, club=:club
          WHERE mail=:mail';
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR, 255);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR, 100);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR, 100);
    $statement->bindParam(':num_licence', $num_licence, PDO::PARAM_INT);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->bindParam(':valide', $valide, PDO::PARAM_BOOL);
    $statement->bindParam(':club', $club, PDO::PARAM_STR,255);
    //$statement->bindParam(':code_insee', $code_insee, PDO::PARAM_INT);
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
//--- dbRequestRaces ---------------------------------------------------------
//----------------------------------------------------------------------------
//Get all races
// \param db The connected database.
// \return The list of the races
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
//--- dbRequestCyclistOnRace -------------------------------------------------
//----------------------------------------------------------------------------
//Get the name and the mail of the cyclist in the race Id
//\param $db The connected database.
//\param $club The cyclists club
//\param $admin True if the user is a admin
//\param $id Id of the race
//Return the name and the mail of cyclists registered in the race Id
function dbRequestCyclistOnRace($db,$club,$admin,$id){
  try{
    $request='SELECT cy.nom, cy.prenom, cy.mail FROM participe p 
        JOIN cycliste cy ON p.mail=cy.mail 
        WHERE p.id=:id AND cy.valide=1';
    if(!$admin){
      $request=$request . 'AND cy.club=:club';
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
//--- dbRequestCyclistOnRace -------------------------------------------------
//----------------------------------------------------------------------------
//Get the mail of the cyclist in the race Id
//Get the name and the mail of the cyclist in the race Id
//\param $db The connected database.
//\param $club The cyclists club
//\param $admin True if the user is a admin
//\param $id Id of the race
//Return the mail of cyclists registered in the race Id
function dbRequestMailOnRace($db,$club,$admin,$id){
  try{
    $request='SELECT p.mail FROM participe p JOIN cycliste c ON p.mail=c.mail WHERE p.id=:id AND c.valide=1';
    if(!$admin){
      $request=$request . 'AND c.club=:club';
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
//--- dbRequestCyclistNotOnRace -------------------------------------------------
//----------------------------------------------------------------------------
//Get the name of the cyclist who are not in the race
//\param $db The connected database.
//\param $club The cyclists club
//\param $admin True if the user is a admin
//\param $id Id of the race
//Return the name of cyclists who are not registered in the race  
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
    echo $request;
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

$db=dbConnect();
$tests=dbRequestCyclistNotOnRace($db,'ABC PLOUESCAT',0,1);
var_dump($tests);


//----------------------------------------------------------------------------
//--- dbAddCyclisteOnRace ----------------------------------------------------
//----------------------------------------------------------------------------
//Add a cyclist in a race
//\param $db The connected database.
//\param $id Id of the race
//\param $mail Cyclist's mail
// \return True on success, false otherwise
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
//--- dbDeleteCyclistOnRace ----------------------------------------------------
//----------------------------------------------------------------------------
//Delete a cyclist in a race.
//\param $db The connected database.
//\param $mail Cyclist's mail.
// \return True on success, false otherwise.
function dbDeleteCyclistOnRace($db,$mail){
  try{
    $request='DELETE FROM participe WHERE mail=:mail';
    $statement = $db->prepare($request);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
    $statement->execute();
  }
  catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return true;
}


?>
