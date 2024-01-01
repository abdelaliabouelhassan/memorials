<?php

namespace App\Filament\Resources\QrCodeResource\Pages;

use App\Filament\Resources\QrCodeResource;
use App\Models\QrCode;
use Filament\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Str;

class CreateQrCode extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static string $resource = QrCodeResource::class;

    protected static string $view = 'filament.resources.qr-code-resource.pages.create-qr-code';


    public ?array $data = []; 
    public function mount(): void
    {
        static::authorizeResourceAccess();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Qr Code Generators')->schema([
                       TextInput::make('quantity')->numeric()->rules('required')->label('Quantity')->maxValue(300)->minValue(1)
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
            
            $Quantity = $data['quantity'];

            for($i = 0; $i < $Quantity; $i++){
                QrCode::create([
                    'code' => $this->GenerateCode(),
               ]);
            }
            
        } catch (Halt $exception) {
            return;
        }
 
        Notification::make() 
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send(); 
    }


    private function GenerateCode(){
        return $referral_code = Str::random(16) . '' . time() . Str::random(6);
    }
}
