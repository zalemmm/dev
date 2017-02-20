<?php

function extraireBLXLS($filePath) {

	$liste_code = array();

    $extension = strtoupper(pathinfo($filePath, PATHINFO_EXTENSION));	
    if($extension == 'XLS') {

        //Read spreadsheeet workbook
        try {
             $inputFileType = PHPExcel_IOFactory::identify($filePath);
             $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                 $objPHPExcel = $objReader->load($filePath);
        } catch(Exception $e) {
                die($e->getMessage());
        }

        //Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
		
		$row = 1;
		$lastColumn = $sheet->getHighestColumn();
		$lastColumn++;
		
		for ($row = 1; $row <= $highestRow; $row++) { 
			$sheet->setCellValueExplicit('A'.$row,$sheet->getCell('A'.$row),PHPExcel_Cell_DataType::TYPE_STRING);
		}
		
		
		
        //Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++){ 
                
				//  Read a row of data into an array                
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                foreach ($rowData as $cell) {
					if($row > 1) {
						if($cell[0] != '') {
							$liste_code[$row-1] = str_pad($cell[0], 5, "0", STR_PAD_LEFT);
						} else {
							$liste_code[$row-1] = 0;
						}
					}
				}
        }
		
		return $liste_code;
    }
    else {
         return false;
    }
	
}
?>