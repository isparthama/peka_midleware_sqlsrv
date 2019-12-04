<?php

namespace App\Http\Controllers;


use App\ModelMenuFront;
use App\ModelContents;
use App\ModelPekaCostCenter;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
class PekaCostCenter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function initdata(){
        $sql="CALL krp.sp_PekaCostCenter_listmenu()";
        return DB::select($sql);
    }
    public function index($id)
    {
        $data['listdata']=$this->initdata();
        $data['content']="krp.PekaCostCenter.list_form";
        $data['judul']="Master Klasifikasi Pengemudi";
        $data['statusnya']=$id;
        
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('PekaCostCenter','class="current" ');
        
        return view('admin-user.templatepdsi',$data);
    }
    public function details($id)
    {
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $data['content']="krp.PekaCostCenter.form_detail";
        $data['judul']="Detail Serah Terima";
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('PekaCostCenter','class="current" ');
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
        $data['content']="krp.PekaCostCenter.form_input";
        $data['judul']="Form Master Klasifikasi Pengemudi";
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('PekaCostCenter','class="current" ');
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
            $sql="call krp.sp_PekaCostCenter_insert(0,"
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
        $sql="call krp.sp_PekaCostCenter_get($id);";
        $modelPekaCostCenter=new ModelPekaCostCenter();
        $PekaCostCenter=$modelPekaCostCenter->hydrate(
                DB::select($sql));
        $data['row']=$PekaCostCenter->first();
        //$data['row']=ModelPekaCostCenter::where('clasificationid',$id)->first();
        $data['content']="krp.PekaCostCenter.form_input";
        $data['judul']="Master Klasifikasi Pengemudi";
        
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('PekaCostCenter','class="current" ');
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
            $sql="call krp.sp_PekaCostCenter_update("
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
            $sql="call krp.sp_PekaCostCenter_delete("
                    . "'".$id."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil DiHapus');
            return redirect('/admin-user/PekaCostCenter-list/0');
        
        
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
                'exec sp_PekaCostCenter_list
                        
                ',
                [
                        

                ]
        );

        return response()->json($response);
    }
}
