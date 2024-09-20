@extends('layouts.app')

@section('title')
    Deliveboo | Partner Hub - Dashboard
@endsection

@section('content')
    <div class="container-fluid p-0 overflow-hidden">
        <div class="d-flex">
            {{-- Sidebar --}}
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-custom-secondary col-2 custom-sidebar">
                <a class="d-flex align-items-center mb-3 mb-md-0 text-decoration-none mt-2 text-white">
                    <i class="fa-solid fa-user-gear pe-2"></i>
                    <span class="fs-5 ">Area Riservata</span>
                </a>
                <hr class="mt-2 border-top border-white">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="#" class="nav-link active text-white">
                            <i class="fa-solid fa-table-columns me-lg-2 me-md-0"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="@if ($restaurants) {{ route('user.restaurants.show', $restaurant) }} @endif"
                            class="nav-link text-white">
                            <i class="fa-solid fa-utensils me-lg-2 me-md-0"></i>
                            <span>Ristorante</span>
                        </a>
                    </li>
                    <li>
                        <a href="@if ($restaurants) {{ route('user.orders.index') }} @endif"
                            class="nav-link text-white">
                            <i class="fa-solid fa-layer-group me-lg-2 me-md-0"></i>
                            <span>Ordini</span>
                        </a>
                    </li>
                    <li>
                        <a href="@if ($restaurants) {{ route('user.dishes.index') }} @endif"
                            class="nav-link text-white">
                            <i class="fa-solid fa-book-open me-lg-2 me-md-0"></i>
                            <span>Menú</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contenuto principale --}}
            <div class="container-fluid custom-ml overflow-auto">
                <div class="mx-4 my-4 flex-grow-1">
                    <h5 class="pb-3 mb-0 fw-semibold">Ben tornato {{ Auth::user()->name }} !</h5>
                    <p class="py-3">Di seguito puoi visualizzare le statistiche relative a vendite e
                        ordini</p>
                    <div class="d-inline">
                        @if (Auth::user()->restaurant === null)
                            <a href="{{ route('user.restaurants.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i>
                                Aggiungi Nuovo Ristorante
                            </a>
                        @endif
                    </div>
                    {{-- i tuoi ristoranti e  --}}
                    <div class="col-11 col-md-12 d-none">
                        <div class="card">
                            @if (!empty($restaurants) && count($restaurants) > 0)
                                <div class="card-header">
                                    <h5 class="dashboard-card-header fw-semibold my-1">{{ __('Ristoranti associati a te') }}
                                    </h5>
                                </div>
                            @endif
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    @if (!empty($restaurants) && count($restaurants) > 0)
                                        @foreach ($restaurants as $restaurant)
                                            <div class="col-lg-3 col-md-4">
                                                <div class="card mb-4">
                                                    <img src="{{ $restaurant->image_path ? asset($restaurant->image_path) : Vite::asset('resources/img/restaurant-placeholder-show.png') }}"
                                                        class="card-img-top" alt="{{ $restaurant->name }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3 text-center fw-semibold">
                                                            {{ $restaurant->name }}</h5>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('user.restaurants.show', $restaurant) }}"
                                                                class="btn btn-warning btn-sm custom-btn bg-custom-primary">Dettagli</a>
                                                            <input type="hidden" id="id"
                                                                value="{{ $restaurant->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Non hai ristoranti associati.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!empty($restaurants) && count($restaurants) > 0)
                    <div class="mx-4 my-4 flex-grow-1">
                        <div class="col-11 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="dashboard-card-header fw-semibold my-1">
                                        {{ __('Statistiche del Ristorante') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="container-graph px-5">
                                        <div class="row py-2 justify-content-between ">
                                            <div class="col-6">
                                                <h2 class="mb-3">Numero ordini</h2>
                                                <div class="d-flex mb-3">
                                                    <select class="form-select w-50 fs-20 me-3"
                                                        aria-label="Default select example" id="year"
                                                        onchange="getGraph()">
                                                        <option selected value="">Years</option>
                                                        @for ($i = date('Y'); $i >= $restaurants[0]->created_at->format('Y'); $i--)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <select class="form-select w-50 fs-20"
                                                        aria-label="Default select example" id="month"
                                                        onchange="getGraph()">
                                                        <option selected value="">Months</option>
                                                        @php
                                                            $months = [
                                                                1 => 'Gennaio',
                                                                2 => 'Febbraio',
                                                                3 => 'Marzo',
                                                                4 => 'Aprile',
                                                                5 => 'Maggio',
                                                                6 => 'Giugno',
                                                                7 => 'Luglio',
                                                                8 => 'Agosto',
                                                                9 => 'Settembre',
                                                                10 => 'Ottobre',
                                                                11 => 'Novembre',
                                                                12 => 'Dicembre',
                                                            ];
                                                        @endphp
                                                        @foreach ($months as $number => $name)
                                                            <option value="{{ $number }}">{{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="hidden" id="id" value="{{ $restaurants[0]->id }}">
                                                <canvas id="barChart"></canvas>
                                            </div>
                                            <div class="col-4 pe-5">
                                                <h2>Top 5 Piatti del mese</h2>
                                                <canvas id="doughnutChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let chart;
        let doughnut;
        const idrest = document.getElementById("id").value;
        const ctx = document.getElementById('barChart');
        const ctxx = document.getElementById('doughnutChart');

        function creationGraph(orders, month, year) {
            const monthNames = [
                "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno",
                "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
            ];

            // Converti il numero del mese in nome del mese
            const monthName = monthNames[month - 1];

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: orders.map(row => row.day),
                    datasets: [{
                        label: "Ordini nel mese di " + monthName + " " + year,
                        data: orders.map(row => row.ordini),
                    }]
                }
            });
        }

        function calcDays(nGiorni, results) {
            for (i = 0; i < parseInt(nGiorni); i++) {
                if (!results[i]) {
                    let obj = {
                        ordini: 0,
                        day: i + 1
                    };
                    results.splice(i, 0, obj);
                } else if (i + 1 != results[i].day) {
                    let obj = {
                        ordini: 0,
                        day: i + 1
                    };
                    results.splice(i, 0, obj);
                }
            }
            return results;
        }

        function getDoughnut() {
            $.ajax({
                url: '/api/graph/doughnut',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: idrest,
                },
                success: function(data) {
                    const res = data.results;

                    doughnut = new Chart(ctxx, {
                        type: 'doughnut',
                        data: {
                            labels: res.map(row => row.piatto),
                            datasets: [{
                                label: res.map(row => row.piatto),
                                data: res.map(row => row.ordini),
                                backgroundColor: ['rgb(255,0,0)', 'rgb(0,0,255)',
                                    'rgb(255,205,86)', 'rgb(0,255,0)', 'rgb(41,0,61)',
                                ],
                                hoverOffeset: 4
                            }]
                        }
                    })

                }

            })
        }

        function getGraph() {
            let year = document.getElementById("year").value;
            let month = document.getElementById("month").value;
            let today = new Date();
            let meseCorrente = today.getMonth() + 1;
            let annoCorrente = today.getFullYear(); // Ottenere l'anno corrente
            let numeroGiorniMeseCorrente;

            $.ajax({
                url: '/api/graph',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: idrest,
                    year: year,
                    month: month
                },
                success: function(data) {
                    const results = data.results;

                    if (chart) {
                        chart.destroy();
                    }


                    if (year && month) {
                        numeroGiorniMeseCorrente = new Date(year, month, 0).getDate();
                        calcDays(numeroGiorniMeseCorrente, results);
                        creationGraph(results, month, year)
                    } else if (year) {
                        for (i = 0; i < 12; i++) {
                            if (!results[i]) {
                                let obj = {
                                    ordini: 0,
                                    month: i + 1
                                };
                                results.splice(i, 0, obj);
                            } else if (i + 1 != results[i].month) {
                                let obj = {
                                    ordini: 0,
                                    month: i + 1
                                };
                                results.splice(i, 0, obj);
                            }
                        }
                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: results.map(row => row.month),
                                datasets: [{
                                    label: "Ordini del " + year,
                                    data: results.map(row => row.ordini),
                                }]
                            }
                        })
                    } else {
                        if (month)
                            numeroGiorniMeseCorrente = new Date(annoCorrente, month, 0).getDate();
                        else {
                            month = meseCorrente;
                            numeroGiorniMeseCorrente = new Date(annoCorrente, month, 0).getDate();
                        }
                        calcDays(numeroGiorniMeseCorrente, results);
                        creationGraph(results, month, year);
                    }
                }
            })
        }
        getGraph();
        getDoughnut();
    </script>
@endsection
