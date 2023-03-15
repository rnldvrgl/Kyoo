{{-- Page Title --}}
@section('mytitle', 'FAQs List')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" />


    {{-- Dashboard Sidebar --}}
    <x-dashboard-sidebar name="{{ $role->name }}" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>FAQs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">FAQs</li>
                    <li class="breadcrumb-item active">FAQs List</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Frequently Asked Questions</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addFAQModal">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add FAQs
                                </button>
                            </div>

                            <div class="table-responsive">
                                <div id="res">
                                    {{-- Append Success/Error Messages here --}}
                                </div>
                                <table id="faqs-table" class="table-bordered table-hover table" style="width:100%">
                                    <caption>List of Frequently Asked Questions</caption>
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Insert DataTable here --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->

        <!-- Add FAQ Modal -->
        <div class="modal fade" id="addFAQModal" tabindex="-1" aria-labelledby="addFAQModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFAQModalLabel">Add Frequently Asked Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <form id="add-faqs-frm" action="{{ route('manage.frequent_questions.store') }}" method="POST">
                            @csrf
                            {{-- Question --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="question" id="floatingQuestion"
                                    placeholder="Question" required>
                                <label for="floatingQuestion">Question</label>
                            </div>

                            {{-- Answer --}}
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Answer" name="answer" id="floatingAnswer"
                                    style="height: 100px; min-height: 100px; max-height: 150px;"></textarea>
                                <label for="floatingAnswer">Answer</label>
                            </div>

                            {{-- Buttons --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" id="btn-save-faq">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add FAQ
                                </button>
                                <button type="reset" class="btn btn-kyoored">
                                    <i class="fas fa-eraser me-2"></i>
                                    Clear Input Fields
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main Content -->

    {{-- For FAQs Table --}}
    <script>
        $(function() {
            $('#faqs-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.frequent_questions.fetch_faqs') }}',
                columns: [{
                        data: 'question',
                        name: 'question',
                        width: '90%'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '10%',
                        className: 'text-center'
                    }
                ],
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100]
            });
        });
    </script>
</x-layout>
