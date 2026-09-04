<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Vehicle;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalCars = Vehicle::count();
        $availableCars = Vehicle::where('is_available', true)->count();
        $underMaintenance = Vehicle::where('is_available', false)->count();// Assuming a 'status' column exists
        $totalReservations = Reservation::count();
        // Get current month's income
        $monthlyIncome = DB::table('reservations')
            ->where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_cost');

            $dailyIncome = Reservation::where('status', 'confirmed')
            ->whereDate('created_at', today())
            ->sum('total_cost');
        return [
            Stat::make('Total Cars', $totalCars),
            Stat::make('Available Cars', $availableCars),
            Stat::make('Under Maintenance', $underMaintenance),
            Stat::make('Current Month Income', number_format((float) $monthlyIncome, 2, ',', ' ') . ' MAD')
            ->description('Confirmed reservations this month')
            ->descriptionIcon('heroicon-o-currency-dollar')
            ->color($monthlyIncome > 0 ? 'success' : 'danger')
            ->chart([/* optional chart data array */]),
            Stat::make('Today\'s Income', number_format((float) $dailyIncome, 2, ',', ' ') . ' MAD')
            ->description(now()->format('l, F j')) // e.g. "Monday, January 15"
            ->descriptionIcon('heroicon-o-calendar')
            ->color($dailyIncome > 0 ? 'success' : 'gray')
            ->chart([]),
            Stat::make('Total Recervation', $totalReservations),
        ];
    }
}
