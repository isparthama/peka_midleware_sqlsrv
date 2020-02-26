<?php

namespace App\Http\Controllers;


use App\ModelMenuFront;
use App\ModelContents;
use App\ModelTUnsDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
class TUnsDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function initdata(){
        $sql="CALL krp.sp_TUnsDetail_listmenu()";
        return DB::select($sql);
    }
    public function index($id)
    {
        $data['listdata']=$this->initdata();
        $data['content']="krp.TUnsDetail.list_form";
        $data['judul']="Master Klasifikasi Pengemudi";
        $data['statusnya']=$id;
        
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('TUnsDetail','class="current" ');
        
        return view('admin-user.templatepdsi',$data);
    }
    public function details($id)
    {
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $data['content']="krp.TUnsDetail.form_detail";
        $data['judul']="Detail Serah Terima";
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('TUnsDetail','class="current" ');
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
        $data['content']="krp.TUnsDetail.form_input";
        $data['judul']="Form Master Klasifikasi Pengemudi";
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('TUnsDetail','class="current" ');
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
            $sql="call krp.sp_TUnsDetail_insert(0,"
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
        $sql="call krp.sp_TUnsDetail_get($id);";
        $modelTUnsDetail=new ModelTUnsDetail();
        $TUnsDetail=$modelTUnsDetail->hydrate(
                DB::select($sql));
        $data['row']=$TUnsDetail->first();
        //$data['row']=ModelTUnsDetail::where('clasificationid',$id)->first();
        $data['content']="krp.TUnsDetail.form_input";
        $data['judul']="Master Klasifikasi Pengemudi";
        
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('TUnsDetail','class="current" ');
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
            $sql="call krp.sp_TUnsDetail_update("
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
            $sql="call krp.sp_TUnsDetail_delete("
                    . "'".$id."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil DiHapus');
            return redirect('/admin-user/TUnsDetail-list/0');
        
        
    }
    
    function printpdf($id){
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $pdf = PDF::loadview('pdf/serahterima',$data);
        return $pdf->stream();
    }

    public static function list(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $data['']=[];
        $PROCEDURE = DB::select(
                'exec sp_TUnsDetail_list
                        ?,
                        ?
                ',
                [
                        $request->UnsafeID,
                        'PROCEDURE'

                ]
        );
        if (!empty($PROCEDURE)){
            $data['PROCEDURE']=$PROCEDURE;
        }
        $PERALATAN_BAHAN = DB::select(
            'exec sp_TUnsDetail_list
                    ?,
                    ?
            ',
            [
                    $request->UnsafeID,
                    'PERALATAN & BAHAN'

            ]
    );
    if (!empty($PERALATAN_BAHAN)){
        $data['PERALATAN & BAHAN']=$PERALATAN_BAHAN;
    }
    $APD = DB::select(
        'exec sp_TUnsDetail_list
                ?,
                ?
        ',
        [
                $request->UnsafeID,
                'APD'

        ]
    );
    if (!empty($APD)){
        $data['APD']=$APD;
    }
    $LAIN_LAIN = DB::select(
        'exec sp_TUnsDetail_list
                ?,
                ?
        ',
        [
                $request->UnsafeID,
                'LAIN - LAIN'

        ]
    );
    if (!empty($LAIN_LAIN)){
        $data['LAIN - LAIN']=$LAIN_LAIN;
    }
    $LINGKUNGAN_KERJA= DB::select(
        'exec sp_TUnsDetail_list
                ?,
                ?
        ',
        [
                $request->UnsafeID,
                'LINGKUNGAN KERJA'

        ]
    );
    if (!empty($LINGKUNGAN_KERJA)){
        $data['LINGKUNGAN KERJA']=$LINGKUNGAN_KERJA;
    }
    $nearmiss = DB::select(
        'exec sp_TUnsDetail_list
                ?,
                ?
        ',
        [
                $request->UnsafeID,
                ''

        ]
    );
    if (!empty($nearmiss)){
        $data['NEAR MISS']=$nearmiss;
    }
    $response['data']=$data;
        return response()->json($response);
    }
}
