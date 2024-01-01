<?php

namespace App\Filament\Resources\QrCodeResource\Pages;

use App\Filament\Resources\QrCodeResource;
use App\Models\QrCode;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class EditQrCode extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string $resource = QrCodeResource::class;

    protected static string $view = 'filament.resources.qr-code-resource.pages.edit-qr-code';
   
    public int $record =  0;

    public ?array $data = []; 
    public function mount(): void
    {
        $this->record = request('record');
        // static::authorizeResourceAccess();
        $qrCode = QrCode::findOrFail($this->record);
        $this->form->fill($qrCode->attributesToArray());
        
    }


   

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Assign  or UnAssign User')->schema([
                       Select::make('user_id')->label('Assign User')
                       ->options([null => 'UnAssign'] + User::all()->pluck('name', 'id')->toArray())
                       ->native(false)
                    ])->columns(1)
                 ])->columnSpan('full')
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
       
        try {
            $data = $this->form->getState();
            QrCode::where('id',$this->record )->update([
                'user_id' =>$data['user_id']
            ]);
            
        } catch (Halt $exception) {
            return;
        }
 
        Notification::make() 
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send(); 
    }


  
}
