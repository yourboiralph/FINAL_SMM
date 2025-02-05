<?php
    {{ Auth::user()->role === '1' ? return redirect('/client/dashboard'); : return redirect('/admin/dashboard');
}}
?>

<form action="{{ url('/joborder/store')}}" method="POST">
    @csrf
    <p>
        <label for="">Title</label>
        <input type="text" name="title">
    </p>

    <p>
        <label for="">Description</label>
        <input type="text" name="description">
    </p>
    <p>
        <label for="content_writer_id">Content Writer</label>
        <select name="content_writer_id" id="content_writer_id">
            <option value="">Select Content Writer</option>
            @foreach ($content_writers as $content_writer)
                <option value="{{ $content_writer->id }}">{{ $content_writer->name }}</option>
            @endforeach
        </select>
    </p>
    
    <p>
        <label for="graphic_designer_id">Graphic Designer</label>
        <select name="graphic_designer_id" id="graphic_designer_id">
            <option value="">Select a Graphic Designer</option>
            @foreach ($graphic_designers as $graphic_designer)
                <option value="{{ $graphic_designer->id }}">{{ $graphic_designer->name }}</option>
            @endforeach
        </select>
    </p>
    
    <p>
        <label for="client_id">Client</label>
        <select name="client_id" id="client_id">
            <option value="">Select a Client</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
    </p>

    <p>
        <label for="date_started">Date Started</label>
        <input type="date" name="date_started">
    </p>
    <p>
        <label for="date_target">Date Target</label>
        <input type="date" name="date_target">
    </p>

    
    <button type="submit">Create Job Order</button>
    <a href="{{url('/joborder')}}">Go back</a>
</form>