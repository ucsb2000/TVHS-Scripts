<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'csp-s1-final-p3.csv';
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
            $pdf->Cell(180, 7, 'AP CSP - AAP (PRL) Standard Grade Breakdown',0,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your Semester 1 Final project grade.',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'Your grade is a combination of the 4 standards we learned this first  ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'semester: CRD, AAP-VCF, AAP-LLT and AAP-PRL. ',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'Each standard is weighted equally at 25% of your overall grade.',0,0,'C');
            $pdf->Ln(10);

        //CRD Standard Breakdown
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Creative Development (25%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', 'B',12);            
            for($i=28;$i<=30;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[31],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[32] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[33],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[34], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[36], "LBR", 'L', false);
            $pdf->Ln(15);

        //AAP-VCF Standard Breakdown
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Variables, Conditionals & Functions (25%):','B',0, 'L', false);
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
            for($i=19;$i<=21;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[22],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[23] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[24],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[25], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[27], "LBR", 'L', false);
            $pdf->Ln(15);

            //Add new page for formatting
            $pdf->AddPage();

        //AAP-LLT Standard Breakdown
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Lists, Loops & Traversals (25%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', 'B',12);            
            for($i=10;$i<=12;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[13],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[14] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[15],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[16], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[18], "LBR", 'L', false);
            $pdf->Ln(15);

        //AAP-PRL Standard Breakdown
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Parameters, Return & Libraries (25%):','B',0, 'L', false);
            $pdf->Ln();

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(60, 7, 'Requirement',1,0,'C', true);
            $pdf->Cell(60, 7, 'Points Possible',1,0,'C',true);
            $pdf->Cell(60,7,'Points Earned',1,0,'C',true);
            $pdf->Ln();

            //Table Data
            $pdf->SetFont('Arial', 'B',12);            
            for($i=2;$i<=3;$i++) {
                $pdf->Cell(60,6,$headers[$i],1,0,'C');
                $pdf->Cell(60,6,4,1,0,'C');
                $pdf->Cell(60,6,$student[$i],1,0,'C');
                $pdf->Ln();
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Average Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[4],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Percentage',1,0,'C', true);
            $pdf->Cell(60,7,round($student[5] * 100, 0) . '%',1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(120, 7, 'Adjusted Score',1,0,'C', true);
            $pdf->Cell(60,7,$student[6],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(120, 7, 'Weighted Score',1,0,'C', true);
            $pdf->Cell(60,7,round($student[7], 2),1,0,'C',true);
            $pdf->Ln(10);

            //Project comments
            $pdf->Cell(180, 7, 'Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[9], "LBR", 'L', false);
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
            $pdf->Cell(45,6,'CRD',1,0,'C');
            $pdf->Cell(45,6,round($student[6], 2),1,0,'C');
            $pdf->Cell(45,6,'25%',1,0,'C');
            $pdf->Cell(45,6,round($student[7], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'AAP-VCF',1,0,'C');
            $pdf->Cell(45,6,round($student[15], 2),1,0,'C');
            $pdf->Cell(45,6,'25%',1,0,'C');
            $pdf->Cell(45,6,round($student[16], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'AAP-LLT',1,0,'C');
            $pdf->Cell(45,6,round($student[24], 2),1,0,'C');
            $pdf->Cell(45,6,'25%',1,0,'C');
            $pdf->Cell(45,6,round($student[25], 2),1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'AAP-PRL',1,0,'C');
            $pdf->Cell(45,6,round($student[33], 2),1,0,'C');
            $pdf->Cell(45,6,'25%',1,0,'C');
            $pdf->Cell(45,6,round($student[34], 2),1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(135, 7, 'Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[37],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(61,133,198);
            $pdf->Cell(135, 7, 'Rounded Overall Weighted Unit Score',1,0,'C', true);
            $pdf->Cell(45,7,$student[38],1,0,'C',true);
            $pdf->Ln();
            $pdf->setFillColor(180,167,214);
            $pdf->Cell(135, 7, 'Overall Unit Grade',1,0,'C', true);
            
            //Calculate Unit Grade
            $pdf->setFillColor(180,167,214);
            if($student[38] >= 3.5) {
                $pdf->Cell(45,7,'A',1,0,'C',true);
            } elseif($student[38] >= 2.5 AND $student[38] <=3.49) {
                $pdf->Cell(45,7,'B',1,0,'C',true);
            } elseif ($student[38] >= 1.5 AND $student[38] <=2.49) {
                $pdf->Cell(45,7,'C',1,0,'C',true);
            } else {
                $pdf->Cell(45,7,'F',1,0,'C',true);
            }
            $pdf->Ln(15);

            //Final comments for student
            $pdf->Cell(180, 7, 'Additional Comments:','LTR',0, 'L', false);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);      
            $pdf->MultiCell(180, 7, $student[39], "LBR", 'L', false);

            //Generate a new page for AAP - LLT Project Reassessment Data
            $pdf->AddPage();

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