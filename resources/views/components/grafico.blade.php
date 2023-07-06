<div class="row px-sm-2 px-0 py-1 align-items-center justify-content-center border border-4 border-{{ $this->cor1 }}-active rounded"
    style="min-height: 20em; max-height: 70em;" x-data="{ isMobile: window.innerWidth < 768 }" x-init="() => {
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth < 768;
        });
    }">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas class=" w-75 h-75 radarChart"></canvas>
   

    <script>
        const data = {
            labels: {!! json_encode($this->titulosSub) !!},
            datasets: [{
                label: '{{ $this->titulo }}',
                data: {!! json_encode($this->medias) !!},
                fill: true,
                backgroundColor: "{{ $this->cor2 == 'secondary' ? 'rgba(255, 175, 2, 0.62)' : 'rgba(0, 74, 173, 0.35)' }}",
                borderColor: "{{ $this->cor2 == 'secondary' ? '#FFAF02' : '#004AAD' }}",
                pointBackgroundColor: "{{ $this->cor2 == 'secondary' ? '#FFAF02' : '#004AAD' }}",
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: "{{ $this->cor2 == 'secondary' ? 'rgb(255, 99, 132)' : '#004AAD' }}"
            }]
        };
    </script>

    <template x-if="!isMobile">
        <script>
            const config = {
                type: 'radar',
                data: data,
                options: {
                    elements: {
                        line: {
                            borderWidth: 4
                        },
                        point: {
                            radius: 5, // define o raio do ponto como 5 pixels
                            pointHoverRadius: 8, // raio do ponto quando hover
                            pointHitRadius: 15 // área de detecção do ponto para hover
                        }
                    },
                    scales: {
                        r: {
                            pointLabels: {
                                display: true,
                                centerPointLabels: true,
                                font: {
                                    size: 15
                                }
                            },
                            suggestedMin: 1,
                            suggestedMax: 5,
                            ticks: {
                                stepSize: 0.5
                            }
                        }
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 10
                            }
                        }
                    }
                },
            };

            const myChart = new Chart(
                document.getElementsByClassName('radarChart'),
                config
            );
        </script>
    </template>

    <template x-if="isMobile">
        <script>
            const config = {
                type: 'radar',
                data: data,
                options: {
                    elements: {
                        line: {
                            borderWidth: 3,
                            pointHoverRadius: 8, // raio do ponto quando hover
                            pointHitRadius: 15, // área de detecção do ponto para hover
                            pointHitRadius: 20 // área de detecção do ponto para clique
                        }
                    },
                    scales: {
                        r: {
                            pointLabels: {
                                display: true,
                                centerPointLabels: true,
                                font: {
                                    size: 10
                                }
                            },
                            suggestedMin: 1,
                            suggestedMax: 5,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 10
                            }
                        }
                    }
                },
            };

            const myChart = new Chart(
                document.getElementsByClassName('radarChart'),
                config
            );
        </script>
    </template>

</div>
