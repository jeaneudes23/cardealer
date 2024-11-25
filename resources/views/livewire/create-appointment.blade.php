<?php

use App\Filament\Resources\AppointmentResource;
use App\Jobs\SendResetLink;
use App\Mail\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Car;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Livewire\Notifications;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Volt\Component;

new class extends Component implements HasForms {
  //
  use InteractsWithForms;

  public ?array $data = [];
  public Car $car;

  public function mount(): void
  {
    $this->form->fill();
  }

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Group::make()
        ->columns(2)
        ->schema([
          TextInput::make('name')->visible(fn(): bool => !Auth::check())->required(fn(): bool => !Auth::check()),
          TextInput::make('email')
          ->visible(fn(): bool => !Auth::check())->required(fn(): bool => !Auth::check()),
          DateTimePicker::make('date')->required()->default(now()->addDays(2))->minDate(now()->addDays(2)),
          Textarea::make('customer_message')
          ->label('message'),
        ])
      ])
      ->statePath('data');
  }

  public function create()
  {
    $customer = Auth::user();
    $message = "You will be updated on the status of your appointment";
    if (!$customer) {
      $customer = User::where('email',$this->data['email'])->first();
      if (!$customer) {
        $message = "You will be updated on the status of your appointment, Please check your email to activate your account";
        $customer = Customer::create([
          'name' => $this->data['name'],
          'email' => $this->data['email'],
          'password' => fake()->password(),
        ]);

        !Auth::check() && dispatch(new SendResetLink($customer->email));
      }
    }

    $appointment = Appointment::create([
      'customer_id' => $customer->id,
      'date' => $this->data['date'],
      'customer_message' => $this->data['customer_message'],
      'car_id' => $this->car->id
    ]);
    
    Notification::make()
    ->title('Appointment Requested')
    ->body($appointment->message)
    ->actions([
      Action::make('view')
      ->url(fn () => AppointmentResource::getUrl('view',['record' => $appointment->id]))
    ])
    ->sendToDatabase(User::where('role','admin')->get());

    $this->form->fill([]);

    Notification::make()
    ->title('Appointment Requested')
    ->body($message)
    ->success()
    ->send();

  }
}; ?>

<div class="space-y-8">
  <h3 class="text-3xl font-bold capitalize">Request Appointment</h3>
  <div class="bg-gray-100 divide-y divide-muted rounded-lg">
    <form wire:submit='create' class="p-6">
      {{ $this->form }}
      <div class="mt-8">
        <button type="submit" class="bg-secondary rounded-lg px-8 py-2 font-medium capitalize tracking-wide text-secondary-foreground inline-flex items-center justify-center gap-2">
          <span wire:loading><x-lucide-loader-circle class="size-5 animate-spin"/></span>
          Submit
        </button>
      </div>
    </form>
  </div>
</div>