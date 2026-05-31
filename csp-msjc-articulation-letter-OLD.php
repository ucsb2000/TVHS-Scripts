<?php
	echo "<p>Generating Midterm Rubric...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'period3-msjc.csv';
    $period = 'period3';

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

            // Header
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Student Name: ' . $student[0] . ' ' . $student[1],0,0,'C');
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
            $pdf->Cell(180, 7, 'Below is a breakdown of your MCQ Final grade, Project final grade and then a combined',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'breakdown of your course final.  The Final breakdown is your grade on the course final and',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'used to determine if your met the 70% threshold on the course final. The Semester',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'Grade breakdown is the grade your earned both 1st and 2nd semester.',0,0,'C');
            $pdf->Ln(10);

            //MCQ Breakdown Table
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'MCQ Breakdown (55 Points Possible, 70% of Final Grade):','B',0, 'L', false);
            $pdf->Ln(10);

                //Section Breakdown Table
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, 'Part',1,0,'C', true);
                $pdf->Cell(60, 7, 'Points Earned',1,0,'C', true);
                $pdf->Cell(60, 7, 'Points Possible',1,0,'C', true);
                $pdf->Ln();

                //Section Breakdown Data
                for($i = 1; $i <= 3; $i++) {
                    $pdf->Cell(60, 7, $i,1,0,'C');
                    $pdf->Cell(60, 7, $student[14+$i],1,0,'C');

                    if($i == 1) {
                        $pdf->Cell(60, 7, 15,1,0,'C');
                    } else {
                        $pdf->Cell(60, 7, 20,1,0,'C');
                    }

                    $pdf->Ln();
                }
                $pdf->Ln(10);
                
                //Total Breakdown Table
                $pdf->setFillColor(61,133,198);
                $pdf->Cell(180, 7, "MCQ TOTAL",1,0,'C', true);
                $pdf->Ln();
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, "Total Points",1,0,'C', true);
                $pdf->Cell(60, 7, "Percentage",1,0,'C', true);
                $pdf->Cell(60, 7, "Weighted Score",1,0,'C', true);
                $pdf->Ln();               
                
                //Total Breakdown Data
                $pdf->Cell(60, 7, $student[18],1,0,'C');
                $pdf->Cell(60, 7, $student[19],1,0,'C');
                $pdf->Cell(60, 7, $student[20],1,0,'C');
            $pdf->Ln(15);

            //Project Breakdown Table
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Project Breakdown (40 Points Possible, 30% of Final Grade):','B',0, 'L', false);
            $pdf->Ln(10);

                //Section Breakdown Table
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
                $pdf->Cell(60, 7, 'Points Earned',1,0,'C', true);
                $pdf->Cell(60, 7, 'Points Possible',1,0,'C', true);
                $pdf->Ln();

                //Section Breakdown Data
                for($i=2;$i<=11;$i++) {
                    $pdf->Cell(60,6,$headers[$i],1,0,'C');
                    $pdf->Cell(60,6,$student[$i],1,0,'C');
                    $pdf->Cell(60,6,4,1,0,'C');
                    $pdf->Ln();
                }
                $pdf->Ln(10);
                
                //Total Breakdown Table
                $pdf->setFillColor(61,133,198);
                $pdf->Cell(180, 7, "PROJECT TOTAL",1,0,'C', true);
                $pdf->Ln();
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, "Total Points",1,0,'C', true);
                $pdf->Cell(60, 7, "Percentage",1,0,'C', true);
                $pdf->Cell(60, 7, "Weighted Score",1,0,'C', true);
                $pdf->Ln();               
                
                //Total Breakdown Data
                $pdf->Cell(60, 7, $student[12],1,0,'C');
                $pdf->Cell(60, 7, $student[13],1,0,'C');
                $pdf->Cell(60, 7, $student[14],1,0,'C');
            $pdf->Ln(15);

            $pdf->AddPage();

            //Course Final Breakdown Table
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Final Unit Grade','B',0, 'L', false);
            $pdf->Ln(10);

                //Section Breakdown Table
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(45, 7, 'MCQ Score',1,0,'C', true);
                $pdf->Cell(45, 7, 'Project Score',1,0,'C', true);
                $pdf->Cell(45, 7, 'Total Score',1,0,'C', true);
                $pdf->Cell(45, 7, 'Unit Grade',1,0,'C', true);
                $pdf->Ln();

                //Section Breakdown Data
                $pdf->Cell(45,6,$student[20],1,0,'C');
                $pdf->Cell(45,6,$student[14],1,0,'C');
                $pdf->Cell(45,6,$student[14] + $student[20] . " (" . $student[22] . ")",1,0,'C');
                $pdf->Cell(45,6,$student[23],1,0,'C');
                $pdf->Ln(10);
            $pdf->Ln(15);

            //MSJC Breakdown Table
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'MSJC Articulation Credit','B',0, 'L', false);
            $pdf->Ln(10);

                //Section Breakdown Table
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->setFillColor(160,160,160);
                $pdf->Cell(60, 7, '1st Semester',1,0,'C', true);
                $pdf->Cell(60, 7, '2nd Semester',1,0,'C', true);
                $pdf->Cell(60, 7, 'Final Grade',1,0,'C', true);
                $pdf->Ln();

                //Section Breakdown Data
                $pdf->Cell(60,6,$student[25],1,0,'C');
                $pdf->Cell(60,6,$student[26],1,0,'C');
                $pdf->Cell(60,6,$student[22],1,0,'C');
                $pdf->Ln(10);
            $pdf->Ln(15);

            // Create individual student report
            $pdf->SetFont('Arial', 'B', 13);
            if (floatval($student[22]) / 100 >= 0.7 && ($student[25] == "A" || $student[25] == "B") && ($student[26] == "A" || $student[26] == "B")) {
                //Student earned the credit
                $pdf->Cell(180,7,"MSJC Articulation Credit EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(180,7,"You will receive a grade of " . $student[27] . " on your MSJC college transcript.",0,0,'C');
                $pdf->Ln(20);
            } else {
                //Student did NOT earn credit
                $pdf->SetFont('Arial', 'B', 13);
                $pdf->Cell(180,7,"MSJC Articulation Credit NOT EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                if (floatval($student[22]) / 100 < 0.7) {
                $pdf->Cell(180,7,"Your grade on the final exam was not above 70%",0,0,'C');
                $pdf->Ln();
                }
                if ($student[25] == "C" || $student[25] == "F" || $student[25] == "NA") {
                $pdf->Cell(180,7,"Your final grade 1st semester was not a B or better",0,0,'C');
                $pdf->Ln();
                }
                if ($student[26] == "C" || $student[26] == "F" || $student[26] == "NA") {
                $pdf->Cell(180,7,"Your final grade 2nd semester was not a B or better",0,0,'C');
                $pdf->Ln();
                }
            }

            $pdf->Output('F', $period . "/" . $student[0] . " " . $student[1] . '-letter.pdf');
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