@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Modifica {{ $dish->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-header text-dark">
                <h2 class="mb-0">Modifica Piatto</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Metodo PUT per l'update -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Piatto</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $dish->name) }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $dish->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo (€)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ old('price', $dish->price) }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="image_path" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="image_path" name="image_path" />
                        @if ($dish->image_path)
                            <img src="{{ asset($dish->image_path) }}" alt="{{ $dish->name }}" class="img-thumbnail mt-2"
                                width="150">
                        @endif
                    </div>

                    <div class="d-flex">
                        <!-- Checkbox personalizzate per opzioni -->
                        <div class="mb-3 col-6  me-2">
                            <div class="mb-2 ">Opzioni</div>

                            <!-- Vegan Option -->
                            <input type="checkbox" class="btn-check" id="vegan" name="vegan" value="1"
                                {{ old('vegan', $dish->vegan) ? 'checked' : '' }} />
                            <label class="btn btn-outline-success mb-1" for="vegan">Vegan</label>

                            <!-- Gluten Free Option -->
                            <input type="checkbox" class="btn-check" id="gluten_free" name="gluten_free" value="1"
                                {{ old('gluten_free', $dish->gluten_free) ? 'checked' : '' }} />
                            <label class="btn btn-outline-secondary mb-1" for="gluten_free">Senza Glutine</label>

                            <!-- Spicy Option -->
                            <input type="checkbox" class="btn-check" id="spicy" name="spicy" value="1"
                                {{ old('spicy', $dish->spicy) ? 'checked' : '' }} />
                            <label class="btn btn-outline-danger mb-1" for="spicy">Piccante</label>

                            <!-- Lactose Free Option -->
                            <input type="checkbox" class="btn-check" id="lactose_free" name="lactose_free" value="1"
                                {{ old('lactose_free', $dish->lactose_free) ? 'checked' : '' }} />
                            <label class="btn btn-outline-primary mb-1" for="lactose_free">Senza Lattosio</label>
                        </div>

                        <!-- Campo Visibilità -->
                        <div class="mb-3 col-6">
                            <div class="mb-2">Visibilitá</div>
                            <input type="checkbox" class="btn-check" id="visible" name="visible" value="1"
                                {{ old('visible', $dish->visible) ? 'checked' : '' }} />
                            <label class="btn btn-outline-primary mb-1" for="visible">Visibile</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.restaurants.show', $restaurant) }}"
                            class="py-1 px-2 bg-custom-secondary fs-6 custom-btn me-2 d-flex align-items-center mt-2 text-white">
                            <i class="fas fa-arrow-left me-2"></i>
                            Torna al Ristorante
                        </a>
                        <button type="submit"
                            class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 d-flex align-items-center mt-2 text-white border-none border">
                            Aggiorna Piatto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
