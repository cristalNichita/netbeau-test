@foreach($jobs as $job)
    <div class="job-item">
        <a href="{{ route('show', ['id' => $job->id]) }}">
            <div class="job_company">
                <h5>{{ $job->company }}</h5>
            </div>
            <hr>
            <div class="job_title">
                <h6>{{ $job->title }}</h6>
            </div>
            <hr>
            <span class="job_loc">
                <h6>{{ $job->location }}</h6>
            </span>
        </a>
    </div>
@endforeach
