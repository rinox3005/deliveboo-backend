@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex">
            {{-- Sidebar --}}
            <div class="col-2">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-custom-secondary">
                    <a href="/"
                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none mt-4">
                        <span class="fs-5 text-white">Area Riservata</span>
                    </a>
                    <hr class="m-1">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a href="#" class="nav-link active link-body-emphasis text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-body-emphasis text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#table"></use>
                                </svg>
                                Ristorante
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-body-emphasis text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Ordini
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-body-emphasis text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#people-circle"></use>
                                </svg>
                                Menú
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Dettagli --}}
            <div class="col-10">
                <div class="container mx-4 my-5">
                    <h5>Ben tornato Gesú</h5>
                    <div class="col-11">
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
                                                        <h4 class="card-title mb-3 text-center">{{ $restaurant->name }}
                                                        </h4>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('user.restaurants.show', $restaurant) }}"
                                                                class="btn btn-primary">Dettagli</a>
                                                        </div>
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
        </div>
    </div>
@endsection
