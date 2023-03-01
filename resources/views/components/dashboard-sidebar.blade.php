<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        {{-- Main --}}
        <li class="nav-heading">MAIN</li>
        <li class="nav-item">
            {{-- Anchor Tag based on User Role --}}
            @if ($attributes['name'] == 'Main Admin')
                <a class="nav-link active" href="{{ route('dashboard.main_admin') }}">
                    <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
                </a>
            @elseif($attributes['name'] == 'Department Admin')
                <a class="nav-link active" href="{{ route('dashboard.department_admin') }}">
                    <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
                </a>
            @elseif($attributes['name'] == 'Staff')
                <a class="nav-link active" href="{{ route('dashboard.staff') }}">
                    <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
                </a>
            @elseif($attributes['name'] == 'Librarian')
                <a class="nav-link active" href="{{ route('dashboard.librarian') }}">
                    <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
                </a>
            @endif
        </li>

        {{-- Manage --}}
        <li class="nav-heading">MANAGE</li>

        {{-- Accounts --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-user"></i><span>Account</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <ul id="account-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('manage.accounts.add') }}" class="active">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Account</span>
                    </a>
                    <a href="{{ route('manage.accounts.edit') }}">
                        <i class="fa-solid fa-pen-to-square"></i><span>Edit Account</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Departments --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#dept-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-building"></i>
                <span>Departments</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <ul id="dept-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('manage.departments.add') }}">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Department</span>
                    </a>
                    <a href="{{ route('manage.departments.edit') }}">
                        <i class="fa-solid fa-pen-to-square"></i><span>Edit Department</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Services --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#serv-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-hand-holding"></i>
                <span>Services</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <ul id="serv-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('manage.services.add') }}">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Service</span>
                    </a>
                    <a href="{{ route('manage.services.edit') }}">
                        <i class="fa-solid fa-pen-to-square"></i><span>Edit Service</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Frequently Asked Questions --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#faq-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-file-circle-question"></i> <span>Frequent Questions</span>
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>
            <ul id="faq-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('manage.frequent_questions.add') }}">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Question</span>
                    </a>
                    <a href="{{ route('manage.frequent_questions.edit') }}">
                        <i class="fa-solid fa-pen-to-square"></i><span>Edit Question</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Queue Screen --}}
        <li class="nav-heading">Live Queue Screen</li>

        {{-- Promotional Video and Promotional Text --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('manage.promotionals.edit') }}">
                <i class="fa-solid fa-video"></i>
                <span>Promotionals</span>
            </a>
        </li>

    </ul>
</aside>
<!-- /Sidebar -->
