{{-- Page Title --}}
@section('mytitle', 'Staff Dashboard')

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


    @switch($department->id)
        @case(1)
            @include('dashboard.staff.content.registrar')
        @break

        @case(3)
            @include('dashboard.staff.content.librarian')
        @break

        @case(4)
            @include('dashboard.staff.content.librarian')
        @break

        @default
            @include('dashboard.staff.content.regular-staff')
        @break
    @endswitch

    {{-- Staff JS --}}
    <script src="{{ asset('assets/js/staff.js') }}"></script>
</x-layout>
