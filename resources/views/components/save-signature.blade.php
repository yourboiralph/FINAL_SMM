<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<div id="signatureModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <!-- Modal Content -->
    <div class="bg-white p-6 rounded z-10 max-w-md mx-auto">
        <h1 class="text-xl font-bold mb-4">Add a Signature</h1>
        <p class="mb-4">No signature found. Please create your signature below.</p>
        
        <!-- New Signature Pad -->
        <div id="newSignaturePadContainer">
            <canvas id="new-signature-pad" class="w-full border border-gray-400" style="height:200px;"></canvas>
            <!-- Hidden input to store the signature data -->
            <input type="hidden" name="new_signature_pad" id="savedSignaturePadData" value="">
            <button type="submit" id="saveNewSignature" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">
                Save and Use Signature
            </button>
        </div>
        
        <!-- Close Modal Button -->
        <button type="button" id="closeSignatureModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
            Close
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('signatureModal');
    // Immediately show the modal
    modal.classList.remove('hidden');

    const canvas = document.getElementById('new-signature-pad');
    const signaturePad = new SignaturePad(canvas);
    const saveButton = document.getElementById('saveNewSignature');
    const closeButton = document.getElementById('closeSignatureModal');
    const hiddenInput = document.getElementById('savedSignaturePadData');

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 200 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }

    // Delay resize to ensure the modal is rendered
    setTimeout(resizeCanvas, 100);
    
    saveButton.addEventListener('click', function(e) {
        if(signaturePad.isEmpty()){
            alert("Please provide a signature first.");
            e.preventDefault();
        } else {
            hiddenInput.value = signaturePad.toDataURL("image/png");
            modal.classList.add('hidden');
        }
    });

    closeButton.addEventListener('click', function(){
        modal.classList.add('hidden');
    });

    window.addEventListener('resize', resizeCanvas);
});
</script>
