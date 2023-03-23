{{-- Page Title --}}
@section('mytitle', 'Live Queue')

{{-- Main Content --}}
<x-layout>

    <!-- Header Navbar -->
    <header id="header" class="header d-flex align-items-center bg-kyoodark">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/images/kyoo-logo.png') }}" alt="Kyoo Logo" class="img-fluid" />
                <span class="d-none d-lg-block">Queueing Management System</span>
            </a>
        </div>
        <nav class="header-nav ms-auto d-none d-md-block">
            <ul id="datetimefield" class="d-flex align-items-center pe-3 text-center text-white">
                <li class="nav-item pe-3 text-center">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span class="fw-normal date">
                    </span>
                </li>
                <li class="nav-item">
                    <i class="fa-regular fa-clock"></i>
                    <span class="fw-normal time">
                    </span>
                </li>
            </ul>
        </nav>
    </header>
    <!-- /Header Navbar -->

    <!-- Main Content -->
    <main class="h-100 px-2 py-3">
        <section class="section">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 align-items-center">
                    <div class="col {{ count($ticket_data['departments']) > 4 ? 'col-lg-4' : 'col-lg-5' }} mb-4">
                        <div
                            class="row {{ count($ticket_data['departments']) > 4 ? 'row-cols-xl-2 row-cols-lg-1' : 'row-cols-1 row-cols-lg-2 row-cols-xl-1' }}">
                            @foreach ($ticket_data['departments'] as $department_data)
                                <x-current-serving-card :department="$department_data" />
                            @endforeach
                        </div>
                    </div>
                    {{-- <button class="btn btn-kyoored" id="testButton">TTS Test Button</button> --}}
                    <div
                        class="col {{ count($ticket_data['departments']) > 4 ? 'col-lg-8' : 'col-lg-7' }} d-none d-lg-block h-100">
                        <div class="flex-grow-1 col-auto" style="max-width: 100%;">
                            @php
                                $active_videos = \App\Models\PromotionalVideo::where('is_active', true)->get();
                            @endphp
                            @if ($active_videos->count() > 0)
                                <video class="video" id="loop_video"
                                    style="object-fit: fill; width: 100%; height: calc(100vh - 10%);" autoplay
                                    muted></video>
                                <script>
                                    const activeVideos = @json($active_videos);
                                    const videoElement = document.getElementById('loop_video');
                                    let videoIndex = 0;

                                    function playNextVideo() {
                                        if (videoIndex >= activeVideos.length) {
                                            videoIndex = 0;
                                        }

                                        const videoSrc = '{{ asset('storage/promotional_videos/') }}/' + activeVideos[videoIndex].filename;
                                        videoElement.src = videoSrc;
                                        videoIndex++;

                                        videoElement.play().catch(error => {
                                            console.log(error);
                                            playNextVideo();
                                        });
                                    }

                                    videoElement.addEventListener('ended', () => {
                                        playNextVideo();
                                    });

                                    // Start playing the first video
                                    playNextVideo();
                                </script>
                                <style>
                                    @media (max-width: 991px) {
                                        #loop_video {
                                            display: none;
                                        }
                                    }
                                </style>
                            @else
                                <div class="card border py-5 shadow-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h1 class="text-danger fw-light mb-0">
                                            No active promotional video found.
                                        </h1>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    <!-- Marquee Text  -->
    <div class="d-none d-lg-block fixed-bottom">
        <div class="bg-kyoodark py-2 text-white">
            <div class="row justify-content-center">
                <marquee behavior="scroll" direction="left" class="fw-normal" scrollamount="3%">
                    <span class="d-inline-block text-truncate" style="max-width: 90vw;">
                        {{ $promotional_message[0]->text ?? '' }}
                    </span>
                </marquee>
            </div>
        </div>
    </div>
    <!-- /Marquee Text  -->

    {{-- Text To Speech JS --}}
    <script src="{{ asset('assets/js/textToSpeech.js') }}"></script>

</x-layout>
