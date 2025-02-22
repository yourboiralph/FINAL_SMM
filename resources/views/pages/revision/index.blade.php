This are the list of revisions

@foreach ($job_drafts as $job_draft )
    
<p>

    {{$job_draft->jobOrder->title}}
</p>
@endforeach