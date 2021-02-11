<div class="card-header">{{ __('Login') }}</div>

<div class="card-body">

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
