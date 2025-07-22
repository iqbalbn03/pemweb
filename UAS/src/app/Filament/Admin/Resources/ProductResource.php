<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('service_used')
                    ->label('Service Used')
                    ->options([
                        'YouTube' => 'YouTube',
                        'Netflix' => 'Netflix',
                        'Spotify' => 'Spotify',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $harga = match ($state) {
                            'YouTube' => 40000,
                            'Netflix' => 55000,
                            'Spotify' => 45000,
                            default => 0,
                        };
                        $set('price', $harga);
                    }),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->disabled()
                    ->dehydrated(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('service_used')->label('Service')->searchable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->money('IDR', true)->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    /**
     * Memberi izin agar semua user (bukan hanya admin) bisa mengakses resource ini.
     */
    public static function canAccess(): bool
    {
        return true;
    }

    /**
     * Memberi izin semua user bisa membuat produk.
     */
    public static function canCreate(): bool
    {
        return true;
    }

    /**
     * Memberi izin semua user bisa mengedit produk.
     */
    public static function canEdit($record): bool
    {
        return true;
    }

    /**
     * Memberi izin semua user bisa menghapus produk (jika dibutuhkan).
     */
    public static function canDelete($record): bool
    {
        return true;
    }
}
