<?php

namespace App\Http\Controllers;


use App\ModelMenuFront;
use App\ModelContents;
use App\ModelTArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
class TArea extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function initdata(){
        $sql="CALL krp.sp_TArea_listmenu()";
        return DB::select($sql);
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
            $sql="call krp.sp_TArea_insert(0,"
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
        $sql="call krp.sp_TArea_get($id);";
        $modelTArea=new ModelTArea();
        $TArea=$modelTArea->hydrate(
                DB::select($sql));
        $data['row']=$TArea->first();
        //$data['row']=ModelTArea::where('clasificationid',$id)->first();
        $data['content']="krp.TArea.form_input";
        $data['judul']="Master Klasifikasi Pengemudi";
        
        $global_function=new global_function();
        $global_function->clear_all_session();
        
        Session::put('TArea','class="current" ');
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
            $sql="call krp.sp_TArea_update("
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
            $sql="call krp.sp_TArea_delete("
                    . "'".$id."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil DiHapus');
            return redirect('/admin-user/TArea-list/0');
        
        
    }
    
    public static function list_area(Request $request){
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['data'] = DB::select(
                    'exec sp_TArea_list_area
                            
                    ',
                    [
                            

                    ]
            );

            return response()->json($response);
    }
}
