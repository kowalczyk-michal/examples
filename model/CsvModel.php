<?php
class CsvModel {
	/*
	 *	Create CSV file
	 */
	public function createFile($filename, $data, $header='') {
		$file = fopen($filename.'.csv', 'w+');
		
		if (!empty($header)) fputcsv($file, $header); //set columns if exist
		
		//set data into csv
		foreach ($data as $row) {
			fputcsv($file, $row);
		}
		
		fclose($file);
	}
}