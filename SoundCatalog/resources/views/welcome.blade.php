@extends('layouts.app')

@section('content')
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
                            <div>
                                <a href="{{ route('complaints.index') }}" class="text-sm text-gray-700 underline">Complaints</a>
                            </div>
                            <div>
                                <a href="{{ route('sound.index') }}" class="text-sm text-gray-700 underline">Sounds</a>
                            </div>
                            <ul>
                                <li><a href="/login">login</a></li>
                                <li><a href="/home">home</a></li>
                                <li><a href="/admin-home">admin-home</a></li>
                            </ul>
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
