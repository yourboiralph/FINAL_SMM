This is the revision page

<form action="{{ url('operation/revision/update/' . $job_draft->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="">Put your draft here po</label>
    <input type="text" name='draft'>

    <button type="submit">Submit</button>
</form>