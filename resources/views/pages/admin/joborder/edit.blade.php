this is the edit blade

<form action="{{ url('/joborder/update/' . $job_order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        <label for="">Title</label>
        <input type="text" name="title" value="{{$job_order->title}}">
    </p>

    <p>
        <label for="">Description</label>
        <input type="text" name="description" value="{{$job_order->description}}">
    </p>
    <p>
        <label for="content_writer_id">Content Writer</label>
        <select name="content_writer_id" id="content_writer_id">
            <option value="">Select Content Writer</option>
            @foreach ($content_writers as $content_writer)
                <option value="{{ $content_writer->id }}" 
                    {{ $content_writer->id == $job_order->content_writer_id ? 'selected' : '' }}>
                    {{ $content_writer->name }}
                </option>
            @endforeach
        </select>
    </p>
    
    <p>
        <label for="graphic_designer_id">Graphic Designer</label>
        <select name="graphic_designer_id" id="graphic_designer_id">
            <option value="">Select a Graphic Designer</option>
            @foreach ($graphic_designers as $graphic_designer)
                <option value="{{ $graphic_designer->id }}" 
                    {{ $graphic_designer->id == $job_order->graphic_designer_id ? 'selected' : '' }}>
                    {{ $graphic_designer->name }}
                </option>
            @endforeach
        </select>
    </p>
    
    <p>
        <label for="client_id">Client</label>
        <select name="client_id" id="client_id">
            <option value="">Select a Client</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" 
                    {{ $client->id == $job_order->client_id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>
    </p>
    <p>
        <label for="date_started">Date Started</label>
        <input type="date" name="date_started" 
        value="{{ \Carbon\Carbon::parse($job_order->latest_job_draft->date_started)->format('Y-m-d') }}"
        >
    </p>
    
    <p>
        <label for="date_target">Date Target</label>
        <input type="date" name="date_target" 
        value="{{ \Carbon\Carbon::parse($job_order->latest_job_draft->date_target)->format('Y-m-d') }}">
    </p>
    
    <button type="submit">Update</button>
    <a href="{{url('/joborder')}}">Back</a>
</form>