<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;


class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?int $navigationSort = 0;
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
               Forms\Components\TextInput::make('registration_number')
                ->label('Registration Number')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),
            Forms\Components\TextInput::make('brand') // Changed from 'make' to 'brand'
                ->label('Brand')
                ->required()
                ->maxLength(50),
        
            Forms\Components\TextInput::make('model')
                ->label('Model')
                ->required()
                ->maxLength(50),
        
            Forms\Components\TextInput::make('year')
            ->label('Year')
            ->required()
            ->numeric()
            ->minValue(1981) // Ensures year > 1980
            ->maxValue(now()->year) // Sets max to current year
            ->rules([
                'integer',
                'min:1981',
                'max:'.now()->year, // Dynamic current year validation
                'gt:1980' // Explicit greater than 1980 rule
            ]),
        
            Forms\Components\TextInput::make('color')
                ->label('Color')
                ->required()
                ->maxLength(20)
                ->rules(['regex:/^[a-zA-Z\s]+$/']), // Only letters and spaces
        
            Forms\Components\Select::make('fuel_type')
            ->label('Fuel Type')
            ->options([
                'petrol' => 'Petrol',
                'diesel' => 'Diesel',
                'electric' => 'Electric',
            ])
            ->nullable()
            ->required()
            ->native(false) // Optional: forces use of custom select UI
                ,
                Forms\Components\Select::make('seats')
                ->label('seats')
                ->options([
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ])
                ->nullable()
                ->required()
                ->native(false) // Optional: forces use of custom select UI
        ,
        
            Forms\Components\Select::make('engine')
            ->label('Transmission Type')
            ->options([
                'auto' => 'Auto',
                'manual' => 'Manual',
            ])
            ->default('Auto')
            ->required(),
        
            Forms\Components\Repeater::make('images')
                ->relationship()
                ->label('Vehicle Images')
                ->schema([
                    Forms\Components\FileUpload::make('url')
                        ->label('Image')
                        ->image()
                        ->directory('vehicles')
                        ->preserveFilenames()
                        ->imageEditor()
                        ->required()
                        ->visibility('public')
                        ->imagePreviewHeight('250')
                        ->disk('public'),
                ])
                ->collapsible()
                ->itemLabel(function (array $state): ?string {
                    $url = is_array($state['url'] ?? null) ? $state['url'][0] ?? null : $state['url'] ?? null;
                    return $url ? basename($url) : null;
                })
                ->grid(2)
                ->columnSpanFull()
                ->maxItems(4) // Limits to maximum 4 images
                ->helperText('Maximum 4 images allowed') // Optional helper text
                ,
        
         
        
                Forms\Components\TextInput::make('mileage')
                ->label('Mileage (km)')
                ->numeric()
                ->minValue(0)
                ->required()
                ->maxValue(200000)
                ->step(1)
                
                ->rules([
                    'integer',
                    'min:0',
                    'max:1000000'
                ])
                ->suffix(' km')
                ->default(0)
                ->helperText('Current vehicle mileage in kilometers'),
        
                Forms\Components\TextInput::make('fuel_efficiency')
    ->label('Efficiency')
    ->numeric()
    ->required()
    ->minValue(0)
    ->maxValue(40) // Adjust based on realistic values
    ->step(0.1) // Allows decimal values
    ->suffix('km per one unit') // Visual indicator
    ->rules([
        'numeric',
        'min:0',
        'max:40'
    ])
    ->helperText('Fuel consumption in kilometers per one unit'),

     Forms\Components\Toggle::make('is_available')
                ->label('Is Available')
                ->default(true),

            Forms\Components\TextInput::make('daily_rate')
                ->label('Daily Rate')
                ->required()
                ->numeric()
                ->minValue(1000)
                ->prefix('MAD')
        
           
        ]);
    }

    public static function table(Table $table): Table
    {
      

    return $table
    ->columns([
        // TextColumn::make('vehicle_id')
        //     ->label('ID')
        //     ->sortable()
        //     ->searchable()
        //   ,

            TextColumn::make('registration_number')
            ->label('Reg No')
            ->searchable()
             ->sortable()
            ->copyable()  // Allows copying with click
            ->copyMessage('Registration number copied')
            ->copyMessageDuration(1500),
            
        TextColumn::make('brand')  // Changed from 'make' to 'brand'
            ->label('Vehicle')
            ->sortable()
            ->searchable()
            ->weight('medium')  // Makes text slightly bold
            ->description(fn (Vehicle $record): string => $record->model),  // Shows model below brand

        TextColumn::make('year')
            ->label('Year')
            ->sortable()
            ->searchable()
            ->alignCenter()
            ->formatStateUsing(function ($state) {
            // Ensure year is a 4-digit integer between 1980 and current year
            $year = (int) $state;
            $currentYear = (int) now()->year;
            if ($year >= 1980 && $year <= $currentYear && preg_match('/^\d{4}$/', (string)$year)) {
                return $year;
            }
            return 'Invalid';
            }),

        ImageColumn::make('featured_image')  // Changed to use the accessor
            ->label('Image')
            ->height(50)
            ->width(50)
            ->disk('public')
            ->visibility('public')
            ->alignCenter(),

        TextColumn::make('fuel_type')
            ->label('Fuel')
            ->sortable()
            ->searchable()
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'petrol' => 'warning',
                'diesel' => 'gray',
                'electric' => 'success',
                'hybrid' => 'info',
                default => 'primary',
            }),

    

     
            
            TextColumn::make('seats')
            ->label('Seats')
            ->numeric()
            ->sortable()
            ->icon('heroicon-o-users')
            ->alignCenter(),
            TextColumn::make('fuel_efficiency')
    ->label('Efficiency')
    ->sortable()
    ->suffix(' km/l'),
            TextColumn::make('engine')
    ->label('Transmission')
    ->sortable()
    ->searchable(),
    //->description(fn (Vehicle $record): string => $record->fuel_efficiency ?? ''),

        TextColumn::make('daily_rate')
            ->label('Daily Rate')
            ->sortable()
            ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', ' ') . ' MAD')
            ->alignRight()
            ->color('success')
            ->weight('medium'),

        IconColumn::make('is_available')
            ->label('Available')
            ->boolean()
            ->trueIcon('heroicon-o-check-circle')
            ->falseIcon('heroicon-o-x-circle')
            ->trueColor('success')
            ->falseColor('danger')
            ->sortable()
            ->alignCenter(),

    ])
    
         
            ->filters([
                //
                        ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}