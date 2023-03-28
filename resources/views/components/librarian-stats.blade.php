<div class="card rounded-5 mb-0 shadow-lg" style="flex: 2;max-height: 80vh; overflow-y: auto;">
    <div class="card-header bg-transparent text-kyoodark border-bottom border-5">
        <h4 class="fw-bold mb-0 text-center">Clearance Stats</h4>
    </div>
    <div class="card-body py-3" style="max-height: 80vh; overflow-y: auto;">
        <div class="d-flex flex-column justify-content-center gap-1 gap-md-2 gap-lg-3">
            <div class="col">
                <div class="card bg-kyoodarkblue text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Total Number of Clearances</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-file-circle-check text-white"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0 border-white">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            @if ($departmentId == 3)
                                <div class="h1 mb-0">{{ $countSignedClearances['signedCollegeCount'] }}</div>
                            @elseif($departmentId == 4)
                                <div class="h1 mb-0">{{ $countSignedClearances['signedHSCount'] }}</div>
                            @else
                                <div class="h1 mb-0">Error</div>
                            @endif
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">All time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Cleared Clearances</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0 border-white">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            @if ($departmentId == 3)
                                <div class="h1 mb-0">{{ $countClearedClearances['clearedCollegeCount'] }}</div>
                            @elseif($departmentId == 4)
                                <div class="h1 mb-0">{{ $countClearedClearances['clearedHSCount'] }}</div>
                            @else
                                <div class="h1 mb-0">Error</div>
                            @endif
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">All time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-kyoored text-white rounded-5 shadow-lg mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0">Uncleared Clearances</h5>
                            <div class="card-icon d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        </div>
                        <hr class="border border-1 my-0 border-white">
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            @if ($departmentId == 3)
                                <div class="h1 mb-0">{{ $countUnclearedClearances['unclearedCollegeCount'] }}</div>
                            @elseif($departmentId == 4)
                                <div class="h1 mb-0">{{ $countUnclearedClearances['unclearedHSCount'] }}</div>
                            @else
                                <div class="h1 mb-0">Error</div>
                            @endif
                            <div class="ms-1 text-end">
                                <p class="card-text mb-0">All time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <
