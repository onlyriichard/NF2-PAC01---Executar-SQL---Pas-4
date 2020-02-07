<?php
require_once ("class.pdofactory.php");
require_once ("abstract.databoundobject.php");

class Employee extends DataBoundObject {

        protected $USERID;
        protected $ID;
        protected $EMP;
        protected $DES_ID;
        protected $DP_ID;
        protected $STAFF;


        protected function DefineTableName() {
                return("employee");
        }

        protected function DefineRelationMap() {
                return(array(
                        "user_id" => "USERID",
                        "id" => "ID",
                        "emp_name" => "EMP",
                        "designation_id" => "DES_ID",
                        "department_id" => "DP_ID",
                        "staff_type" => "STAFF"
                    ));
        }
}

$strDSN = "pgsql:dbname=postgres;host=localhost;port=5432;user=postgres;
                        password=postgres";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());


        
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$objUser = new Employee($objPDO);

$objUser->setUSERID(1)->setEMP("Ricardo")->setDES_ID(1)->setDP_ID(1)->setSTAFF(20)->Save();

$user_id = $objUser->getUSERID();
print "El ID del usuario es: " . $user_id . "<br />";

$employee_id = $objUser->getUSERID();
print "El ID del employee es: " . $employee_id . "<br />";

print "El Nombre del Empleado es: " . $objUser->getEMP() . "<br />"; 
print "El ID de designacion es: " . $objUser->getDES_ID() . "<br />"; 
print "El ID del departamento es: " . $objUser->getDP_ID() . "<br />"; 
print "El tipo del personal es: " . $objUser->getSTAFF() . "<br />"; 


print "Saving...<br />";


$id = $objUser->getID();
print "ID in database is " . $id . "<br />";

//Destroying object
print "<br>Destroying object...<br />";
unset($objUser);


//Recreating object

print "<br>Recreating object from ID $id<br />";
$objUser = new Employee($objPDO, $id);

$objUser->setEMP("Cristian")->Save();


print "<br>Committing a change.... Richard will become Cristian<br/>";

print "El Nombre del Empleado es: " . $objUser->getEMP() . "<br />"; 

print "Saving...<br />";




?>