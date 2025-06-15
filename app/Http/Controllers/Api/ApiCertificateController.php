<?php

// Namespace should match the folder structure
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Certificate;

// Class name should match the file name
class ApiCertificateController extends Controller
{
    /**
     * Generate and stream a PDF certificate for download.
     */
    public function downloadPdf(Request $request, Certificate $certificate)
    {
        $user = $request->user();

        if ($certificate->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        try {
            // Prepare data for the Blade view
            $data = [
                'userName' => $certificate->user->name,
                'courseName' => $certificate->course->course_name,
                'issuedDate' => $certificate->issued_at->format('d F Y'),
            ];

            $pdf = Pdf::loadView('courses.certificates.template', $data)
                      ->setPaper('a4', 'landscape');
            
            $fileName = 'Certificate-' . str_replace(' ', '_', $certificate->course->course_name) . '.pdf';
            
            return $pdf->stream($fileName);
            
        } catch (\Exception $e) {
            \Log::error('PDF Generation Failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to generate certificate.'], 500);
        }
    }

    /**
     * Get all certificates for the currently authenticated user.
     */
    public function getUserCertificates(Request $request){
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Eager load the 'course' relationship and fix the syntax error
        $certificates = $user->certificates()->with('course')->get(); // REMOVED the extra semicolon

        // Wrap the response in a "data" key to be consistent
        return response()->json(['data' => $certificates]);
    }
}
