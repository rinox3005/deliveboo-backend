<div>
    <div>
        <h1>Ordine {{ $order->slug }} Confermato</h1>
    </div>
    <div>

        <p>
            Gentile Sig/Sig.ra {{ $order->user_name }} le confermiamo la presa a carico dell'ordine da lei effettuato, pertanto la ringraziamo per aver scelto la nostra App!
        </p>
    </div>
    
    <div>

        <ul>
            <li>Il ristorante "{{ $order->restaurant->name }}" ha iniziato a preparare il suo ordine</li>
            <li>L'indirizzo di consegna è: {{ $order->user_address }}</li>
            <li>L'arrivo dell'ordine da lei effettuato è previsto per le ore: {{ $order->delivery_time }}</li>
            <li>Il costo totale dell'ordine è di: {{ $order->total_price }}€</li>
        </ul>

    </div>
    <div>

        <h2>Note Aggiuntive:</h2>
        <p>{{ $order->notes }}</p>

    </div>
</div>



