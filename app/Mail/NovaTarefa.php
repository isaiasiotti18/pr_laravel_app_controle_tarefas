<?php

namespace App\Mail;

use App\Models\Tarefa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaTarefa extends Mailable
{
  use Queueable, SerializesModels;

  public $tarefa;
  public $data_limite;
  public $url;

  /**
   * Create a new message instance.
   */
  public function __construct(Tarefa $tarefa)
  {
    $this->tarefa = $tarefa->tarefa;
    $this->data_limite = date('d/m/Y', strtotime($tarefa->data_limite));
    $this->url = "http://localhost:8000/tarefa/$tarefa->id";
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: "Nova Tarefa: $this->tarefa",
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      markdown: 'emails.novatarefa',
      with: [
        'tarefa' => $this->tarefa,
        'url' => $this->url,
        'data_limite' => $this->data_limite
      ]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
