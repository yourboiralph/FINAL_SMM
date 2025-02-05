<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FINAL SMM</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="grid grid-cols-12 h-screen">
        <div id="sidebar" class="sticky top-0 left-0 w-full col-span-12 shadow-md z-20 md:h-screen bg-white md:col-span-3 transition-all duration-300">
            <div class="grid grid-cols-6 p-6 w-full gap-4 items-center md:flex md:flex-row-reverse md:justify-end">
                <img class="col-span-4 w-full max-w-full sm:w-48 lg:w-64" src="/Assets/logo.png" draggable="false" alt="">
                <i id="toggleButton" class="col-span-2 text-end fa-solid fa-bars text-2xl cursor-pointer"></i>
            </div>            
            <hr class="hidden md:block md:border md:border-[#EC690F] mb-10">
            <x-sidebar />
        </div>
        <div class="col-span-12 md:col-span-9">
            <div class="h-24">
                <x-navbar :header="View::yieldContent('header')" />
            </div>
            <div class="mt-5">@yield('content')</div>
        </div>
    </div>
</body>
</html>