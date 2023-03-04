<div class="col" data-aos="fade-right" data-aos-delay="50">
    <a href="{{ route('select-transaction', ['department_id' => $department->id]) }}"
        class="card h-100 text-kyoodark link-card" id="select-department">
        <div class="card-body p-5">
            <span class="display-6 fw-bold mb-3">
                {{ $department->name }}
            </span>
            <p class="card-text my-3">
                {{ $department->description }}
            </p>
        </div>
    </a>
</div>
