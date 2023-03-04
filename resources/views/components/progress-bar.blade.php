<div class="col-12">
    <div class="progress">
        <div class="progress-bar bg-kyoored" role="progressbar" style="width: {{ $progress }}%;"
            aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="d-flex justify-content-around mt-3">
        <div class="{{ $progress >= 25 ? 'text-kyoored fw-bold' : 'text-muted' }}">1</div>
        <div class="{{ $progress >= 50 ? 'text-kyoored fw-bold' : 'text-muted' }}">2</div>
        <div class="{{ $progress >= 75 ? 'text-kyoored fw-bold' : 'text-muted' }}">3</div>
        <div class="{{ $progress == 100 ? 'text-kyoored fw-bold' : 'text-muted' }}">4</div>
    </div>
</div>
