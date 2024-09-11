@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-header bg-primary text-white">
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

                <form action="{{ route('user.restaurants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Ristorante</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Città</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numero di Telefono</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ old('phone_number') }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="piva" class="form-label">Partita IVA</label>
                        <input type="text" class="form-control" id="piva" name="piva" value="{{ old('piva') }}"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="image_path" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="image_path" name="image_path" />
                    </div>

                    <div class="mb-3">
                        <div class="mb-2">Tipi di Ristorante</div>
                        @foreach ($types as $type)
                            <input type="checkbox" class="btn-check" id="type-{{ $type->id }}" name="types[]"
                                value="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} />
                            <label class="btn btn-outline-primary mb-1" for="type-{{ $type->id }}">
                                {{ $type->name }}
                            </label>
                        @endforeach
                    </div>

                    <a href="{{ route('user.restaurants.index') }}" class="btn btn-primary me-1">
                        <i class="fas fa-arrow-left"></i>
                        Torna alla lista
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Crea Ristorante
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
