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
    {{-- {{ dd($tickets_data) }} --}}
    <main class="h-100 px-2 py-3">
        <section class="section">
            <div class="container-fluid h-100">
                <div class="row row-cols-1 row-cols-lg-2 align-items-start h-100">
                    <div class="col-lg-6 mb-4">
                        <div class="col h-100">
                            <div class="card rounded-5 h-100">
                                <div class="card-body pb-0 h-100">
                                    <div class="table-responsive pt-3 h-100">
                                        <table class="table table-pastel-mint table-hover text-start h-100">
                                            <tbody id="tickets-table" class="h-100">
                                                <!-- Add tickets dynamically using JavaScript -->
                                                @php
                                                    $sorted_tickets = $tickets_data->sortBy(function ($ticket_data) {
                                                        if ($ticket_data['status'] === 'Calling' || $ticket_data['status'] === 'Serving') {
                                                            return 0;
                                                        }
                                                        return 1;
                                                    });
                                                    
                                                    $tickets_data = $sorted_tickets->take(13)->toArray();
                                                    $waiting_tickets = $sorted_tickets
                                                        ->slice(13)
                                                        ->take(6)
                                                        ->toArray();
                                                @endphp
                                                {{-- {{ dd($tickets_data) }} --}}
                                                @foreach ($tickets_data as $ticket_data)
                                                    <x-live-tickets
                                                        departmentName="{{ $ticket_data['service_department']['name'] }}"
                                                        ticketNumber="{{ $ticket_data['ticket_number'] }}"
                                                        ticketStatus="{{ $ticket_data['status'] }}" />
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 d-none d-lg-block h-100">
                        <div class="flex-grow-1 col-auto h-100" style="max-width: 100%; ">
                            @php
                                $active_videos = \App\Models\PromotionalVideo::where('is_active', true)->get();
                            @endphp
                            @if ($active_videos->count() > 0)
                                <video class="video rounded-5 border border-3" id="loop_video"
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
                        <div class="col h-100" style="max-width: 100%; max-height: 50vh;">
                            <div class="card rounded-5 h-100" style="max-width: 100%; max-height: 50vh;">
                                <div class="card-body pb-0 h-100" style="max-width: 100%; max-height: 50vh;">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <h6 class="card-title pt-3 pb-2">Pending Tickets</h6>
                                            <tbody>
                                                @foreach ($waiting_tickets as $waiting_ticket)
                                                    <div class="card shadow-none mb-2 py-2 rounded-5 {{ $waiting_ticket['status'] == 'Calling' ? 'flicker bg-pastel-blue' : '' }} border"
                                                        data-aos="slide-right">
                                                        <div class="card-body pb-0">
                                                            <div class="row">
                                                                <div
                                                                    class="col d-flex justify-content-start align-items-center">
                                                                    <h6 class="mb-0 fw-semibold ">
                                                                        {{ $waiting_ticket['service_department']['name'] }}
                                                                    </h6>
                                                                </div>
                                                                <div
                                                                    class="col d-flex justify-content-start align-items-center">
                                                                    <h6
                                                                        class="text-kyoodark fw-bold mb-0 {{ $waiting_ticket['status'] == 'Calling' ? 'flicker' : '' }}">
                                                                        {{ $waiting_ticket['ticket_number'] }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                <marquee behavior="scroll" direction="left" class="fw-normal" scrollamount="6%">
                    <span class="d-inline-block text-truncate promotional-text" style="max-width: 90vw;">
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
