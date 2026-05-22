<?php
	echo "<p>Generating Unit 4 Rubric...</p>";

  require('fpdf185/fpdf.php');

  $csvfile = 'period4-unit4.csv';
  $period = 'period4';

  //Get file headers
  $file = fopen($csvfile, 'r');
	$headers = fgetcsv($file);

  //Get student information from CSV file
  $students = csv2array($csvfile);
	$count = 0;
  
	echo "<p>" . count($students) . " students found.</p>";
  
  echo "<p>";
  
	foreach($students as $student) {
    if($count != 0) {
      $pdf = new FPDF();
      $pdf->AddPage();

      //Calculate student grade percentage
      $percentage = ($student[11] / 50) * 100 . "%";
      
      // Header
      $pdf->SetFont('Arial', 'B', 18);
      $pdf->Cell(180, 7, 'Unit 4 Project Rubric (50 pts. total)',0,0,'C');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(60, 7, 'Student Name:',0,0,'L');
      $pdf->Cell(80, 7, $student[0],0,0,'L');
      $pdf->Ln();
      
      $pdf->Cell(60, 7, 'Points Earned:',0,0,'L');
      $pdf->Cell(80, 7, $student[11],0,0,'L');
      $pdf->Ln();

      $pdf->Cell(60, 7, 'Percentage:',0,0,'L');
      $pdf->Cell(80, 7, $percentage,0,0,'L');
      $pdf->Ln(30);

      // Add student data to table
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->setFillColor(160,160,160);
      $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
      $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
      $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
      $pdf->Ln();

      $pdf->SetFont('Arial', '',12);
      for($i=1;$i<11;$i++) {
        $pdf->Cell(60,6,$headers[$i],1,0,'C');
        
        if($i == 1) {
          $pdf->Cell(60,6,"10",1,0,'C');
        } else if ($i == 2) {
          $pdf->Cell(60,6,"8",1,0,'C');
        } else {
            $pdf->Cell(60,6,"4",1,0,'C');
        }
          
        $pdf->Cell(60,6,$student[$i],1,0,'C');
        $pdf->Ln();
      }

      //Add total row to table
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->setFillColor(160,160,160);
      $pdf->Cell(60, 7, 'Total',1,0,'C', true);
      $pdf->Cell(60, 7, '50',1,0,'C',true);
      $pdf->Cell(60,7,$student[11],1,0,'C',true);
      $pdf->Ln(10);

      //Add comments header
      $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
      $pdf->Ln();

      //Add comments
      $pdf->SetFont('Arial', '', 12);      
      //Checks to see if comments exist
      if (empty($student[12])) {
        $pdf->MultiCell(180, 7, 'Great job!', "LBR", 'L', false);
      } else {
        $pdf->MultiCell(180, 7, $student[12], "LBR", 'L', false);
      }      
      $pdf->Ln();

      
      $pdf->Output('F', $period . "/" . $student[0] . '-rubric.pdf');
      echo "A PDF has been genereated for " . $student[0] . " Student count is: " . $count . "<br>";
    }
    $count ++;
	}
  echo "</p>";

	function csv2array($filename) {

		$retArray = array();
		$file2 = fopen($filename, 'r');

		while(($line = fgetcsv($file2)) != NULL) {
			$c = array();
			foreach($line as $index => $value) {
        $c[$index] = $value;
			}
			$retArray[] = $c;
		}

		return $retArray;
	}
?>