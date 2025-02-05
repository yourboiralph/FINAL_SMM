<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto p-6">
    <a class="bg-cyan-700 text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition" href="{{ url('joborder/create') }}">
        Create New Job Order
    </a>

    <div class="mt-10 space-y-4">
        @foreach ($job_orders as $job_order)
            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow">
                <div class="text-lg font-semibold">{{ $job_order->title }}</div>
                <div class="space-x-2">
                    <a class="text-blue-600 hover:underline" href="{{ url('/joborder/show/' . $job_order->id) }}">Show</a>
                    <a class="text-yellow-600 hover:underline" href="{{ url('/joborder/edit/' . $job_order->id) }}">Edit</a>
                    <a class="text-red-600 hover:underline" href="{{ url('/joborder/delete/' . $job_order->id) }}">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
