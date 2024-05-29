<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PatientEnrolmentRecord; 
use App\Models\PatientTreatmentRecord; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class DownloadPatientInfoController extends Controller
{
    public function downloadPatientInfoPdf($id)
    {
        // Fetch the patient data by ID
        $patient = PatientEnrolmentRecord::findOrFail($id);

        // Fetch treatment records for the patient
        $treatmentRecords = PatientTreatmentRecord::where('patient_id', $id)->get();

        // Load the logo image content and encode it to base64
        $imagePath = public_path('images/logo0.png');
        $imageContent = base64_encode(File::get($imagePath));

        // Generate the HTML content with the patient information and embedded image
        $html2 = '<div style="margin-top: -28px; text-align: center;">';
        $html2 .= '<div style="position: relative;">'; // Wrapper div for image and text
        $html2 .= '<span style="position: absolute; top:122px; left: 50%; transform: translateX(-50%); font-size: 17px; font-weight: bold; font-family: sans-serif; display: inline-block;">PATIENT ENROLMENT RECORD</span>';
        $html2 .= '<img src="data:image/png;base64,' . $imageContent . '" alt="logo" style="width: 240px; display: inline-block;">';
        $html2 .= '</div>';
        $html2 .= '</div>';

        // Pass the $patient, $treatmentRecords, and $imageContent variables to the view
        $html1 = View::make('ViewPatientInfo', ['patient' => $patient, 'treatmentRecords' => $treatmentRecords])->renderSections()['content'];

        // Load CSS content
        $css = file_get_contents(public_path('css/ViewPatientInfo.css')); // Adjust the path as per your directory structure

        // Load CSS content
        $pdfCss = file_get_contents(public_path('css/PdfStyle.css')); // PDF-specific CSS

        // Combine HTML and CSS
        $htmlWithCss = '<style>' . $css . '</style>' . '<style>' . $pdfCss . '</style>' . $html2 . $html1;
        
        // Create a new instance of Dompdf
        $dompdf = new Dompdf();  
        
        // Load HTML content with CSS into Dompdf
        $dompdf->loadHtml($htmlWithCss);
        
        // (Optional) Set options for PDF generation
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parser
        $options->set('isPhpEnabled', true); // Enable PHP execution in the HTML document

        // (Optional) Configure Dompdf according to your needs
        $dompdf->setOptions($options);
        
        // Render the PDF
        $dompdf->render();
        
        // Generate the PDF file name based on the patient's first name and last name
        $fileName = $patient->first_name . ' ' . $patient->last_name . ' Patient Information.pdf';
        
        // Output the generated PDF to the browser for download
        return $dompdf->stream($fileName);
    }


    public function downloadTreatmentRecordPdf($id, $treatment_id)
{
    // Fetch the patient data by ID
    $patient = PatientEnrolmentRecord::findOrFail($id);

    // Fetch the specific treatment record for the patient
    $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

    // Load the logo image content and encode it to base64
    $imagePath = public_path('images/logo0.png');
    $imageContent = base64_encode(File::get($imagePath));

    // Generate the HTML content with the patient information and embedded image
    $html2 = '<div style="margin-top: -28px; text-align: center;">';
    $html2 .= '<div style="position: relative;">'; // Wrapper div for image and text
    $html2 .= '<span style="position: absolute; top:122px; left: 50%; transform: translateX(-50%); font-size: 17px; font-weight: bold; font-family: sans-serif; display: inline-block;">INDIVIDUAL TREATMENT RECORD</span>';
    $html2 .= '<img src="data:image/png;base64,' . $imageContent . '" alt="logo" style="width: 240px; display: inline-block;">';
    $html2 .= '</div>';
    $html2 .= '</div>';

    // Pass the $patient and $treatmentRecord variables to the view
    $html1 = View::make('ViewTreatmentRecords', ['patient' => $patient, 'treatmentRecord' => $treatmentRecord])->renderSections()['content'];

    // Load CSS content
    $css = file_get_contents(public_path('css/ViewTreatmentRecords.css')); // Adjust the path as per your directory structure

    // Load PDF-specific CSS content
    $pdfCss = file_get_contents(public_path('css/PdfStyle.css')); // PDF-specific CSS

    // Combine HTML and CSS
    $htmlWithCss = '<style>' . $css . '</style>' . '<style>' . $pdfCss . '</style>' . $html2 . $html1;
    
    // Create a new instance of Dompdf
    $dompdf = new Dompdf();  
    
    // Load HTML content with CSS into Dompdf
    $dompdf->loadHtml($htmlWithCss);
    
    // (Optional) Set options for PDF generation
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parser
    $options->set('isPhpEnabled', true); // Enable PHP execution in the HTML document

    // (Optional) Configure Dompdf according to your needs
    $dompdf->setOptions($options);
    
    // Render the PDF
    $dompdf->render();
    
    // Generate the PDF file name based on the patient's first name and last name
    $fileName = $patient->first_name . ' ' . $patient->last_name . ' Individual Treatment Record.pdf';
    
    // Output the generated PDF to the browser for download
    return $dompdf->stream($fileName);
}



}

