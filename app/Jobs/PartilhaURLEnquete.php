<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PartilhaURLEnquete as EmailPartilhaURLEnquete;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\PartilhaURLEnquete as MailPartilhaURLEnquete;

class PartilhaURLEnquete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $enquete;
    private $remetente;
    private $destinatario;

    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($enquete,$remetente,$destinatario)
    {
        $this->enquete = $enquete;
        $this->remetente = $remetente;
        $this->destinatario = $destinatario;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->destinatario)
        ->send(new EmailPartilhaURLEnquete($this->enquete, $this->remetente));
    }
}
