<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        {{-- Main --}}
        <li class="nav-heading">MAIN</li>
        <li class="nav-item">
            <a class="nav-link active" href="/dashboard">
                <i class="fa-solid fa-table-cells-large"></i><span>Dashboard</span>
            </a>
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
                    <a href="{{ route('main_admin.manage.accounts.add') }}" class="active">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Account</span>
                    </a>
                    <a href="{{ route('main_admin.manage.accounts.edit') }}">
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
                    <a href="/add-department">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Department</span>
                    </a>
                    <a href="/manage-department">
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
                    <a href="/add-service">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Service</span>
                    </a>
                    <a href="/manage-service">
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
                    <a href="/add-service">
                        <i class="fa-solid fa-circle-plus"></i><span>Add Question</span>
                    </a>
                    <a href="/manage-service">
                        <i class="fa-solid fa-pen-to-square"></i><span>Edit Question</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Queue Screen --}}
        <li class="nav-heading">Live Queue Screen</li>

        {{-- Promotional Video --}}
        <li class="nav-item">
            <a class="nav-link" href="/promotinal-video">
                <i class="fa-solid fa-video"></i>
                <span>Promotional Video</span>
            </a>
        </li>

        {{-- Promotional Text --}}
        <li class="nav-item">
            <a class="nav-link" href="/promotinal-message">
                <i class="fa-solid fa-quote-left"></i>
                <span>Promotional Message</span>
            </a>
        </li>
    </ul>
</aside>
<!-- /Sidebar -->
