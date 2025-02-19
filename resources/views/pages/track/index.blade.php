hello guys

<div>

    @foreach ($job_drafts as $job_draft)
    <p>

        {{$job_draft->jobOrder->title}} - {{$job_draft->status}}
    </p>
    @endforeach
</div>