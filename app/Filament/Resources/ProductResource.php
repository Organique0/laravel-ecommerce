<?php

namespace App\Filament\Resources;

use App\Enums\ProuductStatusEnum;
use App\Enums\RolesEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
  protected static ?string $model = Product::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Grid::make()
          ->schema([
            Forms\Components\TextInput::make('title')
              ->live(onBlur: true)
              ->required()
              ->afterStateUpdated(
                function (string $operation, $state, callable $set) {
                  $set('slug', Str::slug($state));
                }
              ),
            Forms\Components\TextInput::make('slug')->required(),
            Forms\Components\Select::make('department_id')
              ->relationship('department', 'name')
              ->label('Department')
              ->preload()
              ->searchable()
              ->reactive()
              ->afterStateUpdated(function (callable $set) {
                $set('category_id', null);
              }),
            Select::make('category_id')
              ->relationship(
                name: 'category',
                titleAttribute: 'name',
                modifyQueryUsing: function ($query, $get) {
                  $departmentId = $get('department_id');
                  if ($departmentId) {
                    $query->where('department_id', $departmentId);
                  }
                })
              ->label('Category')
              ->preload()
              ->searchable()
              ->required()
          ]),
        Forms\Components\RichEditor::make('description')
          ->required()
          ->toolbarButtons([
            'blockquote',
            'bold',
            'bulletList',
            'h2',
            'h3',
            'italic',
            'link',
            'orderedList',
            'redo',
            'strike',
            'underline',
            'undo',
            'table'
          ])
          ->columnSpan(2),
        Forms\Components\TextInput::make('price')->required()->numeric(),
        Forms\Components\TextInput::make('quantity')->integer(),
        Select::make('status')
          ->options(ProuductStatusEnum::labels())
          ->default(ProuductStatusEnum::Draft->value)
          ->required()
      ]);

  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title')
          ->sortable()
          ->words(10)
          ->searchable(),
        Tables\Columns\TextColumn::make('status')
          ->badge()
          ->colors(ProuductStatusEnum::colors()),
        Tables\Columns\TextColumn::make('department.name'),
        Tables\Columns\TextColumn::make('category.name'),
        Tables\Columns\TextColumn::make('created_at'),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('status')
          ->options(ProuductStatusEnum::labels()),
        Tables\Filters\SelectFilter::make('department_id')
          ->relationship('department', 'name')
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
      'index' => Pages\ListProducts::route('/'),
      'create' => Pages\CreateProduct::route('/create'),
      'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
  }

  public static function canViewAny(): bool
  {
    $user = Filament::auth()->user();
    return $user && $user->hasRole(RolesEnum::Vendor);
  }
}
