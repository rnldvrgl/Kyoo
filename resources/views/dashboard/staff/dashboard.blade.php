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


    @if ($department->id == 3 || $department->id == 4)
        @include('dashboard.staff.content.librarian')
    @else
        @include('dashboard.staff.content.regular-staff')
    @endif
</x-layout>
