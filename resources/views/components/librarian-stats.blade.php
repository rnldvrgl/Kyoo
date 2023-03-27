<div class="card rounded-5 mb-0 shadow-lg" style="flex: 2;max-height: 80vh; overflow-y: auto;">
    <div class="card-header bg-transparent text-kyoodark border-bottom border-5">
        <h4 class="fw-bold mb-0 text-center">Clearance Stats</h4>
    </div>
    <div class="card-body py-3" style="max-height: 80vh; overflow-y: auto;">
        <div class="d-flex flex-column justify-content-center gap-1 gap-md-2 gap-lg-3">
            <div class="col">
                <div class="card bg-pastel-mint text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Total Number of Clearances</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-file-check"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">1</div>
                            {{-- <div class="h1 mb-0">{{ $total_clearances }}</div> --}}
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">All time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-pastel-red text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Average Time to Clear Item</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-clock-check"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">30 sec</div>
                            {{-- <div class="h1 mb-0">{{ $avg_clearance_time }} sec</div> --}}
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">Last 30 items</p>
                                {{-- <p class="card-text mb-0">Last {{ $clearance_time_period }} items</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-pastel-purple text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Average Wait Time to Get Cleared</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-hourglass-check"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">25 sec</div>
                            {{-- <div class="h1 mb-0">{{ $avg_wait_time }} sec</div> --}}
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">Last 30 tickets</p>
                                {{-- <p class="card-text mb-0">Last {{ $wait_time_period }} tickets</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <
