<!-- resources/views/admin/mood_configurations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Moods</h2>

    @if (session('success'))
        <div class="mt-3 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Mood</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moods as $mood)
                <tr>
                    <td>{{ $mood->user->name }}</td>
                    <td>{{ $mood->mood }}</td>
                    {{-- <a href="/admin/moods/{{ $mood->id }}/edit">Edit Mood {{ $mood->id }}</a> --}}
                    {{-- <td>{{ $mood->mood }}</td> --}}
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/admin/moods/{{ $mood->id }}/edit" class="btn btn-warning me-2"><i
                                    class="text-white bi bi-pencil-fill"></i></a>

                            {{-- <form action="/admin/mood-configurations/destroy{{ $config }}" method="POST"
                                class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="text-white bi bi-trash3-fill"></i></button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Line Chart</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        // Assume $moodData is the array of mood data from Laravel
                        var moodData = @json($moods);

                        var labels = moodData.map(mood => mood.survey_date);
                        var data = moodData.map(mood => mood.mood);

                        new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Mood Chart',
                                    data: data,
                                    fill: false,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value, index, values) {
                                                // Menyesuaikan label dengan kategori mood
                                                return ['Sangat Baik', 'Baik', 'Netral', 'Buruk', 'Sangat Buruk'][
                                                    value
                                                ];
                                            }
                                        }
                                    },
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day'
                                        },
                                        title: {
                                            display: true,
                                            text: 'Tanggal'
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
                <!-- End Line Chart -->

            </div>
        </div>
    </div> --}}

    {{-- <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Line Chart</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        // Assume $moods is the array containing mood data from Laravel
                        var moods = @json($moods);

                        // Initialize an object to store datasets for each user
                        var userDatasets = {};

                        // Iterate through moods and organize data by user
                        moods.forEach(mood => {
                            // Ensure that the user's dataset is initialized
                            userDatasets[mood.user.name] = userDatasets[mood.user.name] || {
                                label: mood.user.name,
                                data: [],
                                borderColor: getRandomColor(),
                                fill: false,
                                tension: 0.1
                            };

                            // Add mood data to the user's dataset
                            // userDatasets[mood.user.name].data.push({
                            //     x: new Date(mood.survey_date),
                            //     y: mood.mood
                            // });
                        });

                        // Convert userDatasets object to an array for Chart.js
                        var datasets = Object.values(userDatasets);

                        new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                datasets: datasets
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value, index, values) {
                                                return ['Sangat Baik', 'Baik', 'Netral', 'Buruk', 'Sangat Buruk'][
                                                    value
                                                ];
                                            }
                                        }
                                    },
                                    // x: {
                                    //     type: 'time',
                                    //     time: {
                                    //         unit: 'day'
                                    //     },
                                    //     title: {
                                    //         display: true,
                                    //         text: 'Tanggal'
                                    //     }
                                    // }
                                }
                            }
                        });

                        // Function to generate random color for each user
                        function getRandomColor() {
                            var letters = '0123456789ABCDEF';
                            var color = '#';
                            for (var i = 0; i < 6; i++) {
                                color += letters[Math.floor(Math.random() * 16)];
                            }
                            return color;
                        }
                    });
                </script>
                <!-- End Line Chart -->

            </div>
        </div>
    </div> --}}
@endsection
