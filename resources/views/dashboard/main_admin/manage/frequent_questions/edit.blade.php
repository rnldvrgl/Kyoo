{{-- Page Title --}}
@section('mytitle', 'Edit FAQs')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" />


    {{-- Dashboard Sidebar --}}
    <x-dashboard-sidebar name="{{ $role->name }}" :role="$role" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>FAQs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">FAQs</li>
                    <li class="breadcrumb-item active">Edit FAQ</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->

        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit FAQ</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <form id="edit-faqs-frm" action="{{ route('manage.frequent_questions.update') }}"
                                method="POST" novalidate>

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="id" value="{{ $faq->id }}">

                                <div class="row">
                                    <div class="col-12">
                                        {{-- Question --}}
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="question"
                                                placeholder="Question" id="floatingQuestion" placeholder="Question"
                                                value="{{ $faq->question }}" required>
                                            <label for="floatingQuestion">Question</label>
                                        </div>

                                        {{-- Answer --}}
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Answer" name="answer" id="floatingAnswer"
                                                style="height: 100px; min-height: 100px; max-height: 150px;">{{ $faq->answer }}</textarea>
                                            <label for="floatingAnswer">Answer</label>
                                        </div>
                                        {{-- Buttons --}}
                                        <div class="d-grid mb-3 gap-2">
                                            <a href="{{ route('manage.frequent_questions.index') }}"
                                                class="btn btn-kyoored">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Go back
                                            </a>

                                            <button type="submit" class="btn btn-success" id="btn-update-faq">
                                                Update
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->


    </main>
    <!-- /Main Content -->
</x-layout>
