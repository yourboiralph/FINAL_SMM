@extends('layouts.application')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="mx-auto max-w-screen-2xl">

    @if (session('Status'))
    <div id="toast" class="fixed top-4 right-4 z-50">
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-md shadow-lg">
            {{ session('Status') }}
        </div>
    </div>
    @endif

    <div class="h-auto">
        <div class="px-10 text-white">
            <div class="w-full flex justify-end items-end mb-4 cursor-pointer" onclick="window.location.assign('{{ url('profile/show') }}')">
                <div class="w-fit px-4 py-1 bg-[#f68e12] rounded-md">Go Back</div>
            </div>

            <form action="{{ url('profile/update/') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-3 h-auto gap-6 text-black">
                    <div class="space-y-10">
                        <div class="col-span-3 px-4 lg:col-span-1 h-fit pb-10 bg-white shadow-md rounded-md pt-10 border border-[#e1e1e1]">
                            <div class="w-full flex justify-center items-center">
                                <img id="profileImage" class="rounded-full w-32 h-32 object-cover" 
                                    src="{{ $user->image ? asset($user->image) : asset('/Assets/user-profile-profilepage.png') }}" 
                                    alt="Profile Picture">
                            </div>
                            <div class="text-center">
                                <h1>{{ $user->name }}</h1>
                                <h1>{{ $user->address }}</h1>
                            </div>
    
                            <div class="flex items-center justify-center gap-2 text-white mt-4">
                                <div id="changeProfileBtn" class="px-4 py-1 bg-[#fa7011] rounded-md cursor-pointer text-nowrap text-sm">Change Profile</div>
                                {{-- <div id="removeProfileBtn" class="px-4 py-1 bg-red-500 rounded-md cursor-pointer text-nowrap text-sm">Remove Profile</div> --}}
                            </div>
                            <input type="file" name="image" id="profileImageInput" accept="image/*" class="hidden">
                        </div>
    
                        <div class="px-10 col-span-3 w-full lg:col-span-3 bg-white shadow-md rounded-md pt-10 py-10">
                            <div class="w-full h-full flex justify-center items-center border-2 border-gray-300">
                                {{-- <img class="rounded-full w-32 h-32 object-cover"
                                    src="{{ file_exists(public_path($user->image)) && $user->image ? asset($user->image) : asset('/Assets/user-profile-profilepage.png') }}"
                                    alt="User Image"> --}}
                                @if ($user->signature)
                                    <img class="object-fill w-full"
                                    src="{{asset($user->signature)}}"
                                    alt="User Image">

                                @else
                                    <p>No Signature Saved</p>
                                @endif
                            </div>
                            <div class="text-center w-full flex items-center justify-center">
                                <h1 class="text-[#fa7011] font-bold">Signature</h1>
                            </div>
                            <div class="flex items-center justify-center gap-2 text-white">
                                <div id="changeSignatureBtn" class="px-4 py-1 bg-[#fa7011] rounded-md cursor-pointer text-nowrap text-sm">Change Signature</div>
                            </div>
                            <input type="file" name="image" id="signatureImageInput" accept="image/*" class="hidden">
                        </div>
                    </div>

                    <div class="col-span-3 lg:col-span-2 bg-white shadow-md h-fit rounded-md p-5 border border-[#e1e1e1]">
                        <div class="text-slate-500">
                            <h1 class="text-sm">User Information</h1>
                        </div>

                        <div class="space-y-2">
                            <div class="gap-4 items-center">
                                <h1 class="text-slate-500 font-bold">Name</h1>
                                <input class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]" 
                                    value="{{ old('name', $user->name) }}" name="name" required>
                                @error('name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                            </div>

                            <div class="gap-4 items-center">
                                <h1 class="text-slate-500 font-bold">Email</h1>
                                <input class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]" 
                                    value="{{ old('email', $user->email) }}" name="email" required>
                                @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                            </div>

                            <div class="gap-4 items-center">
                                <h1 class="text-slate-500 font-bold">Phone</h1>
                                <input class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]" 
                                    value="{{ old('phone', $user->phone) }}" name="phone" required>
                                @error('phone') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                            </div>

                            <div class="gap-4 items-center pb-4">
                                <h1 class="text-slate-500 font-bold">Address</h1>
                                <input class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]" 
                                    value="{{ old('address', $user->address) }}" name="address" required>
                                @error('address') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="text-slate-500">
                            <h1 class="text-sm">Password</h1>
                        </div>
                        <div class="gap-4 items-center">
                            <h1 class="text-slate-500 font-bold">New Password</h1>
                            <input type="password" name="password" class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]">
                            @error('password') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                        </div>
                        <div class="gap-4 items-center">
                            <h1 class="text-slate-500 font-bold">Confirm Password</h1>
                            <input type="password" name="password_confirmation" class="pl-4 w-full border rounded-md py-1 border-[#e1e1e1]">
                            @error('password_confirmation') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="pt-4">
                            <button type="submit" class="px-4 py-1 bg-[#f68e12] w-fit cursor-pointer text-white">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- Include the signature modal (hidden by default) --}}
    <x-signature id="signatureModal" class="hidden" />

<script>
    // Function to display toast notifications
    function showToast(message, type = 'success') {
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'fixed top-20 right-4 z-50 space-y-2';
            document.body.appendChild(toastContainer);
        }
        let toast = document.createElement('div');
        toast.className = 'p-4 rounded shadow-lg text-white ' + (type === 'error' ? 'bg-red-500' : 'bg-green-500');
        toast.innerText = message;
        toastContainer.appendChild(toast);
        // Auto-remove toast after 3 seconds
        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s';
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    }

    // Auto-hide the session toast (if present) after 3 seconds
    setTimeout(function() {
        var toast = document.getElementById('toast');
        if (toast) {
            toast.style.transition = "opacity 0.5s";
            toast.style.opacity = "0";
            setTimeout(() => toast.style.display = "none", 500);
        }
    }, 3000);

    // Trigger file input when "Change Profile" is clicked
    document.getElementById("changeProfileBtn").addEventListener("click", function() {
        document.getElementById("profileImageInput").click();
    });

    // Trigger file input when "Change Signature" is clicked
    document.getElementById("changeSignatureBtn").addEventListener("click", function () {
        document.getElementById("signatureModal").classList.remove("hidden");
    });
    

    // Preview the selected signature image and validate its file size
    document.getElementById("signatureImageInput").addEventListener("change", function(event) {
        let file = event.target.files[0];
        const maxFileSize = 2097152; // 2MB in bytes
        if (file) {
            if (file.size > maxFileSize) {
                showToast("File size is too big. Maximum allowed is 2MB.", "error");
                // Clear the file input
                document.getElementById("signatureImageInput").value = "";
                return;
            }
            let reader = new FileReader();
            reader.onload = function(e) {
                const signatureImage = document.querySelector('.w-full.object-fill');
                if (signatureImage) {
                    signatureImage.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    });


    // Preview the selected image and validate its file size
    document.getElementById("profileImageInput").addEventListener("change", function(event) {
        let file = event.target.files[0];
        const maxFileSize = 2097152; // 2MB in bytes
        if (file) {
            if (file.size > maxFileSize) {
                showToast("File size is too big. Maximum allowed is 2MB.", "error");
                // Clear the file input
                document.getElementById("profileImageInput").value = "";
                return;
            }
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("profileImage").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove profile image and reset to default when "Remove Profile" is clicked
    document.getElementById("removeProfileBtn").addEventListener("click", function() {
        document.getElementById("profileImageInput").value = "";
        document.getElementById("profileImage").src = "{{ asset('/Assets/user-profile-profilepage.png') }}";
    });
</script>
@endsection
