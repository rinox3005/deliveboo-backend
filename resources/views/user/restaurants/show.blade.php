@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1 class="my-3 text-center">Dettagli {{ $restaurant->name }}</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-warning d-flex justify-content-between align-items-center text-white">
                <h2 class="mb-0">Ristorante</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Categorie:</strong>
                                @if ($restaurant->types->isNotEmpty())
                                    @foreach ($restaurant->types as $type)
                                        <span class="badge bg-success text-white">
                                            {{ $type->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span>Non Disponibili</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Indirizzo:</strong>
                                    {{ $restaurant->address }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Creato il:</strong>
                                    {{ $restaurant->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Cittá:</strong>
                                    {{ $restaurant->city }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Contatto:</strong>
                                    {{ $restaurant->phone_number }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p class="mb-2">
                                    <strong>Partita IVA:</strong>
                                    {{ $restaurant->piva }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <img src="{{ $restaurant->image_path ? asset($restaurant->image_path) : Vite::asset('resources/img/restaurant-placeholder-show.png') }}"
                            alt="{{ $restaurant->name }} Image" class="img-thumbnail preview-show" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.restaurants.edit', $restaurant) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i>
                        Modifica
                    </a>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-bs-restaurant-id="{{ $restaurant->id }}" data-bs-restaurant-name="{{ $restaurant->name }}">
                        <i class="fas fa-trash"></i>
                        Cancella
                    </button>
                </div>
            </div>
        </div>
        <!-- Lista dei piatti associati -->
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Menú</h2>
            </div>
            <div class="card-body">
                @if ($dishes->isNotEmpty())
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
                                            <img src="{{ $dish->image_path ? asset($dish->image_path) : Vite::asset('resources/img/restaurant-placeholder-mini.png') }}"
                                                alt="{{ $dish->id }} Preview" class="img-thumbnail preview-index" />
                                        </div>
                                    </td>
                                    <td>{{ $dish->name }}</td>
                                    <td>{{ $dish->description }}</td>
                                    <td>{{ $dish->price }} €</td>
                                    <td>
                                        <a href="{{ route('user.dishes.show', $dish) }}"
                                            class="btn btn-info btn-sm me-1 my-1"><i
                                                class="fas fa-eye me-1"></i>Dettagli</a>
                                        <a href="{{ route('user.dishes.edit', $dish) }}"
                                            class="btn btn-warning btn-sm me-1 my-1"><i
                                                class="fas fa-edit me-1"></i>Modifica</a>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModalDish" data-bs-dish-id="{{ $dish->id }}"
                                            data-bs-dish-name="{{ $dish->name }}">
                                            <i class="fas fa-trash me-1"></i>Cancella
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Non ci sono piatti associati a questo ristorante.</p>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.dishes.create') }}" class="btn btn-success me-2">
                        <i class="fas fa-plus"></i>
                        Aggiungi Nuovo Piatto
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary me-2">
                <i class="fas fa-arrow-left"></i>
                Torna alla Dashboard
            </a>
        </div>
    </div>

    <!-- Modal for delete confirmation for restaurant -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="fw-semibold">Conferma Cancellazione:</h5>
                    <p>
                        Sei sicuro di voler eliminare il ristorante
                        <span class="fw-semibold">{{ $restaurant->name }}</span>
                        ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annulla
                    </button>
                    <form action="{{ route('user.restaurants.destroy', $restaurant) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Elimina Ristorante
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for delete confirmation for dish -->
    @if ($dishes->isNotEmpty())
        <div class="modal fade" id="deleteModalDish" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                        <form action="{{ route('user.dishes.destroy', $dish) }}" method="POST"
                            style="display: inline-block">
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
    @endif
@endsection
