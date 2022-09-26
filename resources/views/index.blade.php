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
        <form class="search-form" method="post" action="{{ route('search') }}">
            <input type="text" name="search" placeholder="Title Location">
            <button onclick="searchForm(event, this)">Search</button>
        </form>
        <hr>

        <form action="{{ route('updateJobs') }}" method="POST">
            <button onclick="updateJobs(event, this)">Refresh jobs list</button>
            <strong> -> Press the button to add or update list of jobs.</strong>
        </form>
        <hr>

        <div class="jobs-list-wrapper">
            @include('search', ['jobs' => $jobs])
        </div>
    </div>

    <div class="loader-bg">
        <div class="loader"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
