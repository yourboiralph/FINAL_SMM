Would You Like to Renew?

{{$job_draft_id}}

<form action="{{ url('/client/renew/' . $job_draft_id->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <button type="submit" name="renewable" value="1" class="btn btn-success">
        Yes
    </button>
    
    <button type="submit" name="renewable" value="0" class="btn btn-danger">
        No
    </button>
</form>
