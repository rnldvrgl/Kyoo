{{-- Page Title --}}
@section('mytitle', 'Department Admin Dashboard')

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :$details :$role />
</x-layout>
