@props(['selectedServices'])

<div class="row fixed-bottom mb-3 ms-1">
    <div class="col text-start">
        @if (empty($selectedServices))
            <button id="go-back" class="btn btn-kyoodark btn-lg">
                <i class="fa-solid fa-chevron-left"></i>
                Back
            </button>
        @else
            <a href="{{ route('transaction-summary') }}" class="btn btn-kyoodark btn-lg">
                <i class="fa-solid fa-chevron-left"></i> Return to Transaction Summary
            </a>
        @endif
    </div>
</div>
