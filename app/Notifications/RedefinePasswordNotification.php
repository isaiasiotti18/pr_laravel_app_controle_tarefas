<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RedefinePasswordNotification extends Notification
{
  use Queueable;

  public $token;
  public $email;

  public $name;

  /**
   * Create a new notification instance.
   */
  public function __construct($token, $email, $name)
  {
    $this->token = $token;
    $this->email = $email;
    $this->name = $name;
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

    $url = 'http://localhost:8000/password/reset/'.$this->token.'?email='.$this->email;
    $minutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

    return (new MailMessage)
      ->subject('Atualização de Senha')
      ->greeting("Olá, tudo bem $this->name?")
      ->line('Esqueceu a senha? Acesse o link abaixo para redefini-la.')
      ->action(('Redefinir Senha'), $url)
      ->line("O link acima expira em $minutes minutos.")
      ->line('Se você não requisitou alteração de senha, ignore este email.')
      ->salutation("Muito obrigado e boas vendas!");
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
