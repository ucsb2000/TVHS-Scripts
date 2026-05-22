<?php
	echo "<p>Hello...</p>";

  require('fpdf185/fpdf.php');

  $csvfile = 'period1-msjc.csv';
  $period = 'period1';

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
      
      // Header
      $pdf->SetFont('Arial', 'B', 18);
      $pdf->Cell(180, 7, 'MSJC Articulation Credit Breakdown',0,0,'C');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'Articulation is credit-by-exam.',0,0,'C');
      $pdf->Ln();

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'So, the grade that is earned on the FINAL is the ',0,0,'C');
      $pdf->Ln();

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'final grade in the class.',0,0,'C');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'For students to earn the credit, they must earn at least ',0,0,'C');
      $pdf->Ln();

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'an 80% in the class both first semester AND second semester AND',0,0,'C');
      $pdf->Ln();

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'at least a 70% on the final exam.',0,0,'C');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(80, 7, 'Student Name:',0,0,'L');
      $pdf->Cell(60, 7, $student[0],0,0,'L');
      $pdf->Ln();

      $pdf->Cell(80, 7, 'Final (Points Earned out of 55):',0,0,'L');
      $pdf->Cell(60, 7, $student[1],0,0,'L');
      $pdf->Ln();

      $pdf->Cell(80, 7, 'Final (Percentage):',0,0,'L');
      $pdf->Cell(60, 7, $student[2],0,0,'L');
      $pdf->Ln();

      $pdf->Cell(80, 7, 'Course Grade (1st Semester):',0,0,'L');
      $pdf->Cell(60, 7, $student[3],0,0,'L');
      $pdf->Ln(30);

      $pdf->Cell(80, 7, 'Course Grade (2nd Semester):',0,0,'L');
      $pdf->Cell(60, 7, $student[4],0,0,'L');
      $pdf->Ln(30);

      // Create individual student report
      if (floatval($student[2]) / 100.00 >= 0.7 && ($student[3] == "A" || $student[3] == "B") && ($student[4] == "A" || $student[4] == "B")) {
        //Student earned the credit
        $pdf->Cell(180,7,"MSJC Articulation Credit EARNED!",0,0,'C');
        $pdf->Ln();

        $pdf->Cell(180,7,"You will receive a grade of " . $student[5] . " on your MSJC college transcript.",0,0,'C');
        $pdf->Ln(20);
      } else {
        //Student did NOT earn credit
        $pdf->Cell(180,7,"MSJC Articulation Credit NOT EARNED!",0,0,'C');
        $pdf->Ln();
        if (floatval($student[2]) / 100.00 < 0.7) {
          $pdf->Cell(180,7,"Your grade on the final exam was not above 70%",0,0,'C');
          $pdf->Ln();
        }
        if ($student[3] == "C" || $student[3] == "F" || $student[3] == "NA") {
          $pdf->Cell(180,7,"Your final grade 1st semester was not a "B" or better",0,0,'C');
          $pdf->Ln();
        }
        if ($student[4] == "C" || $student[4] == "F" || $student[4] == "NA") {
          $pdf->Cell(180,7,"Your final grade 2nd semester was not a "B" or better",0,0,'C');
          $pdf->Ln();
        }
        $pdf->Ln(20);
      }

      $pdf->Output('F', $period . "/" . $student[0] . '-letter.pdf');
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