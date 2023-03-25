<div class="card rounded-5 mb-0 shadow-lg" style="flex: 2;max-height: 80vh; overflow-y: auto;">
    <div class="card-header bg-transparent text-kyoodark border-bottom border-5">
        <h4 class="fw-bold mb-0 text-center">Serving Stats</h4>
    </div>
    <div class="card-body py-3" style="max-height: 80vh; overflow-y: auto;">
        <div class="d-flex flex-column justify-content-center gap-1 gap-md-2 gap-lg-3">
            <div class="col">
                <div class="card bg-kyoogreen text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Completed Tickets</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">{{ $countCompletedTickets }}</div>
                            <div class="text-end">
                                <p class="card-text mb-0">All services</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-kyoored text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Cancelled Tickets</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-times"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">{{ $countCancelledTickets }}</div>
                            <div class="text-end">
                                <p class="card-text mb-0">All services</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-kyooyellow text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Avg. Service Time</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">
                                @if ($avgServingTime)
                                    {{ $avgServingTime < 60 ? gmdate('s', $avgServingTime) . ' sec' : gmdate('i', $avgServingTime) . ' min' }}
                                @else
                                    0 sec
                                @endif
                            </div>
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">Last 30 tickets</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-kyoodarkblue text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Avg. Wait Time</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-hourglass"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="h1 mb-0">
                                @if ($avgWaitTime)
                                    {{ $avgWaitTime < 60 ? gmdate('s', $avgWaitTime) . ' sec' : gmdate('i', $avgWaitTime) . ' min' }}
                                @else
                                    0 sec
                                @endif
                            </div>
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">Last 30 tickets</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
