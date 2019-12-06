<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // sendemail standard (without attachment)
        /*return $this->from('skurniawan@marthana.co.id')
                   ->view('emailku')
                   ->with(
                    [
                        'nama' => 'Sigit Kurniawan',
                        'website' => 'www.cordovastore.com',
                    ]);*/
        // sendemail standard (with attachment)
        /*return $this->from('pengirim@malasngoding.com')
                   ->view('emailku')
                   ->with(
                    [
                        'nama' => 'Diki Alfarabi Hadi',
                        'website' => 'www.malasngoding.com',
                    ])
                    ->attach(public_path('/hubungkan-ke-lokasi-file').'/demo.jpg', [
                      'as' => 'demo.jpg',
                      'mime' => 'image/jpeg',
                    ]);   */
    }
}
