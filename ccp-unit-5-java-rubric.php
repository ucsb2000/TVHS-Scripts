<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'unit-5-java-assessment-breakdown-p2.csv';
    $period = 'period2';

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
            $pdf->Cell(180, 7, 'CTE Computer Programming - Unit 5 Grade Breakdown',0,0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your Unit 5 (Java) standard grade.',0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(180, 7, 'Your standard grade is a combination of your Comprehensive Exam (45%), Project (45%) ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Homework (10%).  As the semester progresses, you will have ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'opportunities to improve this grade, if you choose to take advantage of them.',0,0,'C');
            $pdf->Ln(10);

            //Standard Explanation
            /*
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'CRD Standard Overview:','B',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(180, 7, 'Students will design, develop, and document a computing innovation or program by engaging in collaborative practices, utilizing diverse perspectives, adhering to an iterative development process, and ensuring the program functions correctly for a variety of inputs and situations.', "LBR", 'L', false);
            $pdf->Ln(10);
            */

        //Overall Grade Breadown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Grade Breakdown:',0,0,'L');
            $pdf->Ln();

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
            $pdf->Cell(36,6,'Homework',1,0,'C');
            $pdf->Cell(36,6,$student[21],1,0,'C');
            $pdf->Cell(36,6,$student[20],1,0,'C');
            $pdf->Cell(36,6,'10%',1,0,'C');
            $pdf->Cell(36,6,$student[22],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Project',1,0,'C');
            $pdf->Cell(36,6,$student[16],1,0,'C');
            $pdf->Cell(36,6,$student[15],1,0,'C');
            $pdf->Cell(36,6,'45%',1,0,'C');
            $pdf->Cell(36,6,$student[17],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Comprehensive',1,0,'C');
            $pdf->Cell(36,6,$student[5],1,0,'C');
            $pdf->Cell(36,6,$student[4],1,0,'C');
            $pdf->Cell(36,6,'45%',1,0,'C');
            $pdf->Cell(36,6,$student[6],1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(144, 7, 'Overall Weighted %',1,0,'C', true);
            $pdf->Cell(36,7,$student[23],1,0,'C',true);
            $pdf->Ln();
            $pdf->Cell(144, 7, 'Overall Unit Score',1,0,'C', true);
            $pdf->Cell(36,7,$student[24],1,0,'C',true);
            $pdf->Ln();
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(144, 7, 'Unit Grade',1,0,'C', true);
            if($student[24] == "0") {
                $pdf->Cell(36,7,'F (0%)',1,0,'C',true);
            } elseif($student[24] == "1" ) {
                $pdf->Cell(36,7,'F (50%)',1,0,'C',true);
            } elseif($student[24] == "1+" ) {
                $pdf->Cell(36,7,'F (65%)',1,0,'C',true);
            } elseif($student[24] == "2-" ) {
                $pdf->Cell(36,7,'C- (72%)',1,0,'C',true);
            } elseif($student[24] == "2" ) {
                $pdf->Cell(36,7,'C (75%)',1,0,'C',true);
            } elseif($student[24] == "2+" ) {
                $pdf->Cell(36,7,'C+ (78%)',1,0,'C',true);
            } elseif($student[24] == "3-" ) {
                $pdf->Cell(36,7,'B- (82%)',1,0,'C',true);
            } elseif($student[24] == "3" ) {
                $pdf->Cell(36,7,'B (85%)',1,0,'C',true);
            } elseif($student[24] == "3+" ) {
                $pdf->Cell(36,7,'B+ (88%)',1,0,'C',true);
            } elseif($student[24] == "4-" ) {
                $pdf->Cell(36,7,'A- (92%)',1,0,'C',true);
            } elseif($student[24] == "4" ) {
                $pdf->Cell(36,7,'A (95%)',1,0,'C',true);
            } elseif($student[24] == "4+" ) {
                $pdf->Cell(36,7,'A+ (100%)',1,0,'C',true);
            } else {
                $pdf->Cell(36,7,'F',1,0,'C',true);
            }
            $pdf->Ln(15);

            //Final comments for student
            $pdf->Cell(180, 7, 'Additional Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[25], "LBR", 'L', false);

            //Add new page for formatting
            $pdf->AddPage();
        
        //Comprehensive MCQ Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Comprehensive Exam (45%):','B',0, 'L', false);
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
            for($i=2;$i<=4;$i++) {
                $pdf->Cell(60,6,$student[$i],1,0,'C');
            }
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C',true);
            $pdf->Cell(60,7,$student[5],1,0,'C', true);
            $pdf->Ln();
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C',true);
            $pdf->Cell(60, 7, $student[6],1,0,'C',true);      
            $pdf->Ln(15);

        //Project Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Project (45%:','B',0, 'L', false);
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
            for($i=7;$i<=13;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Score Average',1,0,'C', true);
            $pdf->Cell(60,7,$student[14],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[15],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[16],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,$student[17],1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[18], "LBR", 'L', false);
            $pdf->Ln(15);

        //Homework Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Homework (10%):','B',0, 'L', false);
            $pdf->Ln();
            
            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(90, 7, 'Points Earned',1,0,'C', true);
            $pdf->Cell(90, 7, 'Points Possible',1,0,'C', true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', '',12);
            //18 = Homework Grade Earned          
            $pdf->Cell(90,6,$student[19],1,0,'C');
            $pdf->Cell(90,6,4,1,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B',12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(90, 7, 'Percentage',1,0,'C',true);
            $pdf->Cell(90, 7, $student[20],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(90, 7, 'SBG Score',1,0,'C',true);
            $pdf->Cell(90, 7, $student[21],1,0,'C',true);
            $pdf->Ln();
            $pdf->Cell(90, 7, 'Weighted %',1,0,'C',true);
            $pdf->Cell(90, 7, $student[22],1,0,'C',true);
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