@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Dettagli {{ $restaurant->name }}</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-warning d-flex justify-content-between align-items-center text-white">
                <h2 class="mb-0">{{ $restaurant->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Indirizzo:</strong>
                                    {{ $restaurant->address }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Categorie:</strong>
                                @if ($restaurant->types->isNotEmpty())
                                    @foreach ($restaurant->types as $type)
                                        <span class="badge bg-warning text-black">
                                            {{ $type->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span>Non Disponibili</span>
                                @endif
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
                    <a href="{{ route('user.restaurants.index') }}" class="btn btn-primary me-2">
                        <i class="fas fa-arrow-left"></i>
                        Torna ai ristoranti
                    </a>
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
    </div>

    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="fw-semibold">Delete Confirmation:</h5>
                    <p>
                        Are you sure you want to delete
                        <span class="fw-semibold">{{ $restaurant->name }}</span>
                        ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form action="{{ route('user.restaurants.destroy', $restaurant) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete Restaurant
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
