<div style="font-family: Arial, Helvetica, sans-serif">
    <header>
        <div style="text-align: center">
            <h1 style="color: #ec7600">Ordine #{{ $order->id }} Confermato</h1>
        </div>
    </header>

    <div>
        <div style="text-align: center">
            <p>
                Gentile <strong>{{ $order->user_name }}</strong> le confermiamo la presa a carico dell'ordine
                da lei effettuato, pertanto la ringraziamo per aver scelto Deliveboo!
            </p>
        </div>

        <div>
            <div style="text-align: center">
                <h2 style="color: #ec7600">Riepilogo Ordine</h2>
                <span>Ordine presso <strong>{{ $order->restaurant->name }}!</strong> </span>
                <table cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 12px; border-bottom: 2px solid #dee2e6;">Piatto</th>
                            <th style="text-align: center; padding: 12px; border-bottom: 2px solid #dee2e6;">Qtà</th>
                            <th style="text-align: center; padding: 12px; border-bottom: 2px solid #dee2e6;">Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->dishes as $dish)
                            <tr style="background-color: #f8f9fa;">
                                <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">{{ $dish->name }}</td>
                                <td style="text-align: center; padding: 12px; border-bottom: 1px solid #dee2e6;">
                                    {{ $dish->pivot->quantity }}</td>
                                <td style="text-align: center; padding: 12px; border-bottom: 1px solid #dee2e6;">
                                    €{{ $dish->price }}</td>
                            <tr>
                        @endforeach
                        <tr>
                            <td colspan="3"
                                style="text-align: left; padding: 12px; font-weight: bold; border-top: 2px solid #dee2e6;">
                                Totale: €{{ $order->total_price }}</td>
                        </tr>
                        <tr></tr>
                        <td colspan="3"
                            style="text-align: left; padding: 12px; font-weight: bold; border-top: 2px solid #dee2e6;">
                            Orario di Consegna: {{ $order->delivery_time }}</td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center">
                    <h3 style="color: #ec7600">Note Ordine:</h3>
                </div>
                <div>
                    <p>{{ $order->notes }}</p>
                </div>
            </div>

            <div style="text-align: center;">
                <span>Per continuare ad ordinare clicca <a style="color: #ec7600; text-align:center;"
                        href="http://localhost:5174/restaurant">QUI</a> </span>
            </div>
        </div>
