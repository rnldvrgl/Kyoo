@php
    $uri = Request::path();
@endphp

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        {{-- Main --}}
        <li class="nav-heading">MAIN</li>
        {{-- Anchor Tag based on User Role --}}

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'main-admin/dashboard' ? 'active' : '' }}"
                href="{{ route('dashboard.main_admin') }}">
                <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
            </a>
        </li>
        {{-- Manage --}}
        <li class="nav-heading">MANAGE</li>


        {{-- Accounts --}}
        <li class="nav-item">
            <a href="{{ route('manage.accounts.index') }}"
                class="nav-link {{ $uri == 'main-admin/manage/accounts/edit-account' || $uri == 'main-admin/manage/accounts/view-account' ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>Accounts</span>
            </a>
        </li>

        {{-- Departments --}}
        <li class="nav-item">
            <a href="{{ route('manage.departments.index') }}"
                class="nav-link {{ $uri == 'main-admin/manage/departments/edit-department' || $uri == 'main-admin/manage/departments/view-department' ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i>
                <span>Departments</span>
            </a>
        </li>

        {{-- Services --}}
        <li class="nav-item">
            <a href="{{ route('manage.services.edit') }}"
                class="nav-link {{ $uri == 'main-admin/manage/services/edit-service' ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding"></i>
                <span>Service List</span>
            </a>
        </li>

        {{-- Frequently Asked Questions --}}
        <li class="nav-item">
            <a class="nav-link collapsed {{ $uri == 'main-admin/manage/frequent_questions/add-frequent-question' || $uri == 'main-admin/manage/frequent_questions/edit-frequent-question' ? 'active' : '' }}"
                data-bs-target="#faq-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-file-circle-question"></i> <span>Frequent Questions</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <ul id="faq-nav"
                class="nav-content collapse{{ $uri == 'main-admin/manage/frequent_questions/add-frequent-question' || $uri == 'main-admin/manage/frequent_questions/edit-frequent-question' ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('manage.frequent_questions.add') }}"
                        class="{{ $uri == 'main-admin/manage/frequent_questions/add-frequent-question' ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Question</span>
                    </a>
                    <a href="{{ route('manage.frequent_questions.edit') }}"
                        class="{{ $uri == 'main-admin/manage/frequent_questions/edit-frequent-question' ? 'active' : '' }}">
                        <i class="fa-solid fa-list-ol"></i><span>Question List</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Queue Screen --}}
        <li class="nav-heading">Live Queue Screen</li>

        {{-- Promotional Video and Promotional Text --}}
        <li class="nav-item">
            <a class="nav-link {{ $uri == 'main-admin/manage/promotionals/edit-promotionals' ? 'active' : '' }}"
                href="{{ route('manage.promotionals.edit') }}">
                <i class="fa-solid fa-video"></i>
                <span>Promotionals</span>
            </a>
        </li>
    </ul>
</aside>
<!-- /Sidebar -->
