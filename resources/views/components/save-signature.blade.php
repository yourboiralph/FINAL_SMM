<!-- saved-signature-modal.blade.php -->
<div id="savedSignatureModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Saved Signature</h3>
            <button id="closeSignatureModal" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="flex justify-center mb-4">
            <img id="savedSignatureImage" class="w-full max-h-40 object-contain" 
                src="{{ Auth::user()->signature ? asset(Auth::user()->signature) : '/images/no-signature.png' }}" 
                alt="Your Saved Signature">
        </div>
        
        <div class="text-center mb-4">
            @if(Auth::user()->signature)
                <p class="text-sm text-gray-600">You can use this saved signature or upload a new one.</p>
            @else
                <p class="text-sm text-gray-600">You don't have a saved signature yet. Please upload one.</p>
            @endif
        </div>
        
        <div class="flex flex-col space-y-3">
            @if(Auth::user()->signature)
                <button id="useThisSignature" class="px-4 py-2 bg-[#fa7011] text-white rounded hover:bg-[#d95f0a] transition duration-200">
                    Use This Signature
                </button>
            @endif
            
            <form id="uploadSignatureForm" action="{{ route('user.signature.save') }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-3">
                @csrf
                <div class="border rounded p-2">
                    <input type="file" name="signature" accept="image/*" class="w-full" id="modalSignatureInput">
                </div>
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-200">
                    {{ Auth::user()->signature ? 'Upload New Signature' : 'Upload Signature' }}
                </button>
            </form>
        </div>
    </div>
</div>


<script>
// Add this to your JavaScript file or in a script tag
document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const savedSignatureModal = document.getElementById('savedSignatureModal');
    const closeSignatureModal = document.getElementById('closeSignatureModal');
    const useThisSignature = document.getElementById('useThisSignature');
    const useSavedSignatureBtn = document.getElementById('useSavedSignature');
    const savedSignatureData = document.getElementById('savedSignatureData');
    const savedPadSection = document.getElementById('savedPadSection');
    const modalSignatureInput = document.getElementById('modalSignatureInput');
    
    // Open modal when clicking the saved signature button
    if (useSavedSignatureBtn) {
        useSavedSignatureBtn.addEventListener('click', function() {
            savedSignatureModal.classList.remove('hidden');
        });
    }
    
    // Close modal
    if (closeSignatureModal) {
        closeSignatureModal.addEventListener('click', function() {
            savedSignatureModal.classList.add('hidden');
        });
    }
    
    // Use the saved signature
    if (useThisSignature) {
        useThisSignature.addEventListener('click', function() {
            const signaturePath = document.getElementById('savedSignatureImage').src;
            if (signaturePath) {
                // Update the hidden input with the signature path
                if (savedSignatureData) {
                    savedSignatureData.value = signaturePath;
                }
                
                // Show the saved signature section and hide others
                toggleSection('saved');
                
                // Close the modal
                savedSignatureModal.classList.add('hidden');
            }
        });
    }
    
    // Preview uploaded signature in the modal
    if (modalSignatureInput) {
        modalSignatureInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('savedSignatureImage');
            
            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Handle upload signature form submission (using AJAX)
    const uploadSignatureForm = document.getElementById('uploadSignatureForm');
    if (uploadSignatureForm) {
        uploadSignatureForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the signature image
                    const savedSignatureImage = document.getElementById('savedSignatureImage');
                    savedSignatureImage.src = data.signature_url;
                    
                    // Update the hidden input
                    if (savedSignatureData) {
                        savedSignatureData.value = data.signature_url;
                    }
                    
                    // Show the success button if it was hidden
                    if (useThisSignature) {
                        useThisSignature.classList.remove('hidden');
                    }
                    
                    // Show a success message
                    alert('Signature uploaded successfully!');
                    
                    // Auto-use the new signature
                    toggleSection('saved');
                    savedSignatureModal.classList.add('hidden');
                } else {
                    alert(data.message || 'Error uploading signature.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the signature.');
            });
        });
    }
});
</script>