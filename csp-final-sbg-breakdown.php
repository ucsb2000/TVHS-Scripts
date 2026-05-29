<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'course-final-p3.csv';
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
            $pdf = new FPDF();
            $pdf->AddPage();
            
            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - Course Final Grade Breakdown',0,0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your Course Final grade.',0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(180, 7, 'Your grade is a combination of your MCQ Exam (70%)',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Performance Task (30%).',0,0,'C');
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
            $pdf->AddPage();
        
        //MCQ Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'MCQ Exam (70%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Points Earned',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60, 7, 'Percentage',1,0,'C',true);            
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', 'B',12);            
            $pdf->Cell(60,6,$student[25],1,0,'C');
            $pdf->Cell(60,6,55,1,0,'C');
            $pdf->Cell(60,6,$student[26],1,0,'C');
            $pdf->Ln();

            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C',true);
            $pdf->Cell(60,7,$student[27],1,0,'C', true);
            $pdf->Ln();

            $pdf->Cell(120, 7, 'Weighted %',1,0,'C',true);
            $pdf->Cell(60, 7, round($student[28] * 100,0) . '%',1,0,'C',true);      
            $pdf->Ln(15);

        //Performance Task Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Performance Task (30%):','B',0, 'L', false);
            $pdf->Ln(10);

        //Program Code
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Program Code (1 Point):','B',0, 'L', false);
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
            for($i=2;$i<=7;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,1,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $point_earned = "No";

            if($student[8] == "Yes") {
                $point_earned = "Yes";
            }

            $pdf->setFillColor(61,133,198);
            $pdf->SetFont('Arial', 'B', 12);      
            $pdf->Cell(120, 7, 'Point Earned',1,0,'C',true);
            $pdf->Cell(60,7,$point_earned,1,0,'C', true);
            $pdf->Ln(10);

            //PDF(Code) comments
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'For the program code point to be earned, all sections above must have earned the point.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'No partial credit is given.',0,0,'C');
            $pdf->Ln(10);

            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[9], "LBR", 'L', false);
            $pdf->Ln(15);

        //Video
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Video (1 Point):','B',0, 'L', false);
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
            $pdf->Cell(60,6,'Video',1,0,'C');
            $pdf->Cell(60,6,1,1,0,'C');
            $pdf->Cell(60,6,$student[10],1,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[11], "LBR", 'L', false);
            $pdf->Ln(15);
        
            //Add new page for formatting
            $pdf->AddPage();

        //Written Responses
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Written Responses (4 Points):','B',0, 'L', false);
            $pdf->Ln(10);

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            //Student Data
            $pdf->SetFont('Arial', '',12);
            for($i=12;$i<=15;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,1,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->setFillColor(61,133,198);
            $pdf->SetFont('Arial', 'B', 12);      
            $pdf->Cell(120, 7, 'Total Points Earned',1,0,'C',true);
            $pdf->Cell(60,7,$student[16],1,0,'C', true);
            $pdf->Ln(10);

            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[17], "LBR", 'L', false);
            $pdf->Ln(15);

        //Performance Task Total
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Performance Task Total Points Earned (6 Points):','B',0, 'L', false);
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Total Points',1,0,'C', true);
            $pdf->Cell(60,7,$student[18],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[19],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[20],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,round($student[21] * 100,0) . '%',1,0,'C',true);
            $pdf->Ln(15);

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