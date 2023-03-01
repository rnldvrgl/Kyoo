{{-- Page Title --}}
@section('mytitle', 'Librarian Dashboard')

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :$details :$role />
</x-layout>
