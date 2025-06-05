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
        if ($certificate->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // Load view sertifikat
        $pdf = Pdf::loadView('courses.certificates.template', compact('certificate'));

        // Nama file untuk di-download
        $fileName = 'Certificate-' . $certificate->course->course_name . '.pdf';

        // Download PDF
        return $pdf->download($fileName);
    }
}
