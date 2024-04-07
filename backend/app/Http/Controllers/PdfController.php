<?php

namespace App\Http\Controllers;

use Exception;
use Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;

class PdfController extends Controller
{
    public function createPdf(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
    
                // Validate request
                $request->validate([
                    'text' => ['required', 'string'],
                    'link' => ['required', 'url'],
                ]);
                
                // Generate QR code
                $qrCode = Builder::create()
                    ->writer(new PngWriter())
                    ->data($request->link)
                    ->size(400)
                    ->errorCorrectionLevel(ErrorCorrectionLevel::Medium)
                    ->logoPath(storage_path('app/public/logo.jpg'))
                    ->logoResizeToWidth(100)
                    ->logoPunchoutBackground(true)
                    ->build();
        
                // Generate PDF with text and QR code
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 18);
                $pdf->Write(10, $request->text);
                $pdf->Ln(30);
                $pdf->Image($qrCode->getDataUri(), 50, null, null, null, 'png');
        
                // Save PDF to storage
                $pdfPath = 'pdf/' . uniqid() . '.pdf';
                $pdf->Output(storage_path('app/public/' . $pdfPath), 'F');
                
                // Return PDF url
                $pdfUrl = asset('storage/' . $pdfPath);
                return response()->json(['pdfUrl' => $pdfUrl], 200);
                
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'Invalid request method'
            ], 405);
        }
    }
}