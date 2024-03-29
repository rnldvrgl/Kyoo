<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/kyoo-ico.ico') }}" type="image/x-icon">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('mytitle') | Kyoo : Queueing Management System</title>

    {{-- Scripts --}}
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    {{-- DataTable CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/zf/dt-1.13.2/af-2.5.2/b-2.3.4/b-print-2.3.4/date-1.3.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.css" />

    {{-- jQuery Framework CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    {{-- jQuery Confirm CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    {{-- jQuery DataTables.net CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/98a2b5e7f0.js" crossorigin="anonymous"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Google Chart CDN --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body
    @auth class="{{ $role->name !== 'Main Admin' || $role->name !== 'Department Admin' ? 'toggle-sidebar' : '' }}" @endauth
    data-bs-spy="scroll" data-bs-target="#scrollspy" data-bs-root-margin="0px 0px -20% 0px" data-bs-smooth-scroll="true"
    tabindex="0">

    <x-loading-screen />

    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>

    {{ $slot }}

    {{-- DataTable JS --}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    {{-- Moment.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    {{-- JQuery Confirm CDN JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    {{-- AOS JS --}}
    <script src=" https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- Main JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Date Time JS --}}
    <script src="{{ asset('assets/js/dateTime.js') }}"></script>

    {{-- DataTable JS --}}
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/zf/dt-1.13.2/af-2.5.2/b-2.3.4/b-print-2.3.4/date-1.3.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js">
    </script>

    {{-- Export Tickets --}}
    <script src="{{ asset('assets/js/exports.js') }}"></script>

    {{-- JQuery Confirm Local JS --}}
    <script src="{{ asset('assets/js/jquery-confirm.js') }}"></script>

    {{-- JQuery Validate Form JS --}}
    <script src="{{ asset('assets/js/validateForm.js') }}"></script>

    {{-- Profile Update JS --}}
    <script src="{{ asset('assets/js/profileupdate.js') }}"></script>

    {{-- Forms JS --}}
    <script src="{{ asset('assets/js/forms.js') }}"></script>

    {{-- Kiosk JS --}}
    <script src="{{ asset('assets/js/kiosk.js') }}"></script>

    {{-- Date Format --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

</body>

</html>
