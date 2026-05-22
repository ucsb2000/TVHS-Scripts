<?php
	echo "<p>Generating CTE Computer Programming Unit 2 Test Rubric...</p>";

  require('fpdf185/fpdf.php');

  $csvfile = 'ccp-unit2-test-results.csv';
  $period = 'period2';
  $points_possible = 50;

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
      $percentage = ($student[13] / $points_possible) * 100 . "%";
      
      // Header
      $pdf->SetFont('Arial', 'B', 18);
      $pdf->Cell(180, 7, 'Unit 2 Test Rubric (' . $points_possible . 'pts. total)',0,0,'C');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(60, 7, 'Student Name:',0,0,'L');
      $pdf->Cell(80, 7, $student[1] . " " . $student[0],0,0,'L');
      $pdf->Ln();
      
      $pdf->Cell(60, 7, 'Points Earned:',0,0,'L');
      $pdf->Cell(80, 7, $student[13],0,0,'L');
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
      for($i=3;$i<13;$i++) {
        $pdf->Cell(60,6,$headers[$i],1,0,'C');
        $pdf->Cell(60,6,"5",1,0,'C');
          
        $pdf->Cell(60,6,$student[$i],1,0,'C');
        $pdf->Ln();
      }

      //Add total row to table
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->setFillColor(160,160,160);
      $pdf->Cell(60, 7, 'Total',1,0,'C', true);
      $pdf->Cell(60, 7, $points_possible,1,0,'C',true);
      $pdf->Cell(60,7,$student[13],1,0,'C',true);
      $pdf->Ln(10);

      //Add comments header
      $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
      $pdf->Ln();

      //Add comments
      $pdf->SetFont('Arial', '', 12);      
      //Checks to see if comments exist
      if (empty($student[14])) {
        $pdf->MultiCell(180, 7, 'Great job!', "LBR", 'L', false);
      } else {
        $pdf->MultiCell(180, 7, $student[14], "LBR", 'L', false);
      }      
      $pdf->Ln();

      
      $pdf->Output('F', $period . "/" . $student[0] . " " . $student[1] . '-rubric.pdf');
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