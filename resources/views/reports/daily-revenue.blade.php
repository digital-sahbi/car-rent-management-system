<!-- resources/views/reports/revenue-report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .report-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .date-filters {
            display: none;
            gap: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .text-end {
            text-align: right;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .report-container {
                box-shadow: none;
                border-radius: 0;
                max-width: none;
                margin: 0;
                padding: 20px;
            }
            .header {
                margin-bottom: 30px;
            }
            .header h2 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 10px;
                border: 1px solid #333;
                text-align: left;
            }
            th {
                background-color: #f0f0f0;
                font-weight: bold;
            }
            .text-end, td:last-child {
                text-align: right;
            }
            /* Hide pagination in print */
            .pagination-container {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <h2 style="margin: 0;">{{ $title }}</h2>
            <div class="filter-group no-print">
                <form method="GET" id="reportForm" style="margin: 0; display: flex; gap: 10px; align-items: center;">
                    <select name="group_by" id="groupBySelect" style="padding: 8px 12px; border-radius: 4px; border: 1px solid #ddd;">
                        <option value="day" {{ $groupBy == 'day' ? 'selected' : '' }}>Daily</option>
                        <option value="month" {{ $groupBy == 'month' ? 'selected' : '' }}>Monthly</option>
                        <option value="year" {{ $groupBy == 'year' ? 'selected' : '' }}>Yearly</option>
                    </select>
                    
                    <div class="date-filters" id="dateFilters">
                        <select name="month" id="monthSelect" style="padding: 8px 12px; border-radius: 4px; border: 1px solid #ddd;">
                            <option value="">All Months</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ isset($selectedMonth) && $month == $selectedMonth ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                </option>
                            @endforeach
                        </select>
                        <select name="year" id="yearSelect" style="padding: 8px 12px; border-radius: 4px; border: 1px solid #ddd;">
                            <option value="">All Years</option>
                            @foreach(range(date('Y')-5, date('Y')) as $year)
                                <option value="{{ $year }}" {{ isset($selectedYear) && $year == $selectedYear ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                
                <button onclick="window.print()" style="padding: 8px 16px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Print Report
                </button>
            </div>
        </div>
        
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>
                            @if($groupBy == 'day')
                                Date
                            @elseif($groupBy == 'month')
                                Month
                            @else
                                Year
                            @endif
                        </th>
                        <th style="text-align: right;">Revenue (MAD)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            <td>
                                @if($groupBy == 'day')
                                    {{ \Carbon\Carbon::parse($record->period)->format('M d, Y') }}
                                @elseif($groupBy == 'month')
                                    {{ \Carbon\Carbon::createFromDate($record->year, $record->month, 1)->format('F Y') }}
                                @else
                                    {{ $record->period }}
                                @endif
                            </td>
                            <td style="text-align: right;">{{ number_format((float) $record->revenue, 2, ',', ' ') }} MAD</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align: center; padding: 40px; color: #666;">
                                @if($groupBy == 'day' && (isset($selectedMonth) || isset($selectedYear)))
                                    No revenue records found for 
                                    @if(isset($selectedMonth))
                                        {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }}
                                    @endif
                                    @if(isset($selectedYear))
                                        {{ $selectedYear }}
                                    @endif
                                @else
                                    No revenue records found
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="pagination-container no-print" style="display: flex; justify-content: center; margin-top: 20px;">
            <div style="display: flex; gap: 5px;">
                {{-- Previous Page Link --}}
                @if ($records->onFirstPage())
                    <span style="padding: 8px 12px; border: 1px solid #ddd; color: #999; border-radius: 4px;">&laquo;</span>
                @else
                    <a href="{{ $records->appends(request()->query())->previousPageUrl() }}" 
                       style="padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #333; border-radius: 4px;">&laquo;</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($records->getUrlRange(1, $records->lastPage()) as $page => $url)
                    @if ($page == $records->currentPage())
                        <span style="padding: 8px 12px; border: 1px solid #4f46e5; background-color: #4f46e5; color: white; border-radius: 4px;">{{ $page }}</span>
                    @else
                        <a href="{{ $records->appends(request()->query())->url($page) }}" 
                           style="padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #333; border-radius: 4px;">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($records->hasMorePages())
                    <a href="{{ $records->appends(request()->query())->nextPageUrl() }}" 
                       style="padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #333; border-radius: 4px;">&raquo;</a>
                @else
                    <span style="padding: 8px 12px; border: 1px solid #ddd; color: #999; border-radius: 4px;">&raquo;</span>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reportForm');
            const groupBySelect = document.getElementById('groupBySelect');
            const dateFilters = document.getElementById('dateFilters');
            const monthSelect = document.getElementById('monthSelect');
            const yearSelect = document.getElementById('yearSelect');
            
            // Show/hide date filters based on initial selection
            toggleDateFilters();
            
            // Add change event listeners that auto-submit the form
            groupBySelect.addEventListener('change', function() {
                toggleDateFilters();
                // Only reset month/year values when changing away from daily
                if (groupBySelect.value !== 'day') {
                    monthSelect.value = '';
                    yearSelect.value = '';
                }
                // Auto-submit the form
                form.submit();
            });
            
            // Add change listeners for month and year selects
            monthSelect.addEventListener('change', function() {
                if (groupBySelect.value === 'day') {
                    form.submit();
                }
            });
            
            yearSelect.addEventListener('change', function() {
                if (groupBySelect.value === 'day') {
                    form.submit();
                }
            });
            
            function toggleDateFilters() {
                if (groupBySelect.value === 'day') {
                    dateFilters.style.display = 'flex';
                    // Enable the selects
                    monthSelect.disabled = false;
                    yearSelect.disabled = false;
                } else {
                    dateFilters.style.display = 'none';
                    // Disable the selects so they don't interfere with form submission
                    monthSelect.disabled = true;
                    yearSelect.disabled = true;
                }
            }
        });
    </script>
</body>
</html>