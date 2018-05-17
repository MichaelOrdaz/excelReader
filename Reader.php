<?php 
require 'vendor/autoload.php';

use \Mou\Upload as Upload;


Upload::hola();


	$mysqli = new mysqli("localhost", "root", "", "document");
	if ($mysqli->connect_errno) {
	    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
/*
	if (!($sentencia = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
	    echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	$id = 1;
	if (!$sentencia->bind_param("i", $id)) {
	    echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	if (!$sentencia->execute()) {
	    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
	}
*/

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("excel/test.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

$query = "";
echo '<table>';
for ($row = 2; $row <= $highestRow; $row++) {

	$query = "INSERT INTO datos VALUES(";

    echo '<tr>';
    for ($col = 1; $col <= $highestColumnIndex; $col++) {
        $value = $worksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue(); //recupera el valor de la celda, parsenado formulas
        //$value = $worksheet->getCellByColumnAndRow($col, $row)->getValue(); //recupera el valor de la celda incluso la formula
        
        $query .= "'".$value."',";

        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    //acabando el loop formateo bien el string
    $query = substr( $query, 0, strlen($query)-1 );//quito la ultima coma del string
    $query .= ")";

    $mysqli->query($query);

}
echo '</table>';


/*
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("excel/test.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
echo '<table>';

$query = "";//declaro mi query vacio

foreach ($worksheet->getRowIterator() as $row) {
    $query = "INSERT INTO document values (";//mi linea
    echo '<tr>';
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    foreach ($cellIterator as $k => $cell) {

        $query .= "'" . $cell->getValue() ."',";
        echo '<td>'.
             $cell->getValue() .
             '</td>';
    }
    echo '</tr>';

}
echo '</table>';

echo "<hr>";
echo $query;
*/

?>