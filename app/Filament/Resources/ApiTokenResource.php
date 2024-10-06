<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApiTokenResource\Pages;
use App\Filament\Resources\ApiTokenResource\RelationManagers;
use App\Models\ApiToken;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ApiTokenResource extends Resource
{
    protected static ?string $model = ApiToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('token')
                ->label('API Token')
                ->required(),
            Forms\Components\Hidden::make('user_id')
                ->default(Auth::id())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(\App\Models\ApiToken::where('user_id', Auth::user()->id))//Location

            // ->query(function (Builder $query) {
            //     return $query->where('user_id', Auth::id());
            // })
            ->columns([
                Tables\Columns\TextColumn::make('token')
                    ->label('API Token'),
                Tables\Columns\TextColumn::make('user_id')
                    ->label('User ID')
                    ->visible(false),
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
            'index' => Pages\ListApiTokens::route('/'),
            'create' => Pages\CreateApiToken::route('/create'),
            'edit' => Pages\EditApiToken::route('/{record}/edit'),
        ];
    }
}
