<?php 
require 'vendor/autoload.php';

/**
 * 
 */
class Filas{
	

	function __construct(){
		
	
	}


}

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("helloworld.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
echo '<table>';
$query = "";
foreach ($worksheet->getRowIterator() as $row) {
    $query .= "<br>select * from ";//mi linea
    echo '<tr>';
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    foreach ($cellIterator as $cell) {
        $query .= $cell->getValue() . " , ";
        echo '<td>'.
             $cell->getValue() .
             '</td>';
    }
    echo '</tr>';

}
echo '</table>';

echo "<hr>";
echo $query;
?>