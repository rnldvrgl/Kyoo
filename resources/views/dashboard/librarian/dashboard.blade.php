<x-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{ __('You are logged in!') }}

            @if (session('account_id'))
                <p>The account ID is {{ session('account_id') }}</p>
            @endif

            <p>LIBRARIAN</p>

        </div>
    </div>
</x-layout>
