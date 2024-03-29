{{-- Page Title --}}
@section('mytitle', 'Select Department')


<x-layout>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    {{-- Progress Bar --}}
    <div class="container px-3 pt-5">
        <div class="row mb-3">
            <x-progress-bar :progress="25" />
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column px-5 py-4">
        {{-- Select Department Heading --}}
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Department</h1>
                <p>Select a department where you will be served.</p>
            </div>
        </div>

        {{-- Loop through all departments, display department card and increment active count if it's active --}}
        <div class="row align-items-center justify-content-start">
            @php
                $activeCount = 0;
            @endphp
            @foreach ($departments as $department)
                @if ($department->id != 1 && $department->id != 2 && $department->status == 'active')
                    @php
                        $staffAvailable = false;
                        foreach ($users as $user) {
                            if ($user->department_id == $department->id && $user->account_login->status == 'Logged In') {
                                $staffAvailable = true;
                                break;
                            }
                        }
                    @endphp
                    @if ($staffAvailable)
                        <div class="col-md-6 mb-4" data-aos="fade-right" data-aos-delay="50">
                            <form method="POST" action="{{ route('select-transaction') }}">
                                @csrf
                                <input type="hidden" name="department_id" value="{{ $department->id }}">
                                <button type="submit"
                                    class="card text-start h-100 w-100 text-kyoodark link-card rounded-5"
                                    id="select-department">
                                    <div class="card-body p-5">
                                        @if (!$staffAvailable)
                                            <p><span class="badge bg-warning">No Active Staff</span></p>
                                        @endif
                                        <span class="display-6 fw-bold mb-3">
                                            {{ $department->name }}
                                        </span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    @elseif(!$staffAvailable)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 rounded-5">
                                <div class="card-body p-5 text-muted">
                                    <p><span class="badge bg-warning">No Active Staff</span></p>
                                    <span class="display-6 fw-bold mb-3">
                                        {{ $department->name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Increment active count --}}
                    @php
                        $activeCount++;
                    @endphp
                @endif
            @endforeach

            {{-- If no other department is available, display message --}}
            @if ($activeCount === 0)
                <div class="col-12">
                    <div class="card h-100 w-100 rounded-5">
                        <div class="card-body p-5 text-center">
                            <span class="display-6 fw-bold mb-3 text-kyoored">
                                <i>No other department is available.</i>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        {{-- Back Button --}}
        <x-back-button />
    </div>

</x-layout>
