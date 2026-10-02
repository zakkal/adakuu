@extends('layouts.admin')

@section('title', 'Admin Dashboard — Adakuu')

@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan bisnis dan statistik penjualan')

@section('content')

    {{-- Info Box untuk Cost Price --}}
    @if($omzetBersih == $omzetKotor)
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-300 p-6 rounded-2xl mb-6 shadow-sm">
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white text-2xl shrink-0">
                💡
            </div>
            <div class="flex-1">
                <h3 class="text-base font-black text-blue-900 mb-2">Cara Mengatur Harga Modal untuk Perhitungan Omzet Bersih</h3>
                <p class="text-sm text-blue-800 leading-relaxed mb-4">
                    <strong>Omzet Bersih = Omzet Kotor - Total Modal</strong><br>
                    Saat ini omzet bersih Anda sama dengan omzet kotor karena <strong class="bg-yellow-200 px-1 rounded">belum ada data harga modal produk</strong>. 
                    Untuk mendapatkan perhitungan profit yang akurat, ikuti langkah berikut:
                </p>
                
                <div class="bg-white border border-blue-200 rounded-xl p-4 space-y-3">
                    <h4 class="text-sm font-bold text-gray-900">📋 Langkah-Langkah:</h4>
                    <ol class="text-sm text-gray-700 space-y-2 list-decimal list-inside">
                        <li>Buka menu <strong>"Kelola Produk"</strong> di sidebar</li>
                        <li>Klik tombol <strong>"Edit"</strong> pada produk yang ingin diatur</li>
                        <li>Scroll ke bagian <strong>"Daftar Paket"</strong></li>
                        <li>Klik <strong>"✏️ Edit"</strong> pada setiap paket</li>
                        <li>Isi field <strong>"Harga Modal (Rp)"</strong> dengan cost price produk</li>
                        <li>Klik <strong>"Update"</strong> untuk menyimpan</li>
                    </ol>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-3">
                        <p class="text-xs text-blue-800">
                            <strong>💰 Contoh:</strong><br>
                            • Harga Jual: Rp 49.000<br>
                            • Harga Modal: Rp 25.000<br>
                            • Keuntungan per item: Rp 24.000<br>
                            <br>
                            <strong>Jika terjual 10x:</strong><br>
                            • Omzet Kotor: Rp 490.000<br>
                            • Total Modal: Rp 250.000<br>
                            • <span class="text-emerald-600 font-black">Omzet Bersih: Rp 240.000</span>
                        </p>
                    </div>
                </div>
                
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-flex items-center space-x-2 mt-4 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Set Harga Modal Sekarang</span>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Omzet Kotor --}}
        <div class="bg-white rounded-2xl border border-gray-100 card-shadow p-6 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Omzet Kotor</span>
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-lg">💰</div>
            </div>
            <p class="text-2xl font-black text-gray-900">Rp{{ number_format($omzetKotor, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">Total pendapatan kotor</p>
        </div>

        {{-- Omzet Bersih --}}
        <div class="bg-white rounded-2xl border border-gray-100 card-shadow p-6 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Omzet Bersih</span>
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 text-lg">📈</div>
            </div>
            <p class="text-2xl font-black text-emerald-600">Rp{{ number_format($omzetBersih, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">Keuntungan bersih (setelah modal)</p>
            <div class="pt-2 mt-2 border-t border-gray-100">
                <p class="text-[10px] text-gray-400">
                    💡 Omzet Bersih = Omzet Kotor - Total Modal<br>
                    <span class="font-semibold">Modal diatur di "Kelola Produk" → Edit Package</span>
                </p>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="bg-white rounded-2xl border border-gray-100 card-shadow p-6 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Orders</span>
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-lg">📦</div>
            </div>
            <p class="text-2xl font-black text-gray-900">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-500">
                <span class="text-red-600 font-bold">{{ $paidOrders }}</span> Paid ·
                <span class="text-blue-600 font-bold">{{ $processingOrders }}</span> Processing ·
                <span class="text-emerald-600 font-bold">{{ $completedOrders }}</span> Completed
            </p>
        </div>

        {{-- Total Produk --}}
        <div class="bg-white rounded-2xl border border-gray-100 card-shadow p-6 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</span>
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 text-lg">🛍️</div>
            </div>
            <p class="text-2xl font-black text-gray-900">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-500">Produk aktif di katalog</p>
        </div>
    </div>

    {{-- Sales Chart --}}
    <div class="bg-white rounded-3xl border border-gray-100 card-shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-black text-gray-900">Grafik Penjualan</h2>
                <p class="text-xs text-gray-500">Omzet kotor vs keuntungan bersih (12 bulan terakhir)</p>
            </div>
        </div>
        <div class="relative" style="height: 320px;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="bg-white rounded-3xl border border-gray-100 card-shadow overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-black text-gray-900">Pesanan Terbaru</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-400 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Order ID</th>
                        <th class="py-4 px-6">Customer</th>
                        <th class="py-4 px-6">Produk</th>
                        <th class="py-4 px-6">Total</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="py-4 px-6 font-black text-gray-900">#{{ $order->order_number }}</td>
                        <td class="py-4 px-6 font-bold text-gray-900">{{ $order->customer_name }}</td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-gray-900 block">{{ $order->package->product->name ?? '-' }}</span>
                            <span class="text-gray-500 text-[11px]">{{ $order->package->name ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-6 font-black text-red-600">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold inline-block
                                @if($order->order_status == 'COMPLETED') bg-emerald-100 text-emerald-800
                                @elseif($order->order_status == 'PROCESSING') bg-blue-100 text-blue-800
                                @elseif($order->order_status == 'PAID') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    
    // Pareto Chart Style (Bar + Cumulative Line)
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                // Bar Chart - Omzet Kotor
                {
                    type: 'bar',
                    label: 'Omzet Kotor (Rp)',
                    data: {!! json_encode($chartRevenue) !!},
                    backgroundColor: 'rgba(220, 38, 38, 0.8)',
                    borderColor: 'rgb(220, 38, 38)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.5,
                    categoryPercentage: 0.7,
                    yAxisID: 'y',
                    order: 2
                },
                // Bar Chart - Keuntungan Bersih
                {
                    type: 'bar',
                    label: 'Keuntungan Bersih (Rp)',
                    data: {!! json_encode($chartProfit) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.5,
                    categoryPercentage: 0.7,
                    yAxisID: 'y',
                    order: 3
                },
                // Cumulative Line (Persentase Kumulatif)
                {
                    type: 'line',
                    label: 'Kumulatif Omzet (%)',
                    data: (() => {
                        // Calculate cumulative percentage
                        const revenue = {!! json_encode($chartRevenue) !!};
                        const total = revenue.reduce((a, b) => a + b, 0);
                        let cumulative = 0;
                        return revenue.map(val => {
                            cumulative += val;
                            return total > 0 ? (cumulative / total * 100) : 0;
                        });
                    })(),
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'transparent',
                    borderWidth: 4,
                    tension: 0.3,
                    pointRadius: 6,
                    pointHoverRadius: 9,
                    pointBackgroundColor: 'rgb(239, 68, 68)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointHoverBorderWidth: 4,
                    yAxisID: 'y1',
                    order: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: {
                            size: 13,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#1f2937',
                        generateLabels: (chart) => {
                            const datasets = chart.data.datasets;
                            return datasets.map((dataset, i) => ({
                                text: dataset.label,
                                fillStyle: dataset.type === 'line' ? dataset.borderColor : dataset.backgroundColor,
                                strokeStyle: dataset.borderColor,
                                lineWidth: dataset.type === 'line' ? 3 : 0,
                                hidden: !chart.isDatasetVisible(i),
                                datasetIndex: i,
                                pointStyle: dataset.type === 'line' ? 'circle' : 'rect'
                            }));
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.97)',
                    padding: 16,
                    titleColor: '#fff',
                    titleFont: {
                        size: 14,
                        weight: 'bold',
                        family: 'Plus Jakarta Sans'
                    },
                    bodyColor: '#fff',
                    bodyFont: {
                        size: 14,
                        family: 'Plus Jakarta Sans'
                    },
                    bodySpacing: 10,
                    borderColor: 'rgba(255, 255, 255, 0.15)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: true,
                    usePointStyle: true,
                    callbacks: {
                        title: function(context) {
                            return '📊 ' + context[0].label;
                        },
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                if (context.dataset.yAxisID === 'y1') {
                                    // Percentage for cumulative line
                                    label += context.parsed.y.toFixed(1) + '%';
                                } else {
                                    // Currency for bars
                                    label += 'Rp' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    border: {
                        display: true,
                        color: '#d1d5db',
                        width: 2
                    },
                    grid: {
                        color: '#f3f4f6',
                        lineWidth: 1.5
                    },
                    ticks: {
                        maxTicksLimit: 7,
                        callback: function(value) {
                            if (value >= 1000000) {
                                return 'Rp' + (value / 1000000).toFixed(1) + 'jt';
                            } else if (value >= 1000) {
                                return 'Rp' + (value / 1000).toFixed(0) + 'k';
                            }
                            return 'Rp' + value.toLocaleString('id-ID');
                        },
                        font: {
                            size: 12,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#6B7280',
                        padding: 12
                    },
                    title: {
                        display: true,
                        text: 'Pendapatan (Rp)',
                        font: {
                            size: 12,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#374151',
                        padding: 10
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    min: 0,
                    max: 100,
                    border: {
                        display: true,
                        color: '#fca5a5',
                        width: 2
                    },
                    grid: {
                        drawOnChartArea: false
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        },
                        font: {
                            size: 12,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#dc2626',
                        padding: 12
                    },
                    title: {
                        display: true,
                        text: 'Kumulatif (%)',
                        font: {
                            size: 12,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#dc2626',
                        padding: 10
                    }
                },
                x: {
                    border: {
                        display: true,
                        color: '#d1d5db',
                        width: 2
                    },
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold',
                            family: 'Plus Jakarta Sans'
                        },
                        color: '#374151',
                        padding: 12,
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>
@endpush


