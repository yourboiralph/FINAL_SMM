pag create diri amaw

<form action="{{url('supervisor/joborder/store')}}" method="POST">
    @csrf
    <p>
        <label for="">Title</label>
        <input name="title" type="text">
    </p>
    <p>
        <label for="">Description</label>
        <input name="description" type="text">
    </p>
    <p>
        <label for="">Assigned To</label>
        <select name="assigned_to">
            <option value="">Select an Operator</option>  <!-- This should be outside the loop -->
            @foreach ($operators as $operator)
                <option value="{{ $operator->id }}">{{ $operator->name }}</option>
            @endforeach
        </select>
        
    </p>
    <button type="submit">Submit</button>
</form>