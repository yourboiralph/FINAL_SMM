<div {{ $attributes->merge(['class' => 'fixed inset-0 flex items-center justify-center z-50 hidden']) }}>
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <!-- Modal Content -->
    <div class="bg-white p-6 rounded z-10 max-w-md mx-auto">
        @if(Auth::user()->signature)
            <h1 class="text-xl font-bold mb-4">This is your saved signature</h1>
            <div class="mb-4">
                <img src="{{ asset(Auth::user()->signature) }}" alt="Saved Signature" class="max-w-full">
            </div>
        @else
            <h1 class="text-xl font-bold mb-4">Add a Signature</h1>
            <p class="mb-4">No signature found. Please create your signature below.</p>
            <!-- New Signature Pad -->
            <div id="newSignaturePadContainer">
                <canvas id="new-signature-pad" class="w-full" style="height:200px; border: 2px solid #000; background-color:#fff;"></canvas>
                <button id="saveNewSignature" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Save and Use Signature</button>
            </div>
        @endif
        <button id="closeSignatureModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
            Close
        </button>
    </div>
</div>
