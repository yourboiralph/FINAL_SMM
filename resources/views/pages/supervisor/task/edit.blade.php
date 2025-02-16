This is the edit page for this person. This is where you create a draft
<form action="{{ url('supervisor/task/update/' . $job_draft->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="">Put your draft here po</label>
    <input type="text" name='draft'>

    <button type="submit">Submit</button>
</form>
