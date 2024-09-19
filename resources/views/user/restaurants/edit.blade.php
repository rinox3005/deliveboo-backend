@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-header text-dark">
                <h2 class="mb-0">Modifica Ristorante</h2>
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

                <form id="restaurant-edit-form" action="{{ route('user.restaurants.update', $restaurant) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Ristorante <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $restaurant->name) }}" required />
                    </div>

                    <div class="mb-3 d-flex">
                        <div class="col-6 me-2">
                            <label for="address" class="form-label">Indirizzo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $restaurant->address) }}" required />
                        </div>
                        <div class="col-6">
                            <label for="city" class="form-label">Città <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city', $restaurant->city) }}" required />
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numero di Telefono <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $restaurant->phone_number) }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="piva" class="form-label">Partita IVA <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="piva" name="piva"
                            value="{{ old('piva', $restaurant->piva) }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="preview" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="preview" name="preview" />
                        @if ($restaurant->image_path)
                            <img src="{{ asset($restaurant->image_path) }}" alt="{{ $restaurant->name }}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="mb-3">
                        <div class="mb-2">Tipi di Ristorante <span class="text-danger">*</span></div>
                        <div id="type-error" class="text-danger mb-3" style="display: none;">
                            Seleziona almeno una tipologia di ristorante!
                        </div>
                        @foreach ($types as $type)
                            <input type="checkbox" class="btn-check" id="type-{{ $type->id }}" name="types[]"
                                value="{{ $type->id }}"
                                {{ in_array($type->id, old('types', $restaurant->types->pluck('id')->toArray() ?? [])) ? 'checked' : '' }} />
                            <label class="btn btn-outline-primary mb-1" for="type-{{ $type->id }}">
                                {{ $type->name }}
                            </label>
                        @endforeach
                    </div>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary me-1">
                        <i class="fas fa-arrow-left"></i>
                        Torna alla Dashboard
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Aggiorna Ristorante
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('restaurant-edit-form').addEventListener('submit', function(event) {
            var checkboxes = document.querySelectorAll('input[name="types[]"]');
            var checked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if (!checked) {
                event.preventDefault(); // Blocca l'invio del form
                document.getElementById('type-error').style.display = 'block'; // Mostra l'errore
            } else {
                document.getElementById('type-error').style.display = 'none'; // Nascondi l'errore
            }
        });
    </script>
@endsection
