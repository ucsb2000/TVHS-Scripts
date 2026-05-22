<?php
	echo "<p>Generating Midterm Rubric...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'period4-midterm.csv';
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
            echo "Count = " . $count;
            $pdf = new FPDF();
            $pdf->AddPage();

            //Calculate student grade percentage
            $percentage = round(($student[23] / 75) * 100,1) . "%";

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'Midterm Rubric (75 pts. total)',0,0,'C');
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(60, 7, 'Student Name:',0,0,'L');
            $pdf->Cell(80, 7, $student[0] . " " . $student[1],0,0,'L');
            $pdf->Ln();

            $pdf->Cell(60, 7, 'Points Earned:',0,0,'L');
            $pdf->Cell(80, 7, $student[23],0,0,'L');
            $pdf->Ln();

            $pdf->Cell(60, 7, 'Percentage:',0,0,'L');
            $pdf->Cell(80, 7, $percentage,0,0,'L');
            $pdf->Ln(30);

            //Video Score
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Video Score:',0,0,'L');
            $pdf->Ln(10);

            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            $pdf->SetFont('Arial', '',12);
            $pdf->Cell(60,6,$headers[2],1,0,'C');
            $pdf->Cell(60,6,"10",1,0,'C');
            $pdf->Cell(60,6,$student[2],1,0,'C');
            $pdf->Ln();

            //Add video comment
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->MultiCell(180, 7, $student[3], "LBR", 'L', false);
            $pdf->Ln();

            //Add Code Score
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Code Score:',0,0,'L');
            $pdf->Ln(10);

            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            $pdf->SetFont('Arial', '',12);
            for($i=4;$i<10;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,"5",1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            //Written Response Score
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Written Response Score:',0,0,'L');
            $pdf->Ln(10);

            for($i=11;$i<22;$i+=2) {
                $comment = $i+1;
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
                $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
                $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
                $pdf->Ln();

                $pdf->SetFont('Arial', '',12);
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,"5",1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();

                //$pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
                //$pdf->Ln();
                $pdf->MultiCell(180, 7, $student[$comment], "LBR", 'L', false);
                $pdf->Ln();
            }

            $pdf->Output('F', $period . "/" . $student[0] . " " . $student[1] . '-rubric.pdf');
            echo "A PDF has been genereated for " . $student[0] . " " . $student[1] . " -- Student count is: " . $count . "<br>";
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