@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Ordini di {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-semibold d-inline my-4">Ordini di {{ $restaurant->name }}</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('user.restaurants.show', $restaurant) }}"
                    class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 mt-2 text-white">
                    <i class="fas fa-arrow-left"></i>
                    Torna al Ristorante
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>N. Ordine</th>
                    <th>Data/Ora</th>
                    <th>Cliente</th>
                    <th>Indirizzo</th>
                    <th>Totale</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="align-middle py-5">
                        <td>
                            Ordine #{{ $order->id }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date_time)->format('d/m/Y - H:i') }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->user_address }}</td>
                        <td>{{ $order->total_price }} €</td>
                        <td>
                            <a href="{{ route('user.orders.show', $order) }}"
                                class="py-1 px-2 bg-custom-primary fs-6 custom-btn me-2 mt-2 text-white"><i
                                    class="fas fa-eye me-1"></i>Dettagli</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
