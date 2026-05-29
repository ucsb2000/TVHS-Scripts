<?php
	echo "<p>Generating Articulation Letters...</p>";

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

            //Overall Grade Breadown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Grade Breakdown:',0,0,'L');
            $pdf->Ln(10);

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(36, 7, 'Category',1,0,'C', true);
            $pdf->Cell(36, 7, 'SBG Score',1,0,'C',true);
            $pdf->Cell(36, 7, 'Percentage',1,0,'C',true);
            $pdf->Cell(36, 7, 'Weight',1,0,'C',true);
            $pdf->Cell(36, 7, 'Weighted %',1,0,'C',true);
            $pdf->Ln();

            //Table Data                
            $pdf->SetFont('Arial', '',12);          
            $pdf->Cell(36,6,'MCQ Exam',1,0,'C');
            $pdf->Cell(36,6,$student[27],1,0,'C');
            $pdf->Cell(36,6,$student[26],1,0,'C');
            $pdf->Cell(36,6,'70%',1,0,'C');
            $pdf->Cell(36,6,round($student[28] * 100,2) . '%',1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Performance Task',1,0,'C');
            $pdf->Cell(36,6,$student[20],1,0,'C');
            $pdf->Cell(36,6,$student[19],1,0,'C');
            $pdf->Cell(36,6,'30%',1,0,'C');
            $pdf->Cell(36,6,round($student[21] * 100,2) . '%',1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(144, 7, 'Overall Weighted %',1,0,'C', true);
            $pdf->Cell(36,7,$student[30],1,0,'C',true);
            $pdf->Ln();
            $pdf->Cell(144, 7, 'Overall FInal Score',1,0,'C', true);
            $pdf->Cell(36,7,$student[31],1,0,'C',true);
            $pdf->Ln();
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(144, 7, 'Final Grade',1,0,'C', true);
            if($student[31] == "0") {
                $pdf->Cell(36,7,'F (0%)',1,0,'C',true);
            } elseif($student[31] == "1" ) {
                $pdf->Cell(36,7,'F (50%)',1,0,'C',true);
            } elseif($student[31] == "1+" ) {
                $pdf->Cell(36,7,'F (65%)',1,0,'C',true);
            } elseif($student[31] == "2-" ) {
                $pdf->Cell(36,7,'C- (72%)',1,0,'C',true);
            } elseif($student[31] == "2" ) {
                $pdf->Cell(36,7,'C (75%)',1,0,'C',true);
            } elseif($student[31] == "2+" ) {
                $pdf->Cell(36,7,'C+ (78%)',1,0,'C',true);
            } elseif($student[31] == "3-" ) {
                $pdf->Cell(36,7,'B- (82%)',1,0,'C',true);
            } elseif($student[31] == "3" ) {
                $pdf->Cell(36,7,'B (85%)',1,0,'C',true);
            } elseif($student[31] == "3+" ) {
                $pdf->Cell(36,7,'B+ (88%)',1,0,'C',true);
            } elseif($student[31] == "4-" ) {
                $pdf->Cell(36,7,'A- (92%)',1,0,'C',true);
            } elseif($student[31] == "4" ) {
                $pdf->Cell(36,7,'A (95%)',1,0,'C',true);
            } elseif($student[31] == "4+" ) {
                $pdf->Cell(36,7,'A+ (100%)',1,0,'C',true);
            } else {
                $pdf->Cell(36,7,'F',1,0,'C',true);
            }
            $pdf->Ln(15);

            //Add new page for formatting
            //$pdf->AddPage();

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
                $pdf->Cell(60,6,$student[33],1,0,'C');
                $pdf->Cell(60,6,$student[34],1,0,'C');
                $pdf->Cell(60,6,$student[30],1,0,'C');
                $pdf->Ln(10);
            $pdf->Ln(15);

            // Create individual student report
            $pdf->SetFont('Arial', 'B', 13);
            if ($student[30] >= 70 && ($student[33] == "A" || $student[33] == "B") && ($student[34] == "A" || $student[34] == "B")) {
                //Student earned the credit
                $pdf->Cell(180,7,"MSJC Articulation Credit EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(180,7,"You will receive a grade of " . $student[35] . " on your MSJC college transcript.",0,0,'C');
                $pdf->Ln(20);
            } else {
                //Student did NOT earn credit
                $pdf->SetFont('Arial', 'B', 13);
                $pdf->Cell(180,7,"MSJC Articulation Credit NOT EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                if ($student[30] < 70) {
                $pdf->Cell(180,7,"Your grade on the final exam was not above 70%",0,0,'C');
                $pdf->Ln();
                }
                if ($student[33] == "C" || $student[33] == "F" || $student[33] == "NA") {
                $pdf->Cell(180,7,"Your final grade 1st semester was not a B or better",0,0,'C');
                $pdf->Ln();
                }
                if ($student[34] == "C" || $student[34] == "F" || $student[34] == "NA") {
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