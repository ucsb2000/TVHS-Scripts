<?php
	echo "<p>Hello...</p>";

    require('fpdf185/fpdf.php');

    $csvfile = 'course-final-online.csv';
    $period = 'periodOnline';

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
            $pdf->Cell(180, 7, 'AP CSP Online - Course Final Grade Breakdown',0,0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 7, 'Generated for: ' . $student[1] . ' ' . $student[0],0,0,'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'This document is a breakdown of your Course Final grade and articulation credit status.',0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(180, 7, 'Your grade is a combination of your MCQ Exam (70%)',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(180, 7, 'and your Performance Task (30%).',0,0,'C');
            $pdf->Ln(10);

        //Overall Grade Breadown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Final Exam Grade Breakdown:',0,0,'L');
            $pdf->Ln(10);

            //Table Headers
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(45, 7, 'Category',1,0,'C', true);
            $pdf->Cell(45, 7, 'Percentage',1,0,'C',true);
            $pdf->Cell(45, 7, 'Weight',1,0,'C',true);
            $pdf->Cell(45, 7, 'Weighted %',1,0,'C',true);
            $pdf->Ln();

            //Table Data                
            $pdf->SetFont('Arial', '',12);          
            $pdf->Cell(45,6,'MCQ Exam',1,0,'C');
            $pdf->Cell(45,6,$student[25],1,0,'C');
            $pdf->Cell(45,6,'70%',1,0,'C');
            $pdf->Cell(45,6,round($student[26] * 100,2) . '%',1,0,'C');
            $pdf->Ln();

            $pdf->Cell(45,6,'Performance Task',1,0,'C');
            $pdf->Cell(45,6,$student[19],1,0,'C');
            $pdf->Cell(45,6,'30%',1,0,'C');
            $pdf->Cell(45,6,round($student[20] * 100,2) . '%',1,0,'C');
            $pdf->Ln();

            //Add total row to table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->setFillColor(160,160,160);
            $pdf->Cell(144, 7, 'Overall Weighted %',1,0,'C', true);
            $pdf->Cell(36,7,$student[28],1,0,'C',true);
            $pdf->Ln();
            $pdf->Cell(144, 7, 'Final Grace',1,0,'C', true);
            $pdf->Cell(36,7,$student[29],1,0,'C',true);
            $pdf->Ln();

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
            $pdf->Cell(60,6,$student[24],1,0,'C');
            $pdf->Cell(60,6,55,1,0,'C');
            $pdf->Cell(60,6,$student[25],1,0,'C');
            $pdf->Ln();

            $pdf->Cell(120, 7, 'Weighted %',1,0,'C',true);
            $pdf->Cell(60, 7, round($student[26] * 100,0) . '%',1,0,'C',true);      
            $pdf->Ln(15);

        //Performance Task Breakdown Table
            //Table Title
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(180, 7, 'Performance Task (30%):','B',0, 'L', false);
            $pdf->Ln(10);

        //Program Code
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'Program Code (5 Points):','B',0, 'L', false);
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
                $pdf->Cell(60,6,5,1,0,'C');
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
            $pdf->Cell(180, 7, 'For the program code point to be earned, all sections above must have earned full points.',0,0,'C');
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
            $pdf->Cell(180, 7, 'Video (5 Points):','B',0, 'L', false);
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
            $pdf->Cell(60,6,5,1,0,'C');
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
            $pdf->Cell(180, 7, 'Written Responses (5 Points Each):','B',0, 'L', false);
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
                $pdf->Cell(60,6,5,1,0,'C');
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
            $pdf->Cell(180, 7, 'Performance Task Total Points Earned (30 Points):','B',0, 'L', false);
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
            $pdf->Cell(120, 7, 'Weighted %',1,0,'C', true);
            $pdf->Cell(60,7,round($student[20] * 100,0) . '%',1,0,'C',true);
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
            $pdf->Cell(60,6,$student[31],1,0,'C');
            $pdf->Cell(60,6,$student[32],1,0,'C');
            $pdf->Cell(60,6,$student[28],1,0,'C');
            $pdf->Ln(10);
            $pdf->Ln(15);

            // Create individual student report
            $pdf->SetFont('Arial', 'B', 13);
            if ($student[28] >= 70 && ($student[31] == "A" || $student[31] == "B") && ($student[32] == "A" || $student[32] == "B")) {
                //Student earned the credit
                $pdf->Cell(180,7,"MSJC Articulation Credit EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(180,7,"You will receive a grade of " . $student[29] . " on your MSJC college transcript.",0,0,'C');
                $pdf->Ln(20);
            } else {
                //Student did NOT earn credit
                $pdf->SetFont('Arial', 'B', 13);
                $pdf->Cell(180,7,"MSJC Articulation Credit NOT EARNED!",0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 12);
                if ($student[28] < 70) {
                $pdf->Cell(180,7,"Your grade on the final exam was not above 70%",0,0,'C');
                $pdf->Ln();
                }
                if ($student[31] == "C" || $student[31] == "F" || $student[31] == "NA") {
                $pdf->Cell(180,7,"Your final grade 1st semester was not a B or better",0,0,'C');
                $pdf->Ln();
                }
                if ($student[32] == "C" || $student[32] == "F" || $student[32] == "NA") {
                $pdf->Cell(180,7,"Your final grade 2nd semester was not a B or better",0,0,'C');
                $pdf->Ln();
                }
            }
        

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