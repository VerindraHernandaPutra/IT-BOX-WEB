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

        <form action="{{ route('quiz.submit', $course->id) }}" method="POST" id="quiz-form">
            @csrf
            <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">

            @foreach ($questions as $index => $question)
                <div class="question {{ $index === 0 ? 'active' : '' }}" id="question-{{ $index }}">
                    <p><strong>{{ $index + 1 }}. {{ $question->question_text }}</strong></p>
                    @foreach (['a', 'b', 'c', 'd'] as $option)
                        <div>
                            <input type="radio" name="answers[{{ $question->id }}]" value="option_{{ $option }}" id="q{{ $question->id }}_{{ $option }}">
                            <label for="q{{ $question->id }}_{{ $option }}">{{ $question->{'option_' . $option} }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="navigation-buttons">
                <button type="button" id="prev" class="btn btn-secondary" style="display:none;">Back</button>
                <button type="button" id="next" class="btn btn-primary">Next</button>
                <button type="submit" id="submit" class="btn btn-success" style="display:none;">Finish Quiz</button>
            </div>
        </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questions = document.querySelectorAll('.question');
        const nextButton = document.getElementById('next');
        const prevButton = document.getElementById('prev');
        const submitButton = document.getElementById('submit');
        let currentQuestion = 0;

        const updateButtons = () => {
            prevButton.style.display = currentQuestion === 0 ? 'none' : 'inline-block';
            nextButton.style.display = currentQuestion === questions.length - 1 ? 'none' : 'inline-block';
            submitButton.style.display = currentQuestion === questions.length - 1 ? 'inline-block' : 'none';
        };

        const showQuestion = (index) => {
            questions.forEach((q, i) => {
                q.classList.toggle('active', i === index);
            });
        };

        nextButton.addEventListener('click', () => {
            currentQuestion++;
            showQuestion(currentQuestion);
            updateButtons();
        });

        prevButton.addEventListener('click', () => {
            currentQuestion--;
            showQuestion(currentQuestion);
            updateButtons();
        });

        // Initialize
        showQuestion(currentQuestion);
        updateButtons();
    });
</script>
</body>
</html>
