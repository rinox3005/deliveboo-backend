@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Crea Nuovo Ristorante
@endsection

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-header text-dark">
                <h2 class="mb-0">Nuovo Ristorante</h2>
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

                <form id="restaurant-form" action="{{ route('user.restaurants.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Ristorante <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <div class="col-6 me-2">
                            <label for="address" class="form-label">Indirizzo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}" required />
                        </div>
                        <div class="col-6 ">
                            <label for="city" class="form-label">Città <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city') }}" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numero di Telefono <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ old('phone_number') }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="piva" class="form-label">Partita IVA <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="piva" name="piva" value="{{ old('piva') }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="image_path" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="image_path" name="image_path" />
                    </div>

                    <div class="mb-3">
                        <div class="mb-2">Tipi di Ristorante <span class="text-danger">*</span></div>
                        <div id="type-error" class="text-danger mb-3" style="display: none;">
                            Seleziona almeno una tipologia di ristorante!
                        </div>
                        @foreach ($types as $type)
                            <input type="checkbox" class="btn-check" id="type-{{ $type->id }}" name="types[]"
                                value="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} />
                            <label class="btn btn-outline-primary mb-1" for="type-{{ $type->id }}">
                                {{ $type->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.dashboard') }}"
                            class="py-1 px-2 bg-custom-secondary fs-6 custom-btn me-2 d-flex align-items-center mt-2 text-white">
                            <i class="fas fa-arrow-left"></i>
                            Torna alla Dashboard
                        </a>
                        <button type="submit"
                            class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 d-flex align-items-center mt-2 text-white border-none border">
                            Crea Ristorante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('restaurant-form').addEventListener('submit', function(event) {
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
