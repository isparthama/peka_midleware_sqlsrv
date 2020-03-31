<?php

namespace App\Http\Controllers;


use App\ModelMenuFront;
use App\ModelContents;
use App\ModelTObservasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Http\Controllers\NotifikasiEmailController;
class TObservasi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }

    public function initdata(){
        $sql="CALL krp.sp_TObservasi_listmenu()";
        return DB::select($sql);
    }
    public function index($id)
    {
        $data['listdata']=$this->initdata();
        $data['content']="krp.TObservasi.list_form";
        $data['judul']="Master Klasifikasi Pengemudi";
        $data['statusnya']=$id;

        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('TObservasi','class="current" ');

        return view('admin-user.templatepdsi',$data);
    }
    public function details($id)
    {
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $data['content']="krp.TObservasi.form_detail";
        $data['judul']="Detail Serah Terima";
        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('TObservasi','class="current" ');
        return view('admin-user.templatepdsi',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['row']="";
        $data['content']="krp.TObservasi.form_input";
        $data['judul']="Form Master Klasifikasi Pengemudi";
        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('TObservasi','class="current" ');
        $user=Auth::user();
        $data['penerima']=$user->username;
        return view('admin-user.templatepdsi',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
            $user=Auth::user();
	    //$user->site_id=1;
            $sql="call krp.sp_TObservasi_insert(0,"
                    . "'".$request->clasification_name."',"
                    . "'".$user->username."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil Disimpan');
            //return redirect('/admin-user/serah-terima')->with('alert-success','tes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=Auth::user();
	    //$user->site_id=1;
        $sql="call krp.sp_TObservasi_get($id);";
        $modelTObservasi=new ModelTObservasi();
        $TObservasi=$modelTObservasi->hydrate(
                DB::select($sql));
        $data['row']=$TObservasi->first();
        //$data['row']=ModelTObservasi::where('clasificationid',$id)->first();
        $data['content']="krp.TObservasi.form_input";
        $data['judul']="Master Klasifikasi Pengemudi";

        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('TObservasi','class="current" ');
        return view('admin-user.templatepdsi',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax())
        {
            $user=Auth::user();
	    //$user->site_id=1;
            $sql="call krp.sp_TObservasi_update("
                    . "'".$request->clasificationid."',"
                    . "'".$request->clasification_name."',"
                    . "'".$user->username."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $user=Auth::user();
	    //$user->site_id=1;
            $sql="call krp.sp_TObservasi_delete("
                    . "'".$id."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil DiHapus');
            return redirect('/admin-user/TObservasi-list/0');


    }

    function printpdf($id){
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $pdf = PDF::loadview('pdf/serahterima',$data);
        return $pdf->stream();
    }

    public static function list(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $data = DB::select(
                'exec sp_TObservasi_list
                        ?,
                        ?,
                        ?
                ',
                [
                        $request->UserName,
                        $request->filter,
                        $request->costcenter

                ]
        );

        $response['data']=$data;
        return response()->json($response);
    }

    public static function get(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $Observasi = DB::select(
                'exec sp_TObservasi_get
                        ?
                ',
                [
                    $request->IDobservasion

                ]
        );

        foreach ($Observasi as $o){
            $ObsKlass = DB::select('exec sp_TObsKlas_list '.$o->IDobservasion);

            $o->unsafedetail=$ObsKlass;
        }

        $response['data']=$Observasi;

        return response()->json($response);
    }

    public static function delete(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::select(
                'exec sp_TObservasi_delete
                        ?
                ',
                [
                    $request->IDobservasion

                ]
        );

        return response()->json($response);
    }

    public function downloadFile($namafile)
    {
        $file_path = env('PATH_UPLOADS').'/'.$namafile;
        return response()->download($file_path);
    }

    public function insert(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $result = DB::select(
                'exec sp_TObservasi_insert
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                ',
                [
                    $request->IDobservasion,
                    $request->IDklasifikasi,
                    $request->spesifikasi,
                    $request->DateObs,
                    $request->Pengamatan,
                    $request->Lanjutan,
                    $request->Klasifikasi,
                    $request->FilePhoto,
                    $request->IDNIK,
                    $request->NamaEmploye,
                    $request->FungsiName,
                    $request->Email,
                    $request->NoTlp,
                    $request->IsActive,
                    $request->CreateDate,
                    $request->CreateID,
                    $request->AreaID,
                    $request->jabatan,
                    $request->processApl,
                    $request->langsung,
                    $request->PICNIK,
                    $request->PICSign,
                    $request->PISignDate,
                    $request->PICEmail,
                    $request->PICInformasi,
                    $request->RiskA,
                    $request->RiskB,
                    $request->RejectReason,
                    $request->Pengelolahinfor,
                    $request->UserBypass,
                    $request->BypassDate,
                    $request->Aksi,
                    $request->AksiDate,
                    $request->AksiComment,
                    $request->CostCenter,
                    $request->unsafeDetailId
                ]
        );

        $loop="";
        foreach($result as $row)
        {
            $response['IDobservasion'] =$row->IDobservasion;

            $destinationPath = env('PATH_UPLOADS');
            $request->DateObs=str_replace('"','',$request->DateObs);

            $file_1 = $request->file('attach_file_1');
            if($file_1!=""){
                $nama_file_1 = $this->standard_name_file($row->IDobservasion,'OBS',1,$file_1->getClientOriginalName());
                $file_1->move($destinationPath,$nama_file_1);
            }else{
                $nama_file_1 = "-";
            }

            $file_2 = $request->file('attach_file_2');
            if($file_2!=""){
                $nama_file_2 = $this->standard_name_file($row->IDobservasion,'OBS',2,$file_2->getClientOriginalName());
                $file_2->move($destinationPath,$nama_file_2);
            }else{
                $nama_file_2 = "-";
            }

            $file_3 = $request->file('attach_file_3');
            if($file_3!=""){
                $nama_file_3 = $this->standard_name_file($row->IDobservasion,'OBS',3,$file_3->getClientOriginalName());
                $file_3->move($destinationPath,$nama_file_3);
            }else{
                $nama_file_3 = "-";
            }

            $request->FilePhoto = $nama_file_1.",".$nama_file_2.",".$nama_file_3;

            $result=DB::select(
                'exec sp_TObservasi_update_filephoto 
                ?,
                ?',
                [
                    $row->IDobservasion,
                    $request->FilePhoto
                ]
            );

            $detail=explode(",",$request->unsafeDetailId);
            foreach($detail as $Subksid)
            {
                DB::insert(
                'exec sp_TObsKlas_insert
                    ?,
                    ?,
                    ?
                ',
                [
                    $row->Klasifikasi,
                    $row->IDobservasion,
                    str_replace('"','',$Subksid)
                ]);
            }
            $response['unsafeDetailId']=$detail;
            $emailNotif = new NotifikasiEmailController();
            if($row->processApl>100){
                $response['Email']=$emailNotif->sendEmailRequest($row->IDobservasion);
            }
        }
        $response['data']=$result;
        return response()->json($response);
    }

    public function standard_name_file($IDobservasion,$type,$idx,$fname){
        $path_parts = pathinfo($fname);

        $FileNoExtension = $path_parts['filename'];
        $GetExtension = $path_parts['extension'];
        $dt = date("YmdHisU") . "_.";
        $RenameFile = $type."_"."IMG" .$IDobservasion."_". $idx. "_." . $GetExtension;
        return $RenameFile;
    }
    public  function updateapi(Request $request){
        $destinationPath = env('PATH_UPLOADS');//'uploads';
        $request->DateObs=str_replace('"','',$request->DateObs);

        $file_1 = $request->file('attach_file_1');
        if($file_1!=""){
            $nama_file_1 = $this->standard_name_file($request->IDobservasion,'OBS',1,$file_1->getClientOriginalName());
            $file_1->move($destinationPath,$nama_file_1);
            $request->FilePhoto=$request->FilePhoto.",".$nama_file_1;
        }

        $file_2 = $request->file('attach_file_2');
        if($file_2!=""){
            $nama_file_2 = $this->standard_name_file($request->IDobservasion,'OBS',2,$file_2->getClientOriginalName());
            $file_2->move($destinationPath,$nama_file_2);
            $request->FilePhoto=$request->FilePhoto.",".$nama_file_2;
        }

        $file_3 = $request->file('attach_file_3');
        if($file_3!=""){
            $nama_file_3 = $this->standard_name_file($request->IDobservasion,'OBS',3,$file_3->getClientOriginalName());
            $file_3->move($destinationPath,$nama_file_3);
            $request->FilePhoto=$request->FilePhoto.",".$nama_file_3;
        }

        $Observasi = DB::select(
                'exec sp_TObservasi_get
                        ?
                ',
                [
                    $request->IDobservasion

                ]
        );
        if ($request->FilePhoto==null) $request->FilePhoto=$Observasi[0]->FilePhoto;
        
        
        $file_1_pic = $request->file('attach_file_1_pic');
        if($file_1_pic!=""){
            $nama_file_1_pic = $this->standard_name_file($request->IDobservasion,'PIC',1,$file_1_pic->getClientOriginalName());
            $file_1_pic->move($destinationPath,$nama_file_1_pic);
            $request->Pengelolahinfor=$request->Pengelolahinfor.",".$nama_file_1_pic;
        }

        $file_2_pic = $request->file('attach_file_2_pic');
        if($file_2_pic!=""){
            $nama_file_2_pic = $this->standard_name_file($request->IDobservasion,'PIC',2,$file_2_pic->getClientOriginalName());
            $file_2_pic->move($destinationPath,$nama_file_2_pic);
            $request->Pengelolahinfor=$request->Pengelolahinfor.",".$nama_file_2_pic;
        }

        $file_3_pic = $request->file('attach_file_3_pic');
        if($file_3_pic!=""){
            $nama_file_3_pic = $this->standard_name_file($request->IDobservasion,'PIC',3,$file_3_pic->getClientOriginalName());
            $file_3_pic->move($destinationPath,$nama_file_3_pic);
            $request->Pengelolahinfor=$request->Pengelolahinfor.",".$nama_file_3_pic;
        }

        if ($request->Pengelolahinfor==null) $request->Pengelolahinfor=$Observasi[0]->Pengelolahinfor;

        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $result= DB::select(
                'exec sp_TObservasi_update
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                ',
                [
                    $request->IDobservasion,
                    $request->IDklasifikasi,
                    $request->spesifikasi,
                    $request->DateObs,
                    $request->Pengamatan,
                    $request->Lanjutan,
                    $request->Klasifikasi,
                    $request->FilePhoto,
                    $request->IDNIK,
                    $request->NamaEmploye,
                    $request->FungsiName,
                    $request->Email,
                    $request->NoTlp,
                    $request->IsActive,
                    $request->CreateDate,
                    $request->CreateID,
                    $request->AreaID,
                    $request->jabatan,
                    $request->processApl,
                    $request->langsung,
                    $request->PICNIK,
                    $request->PICSign,
                    $request->PISignDate,
                    $request->PICEmail,
                    $request->PICInformasi,
                    $request->RiskA,
                    $request->RiskB,
                    $request->RejectReason,
                    $request->Pengelolahinfor,
                    $request->UserBypass,
                    $request->BypassDate,
                    $request->Aksi,
                    $request->AksiDate,
                    $request->AksiComment,
                    $request->CostCenter
                ]
        );

        $loop="";
        foreach($result as $row)
        {
            $response['IDobservasion'] =$row->IDobservasion;
            $detail=explode(",",$request->unsafeDetailId);
            foreach($detail as $Subksid)
            {
                DB::insert(
                'exec sp_TObsKlas_insert
                    ?,
                    ?,
                    ?
                ',
                [
                    $row->Klasifikasi,
                    $row->IDobservasion,
                    str_replace('"','',$Subksid)
                ]);
            }
            $response['unsafeDetailId']=$detail;
            $emailNotif = new NotifikasiEmailController();
            if($row->processApl>100){
                $response['Email']=$emailNotif->sendEmailRequest($row->IDobservasion);
            }
        }
        $response['data']=$result;

        return response()->json($response);
    }
}
