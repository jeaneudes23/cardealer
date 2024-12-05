<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\SalesPerson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private Appointment $appointment;
    private Customer $customer;
    private SalesPerson $salesPerson;
    
    public function __construct(Appointment $appointment)
    {
        //
        $this->appointment = $appointment;
        $this->customer = $appointment->customer;
        $this->salesPerson = $appointment->salesPerson;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
          ->from($this->salesPerson->email)
          ->greeting("Hello {$this->customer->name}")
          ->subject(env('APP_NAME')." Booking Update")
          ->line("Your appoint is {$this->appointment->status}")
          ->line($this->appointment->sales_person_message)
          ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
