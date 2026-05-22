<?php
	echo "<p>Hello...</p>";

  require('fpdf185/fpdf.php');

  $csvfile = 'period5-msjc.csv';
  $period = 'period5';

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
      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(180, 7, 'Student Name: ' . $student[1] . ' ' . $student[0],0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'MSJC Articulation Credit Breakdown',0,0,'C');
      $pdf->Ln(10);

      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Cell(180, 7, 'The TVHS articulation agreement with MSJC is approved as credit-by-exam. This',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'means that the grade you receive on your MSJC transcript is the grade you earn on',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'your course final.  It is NOT your final grade in class.  For you to earn MSJC credit, you',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'must earn at least a B both 1st and 2nd semester AND at least 70% on your course final.',0,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(180, 7, 'Below is a breakdown of your MCQ Final grade, FRQ final grade and then a combined breakdown',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'of your course final.  The Final breakdown is your grade on the course final and used to',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'determine if your met the 70% threshold on the course final. The Semester Grade breakdown',0,0,'C');
      $pdf->Ln();
      $pdf->Cell(180, 7, 'is the grade your earned both 1st and 2nd semester.',0,0,'C');
      $pdf->Ln(20);

      //MCQ Breakdown Table
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(180, 7, 'MCQ Breakdown (50 Points Possible):','B',0, 'L', false);
      $pdf->Ln();

        //Table Headers
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->setFillColor(160,160,160);
        $pdf->Cell(90, 7, 'Points Earned',1,0,'C', true);
        $pdf->Cell(90, 7, 'Percentage',1,0,'C',true);
        $pdf->Ln();

        //Table Data
        $pdf->Cell(90, 7, $student[6],1,0,'C');
        $pdf->Cell(90, 7, $student[7],1,0,'C');
      $pdf->Ln(15);

      //FRQ Breakdown Table
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(180, 7, 'FRQ Breakdown (50 Points Possible):','B',0, 'L', false);
      $pdf->Ln();

        //Table Headers
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->setFillColor(160,160,160);
        $pdf->Cell(90, 7, 'Points Earned',1,0,'C', true);
        $pdf->Cell(90, 7, 'Percentage',1,0,'C',true);
        $pdf->Ln();

        //Table Data     
        $pdf->Cell(90, 7, $student[8],1,0,'C');
        $pdf->Cell(90, 7, $student[9],1,0,'C');
      $pdf->Ln(15);


        //Final Grade Breakdown Table
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(180, 7, 'Final Grade Breakdown (100 Points Possible):','B',0, 'L', false);
        $pdf->Ln();

          //Table Headers
          $pdf->SetFont('Arial', 'B', 12);
          $pdf->setFillColor(61,133,198);
          $pdf->Cell(90, 7, 'Points Earned',1,0,'C', true);
          $pdf->Cell(90, 7, 'Percentage',1,0,'C',true);
          $pdf->Ln();

          //Table Data         
          $pdf->Cell(90, 7, $student[10],1,0,'C');    
          $pdf->Cell(90, 7, $student[11],1,0,'C');
        $pdf->Ln(15);

        //Semester Grade Breakdown Table
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(180, 7, 'Semester Grade Breakdown:','B',0, 'L', false);
        $pdf->Ln();

          //Table Headers
          $pdf->SetFont('Arial', 'B', 12);
          $pdf->setFillColor(61,133,198);
          $pdf->Cell(90, 7, 'First Semester',1,0,'C', true);
          $pdf->Cell(90, 7, 'Second Semester',1,0,'C',true);
          $pdf->Ln();

          //Table Data
          $pdf->Cell(90, 7, $student[2],1,0,'C');    
          $pdf->Cell(90, 7, $student[3],1,0,'C');
        $pdf->Ln(20);

      // Create individual student report
      $pdf->SetFont('Arial', 'B', 14);
      if (floatval($student[11]) / 100 >= 0.7 && ($student[2] == "A" || $student[2] == "B") && ($student[3] == "A" || $student[3] == "B")) {
        //Student earned the credit
        $pdf->Cell(180,7,"MSJC Articulation Credit EARNED!",0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(180,7,"You will receive a grade of " . $student[12] . " on your MSJC college transcript.",0,0,'C');
        $pdf->Ln(20);
      } else {
        //Student did NOT earn credit
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(180,7,"MSJC Articulation Credit NOT EARNED!",0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        if (floatval($student[11]) / 100 < 0.7) {
          $pdf->Cell(180,7,"Your grade on the final exam was not above 70%",0,0,'C');
          $pdf->Ln();
        }
        if ($student[2] == "C" || $student[2] == "F" || $student[2] == "NA") {
          $pdf->Cell(180,7,"Your final grade 1st semester was not a B or better",0,0,'C');
          $pdf->Ln();
        }
        if ($student[3] == "C" || $student[3] == "F" || $student[3] == "NA") {
          $pdf->Cell(180,7,"Your final grade 2nd semester was not a B or better",0,0,'C');
          $pdf->Ln();
        }
      }

      $pdf->Output('F', $period . "/" . $student[1] . ' ' . $student[0] . '-letter.pdf');
      echo "A PDF has been genereated for " . $student[1] . ' ' . $student[0] . " Student count is: " . $count . "<br>";
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