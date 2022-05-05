<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $assunto;
    private $mensagem;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($assunto,$mensagem)
    {
        $this->assunto = $assunto;
        $this->mensagem =$mensagem;


    }
    /**
     * Set the subject of the message.
     *
     * @param  string  $subject
     * @return $this
     */
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from('testelaravelsistema@gmail.com', 'Desenvolvedor ATTILA')->view('mail.corpoemail',['mensagem' => $this->mensagem])->subject($this->assunto);
    }
}
