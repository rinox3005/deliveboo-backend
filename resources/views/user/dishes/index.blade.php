@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Menú di {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Menú</h2>
                    <div>
                        <a href="{{ route('user.restaurants.show', $restaurant) }}"
                            class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 mt-2 text-white d-none d-md-inline"">
                            <i class="fas fa-arrow-left p-3 p-md-0"></i>
                            <span class="d-none d-md-inline">Torna al Ristorante</span>
                        </a>
                        <a href="{{ route('user.dishes.create') }}"
                            class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 mt-2 text-white">
                            <i class="fas fa-plus p-3 p-md-0"></i>
                            <span class="d-none d-md-inline">Nuovo Piatto</span>
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                @if ($dishes->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Immagine</th>
                                    <th>Piatto</th>
                                    <th>Descrizione</th>
                                    <th>Prezzo</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dishes as $dish)
                                    <tr class="align-middle">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $dish->image_path ? asset($dish->image_path) : Vite::asset('resources/img/dish-placeholder-mini.jpg') }}"
                                                    alt="{{ $dish->id }} Preview" class="img-thumbnail preview-index" />
                                            </div>
                                        </td>
                                        <td>{{ $dish->name }}</td>
                                        <td>{{ $dish->description }}</td>
                                        <td>€ {{ $dish->price }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.dishes.show', ['dish' => $dish->id, 'slug' => $dish->slug]) }}"
                                                class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 mt-2 text-white"><i
                                                    class="fas fa-eye me-lg-1"></i><span
                                                    class="d-none d-lg-inline">Dettagli</span></a>
                                            {{-- <a href="{{ route('user.dishes.edit', $dish) }}"
                                            class="btn btn-warning btn-sm me-1 my-1"><i
                                                class="fas fa-edit me-1"></i>Modifica</a>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModalDish" data-bs-dish-id="{{ $dish->id }}"
                                            data-bs-dish-name="{{ $dish->name }}">
                                            <i class="fas fa-trash me-1"></i>Cancella
                                        </button> --}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $dishes->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    @else
                        <p>Non ci sono piatti associati a questo ristorante.</p>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
