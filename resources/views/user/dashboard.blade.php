@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0 overflow-hidden">
        <div class="d-flex">
            {{-- Sidebar --}}
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-custom-secondary col-2 custom-sidebar">
                <a class="d-flex align-items-center mb-3 mb-md-0 text-decoration-none mt-2 text-white">
                    <i class="fa-solid fa-user-gear pe-2"></i>
                    <span class="fs-5 ">Area Riservata</span>
                </a>
                <hr class="mt-2 border-top border-white">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="#" class="nav-link active link-body-emphasis text-white">
                            <i class="fa-solid fa-table-columns me-lg-2 me-md-0"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-body-emphasis text-white">
                            <i class="fa-solid fa-utensils me-lg-2 me-md-0"></i>
                            <span>Ristorante</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-body-emphasis text-white">
                            <i class="fa-solid fa-layer-group me-lg-2 me-md-0"></i>
                            <span>Ordini</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-body-emphasis text-white">
                            <i class="fa-solid fa-book-open me-lg-2 me-md-0"></i>
                            <span>Menú</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contenuto principale --}}
            <div class="container-fluid custom-ml overflow-auto">
                <div class="mx-4 my-4 flex-grow-1">
                    <h5 class="pb-3 mb-0">Ben tornato {{ Auth::user()->name }}</h5>
                    <p class="py-3">Di seguito puoi visualizzare i tuoi ristoranti e le statistiche relative a vendite e
                        ordini</p>
                    <div class="col-11 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if (!empty($restaurants) && count($restaurants) > 0)
                                    <h5>{{ __('Ristoranti associati a te') }}</h5>
                                @endif
                            </div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    @if (!empty($restaurants) && count($restaurants) > 0)
                                        @foreach ($restaurants as $restaurant)
                                            <div class="col-md-4">
                                                <div class="card mb-4">
                                                    <img src="{{ $restaurant->image_path ? asset($restaurant->image_path) : Vite::asset('resources/img/restaurant-placeholder-show.png') }}"
                                                        class="card-img-top" alt="{{ $restaurant->name }}">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3 text-center">{{ $restaurant->name }}</h4>
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
