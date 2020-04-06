<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Mail\NotifikasiEmail;
use App\Http\Controllers\TObservasi;
use App\ModelTObservasi;
use View;

class NotifikasiEmailController extends Controller
{
    public function index($email){

        Mail::to($email)->send(new NotifikasiEmail());

        return "Email telah dikirim ke ".$email;

    }

    public function sendEmailRequest($idobservasion)
    {
        try{
            $sql="exec sp_TObservasi_get $idobservasion";
            $modelTObservasi=new ModelTObservasi();
            $TObservasi=$modelTObservasi->hydrate(
                    DB::select($sql));
            $row=$TObservasi->first();

            if ($row->processApl==110){
                $email_content=[
                    'Nomor_Observasi_ID'=>$row->IDobservasion,
                    'Tanggal_Pengamatan'=>$row->DateObs,
                    'Pengamatan'=>$row->Pengamatan,
                    'Nama_Pelapor'=>$row->NamaEmploye,
                    'Fungsi'=>$row->FungsiName,
                    'Lokasi'=>$row->lokasi_tempat,
                    'link_webapp'=>env('LINK_WEBAPP')
                ];
                
                $email_content_user=(string)View::make('notif_email_request',$email_content);
                $email_content_pengelola=(string)View::make('notif_email_pengelola',$email_content);

                $emailNotif=[
                    [
                        'subject'=>"[PEKA-PEPC] NEW OBSERVATION '.$row->IDobservasion.' ID KLASIFIKASI '.$row->Klasifikasi",
                        'body'=>$email_content_user,
                        'mailto'=>$row->Email,
                        'cc'=>'jodhi.sugihartono@pertamina.com',
                        'bcc'=>''
                    ],
                    [
                        'subject'=>"[PEKA-PEPC] NEW OBSERVATION '.$row->IDobservasion.' ID KLASIFIKASI '.$row->Klasifikasi",
                        'body'=>$email_content_pengelola,
                        'mailto'=>$this->getEmailAddress_Pengelola($row->PICSign),
                        'cc'=>'jodhi.sugihartono@pertamina.com',
                        'bcc'=>''
                    ]
                ];

                $send_result=[];
                $emailNotif=json_decode(json_encode($emailNotif), FALSE);
                $send_result=$this->kirimEmailMulti($emailNotif);

                return response (['status' => true,'errors' => 'none','emailNotif' => $emailNotif,'send_result'=>$send_result]);
            } 
            
            
            if ($row->processApl==200){
                $email_content=[
                    'Nomor_Observasi_ID'=>$row->IDobservasion,
                    'Tanggal_Pengamatan'=>$row->DateObs,
                    'Pengamatan'=>$row->Pengamatan,
                    'Nama_Pelapor'=>$row->NamaEmploye,
                    'Fungsi'=>$row->FungsiName,
                    'Lokasi'=>$row->lokasi_tempat,
                    'Informasi_untuk_pic'=>$row->PICInformasi,
                    'tindakan_langsung'=>$row->langsung,
                    'tgl_laporan_observasi'=> $row->CreateDate,
                    'link_webapp'=>env('LINK_WEBAPP')
                ];
                
                $email_content_user=(string)View::make('notif_email_pic',$email_content);

                $emailNotif=[
                    [
                        'subject'=>"[PEKA-PEPC] NEW OBSERVATION '.$row->IDobservasion.' ID KLASIFIKASI '.$row->Klasifikasi",
                        'body'=>$email_content_user,
                        'mailto'=>$this->getEmailAddress($row->PICSign),
                        'cc'=>'jodhi.sugihartono@pertamina.com',
                        'bcc'=>''
                    ]
                ];

                $send_result=[];
                $emailNotif=json_decode(json_encode($emailNotif), FALSE);
                $send_result=$this->kirimEmailMulti($emailNotif);

                return response (['status' => true,'errors' => 'none','emailNotif' => $emailNotif,'send_result'=>$send_result]);
            } 
            if ($row->processApl==400){
                $email_content=[
                    'Nomor_Observasi_ID'=>$row->IDobservasion,
                    'Tanggal_Pengamatan'=>$row->DateObs,
                    'Pengamatan'=>$row->Pengamatan,
                    'Nama_Pelapor'=>$row->NamaEmploye,
                    'Fungsi'=>$row->FungsiName,
                    'Lokasi'=>$row->lokasi_tempat,
                    'Tindak_Lanjut_PIC'=>$row->Aksi,
                    'tindakan_langsung'=>$row->langsung,
                    'Tanggal_penyelesaian'=> $row->AksiDate,
                    'link_webapp'=>env('LINK_WEBAPP')
                ];
                
                $email_content_user=(string)View::make('notif_email_approved',$email_content);

                $emailNotif=[
                    [
                        'subject'=>"[PEKA-PEPC] NEW OBSERVATION '.$row->IDobservasion.' ID KLASIFIKASI '.$row->Klasifikasi",
                        'body'=>$email_content_user,
                        'mailto'=>$this->getEmailAddress_Pengelola($row->Email),
                        'cc'=>'jodhi.sugihartono@pertamina.com',
                        'bcc'=>''
                    ]
                ];

                $send_result=[];
                $emailNotif=json_decode(json_encode($emailNotif), FALSE);
                $send_result=$this->kirimEmailMulti($emailNotif);

                return response (['status' => true,'errors' => 'none','emailNotif' => $emailNotif,'send_result'=>$send_result]);
            } 
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function getEmailAddress($costcenter){
        $emailaddress='';
        $resultset=DB::select("exec sp_getEmailAddress '".$costcenter."'");
        foreach ($resultset as $row){
            $emailaddress=$emailaddress.$row->email.";";
        }
        return substr($emailaddress,0,strlen($emailaddress)-1);
    }

    public function getEmailAddress_Pengelola($Email){
        $emailaddress=$Email;
        $resultset=DB::select("exec sp_getEmailAddress_Pengelola");
        foreach ($resultset as $row){
            $emailaddress=$emailaddress.";".$row->email;
        }
        return $emailaddress;
    }

    public function sendemail(){
        try{
            $emailNotif=[
                [
                    'subject'=>'tes email peka1',
                    'body'=>$this->gettemplate(110),
                    'mailto'=>'trainee04@pertamina.com',
                    'cc'=>'jodhi.sugihartono@pertamina.com',
                    'bcc'=>''
                ],
                [
                    'subject'=>'tes email peka2',
                    'body'=>'tes email peka2',
                    'mailto'=>'trainee06@pertamina.com',
                    'cc'=>'jodhi.sugihartono@pertamina.com',
                    'bcc'=>''
                ]
                ];

            $emailNotif=json_decode(json_encode($emailNotif), FALSE);
            $send_result=$this->kirimEmailMulti($emailNotif);

            return response (['status' => true,'errors' => 'none','emailNotif' => $emailNotif,'send_result'=>$send_result]);
        } 
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
    public function kirimEmailMulti($emailNotif){    
        ini_set('max_execution_time', 1800);    
        // array of curl handles
        $multiCurl = array();
        // data to be returned
        $result = array();
        // multi handle
        $mh = curl_multi_init();
        
        foreach($emailNotif as $i => $email){
            $emails['subject'] = $email->subject;
            $emails['body'] = $email->body;
            $emails['mailto'] = $email->mailto;            
            $emails['CC'] = $email->cc;
            $emails['BCC'] = $email->bcc;
            
            $param_set = json_encode($emails);
            
            // URL from which data will be fetched
            //$fetchURL = 'http://10.3.30.61:47501/send/mail';
            $fetchURL = env('SEND_MAIL_API');
            $multiCurl[$i] = curl_init();
            curl_setopt($multiCurl[$i], CURLOPT_URL,$fetchURL);
            curl_setopt($multiCurl[$i], CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($multiCurl[$i], CURLOPT_POSTFIELDS,$param_set);
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,true);
            curl_setopt($multiCurl[$i], CURLOPT_HTTPHEADER,array(
                'Content-type: application/json'
            ));
            curl_multi_add_handle($mh, $multiCurl[$i]);
                        
        }
        
        $index=null;
        do {
            curl_multi_exec($mh,$index);
        } while($index > 0);
        
        // get content and remove handles
        foreach($multiCurl as $k => $ch) {
            $result[$k] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
        }
        // close
        curl_multi_close($mh);
        
        return count($result);
    }
}
