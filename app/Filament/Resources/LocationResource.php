<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Place Name Field
                Forms\Components\TextInput::make('place_name')
                    ->label('Place Name')
                    ->required(),

                // Latitude Field (Readonly and filled via map)
                Forms\Components\TextInput::make('latitude')
                    ->label('Latitude')
                    ->readonly()
                    ->required(),

                // Longitude Field (Readonly and filled via map)
                Forms\Components\TextInput::make('longitude')
                    ->label('Longitude')
                    ->readonly()
                    ->required(),

                // Lead Time (Notification lead time before overpass)
                Forms\Components\TextInput::make('lead_time')
                    ->label('Notification Lead Time (minutes)')
                    ->numeric() // Ensure it's a number input
                    ->minValue(0) // Minimum lead time of 0 minutes
                    ->default(30) // Default lead time is 30 minutes
                    ->required(),

                // Notification Method (Dropdown for notification methods)
                Forms\Components\Select::make('notification_method')
                    ->label('Notification Method')
                    ->options([
                        'email' => 'Email',
                        'sms' => 'SMS',
                        'both' => 'Both',
                    ])
                    ->default('email') // Default to email notifications
                    ->required(),

                // Cloud Coverage Threshold (Maximum cloud coverage)
                Forms\Components\TextInput::make('cloud_threshold')
                    ->label('Maximum Cloud Coverage (%)')
                    ->numeric() // Ensure it's a number input
                    ->minValue(0)
                    ->maxValue(100) // Cloud coverage should be between 0% and 100%
                    ->default(15) // Default to 15% cloud coverage
                    ->required(),

                // Automatically assign the authenticated user's ID to the user_id field
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id)
                    ->required(),//.
                    // ->exists(),

                // Render the map as a View component
                Forms\Components\View::make('components.map'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(\App\Models\Location::where('user_id', Auth::user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('place_name')->label('Place Name'),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude'),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude'),
                Tables\Columns\TextColumn::make('lead_time')->label('Lead Time (minutes)'),
                Tables\Columns\TextColumn::make('notification_method')->label('Notification Method'),
                Tables\Columns\TextColumn::make('cloud_threshold')->label('Cloud Coverage (%)'),
            ])
            // ->modifyQueryUsing(function(Builder $builder){
            //     // Filter by user_id
            //     return $builder->where('user_id', Auth::id());
            // })
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
