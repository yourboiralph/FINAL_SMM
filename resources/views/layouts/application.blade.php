<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FINAL SMM</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto max-w-screen-2xl">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div id="sidebar"
                class="sticky top-0 left-0 w-1/4 bg-white shadow-md h-screen flex flex-col">
                <div class="p-6 flex items-center justify-between">
                    <img class="w-48 sm:w-48 lg:w-64" src="/Assets/logo.png" draggable="false" alt="">
                    <i id="toggleButton" class="text-2xl cursor-pointer fa-solid fa-bars"></i>
                </div>
                <hr class="hidden md:block md:border md:border-[#EC690F] mb-10">
                <x-sidebar />
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <div class="h-24">
                    <x-navbar :header="View::yieldContent('header')" />
                </div>
                <div class="mt-5 flex-1 overflow-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>


</html>