@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Dettagli Piatto</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $dish->name }}</h2>
                <span
                    class="badge @if ($dish->visible == '1') bg-success @elseif ($dish->visible == '0') bg-danger @endif">
                    @if ($dish->visible == '1')
                        Visibile
                    @else
                        Non Visibile
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Descrizione:</strong>
                                    {{ $dish->description }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Prezzo:</strong>
                                    {{ $dish->price }} €
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Vegan:</strong>
                                    {{ $dish->vegan ? 'Sì' : 'No' }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Senza Glutine:</strong>
                                    {{ $dish->gluten_free ? 'Sì' : 'No' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Piccante:</strong>
                                    {{ $dish->spicy ? 'Sì' : 'No' }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Senza Lattosio:</strong>
                                    {{ $dish->lactose_free ? 'Sì' : 'No' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Creato il:</strong>
                                    {{ $dish->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <img src="{{ $dish->image_path ? asset($dish->image_path) : Vite::asset('resources/img/restaurant-placeholder-show.png') }}"
                            alt="{{ $dish->name }} Image" class="img-thumbnail preview-show" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.restaurants.show', $restaurant) }}" class="btn btn-primary me-2">
                        <i class="fas fa-arrow-left"></i>
                        Torna al Ristorante
                    </a>
                    <a href="{{ route('user.dishes.edit', $dish) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i>
                        Modifica
                    </a>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-bs-dish-id="{{ $dish->id }}" data-bs-dish-name="{{ $dish->name }}">
                        <i class="fas fa-trash"></i>
                        Cancella
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="fw-semibold">Delete Confirmation:</h5>
                    <p>
                        Sei sicuro di voler eliminare
                        <span class="fw-semibold">{{ $dish->name }}</span>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('user.dishes.destroy', $dish) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Cancella Piatto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
