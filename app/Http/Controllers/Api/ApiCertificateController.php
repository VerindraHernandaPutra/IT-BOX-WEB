<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function downloadPdf(Certificate $certificate)
    {
        $user = auth()->user();

        // Pastikan hanya user yang memiliki sertifikat ini yang bisa mendownload
        // if ($certificate->user_id !== $user->id) {
        //     abort(403, 'Unauthorized action.');
        // }
        
        if ($certificate->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        try {
            $pdf = Pdf::loadView('courses.certificates.template', compact('certificate'));
            $fileName = 'Certificate-' . $certificate->course->course_name . '.pdf';
            return $pdf->stream($fileName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to generate certificate.'], 500);
        }
        //     return $pdf->download($fileName);
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Failed to generate certificate.'], 500);
        // }

        // // Load view sertifikat
        // $pdf = Pdf::loadView('courses.certificates.template', compact('certificate'));

        // // Nama file untuk di-download
        // $fileName = 'Certificate-' . $certificate->course->course_name . '.pdf';

        // // Download PDF
        // return $pdf->download($fileName);
    }

    public function getUserCertificates(Request $request){
    $user = $request->user(); // Mendapatkan user yang sedang login

    // Mendapatkan sertifikat yang dimiliki oleh user berdasarkan relasi
    $certificates = $user->certificates()->with('course')->get();; // Asumsi ada relasi antara User dan Certificate

    return response()->json($certificates);
    }
}
