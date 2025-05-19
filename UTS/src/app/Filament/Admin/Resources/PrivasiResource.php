<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PrivasiResource\Pages;
use App\Filament\Admin\Resources\PrivasiResource\RelationManagers;
use App\Models\Privasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrivasiResource extends Resource
{
    protected static ?string $model = Privasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pelanggan_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('waktu_beli')
                    ->required(),
                Forms\Components\DateTimePicker::make('waktu_habis')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pelanggan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_beli')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_habis')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPrivasis::route('/'),
            'create' => Pages\CreatePrivasi::route('/create'),
            'edit' => Pages\EditPrivasi::route('/{record}/edit'),
        ];
    }
}
