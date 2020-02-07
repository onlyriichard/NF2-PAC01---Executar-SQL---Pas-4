<?php
require_once ("class.pdofactory.php");
require_once ("abstract.databoundobject.php");

class Department extends DataBoundObject {

        protected $ID;
        protected $Nombre;
        protected $Descripcion;


        protected function DefineTableName() {
                return("department");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "dept_name" => "Nombre",
                        "dept_description" => "Descripcion"));
        }
}

$strDSN = "pgsql:dbname=postgres;host=localhost;port=5432;user=postgres;
                        password=postgres";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());


        
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$objUser = new Department($objPDO);


$objUser->setNombre("FPLlefia")->setDescripcion(20);

print "El Nombre del departamento es: " . $objUser->getNombre() . "<br />";
print "Descripcion: " . $objUser->getDescripcion() . "<br />";


print "Saving...<br />";

$objUser->Save();

$id = $objUser->getID();
print "ID in database is " . $id . "<br />";


print "<br>Destroying object...<br />";
unset($objUser);

print "<br>Recreating object from ID $id<br />";
$objUser = new Department($objPDO, $id);

print "El Nombre del departamento es: " . $objUser->getNombre() . "<br />";
print "Descripcion: " . $objUser->getDescripcion() . "<br />";

print "<br>Committing a change.... FPLlefia will become Llefia, 
       20 will become 18<br/>";
$objUser->setNombre("Llefia")->setDescripcion(18)->Save();
print "Saving...<br />";



?>