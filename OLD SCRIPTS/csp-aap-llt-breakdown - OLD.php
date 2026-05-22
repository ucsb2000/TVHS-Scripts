<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'csp-unit-6-p3.csv';
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
            $pdf->Cell(180, 7, 'AP CSP - AAP (LLT) Standard Grade Breakdown',0,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your AAP (LLT) standard grade.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'Your standard grade is a combination of your Comprehensive Exam (45%), Project (45%) ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Homework (10%).  As the semester progresses, you will have ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'opportunities to improve this grade, if you choose to take advantage of them.',0,0,'C');
            $pdf->Ln(10);

            //Standard Explanation
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'AAP (LLT) Standard Overview:','B',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(180, 7, 'This unit explores how lists, loops and traversals allow for the design of increasingly complex apps.', "LBR", 'L', false);
            $pdf->Ln(10);

            //Comprehensive MCQ Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Comprehensive Exam (45%):','B',0, 'L', false);
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
            //for($i=3;$i<22;$i++) {
            for($i=3;$i<8;$i++) {
                if(($i >= 3 AND $i <= 6)) {
                    if ($i == 5) {
                        $pdf->Cell(45,6,round($student[$i] * 100, 0) . '%',1,0,'C');
                    } else {
                        $pdf->Cell(45,6,$student[$i],1,0,'C');
                    }
                    
                }
            }
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(135, 7, 'Weighted Score',1,0,'C',true);
            $pdf->Cell(45, 7, round($student[7], 2),1,0,'C',true);
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
            for($i=8;$i<=10;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[11],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[12] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[13],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[14], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[15], "LBR", 'L', false);
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
            $pdf->Cell(60,6,$student[32],1,0,'C');
            $pdf->Cell(60,6,round($student[33] * 100, 0) . '%',1,0,'C');
            $pdf->Cell(60,6,$student[34],1,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B',12);
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C',true);
            $pdf->Cell(60, 7, round($student[35], 2),1,0,'C',true);
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
            $pdf->Cell(45,6,round($student[13], 2),1,0,'C');
            $pdf->Cell(45,6,'45%',1,0,'C');
            $pdf->Cell(45,6,round($student[14], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'Homework',1,0,'C');
            $pdf->Cell(45,6,round($student[34], 2),1,0,'C');
            $pdf->Cell(45,6,'10%',1,0,'C');
            $pdf->Cell(45,6,round($student[35], 2),1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(135, 7, 'Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[36],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(135, 7, 'Rounded Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[37],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(135, 7, 'Overall Unit Grade',1,0,'C', true);
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            if($student[37] >= 3.5) {
                $pdf->Cell(45,7,'A',1,0,'C',true);
            } elseif($student[37] >= 2.5 AND $student[37] <=3.49) {
                $pdf->Cell(45,7,'B',1,0,'C',true);
            } elseif ($student[37] >= 1.5 AND $student[37] <=2.49) {
                $pdf->Cell(45,7,'C',1,0,'C',true);
            } else {
                $pdf->Cell(45,7,'F',1,0,'C',true);
            }
            $pdf->Ln(15);

            //Final comments for student
            $pdf->Cell(180, 7, 'Additional Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[38], "LBR", 'L', false);

            //Generate a new page for AAP - VCF Project Reassessment Data
            $pdf->AddPage();

            //Header
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(180, 7, 'AP CSP - AAP (VCF) Standard Grade Reassessment',0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Following is a breakdown of your AAP - VCF Project reassessment.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'This reassessment details how your current project reflects your understanding of the ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'AAP-VCF standard.  If this grade reflects a better grade than your previous assessments',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'then your grade in Infinite Campus will be updated to reflect the improvement.',0,0,'C');
            $pdf->Ln(10);

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
            for($i=16;$i<=18;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[19],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[20] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[21],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[22], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[23], "LBR", 'L', false);
            $pdf->Ln(15);

            //Generate a new page for CRD Project Reassessment Data
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
            for($i=24;$i<=26;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[27],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[28] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[29],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[30], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[31], "LBR", 'L', false);
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