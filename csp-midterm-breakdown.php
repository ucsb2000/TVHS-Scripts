<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'midterm-assessment-breakdown-p3.csv';
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
            $pdf->Cell(180, 7, 'AP CSP - Midterm Standard Grade Breakdown',0,0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your Midterm standard grade.',0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(180, 7, 'Your standard grade is based solely on your Midterm project.  No retakes are allowed. ',0,0,'C');
            $pdf->Ln(10);

            /*
            //Standard Explanation
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'PRL Standard Overview:','B',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(180, 7, 'This unit explores how we use parameters, argruments and return to improve the scope within our apps.', "LBR", 'L', false);
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
            $pdf->Cell(36,6,'Unit 7',1,0,'C');
            $pdf->Cell(36,6,$student[8],1,0,'C');
            $pdf->Cell(36,6,$student[7],1,0,'C');
            $pdf->Cell(36,6,'100%',1,0,'C');
            $pdf->Cell(36,6,$student[9],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Unit 6',1,0,'C');
            $pdf->Cell(36,6,$student[17],1,0,'C');
            $pdf->Cell(36,6,$student[16],1,0,'C');
            $pdf->Cell(36,6,'100%',1,0,'C');
            $pdf->Cell(36,6,$student[18],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Unit 4',1,0,'C');
            $pdf->Cell(36,6,$student[27],1,0,'C');
            $pdf->Cell(36,6,$student[26],1,0,'C');
            $pdf->Cell(36,6,'100%',1,0,'C');
            $pdf->Cell(36,6,$student[28],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(36,6,'Unit 3',1,0,'C');
            $pdf->Cell(36,6,$student[37],1,0,'C');
            $pdf->Cell(36,6,$student[36],1,0,'C');
            $pdf->Cell(36,6,'100%',1,0,'C');
            $pdf->Cell(36,6,$student[38],1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(144, 7, 'Overall Weighted %',1,0,'C', true);
            $pdf->Cell(36,7,$student[40],1,0,'C',true);
            $pdf->Ln();
            $pdf->Cell(144, 7, 'Overall Unit Score',1,0,'C', true);
            $pdf->Cell(36,7,$student[41],1,0,'C',true);
            $pdf->Ln();
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(144, 7, 'Unit Grade',1,0,'C', true);
            if($student[41] == "0") {
                $pdf->Cell(36,7,'F (0%)',1,0,'C',true);
            } elseif($student[41] == "1" ) {
                $pdf->Cell(36,7,'F (50%)',1,0,'C',true);
            } elseif($student[41] == "1+" ) {
                $pdf->Cell(36,7,'F (65%)',1,0,'C',true);
            } elseif($student[41] == "2-" ) {
                $pdf->Cell(36,7,'C- (72%)',1,0,'C',true);
            } elseif($student[41] == "2" ) {
                $pdf->Cell(36,7,'C (75%)',1,0,'C',true);
            } elseif($student[41] == "2+" ) {
                $pdf->Cell(36,7,'C+ (78%)',1,0,'C',true);
            } elseif($student[41] == "3-" ) {
                $pdf->Cell(36,7,'B- (82%)',1,0,'C',true);
            } elseif($student[41] == "3" ) {
                $pdf->Cell(36,7,'B (85%)',1,0,'C',true);
            } elseif($student[41] == "3+" ) {
                $pdf->Cell(36,7,'B+ (88%)',1,0,'C',true);
            } elseif($student[41] == "4-" ) {
                $pdf->Cell(36,7,'A- (92%)',1,0,'C',true);
            } elseif($student[41] == "4" ) {
                $pdf->Cell(36,7,'A (95%)',1,0,'C',true);
            } elseif($student[41] == "4+" ) {
                $pdf->Cell(36,7,'A+ (100%)',1,0,'C',true);
            } else {
                $pdf->Cell(36,7,'F',1,0,'C',true);
            }
            $pdf->Ln(15);

            //Final comments for student
            $pdf->Cell(180, 7, 'Additional Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[42], "LBR", 'L', false);

        //Generate a new page for AAP - PRL Project Reassessment Data (Unit 7)
            $pdf->AddPage();

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - PRL Standard Grade Reassessment',0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your PRL standard grade.',0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(180, 7, 'Your standard grade is a combination of your Comprehensive Exam (45%), Project (45%) ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Homework (10%).  As the semester progresses, you will have ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'opportunities to improve this grade, if you choose to take advantage of them.',0,0,'C');
            $pdf->Ln(10);

            //CRD Project Breakdown Table
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
            for($i=2;$i<=5;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Score Average',1,0,'C', true);
            $pdf->Cell(60,7,$student[6],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[7],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[8],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,$student[9],1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[10], "LBR", 'L', false);
            $pdf->Ln(15);


        //Generate a new page for AAP - LLT Project Reassessment Data (Unit 6)
            $pdf->AddPage();

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - LLT Standard Grade Reassessment',0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Following is a breakdown of your LLT Project reassessment.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'This reassessment details how your current project reflects your understanding of the ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'LLT standard.  If this grade reflects a better grade than your previous assessments',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'then your grade in Infinite Campus will be updated to reflect the improvement.',0,0,'C');
            $pdf->Ln(10);

            //CRD Project Breakdown Table
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
            for($i=11;$i<=14;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Score Average',1,0,'C', true);
            $pdf->Cell(60,7,$student[15],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[16],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[17],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,$student[18],1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[19], "LBR", 'L', false);
            $pdf->Ln(15);        
        
        //Generate a new page for AAP - VCF Project Reassessment Data (Unit 4)
            $pdf->AddPage();

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - VCF Standard Grade Reassessment',0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Following is a breakdown of your VCF Project reassessment.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'This reassessment details how your current project reflects your understanding of the ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'VCF standard.  If this grade reflects a better grade than your previous assessments',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'then your grade in Infinite Campus will be updated to reflect the improvement.',0,0,'C');
            $pdf->Ln(10);

            //CRD Project Breakdown Table
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
            for($i=20;$i<=24;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Score Average',1,0,'C', true);
            $pdf->Cell(60,7,$student[25],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[26],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[27],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,$student[28],1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[29], "LBR", 'L', false);
            $pdf->Ln(15);

        //Generate a new page for AAP - CRD Project Reassessment Data (Unit 3)
            $pdf->AddPage();

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - CRD Standard Grade Reassessment',0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Following is a breakdown of your CRD Project reassessment.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'This reassessment details how your current project reflects your understanding of the ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'CRD standard.  If this grade reflects a better grade than your previous assessments',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'then your grade in Infinite Campus will be updated to reflect the improvement.',0,0,'C');
            $pdf->Ln(10);

            //CRD Project Breakdown Table
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
            for($i=30;$i<=34;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Score Average',1,0,'C', true);
            $pdf->Cell(60,7,$student[35],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,$student[36],1,0,'C',true);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'SBG Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[37],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,$student[38],1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[39], "LBR", 'L', false);
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