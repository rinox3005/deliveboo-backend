@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Lista Ristoranti
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-semibold d-inline my-4">Ristoranti di {{ Auth::user()->name }}</h1>

            <div class="d-inline">
                @if (Auth::user()->restaurant === null)
                    <a href="{{ route('user.restaurants.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Aggiungi Nuovo Ristorante
                    </a>
                @endif
            </div>
        </div>


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <ul class="list-group mb-5 mt-3">
            @foreach ($restaurants as $restaurant)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ $restaurant->image_path ? asset($restaurant->image_path) : Vite::asset('resources/img/restaurant-placeholder-mini.jpg') }}"
                            alt="{{ $restaurant->id }} Preview" class="img-thumbnail preview-index" />
                        <h6 class="mb-0 ms-2">
                            {{ $restaurant->name }}
                        </h6>
                    </div>
                    <div>
                        <a href="{{ route('user.restaurants.show', $restaurant) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            Dettagli
                        </a>
                        <a href="{{ route('user.restaurants.edit', $restaurant) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil"></i>
                            Modifica
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $restaurant->id }}" data-bs-restaurant-id="{{ $restaurant->id }}"
                            data-bs-restaurant-title="{{ $restaurant->title }}">
                            <i class="fas fa-trash-can"></i>
                            Cancella
                        </button>
                    </div>
                </li>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $restaurant->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="fw-semibold">
                                    Conferma Cancellazione:
                                </h5>
                                <p>
                                    Sei sicuro di voler cancellare
                                    <span class="fw-semibold">
                                        {{ $restaurant->name }}
                                    </span>
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
                                        Cancella Ristorante
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
