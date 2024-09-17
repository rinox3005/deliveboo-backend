@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-3 text-center">Dettagli Ordine #{{ $order->id }}</h1>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Dettagli dell'Ordine</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Nome Cliente:</strong> {{ $order->user_name }}</p>
                        <p class="mb-2"><strong>Email Cliente:</strong> {{ $order->user_email }}</p>
                        <p class="mb-2"><strong>Indirizzo di Consegna:</strong> {{ $order->user_address }}</p>
                        <p class="mb-2"><strong>Telefono Cliente:</strong> {{ $order->user_phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Data dell'Ordine:</strong>
                            {{ \Carbon\Carbon::parse($order->order_date_time)->format('d/m/Y H:i') }}</p>
                        <p class="mb-2"><strong>Data di Consegna:</strong>
                            {{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</p>
                        <p class="mb-2"><strong>Orario di Consegna:</strong>
                            {{ \Carbon\Carbon::parse($order->delivery_time)->format('H:i') }}</p>
                        <p class="mb-2"><strong>Totale Ordine:</strong> €{{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>

                @if ($order->notes)
                    <div class="row mb-3">
                        <div class="col">
                            <p class="mb-2"><strong>Note:</strong> {{ $order->notes }}</p>
                        </div>
                    </div>
                @endif

                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0">Piatti Ordinati</h2>
                    </div>
                    <div class="card-body">
                        @if ($dishes->isNotEmpty())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome Piatto</th>
                                        <th>Descrizione</th>
                                        <th>Prezzo</th>
                                        <th>Quantità</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $dish)
                                        <tr>
                                            <td>{{ $dish->name }}</td>
                                            <td>{{ $dish->description }}</td>
                                            <td>€{{ number_format($dish->price, 2) }}</td>
                                            <td>{{ $dish->pivot->quantity }}</td>
                                            <!-- Assumi che esista una tabella pivot con 'quantity' -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Nessun piatto associato a questo ordine.</p>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('user.orders.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Torna agli Ordini
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
