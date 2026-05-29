<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'final-p1.csv';
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
            
            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - Course Final Grade Breakdown',0,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(180, 7, 'This document is a breakdown of your course final exam grade.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'Your standard grade is a combination of your Comprehensive Exam (70%) ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Performance Task (30%).',0,0,'C');
            $pdf->Ln(10);

            //Standard Explanation
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Course Final Overview:','B',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(180, 7, '70% of your grade is from the MCQ questions you completed in class.  The final 30% is from your Performance Task Submission.  This includes your PDF of your code, your video and your 4 written response questions.', "LBR", 'L', false);
            $pdf->Ln(10);

            //MCQ Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'MCQ Exam (70%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(45, 7, 'Points Earned',1,0,'C', true);
            $pdf->Cell(45, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(45, 7, 'Percentage',1,0,'C',true);
            $pdf->Cell(45, 7, 'Adjusted Score',1,0,'C',true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', 'B',12);            
            $pdf->Cell(45,6,round($student[24], 0) . '%',1,0,'C');
            
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(135, 7, 'Weighted Score',1,0,'C',true);
            $pdf->Cell(45, 7, round($student[26], 2),1,0,'C',true);
            $pdf->Ln(15);

            //Project Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Project (45%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            //Student Data
            $pdf->SetFont('Arial', '',12);
            for($i=8;$i<=11;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[12],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[13] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[14],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[15], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[16], "LBR", 'L', false);
            $pdf->Ln(15);

            //Add new page for formatting
            $pdf->AddPage();

            //Homework Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Homework (10%):','B',0, 'L', false);
            $pdf->Ln();
            
            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', '',12);
            $pdf->Cell(60,6,$student[17],1,0,'C');
            $pdf->Cell(60,6,round($student[18] * 100, 0) . '%',1,0,'C');
            $pdf->Cell(60,6,$student[19],1,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B',12);
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C',true);
            $pdf->Cell(60, 7, round($student[20], 2),1,0,'C',true);
            $pdf->Ln(15);

            //Overall Grade Breadown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Grade Breakdown:','LTR',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(45, 7, 'Category',1,0,'C', true);
            $pdf->Cell(45, 7, 'Raw Score',1,0,'C',true);
            $pdf->Cell(45, 7, 'Category Weight',1,0,'C',true);
            $pdf->Cell(45, 7, 'Weighted Score',1,0,'C',true);
            $pdf->Ln();

            //Table Data                
            $pdf->SetFont('Arial', '',12);  
            $pdf->Cell(45,6,'Comprehensive',1,0,'C');
            $pdf->Cell(45,6,round($student[6], 2),1,0,'C');
            $pdf->Cell(45,6,'45%',1,0,'C');
            $pdf->Cell(45,6,round($student[7], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'Project',1,0,'C');
            $pdf->Cell(45,6,round($student[14], 2),1,0,'C');
            $pdf->Cell(45,6,'45%',1,0,'C');
            $pdf->Cell(45,6,round($student[15], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'Homework',1,0,'C');
            $pdf->Cell(45,6,round($student[19], 2),1,0,'C');
            $pdf->Cell(45,6,'10%',1,0,'C');
            $pdf->Cell(45,6,round($student[20], 2),1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(135, 7, 'Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[21],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(135, 7, 'Rounded Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[22],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(135, 7, 'Overall Unit Grade',1,0,'C', true);
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            
            //If a student did not turn in a project, they receive no credit for the unit.
            if($student[13] == 0.00)
            {
                $pdf->Cell(45,7,'F',1,0,'C',true);
            } else {
                if($student[22] >= 3.5) {
                    $pdf->Cell(45,7,'A',1,0,'C',true);
                } elseif($student[22] >= 2.5 AND $student[22] <=3.49) {
                    $pdf->Cell(45,7,'B',1,0,'C',true);
                } elseif ($student[22] >= 1.5 AND $student[22] <=2.49) {
                    $pdf->Cell(45,7,'C',1,0,'C',true);
                } else {
                    $pdf->Cell(45,7,'F',1,0,'C',true);
                }
            }
            
            $pdf->Ln(15);

            //Final comments for student
            $pdf->Cell(180, 7, 'Additional Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[23], "LBR", 'L', false);


            //Generate output on screen before moving to next student
            $pdf->Output('F', $period . "/" . $student[0] . ' ' . $student[1] . '-letter.pdf');
            echo "A PDF has been genereated for " . $student[1] . " " . $student[0] . " Student count is: " . $count . "<br>";
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