<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Mail\NotifikasiEmail;
use App\Http\Controllers\TicketingRequestController;

class NotifikasiEmailController extends Controller
{
    public function index($email){

        Mail::to($email)->send(new NotifikasiEmail());

        return "Email telah dikirim ke ".$email;

    }

    public function sendEmailRequest($row)
    {
        try{
            Mail::send('notif_email_request',
            [
                'Nomor_Observasi_ID' => $row->IDobservasion,
                'Tanggal_Pengamatan' => $row->DateObs,
                'Pengamatan' => $row->Pengamatan,
                'Nama_Pelapor' => $row->NamaEmploye,
                'Fungsi' => $row->FungsiName,
                'Lokasi' => $row->CreateDate,
            ],
            function ($pesan) use ($row)
            {
                $pesan->subject('[PEKA-PEPC] NEW OBSERVATION '.$row->IDobservasion.' ID KLASIFIKASI '.$row->Klasifikasi);
                $pesan->from('do-not-reply@pekapepc', 'PEKA');
                $pesan->to($row->Email);
            });

            return response (['status' => true,'errors' => 'none']);
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
