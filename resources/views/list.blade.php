<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<div class="container mt-5">
    <h1>Trivia Questions</h1>
    <hr>

    <div class="container mt-5">
        <div id="questions-container" class="mb-4">
            @foreach ($filteredTrivia as $index => $question)
                <div class="card mt-3 question-card @if($index > 0) d-none @endif" data-question-index="{{ $index }}">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Question {{ $index + 1 }}</h5>
                        <h6 class="card-title">Category : <i class="text-primary">{{ htmlspecialchars_decode($question['category']) }}</i></h6>
                        <p class="card-text">{{ htmlspecialchars_decode($question['question']) }}</p>
                        <form class="question-form">
                            @foreach ($question['incorrect_answers'] as $answer)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer"
                                           value="{{ htmlspecialchars_decode($answer) }}" required>
                                    <label class="form-check-label">{{ htmlspecialchars_decode($answer) }}</label>
                                </div>
                            @endforeach
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer"
                                       value="{{ htmlspecialchars_decode($question['correct_answer']) }}" required>
                                <label class="form-check-label">
                                    {{ htmlspecialchars_decode($question['correct_answer']) }}
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            <div id="result-container" class="d-none">
                <h3>Answers:</h3>
                <ul id="user-answers"></ul>
            </div>
        </div>
        <button id="submit-btn" class="btn btn-primary" onclick="nextQuestion()">Submit & Next</button>
        <a id="finish-btn" class="btn btn-primary" href="{{ route('index') }}" onclick="indexPage()" hidden>Finish Quiz</a>
    </div>
</div>
</div>

<script>
    let currentQuestion = 0;
    let cards = document.querySelectorAll('.question-card');
    const answers = [];

    // Toggle buttons
    let btnToggle = () => {
        let submitBtn = document.getElementById("submit-btn");
        let finishBtn = document.getElementById("finish-btn");

        submitBtn.hidden = !submitBtn.hidden;
        finishBtn.hidden = !finishBtn.hidden;
    };

    function showQuestion(index) {
        cards.forEach((card, i) => {
            if (i === index) {
                card.classList.remove('d-none');
            } else {
                card.classList.add('d-none');
            }
        });
    }

    function saveAnswer() {
        const selectedAnswer = document.querySelector('input[name="answer"]:checked');
        if (selectedAnswer) {
            answers[currentQuestion] = selectedAnswer.value;
        }
    }

    function nextQuestion() {
        saveAnswer();
        if (currentQuestion < cards.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        } else {
            alert("Quiz completed!");
            btnToggle();
        }
    }

    function showAnswers() {
        console.log("Answers : ", answers);
    }

    showQuestion(currentQuestion);
</script>

</body>
</html>
