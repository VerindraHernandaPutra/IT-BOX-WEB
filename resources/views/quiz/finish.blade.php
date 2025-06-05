<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->course_name }} Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        .navigation-buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $course->course_name }} Quiz</h1>
    <p>Peraturan Quiz dan Ujian Akhir:</p>
    <ul>
        <li>Quiz dapat diikuti bila quiz sebelumnya lulus >= 90/100.</li>
        <li>Exam dapat diambil bila seluruh quiz telah lulus (nilai semua quiz >= 90/100).</li>
        <li>Nilai exam >= 90/100 untuk dinyatakan selesai/lulus.</li>
    </ul>

    @if (isset($maxScore))
        <div class="alert alert-success">
            <h4>Hasil Anda:</h4>
            <p>Skor Anda: <strong>{{ $maxScore }}%</strong></p>
            @if ($maxScore >= 90)
                <div class="mt-4">
                    <h3>Certificate</h3>
                    <a href="{{ route('certificate.download.pdf', $certificate->id) }}" class="btn btn-primary">Download PDF</a>
                </div>
            @else
                <p>Skor Anda belum mencukupi untuk mendapatkan sertifikat. Silakan coba lagi!</p>
            @endif
        </div>
        <a href="{{ route('quiz.start', $course->id) }}" class="btn btn-warning">Attempt Quiz Again</a>
    @else
        <a href="{{ route('quiz.start', $course->id) }}" class="btn btn-primary">Attempt Quiz</a>
    @endif
</div>
</body>
</html>
