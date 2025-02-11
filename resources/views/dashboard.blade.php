@extends('layouts.application')

@section('title', 'Page Title')
@section('header', "Dashboard") 

<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

@section('content')
<div class="container mx-auto p-6 max-w-screen-xl overflow-hidden">
    <div>
        <div class="grid grid-cols-1 md:grid md:grid-cols-3 md:px-2 mx-auto">
            <div class="col-span-1 md:col-span-2">
                <img class="" src="/Assets/Banner.png" alt="" draggable="false">
                <h1 class="mx-6">Documents</h1>
                <div class="px-6">
                    <div class="w-full p-4 bg-white rounded-lg shadow-md">
                        <table class="table-auto gap-8 text-left border-collapse w-full">
                            <thead class="text-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-sm font-semibold">Project Development</th>
                                    <th class="px-4 py-2 text-sm font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_drafts as $job_draft )
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{$job_draft->jobOrder->title}}</td>
                                        @if ($job_draft->signature_admin)
                                            <td class="px-4 py-2 text-sm flex items-center gap-8">
                                                Signed
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </td>
                                        @else
                                            @if ($job_draft->status == "pending")
                                                <td class="px-4 py-2 text-sm text-gray-500 cursor-not-allowed">Sign Now</td>
                                            @else
                                            <td class="px-4 py-2 text-sm text-orange-500 cursor-pointer">
                                                <a href="{{ url('/operation/show/' . $job_draft->id) }}" class="text-orange-500">Sign Now</a>
                                            </td>                                            
                                            @endif
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mt-10 w-full flex flex-col justify-center items-center shadow-lg">
                    <div class="w-full h-full">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/QF-HFO7Uop0?si=APB2sG6Xrdm-C-ct"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="h-20 w-full bg-white flex items-center justify-center gap-8">
                        <i class="fa-brands fa-facebook-f px-3 py-2 rounded-full bg-[#fa7011]"
                            style="color: #ffffff;"></i>
                        <i class="fa-brands fa-instagram px-3 py-2 rounded-full bg-[#fa7011]"
                            style="color: #ffffff;"></i>
                        <i class="fa-brands fa-pinterest-p px-3 py-2 rounded-full bg-[#fa7011]"
                            style="color: #ffffff;"></i>
                    </div>
                </div>
            </div>
            {{-- Bottom Part --}}
            <div class="max-w-screen-xl pt-10">
                <div class="carousel">
                    <div class="carousel-track flex">
                        <a href="https://link1.com" class="carousel-item">
                            <img src="/Assets/ads1.png" alt="Image 1" draggable="false">
                        </a>
                        <a href="https://link2.com" class="carousel-item">
                            <img src="/Assets/ads2.png" alt="Image 2" draggable="false">
                        </a>
                        <a href="https://link3.com" class="carousel-item">
                            <img src="/Assets/ads3.png" alt="Image 3" draggable="false">
                        </a>
                        <a href="https://link4.com" class="carousel-item">
                            <img src="/Assets/ads4.png" alt="Image 4" draggable="false">
                        </a>
                        <a href="https://link1.com" class="carousel-item">
                            <img src="/Assets/ads1.png" alt="Image 1" draggable="false">
                        </a>
                        <a href="https://link2.com" class="carousel-item">
                            <img src="/Assets/ads2.png" alt="Image 2" draggable="false">
                        </a>
                        <a href="https://link3.com" class="carousel-item">
                            <img src="/Assets/ads3.png" alt="Image 3" draggable="false">
                        </a>
                        <a href="https://link4.com" class="carousel-item">
                            <img src="/Assets/ads4.png" alt="Image 4" draggable="false">
                        </a>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

<style>
    .carousel {
        @apply relative overflow-hidden w-full mx-auto;
    }
    
    .carousel-track {
        @apply flex gap-0;
        width: calc(8 * 24rem); /* Increase width */
        animation: scroll 60s linear infinite;
    }
    
    .carousel-item {
        @apply flex-shrink-0 w-[400px]; /* Increase width */
    }
    
    .carousel-item img {
        @apply object-cover w-full h-[300px]; /* Increase height */
    }
    
    /* Keyframes for infinite scroll */
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
    
        100% {
            transform: translateX(-100%);
        }
    }
    
    </style>
    
    <script>
        // Get the carousel track
        const carouselTrack = document.querySelector('.carousel-track');
    
        // Duplicate images logic
        const items = [...carouselTrack.children];
        const firstSetWidth = items.length / 2 * items[0].offsetWidth;
    
        // Reset scroll on animation end
        carouselTrack.addEventListener('animationiteration', () => {
            carouselTrack.style.transform = 'translateX(0)';
        });
    
        // Restart animation
        carouselTrack.style.animation = 'none';
        setTimeout(() => {
            carouselTrack.style.animation = '';
        }, 10);
    </script>
