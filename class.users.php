<?php
require_once ("class.pdofactory.php");
require_once ("abstract.databoundobject.php");

class Users extends DataBoundObject {

        protected $ID;
        protected $Nombre;
        protected $Contrasenya;
        protected $Locked;
        protected $Logged;
        protected $Email;
        protected $Org_id;
        protected $Suborg_id;


        protected function DefineTableName() {
                return("users");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "user_name" => "Nombre",
                        "password" => "Contrasenya",
                        "lockedStatus" => "Locked",
                        "loggedStatus" => "Logged",
                        "email" => "Email",
                        "org_id" => "Org_id",
                        "suborg_id" => "Suborg_id"
                    ));
        }

        
}
$strDSN = "pgsql:dbname=postgres;host=localhost;port=5432;user=postgres;
                        password=postgres";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());


        
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$objUser = new Users($objPDO);


$objUser->setNombre("Richard")->setContrasenya("Passw0rd")->setLocked(0)->setLogged(1)->setEmail("ricardopr181999@gmail.com")->setOrg_id(1)->setSuborg_id(1)->Save();

print "El Nombre del Usuario es: " . $objUser->getNombre() . "<br />";
print "La contraseña es: " . $objUser->getContrasenya() . "<br />";

$Locked = $objUser->getLocked();

if($Locked==0){
    print "ESTADO: El usuario está bloqueado" . "<br />";
}else{
    print "ESTADO: El usuario está desbloqueado" . "<br />";
}

$Logged = $objUser->getLogged();

if($Logged==1){
   print "ESTADO: El usuario está registrado" . "<br />";
}else{
    print "ESTADO: El usuario no está registrado" . "<br />";
}

print "El email es: " . $objUser->getEmail() . "<br />";
print "El ID de la organización es: " . $objUser->getOrg_id() . "<br />";
print "El ID de la Suborganización es: " . $objUser->getSuborg_id() . "<br />";


print "Saving...<br />";

$id = $objUser->getID();
print "ID in database is " . $id . "<br />";



//Destroying object
print "<br>Destroying object...<br />";
unset($objUser);


//Recreating object

print "<br>Recreating object from ID $id<br />";
$objUser = new Users($objPDO, $id);



print "El Nombre del Usuario es: " . $objUser->getNombre() . "<br />";
print "La contraseña es: " . $objUser->getContrasenya() . "<br />";

$Locked = $objUser->getLocked();

if($Locked==0){
    print "ESTADO: El usuario está bloqueado" . "<br />";
}else{
    print "ESTADO: El usuario está desbloqueado" . "<br />";
}

$Logged = $objUser->getLogged();
if($Logged==1){
   print "ESTADO: El usuario está registrado" . "<br />";
}else{
    print "ESTADO: El usuario no está registrado" . "<br />";
}

print "El email es: " . $objUser->getEmail() . "<br />";
print "El ID de la organización es: " . $objUser->getOrg_id() . "<br />";
print "El ID de la Suborganización es: " . $objUser->getSuborg_id() . "<br />";

print "<br>Committing a change.... Richard will become Cristian, 
       Locked True will become Locked False<br/>";

$objUser->setNombre("Cristian")->setContrasenya("Passw0rd")->setLocked(1)->setLogged(1)->setEmail("ricardopr181999@gmail.com")->setOrg_id(1)->setSuborg_id(1)->Save();
print "Saving...<br />";

print "<br>El Nombre del Usuario es: " . $objUser->getNombre() . "<br />";
if($Locked==0){
    print "ESTADO: El usuario está bloqueado" . "<br />";
}else{
    print "ESTADO: El usuario está desbloqueado" . "<br />";
}



$id = $objUser->getID();
print "ID in database is " . $id . "<br />";

?>