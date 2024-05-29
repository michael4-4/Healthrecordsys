<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PatientEnrolmentRecord; 
use App\Models\PatientTreatmentRecord; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class DownloadViewRecordsController extends Controller
{
    public function downloadViewRecordsPdf(Request $request)
{
    // Retrieve all barangays
    $barangays = ['Show','Acnam', 'Barikir', 'Barangobong', 'Bugayong', 'Caray', 'Cabitauran', 'Garnaden', 'Naguilian', 'Poblacion', 'Sto. Nino', 'Uguis'];

    // Initialize query builder
    $query = PatientEnrolmentRecord::query();

    // Check if search query is provided
    if ($request->has('search_query')) {
        $searchQuery = $request->search_query;
        // Apply search filter to multiple columns as needed
        $query->where(function ($q) use ($searchQuery) {
            $q->where('last_name', 'like', '%' . $searchQuery . '%')
              ->orWhere('first_name', 'like', '%' . $searchQuery . '%')
              ->orWhere('barangay', 'like', '%' . $searchQuery . '%');
        });
    }

    // Check if filter by barangay is applied
    if ($request->has('filter') && in_array($request->filter, $barangays)) {
        // Convert both column value and selected barangay value to lowercase for case-insensitive comparison
        $query->whereRaw('LOWER(barangay) LIKE ?', ['%' . strtolower($request->filter) . '%']);
    }

    // Paginate the filtered records with a large number to ensure all records are retrieved
    $patients = $query->paginate(12000); // Adjust pagination as needed

    // Calculate the starting number for the first page
    $startNumber = 1;

    // Load the logo image content and encode it to base64
    $imagePath = public_path('images/logo0.png');
    $imageContent = base64_encode(File::get($imagePath));

    // Generate the HTML content with the patient information and embedded image
    $html2 = '<div style="margin-top: -28px; text-align: center;">';
    $html2 .= '<div style="position: relative;">'; // Wrapper div for image and text
    $html2 .= '<span style="position: absolute; top:122px; left: 50%; transform: translateX(-50%); font-size: 17px; font-weight: bold; font-family: sans-serif; display: inline-block;">LIST OF PATIENT RECORDS</span>';
    $html2 .= '<img src="data:image/png;base64,' . $imageContent . '" alt="logo" style="width: 240px; display: inline-block;">';
    $html2 .= '</div>';
    $html2 .= '</div>';

    // Pass the $patients and $startNumber variables to the view
    $html1 = view('ViewRecords', compact('patients', 'startNumber', 'barangays', 'searchQuery'))->renderSections()['content'];

    // Load CSS content
    $css = file_get_contents(public_path('css/ViewRecords.css')); // Adjust the path as per your directory structure

    // Load PDF-specific CSS content
    $pdfCss = file_get_contents(public_path('css/PdfStyle2.css'));

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

    // Generate the PDF file name
    $fileName = 'Patient_Record.pdf';

    // Output the generated PDF to the browser for download
    return $dompdf->stream($fileName);
}

}
