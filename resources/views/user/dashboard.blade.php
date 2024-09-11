@extends('layouts.app')

@section('content')
    <div class="container">
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

                        @if (!empty($restaurants) && count($restaurants) > 0)
                            <h3>{{ __('Ristoranti associati a te') }}</h3>
                        @endif

                        <div class="row">
                            @if (!empty($restaurants) && count($restaurants) > 0)
                                @foreach ($restaurants as $restaurant)
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <img src="{{ $restaurant->image_path ? asset($restaurant->image_path) : Vite::asset('resources/img/restaurant-placeholder-show.png') }}"
                                                class="card-img-top" alt="{{ $restaurant->name }}">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $restaurant->name }}</h4>
                                                <a href="{{ route('user.restaurants.show', $restaurant) }}"
                                                    class="btn btn-primary">Dettagli</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Non hai ristoranti associati.</p>
                            @endif

                            <div class="d-inline">
                                @if (Auth::user()->restaurant === null)
                                    <a href="{{ route('user.restaurants.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i>
                                        Aggiungi Nuovo Ristorante
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
