{{-- Page Title --}}
@section('mytitle', 'Staff Dashboard')

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :$details :$role />
</x-layout>
