<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Users';

    protected static ?string $navigationGroup = '';

    protected static ?int $navigationSort = 0;

    public function rulesForCreate()
    {
        return [
            'first_name' => ['required', 'min:2', 'max:14'],
            'last_name' => ['required', 'min:2', 'max:14'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'role' => ['required'],
        ];
    }

    public function rulesForUpdate($resource)
    {
        return [
            'first_name' => ['required', 'min:2', 'max:14'],
            'last_name' => ['required', 'min:2', 'max:14'],
            'email' => ['required', 'email', 'unique:users,email,' . $resource->id],
            'password' => ['required', 'min:8'],
            'role' => ['required'],
        ];
    }

    public static function form(Form $form): Form
    {
       
        return $form
            ->schema([
                //
                
                Group::make()->schema([
                   Section::make('User Info')->schema([
                     TextInput::make('first_name')->rules(['required','min:2','max:14']),
                     TextInput::make('last_name')->rules(['required','min:2','max:14']),
                     TextInput::make('email')->type('email')->unique(ignoreRecord: true)
                     ->rules(['required','email']),
                     TextInput::make('password')->type('password')
                     ->dehydrated(fn ($state) => filled($state))
                     ->required(fn (string $context): bool => $context === 'create')
                     ->rules(['min:8']),
                     Select::make('role')->native(false)->options(
                        [
                            'admin'=>'Admin',
                            'user'=>'User'
                        ]
                     )->rules(['required'])->columnSpan('full')
                    
                   ])->columns(2)
                ])->columnSpan('full')
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->searchable(),
            ])
            ->filters([
                //
                Filter::make('is_admin')->label('is Admin')->query(fn (Builder $query): Builder => $query->where('role', 'admin'))
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'role'];
    }
}
