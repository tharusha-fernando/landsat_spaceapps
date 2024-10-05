<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // return $form
        //     ->schema([
        //         //
        //     ]);
        // return $form
        //     ->schema([
        //         Forms\Components\TextInput::make('place_name')
        //             ->label('Place Name')
        //             ->required(),

        //         Forms\Components\TextInput::make('latitude')
        //             ->label('Latitude')
        //             ->required()
        //             ->disabled(), // We will update it via the map

        //         Forms\Components\TextInput::make('longitude')
        //             ->label('Longitude')
        //             ->required()
        //             ->disabled(), // We will update it via the map

        //         Forms\Components\Fieldset::make('Location Map')
        //             ->schema([
        //                 Forms\Components\View::make('components.map'),

        //                 // Forms\Components\Html::make('map')
        //                 //     ->html('<div id="map" style="height: 300px;"></div>')
        //                 //     ->columnSpan(2),
        //             ]),
        //     ]);
        return $form
            ->schema([
                Forms\Components\TextInput::make('place_name')
                    ->label('Place Name')
                    ->required(),

                Forms\Components\TextInput::make('latitude')
                    ->label('Latitude')
                    // ->hidden() // Hide this input in the form
                    ->disabled()
                    ->required(),

                Forms\Components\TextInput::make('longitude')
                    ->label('Longitude')
                    // ->hidden() // Hide this input in the form
                    ->disabled()
                    ->required(),
                // Automatically assign the authenticated user's ID to the user_id field
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id) // Set default to the authenticated user's ID()
                    ->required(),

                // Render the map as a View component
                Forms\Components\View::make('components.map'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->columns([
            //     //
            // ])
            ->columns([
                Tables\Columns\TextColumn::make('place_name')->label('Place Name'),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude'),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude'),
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
