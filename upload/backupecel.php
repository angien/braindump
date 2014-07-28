<html>
<body>

<script type="text/javascript" src="validate.js"></script>

<form action="<?php $PHP_SELF?>" method="post" enctype="multipart/form-data" onsubmit="return finalValidateExcel()">
Select Metric Type:<br> <select name="type" onchange="validate(this.name, this.value)" >
<option>SELECT</option>
<option>Content</option>
<option>Event</option>
</select>
<input type="checkbox" name="type" disabled>
<small><span name="type"></span></small><br><br>
Choose a file to upload:<br>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php

if(isset($_POST["submit"])) {
	$allowedExts = array("xls", "xlsx");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	//&& ($_FILES["file"]["size"] < 20000) // size limit
	if (in_array($extension, $allowedExts)) {
		// problem with file
	  	if ($_FILES["file"]["error"] > 0)
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		// no problem with file
	  	else {
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			// check if file exists and print that
			if (file_exists("upload/" . $_FILES["file"]["name"]))
				echo $_FILES["file"]["name"] . " already exists. ";
			else {
				move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}

			// CODE FOR PARSING THE FILE!
			echo "<br><br>";
			require_once '/Classes/PHPExcel.php';
			$inputFileType = PHPExcel_IOFactory::identify("upload/" . $_FILES["file"]["name"]);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
			// $objReader = new PHPExcel_Reader_Excel2007(); // if 2007 only
			$objReader->setReadDataOnly(true);

			// Load to a PHPExcel Object  
	        $objPHPExcel = $objReader->load("upload/" . $_FILES["file"]["name"]);
			
			// make SQL table connection
			$link = mysqli_connect('localhost','root','', 'event_metrics'); 
			if (!$link) { 
				die ('Could not connect to MySQL!'); 
			}

			// upload date
			$upload_date = date("Y:m:d");
			
			// array for mapping columns (to standardize)
			//$myArray = array('Fiscal Year' => 0, 'Calendar Year' => 0, 'Quarter' => 0);

			// for each sheet
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

				// check to make sure sheet is FYXX
				//$regex = '/^FY[0-9][0-9]$/';
				$regex = '/^FY14$/';
				if(preg_match($regex, $worksheet->getTitle())) {
					echo "MATCHED!" , $worksheet->getTitle();

					// for each row
					foreach ($worksheet->getRowIterator() as $row) {
						echo ' Row number - ' , $row->getRowIndex() , '<br>';
						/*
						// map the columns
						if ($row->getRowIndex() == 1) {
							$cellIterator = $row->getCellIterator();
							$cellIterator->setIterateOnlyExistingCells(true); // Loop only existing cells
							foreach ($cellIterator as $cell) {
								if (!is_null($cell)) {
									echo ' Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue();
									if (array_key_exists($cell->getCalculatedValue(), $myArray))
										$myArray[$cell->getCalculatedValue()] = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
									foreach($myArray as $key => $value)
  										echo $key . ' ' . $value . "<br>" ;
								}
							}
						}
						// start uploading into sql
						else if ($row->getRowIndex() == 2) {
							$myArray[]
						}*/

						if ($row->getRowIndex() != 1) { // we do not want to take row 1 (those are all the titles)
							$cellIterator = $row->getCellIterator();
							$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells
							foreach ($cellIterator as $cell) {
								if ($cell != NULL) {//!is_null($cell)) {
									echo ' Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue(), '<br>';
								}
							}
						}

					}
				}
			

					/*
					// write SQL insert
					$insert = "INSERT INTO form
					(upload_date)
					VALUES
					('$upload_date')";
			
					// make the query
					$result = mysqli_query($link, $insert);

					// check if insert query worked
					if (!$result ) {
						echo 'Insert was NOT successful.';
					}
					else {
						$result = mysqli_query($link, "SELECT * FROM form_test");
						echo 'Insert was successful.';
					}*/
				/*}
				else
					echo 'Insert was NOT successful.'*/

			}

			// close db
			mysqli_close($link);

		
		}
	} 
	else {
	  echo "Invalid file";
	}
}
?>

</body>
</html>

