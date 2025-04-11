<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('brand_name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('brand_tag')
                    ->label(__('Tag')),
                ToggleButtons::make('is_exclusive')
                    ->label('Is Exclusive ?')
                    ->grouped()
                    ->boolean()
                    ->default(false),
                TextInput::make('rating')
                    ->label(__('Rating'))
                    ->integer()
                    ->required(),
                FileUpload::make('brand_image')
                    ->label(__('Image'))
                    ->image()
                    ->maxSize(1024)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand_name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand_tag')
                    ->label(__('Tag'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label(__('Rating'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_exclusive')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-check-circle')
                    ->falseColor('danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBrands::route('/'),
        ];
    }
}
