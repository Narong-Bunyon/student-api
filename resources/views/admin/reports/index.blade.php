@extends('admin.layout')

@section('content')
    <!-- Page Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Analytics &amp; Reports</h2>
            <p class="text-sm text-slate-500 mt-0.5">Comprehensive audit, circulation trends, category breakdown, and member engagement insights.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                <span>Print Report</span>
            </button>
            <a href="{{ route('borrowings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#4b3ecb] hover:bg-[#3f32b6] text-white text-xs font-bold shadow-lg shadow-indigo-900/20 transition transform active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Export Records</span>
            </a>
        </div>
    </div>

    <!-- 4 High Level KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Circulation Rate -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Circulation Rate</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $circulationRate }}%</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>Healthy inventory turnover</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
        </div>

        <!-- Return Rate -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Return Completion</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $returnRate }}%</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-2">
                    <span>{{ $returnedCount }} of {{ $totalBorrowings }} returned</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Overdue Alerts -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Overdue Alerts</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $overdueCount }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-rose-500 mt-2">
                    <span>Past 14 days lending period</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>

        <!-- Catalog Size -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Inventory</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $totalBooks }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-sky-600 mt-2">
                    <span>Across {{ $totalCategories }} categories</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        <!-- Monthly Lending Trend -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>Circulation Volume (Monthly)</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Total books borrowed and returned during this academic semester</p>
                </div>
            </div>
            <div class="h-64 relative w-full">
                <canvas id="monthlyTrendChart"></canvas>
            </div>
        </div>

        <!-- Category Distribution Breakdown -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                    <span>Books Distribution by Category</span>
                </h3>
            </div>
            <div class="h-56 relative w-full flex items-center justify-center">
                <canvas id="reportCategoryDonut"></canvas>
            </div>
            <div class="pt-3 border-t border-slate-100 text-center">
                <span class="text-xs font-semibold text-slate-500">Most stocked topic: <strong class="text-slate-800">{{ $categoriesBreakdown->first()->name ?? 'N/A' }}</strong> ({{ $categoriesBreakdown->first()->books_count ?? 0 }} books)</span>
            </div>
        </div>
    </div>

    <!-- Category Distribution Performance Table & Most Borrowed Books -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Category Analysis -->
        <div class="lg:col-span-7 bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Category Breakdown &amp; Share</span>
                </h3>
                <a href="{{ route('categories.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">Manage</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 font-semibold border-b border-slate-100 uppercase tracking-wider">
                            <th class="py-2.5 px-3">Category</th>
                            <th class="py-2.5 px-3 text-center">Books Count</th>
                            <th class="py-2.5 px-3 text-center">Share</th>
                            <th class="py-2.5 px-3">Distribution Bar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @foreach($categoriesBreakdown as $cat)
                            @php
                                $percent = $totalBooks > 0 ? round(($cat->books_count / $totalBooks) * 100, 1) : 0;
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-3 px-3 font-bold text-slate-800">{{ $cat->name }}</td>
                                <td class="py-3 px-3 text-center font-semibold text-slate-700">{{ $cat->books_count }}</td>
                                <td class="py-3 px-3 text-center text-slate-500 font-semibold">{{ $percent }}%</td>
                                <td class="py-3 px-3 w-40">
                                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Active Members / Borrowers -->
        <div class="lg:col-span-5 bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Most Active Readers</span>
                </h3>
                <a href="{{ route('users.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">View Members</a>
            </div>

            <div class="space-y-3">
                @forelse($topMembers as $idx => $member)
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50/60 border border-slate-100">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full {{ $idx === 0 ? 'bg-amber-400 text-white' : 'bg-slate-200 text-slate-700' }} flex items-center justify-center font-bold text-xs shrink-0">
                                {{ $idx + 1 }}
                            </span>
                            <div>
                                <span class="font-bold text-slate-800 block text-xs">{{ $member->name }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ $member->email }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                {{ $member->borrowings_count }} loans
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-xs text-center py-6 text-slate-400">No member activity recorded yet.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Monthly Lending Trend Chart
            const trendCanvas = document.getElementById('monthlyTrendChart');
            if (trendCanvas) {
                new Chart(trendCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                        datasets: [
                            {
                                label: 'Borrowed',
                                data: [18, 24, 19, 32, 28, 38],
                                backgroundColor: '#5b51d8',
                                borderRadius: 8,
                                barThickness: 18
                            },
                            {
                                label: 'Returned',
                                data: [14, 20, 16, 29, 25, 34],
                                backgroundColor: '#cbd5e1',
                                borderRadius: 8,
                                barThickness: 18
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end',
                                labels: { boxWidth: 12, font: { size: 11, weight: '600' }, color: '#64748b' }
                            }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                            y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8' } }
                        }
                    }
                });
            }

            // 2. Report Category Donut Chart
            const catCanvas = document.getElementById('reportCategoryDonut');
            if (catCanvas) {
                const categoryLabels = {!! json_encode($categoriesBreakdown->pluck('name')) !!};
                const categoryData = {!! json_encode($categoriesBreakdown->pluck('books_count')) !!};

                new Chart(catCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: categoryLabels.length ? categoryLabels : ['General'],
                        datasets: [{
                            data: categoryData.length && categoryData.some(v => v > 0) ? categoryData : [1],
                            backgroundColor: ['#5b51d8', '#38bdf8', '#818cf8', '#fbbf24', '#34d399', '#94a3b8'],
                            borderWidth: 0,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: { boxWidth: 10, font: { size: 10, weight: '600' }, color: '#475569' }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
