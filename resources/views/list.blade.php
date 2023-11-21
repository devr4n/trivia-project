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
        <div class="card">
            <div class="card-body">

                <div id="questions-container" class="mb-4">
                    @foreach ($filteredTrivia as $index => $question)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Question {{ $index + 1 }}</h5>
                                <p class="card-text">{{ htmlspecialchars_decode($question['question']) }}</p>
                                <form>
                                    @foreach ($question['incorrect_answers'] as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer_{{ $index }}"
                                                   id="answer_{{ $index }}_{{ $loop->iteration }}" value="{{ $answer }}">
                                            <label class="form-check-label"
                                                   for="answer_{{ $index }}_{{ $loop->iteration }}">{{ $answer }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_{{ $index }}"
                                               id="answer_{{ $index }}_correct"
                                               value="{{ $question['correct_answer'] }}">
                                        <label class="form-check-label"
                                               for="answer_{{ $index }}_correct">{{ $question['correct_answer'] }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>

                <button id="submit-btn" class="btn btn-primary">Submit</button>

                <div id="user-answers-container" class="mt-3">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
