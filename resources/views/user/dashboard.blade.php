@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.restaurants.create') }}" class="btn btn-success mt-4">
            <i class="fas fa-plus"></i>
            Aggiungi Ristorante
        </a>
        <div class="row justify-content-center">
            <div class="col mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
