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
class TObservasi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
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
        $response['data'] = DB::select(
                'call sp_TObservasi_list(
                        ?,
                        ?
                )',
                [
                        $request->UserName,
                        $request->filter

                ]
        );

        return response()->json($response);
    }

    public static function get(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::select(
                'call TObservasi_get(
                        ?
                )',
                [
                    $request->IDobservasion    

                ]
        );

        return response()->json($response);
    }

    public static function delete(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::raw(
                'exec sp_TObservasi_delete
                        ?
                ',
                [
                    $request->IDobservasion    

                ]
        );

        return response()->json($response);
    }


    public static function insert(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::raw(
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

        return response()->json($response);
    }

    public static function updateapi(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::raw(
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

        return response()->json($response);
    }
}
