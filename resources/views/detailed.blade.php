<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Document</title>
</head>
<body>
<div class="container">
    <br>
    <div class="detailed-wrapper">
        <div class="job-title">
            <h3>{{ $job->title }}</h3>
        </div>
        <div class="job-descr">
            <h6>{{ $job->description }}</h6>
        </div>
        <hr>
        <div class="users-list">
            @foreach($cvs as $cv)
                <div class="user-cv">
                    <div>
                        <strong>Name: </strong>
                        {{ $cv->name }}
                    </div>
                    <div>
                        <strong>Address: </strong>
                        {{ $cv->address }}
                    </div>
                    <div>
                        <strong>Education: </strong>
                        {{ $cv->education }}
                    </div>
                    <div>
                        <strong>Work: </strong>
                        {{ $cv->work }}
                    </div>
                    <div>
                        <strong>Experience: </strong>
                        {{ $cv->experience }} years
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="loader-bg">
    <div class="loader"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
