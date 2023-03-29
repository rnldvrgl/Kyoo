<div class="col" data-aos="fade-right" data-aos-delay="50">
    <form method="POST" action="{{ route('select-transaction') }}">
        @csrf
        <input type="hidden" name="department_id" value="{{ $department->id }}">
        <button type="submit" class="card h-100 w-100 text-kyoodark link-card kiosk-card rounded-5"
            id="select-department">
            <div class="card-body p-5">
                <span class="display-6 fw-bold mb-3">
                    {{ $department->name }}
                </span>
                <p class="card-text my-3">
                    {{ $department->description }}
                </p>
            </div>
        </button>
    </form>
</div>
