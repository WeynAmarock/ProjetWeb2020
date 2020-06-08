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
//--- dbRequestCyclistes -----------------------------------------------------
//----------------------------------------------------------------------------
//Get all cyclistes 
// \param db The connected database.
// \param $club The cyclists club
// \param $admin Variable if the user is a admin 
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
function dbModifyCyclist($db,$mail,$nom,$prenom,$num_licence,$date,$valide,$club,$code_insee){
  try{
    $request = 'UPDATE cycliste SET nom=:nom, prenom=:prenom, num_licence=:num_licence,
          date_naissance=:date, valide=:valide, club=:club, code_insee=12530
          WHERE mail=:mail';
    $statement = $db->prepare($request);
    //$statement->bindParam(':new_mail', $new_mail, PDO::PARAM_STR, 255);
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


function dbRequestCourses($db){
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


function dbRequestCyclistOnCourse($db,$club,$admin,$id){
  try{
    $request='SELECT cy.nom, cy.prenom FROM participe p 
        JOIN cycliste cy ON p.mail=cy.mail 
        WHERE p.id=:id ';
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



$db = dbConnect();

$test=dbRequestCyclistOnCourse($db,'ABC PLOUESCAT',0,1);

foreach($test as $t){
  echo $t["nom"]. '</br>';
}

