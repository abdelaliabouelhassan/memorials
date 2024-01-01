<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QrCodeResource\Pages;
use App\Filament\Resources\QrCodeResource\RelationManagers;
use App\Models\QrCode;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Forms\Components\Button;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;

class QrCodeResource extends Resource
{
    protected static ?string $model = QrCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     protected static ?int $navigationSort = 1;

     public static function canCreate(): bool
     {
        return true;
     }

     public function actions()
     {
         return [
             Action::make('Generate QR Codes')
                 ->action('generateQRCodes'),
         ];
     }
 
     public function generateQRCodes()
     {
         // Your custom functionality goes here
         // For example, you can generate QR codes or perform any other action
 
         // Optionally, you can redirect to a different page after the action
         return redirect()->route('filament.resources.qr-codes.index');
     }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()->schema([
                Section::make('Assigned or Unassigned')->schema([
                    Select::make('user_id')->label('assign user')
                    ->searchable()
                    ->options([null => 'Unassigned'] + User::all()->pluck('email', 'id')->toArray())
                    ->native(false)
                ])->columns(1)
             ])->columnSpan('full')
                ]);
      
     
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('code')->view('tables.columns.qr-code-column')->label('QR Code'),
                ViewColumn::make('user_id')->view('tables.columns.assigne-user')->label('is Assigned'),
               
            ])
            ->filters([
                Filter::make('Assigned')->label('is Assigned')->query(fn (Builder $query): Builder => $query->where('user_id','!=',null)),
                Filter::make('notAssigned')->label('not Assigned')->query(fn (Builder $query): Builder => $query->where('user_id','=',null))
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
            'index' => Pages\ListQrCodes::route('/'),
            'create' => Pages\CreateQrCode::route('/create'),
            'edit' => Pages\EditQrCode::route('/{record}/edit'),
        ];
    }
}
