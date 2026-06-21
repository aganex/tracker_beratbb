@push('scripts')
    <script>
        window.onload = function () {
            const labels = [
                @foreach ($riwayatGrafik as $item)
                    '{{ \Carbon\Carbon::parse($item->tanggal)->format('d M') }}',
                @endforeach
            ];

            const dataBerat = [
                @foreach ($riwayatGrafik as $item)
                    {{ $item->berat }},
                @endforeach
            ];

            const targetBerat = {{ $user->target_berat ?? 'null' }};

            // =====================================================
            // CARI INDEX NILAI TERTINGGI & TERENDAH
            // =====================================================
            const maxValue = Math.max(...dataBerat);
            const minValue = Math.min(...dataBerat);

            const pointColors = dataBerat.map(function (berat) {
                if (berat === maxValue) return '#dc3545';
                if (berat === minValue) return '#198754';
                return '#1ca3e0';
            });

            const pointRadiuses = dataBerat.map(function (berat) {
                return (berat === maxValue || berat === minValue) ? 6 : 4;
            });

            // =====================================================
            // GRADIENT FILL
            // =====================================================
            const ctx = document.getElementById('beratChart');
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, 'rgba(28, 163, 224, 0.35)');
            gradient.addColorStop(1, 'rgba(28, 163, 224, 0.02)');

            // =====================================================
            // SUSUN DATASET
            // =====================================================
            const datasets = [{
                label: 'Berat Badan (kg)',
                data: dataBerat,
                borderColor: '#1ca3e0',
                backgroundColor: gradient,
                borderWidth: 3,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: pointColors,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: pointRadiuses,
                pointHoverRadius: 7
            }];

            if (targetBerat) {
                datasets.push({
                    label: 'Target Berat (kg)',
                    data: labels.map(function () { return targetBerat; }),
                    borderColor: '#6c757d',
                    borderWidth: 2,
                    borderDash: [6, 6],
                    pointRadius: 0,
                    fill: false
                });
            }

            // =====================================================
            // RENDER CHART
            // =====================================================
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    if (context.dataset.label === 'Target Berat (kg)') {
                                        return 'Target: ' + context.parsed.y + ' kg';
                                    }

                                    const index = context.dataIndex;
                                    const beratSekarang = dataBerat[index];
                                    const beratSebelumnya = index > 0 ? dataBerat[index - 1] : null;

                                    let label = 'Berat: ' + beratSekarang + ' kg';

                                    if (beratSebelumnya !== null) {
                                        const selisih = (beratSekarang - beratSebelumnya).toFixed(1);
                                        const tanda = selisih > 0 ? '+' : '';
                                        label += ' (' + tanda + selisih + ' kg dari sebelumnya)';
                                    }

                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        };
    </script>
@endpush