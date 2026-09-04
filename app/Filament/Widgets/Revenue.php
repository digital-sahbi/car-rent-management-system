<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;

class Revenue extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public function getTableRecordKey(Model $record): string
    {
        return $record->day; // Use day as key for daily records
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('print')
                    ->label('🖨️ Print Report')
                    ->url(route('print.daily.revenue')) // Named route (recommended)
                    ->openUrlInNewTab(), // Optional: opens in a new tab
            ])
            ->query(
                Reservation::query()
                    ->selectRaw('DATE(created_at) as day')
                    ->selectRaw('SUM(total_cost) as revenue')
                    ->where('status', 'confirmed')
                    ->groupBy('day')
                    ->orderBy('day', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->label('Date')
                    ->date('Y-m-d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('revenue')
                    ->label('Revenue')
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', ' ') . ' MAD')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('month')
                    ->label('Month')
                    ->options([
                        '01' => 'January',
                        '02' => 'February',
                        '03' => 'March',
                        '04' => 'April',
                        '05' => 'May',
                        '06' => 'June',
                        '07' => 'July',
                        '08' => 'August',
                        '09' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $month): Builder =>
                                $query->whereMonth('created_at', $month)
                        );
                    }),

                Tables\Filters\SelectFilter::make('year')
                    ->options(function () {
                        return Reservation::query()
                            ->selectRaw('YEAR(created_at) as year')
                            ->groupBy('year')
                            ->pluck('year', 'year')
                            ->toArray();
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $year): Builder =>
                                $query->whereYear('created_at', $year)
                        );
                    }),
            ]);
    }
}
