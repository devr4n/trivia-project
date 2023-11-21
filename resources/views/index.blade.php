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
    <h1>Trivia Project</h1>
    <ul>
        <li><i class="text-danger"> Please do not leave fields marked with * blank. </i></li>
    </ul>

    <hr>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <form action="{{ route('store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name *</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="number_of_questions" class="form-label">Number of Questions *</label>
            <input type="number" class="form-control" id="number_of_questions" name="number_of_questions" required
                   max="50">
        </div>

        <div class="mb-3">
            <label for="difficulty" class="form-label">Select Difficulty *</label>
            <select class="form-select" id="difficulty" name="difficulty" required>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Select Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="multiple">Multiple Choice</option>
                <option value="boolean">True/False</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    function formValidation() {
        let full_name = document.getElementById('full_name').value;
        let email = document.getElementById('email').value;
        let num_of_questions = document.getElementById('num_of_questions').value;
        let difficulty = document.getElementById('difficulty').value;
        if (full_name === "" || email === "" || num_of_questions === "" || difficulty === "") {
            alert("Please fill out all fields marked with *");
            return false;
        }
        return true;

    }
</script>
</body>
</html>
