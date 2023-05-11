<?php
// Include the main TCPDF library
require_once('C:\xampp\htdocs\TCPDF\tcpdf.php');
require('../../config/dbconnection.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Uthpalani Jayasinghe');
$pdf->SetTitle('Course Performance Report');
$pdf->SetSubject('itmansala');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
$pdf->AddPage();

// Get current date and time
$dateTime = date('Y-m-d H:i:s');

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Add logo of the company
$pdf->Image('../../assets/images/icon.png', 165, 20, 30, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

// Fetch data from database
$sql = "SELECT courseId,COUNT(*) as total FROM student_course group by courseId";
$result = mysqli_query($connection, $sql);

// Initialize variable to store data
$data = '';

// Check if there are any rows in the result
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and concatenate data
    while($row = mysqli_fetch_assoc($result)) {

        $sqlMarks = "SELECT avg(marks) as average from student_modelpaperquiz where courseId = '".$row["courseId"]."'";
        $resultMarks = mysqli_query($connection, $sqlMarks);
        $rowMarks = mysqli_fetch_assoc($resultMarks);

        $sqlRatings = "SELECT avg(rating) as rating from course_ratings where courseId = '".$row["courseId"]."'";
        $resultRatings = mysqli_query($connection, $sqlRatings);
        $rowRatings = mysqli_fetch_assoc($resultRatings);

        $data .= '<tr>';
        $data .= '<td>' . $row["courseId"] . '</td>';
        $data .= '<td>' . $row["total"] . '</td>';
        $data .= '<td>' . $rowMarks["average"] . '</td>';
        $data .= '<td>' . $rowRatings["rating"] . '</td>';
        $data .= '</tr>';
    }
}


// Set some content to print
$html = <<<EOD
<h1>Course Performance Report</h1>
<h4>$dateTime</h4>
<table>
<tr>
<th>Course</th>
<th>Students</th>
<th>Average Marks</th>
<th>Ratings</th>
</tr>
{$data}
</table>
EOD;
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('CoursePerformance.pdf', 'I');
?>
