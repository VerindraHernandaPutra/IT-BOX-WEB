<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
        }
        .certificate {
            border: 5px solid #6c63ff;
            padding: 20px;
            border-radius: 15px;
        }
        h1 {
            color: #6c63ff;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .signature {
            margin-top: 50px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2>{{ $certificate->user->name }}</h2>
        <p>has successfully completed the course</p>
        <h3>{{ $certificate->course->course_name }}</h3>
    </div>
</body>
</html>
