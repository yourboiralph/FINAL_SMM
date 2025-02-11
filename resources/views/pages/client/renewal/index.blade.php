@foreach ($job_orders as $job_order)
    <p>{{ $job_order->title }} 
        <input type="checkbox" name="renewable[]" value="{{ $job_order->id }}" onclick="handleClick(this)">
    </p>
@endforeach

<script>
    function handleClick(checkbox) {
        if (checkbox.checked) {
            let jobOrderId = checkbox.value;
            window.location.href = "{{ url('/client/update') }}/" + jobOrderId;
        }
    }
</script>
