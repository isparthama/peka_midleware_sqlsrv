<?php

namespace App\Http\Controllers;


use App\ModelMenuFront;
use App\ModelContents;
use App\ModelPekaEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
use GuzzleHttp\Client;
class PekaEmployee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function initdata(){
        $sql="CALL krp.sp_PekaEmployee_listmenu()";
        return DB::select($sql);
    }
    public function index($id)
    {
        $data['listdata']=$this->initdata();
        $data['content']="krp.PekaEmployee.list_form";
        $data['judul']="Master Klasifikasi Pengemudi";
        $data['statusnya']=$id;

        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('PekaEmployee','class="current" ');

        return view('admin-user.templatepdsi',$data);
    }
    public function details($id)
    {
        $data['row']=Modelserahterima::where('form_no',$id)->first();
        $data['content']="krp.PekaEmployee.form_detail";
        $data['judul']="Detail Serah Terima";
        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('PekaEmployee','class="current" ');
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
        $data['content']="krp.PekaEmployee.form_input";
        $data['judul']="Form Master Klasifikasi Pengemudi";
        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('PekaEmployee','class="current" ');
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
            $sql="call krp.sp_PekaEmployee_insert(0,"
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
        $sql="call krp.sp_PekaEmployee_get($id);";
        $modelPekaEmployee=new ModelPekaEmployee();
        $PekaEmployee=$modelPekaEmployee->hydrate(
                DB::select($sql));
        $data['row']=$PekaEmployee->first();
        //$data['row']=ModelPekaEmployee::where('clasificationid',$id)->first();
        $data['content']="krp.PekaEmployee.form_input";
        $data['judul']="Master Klasifikasi Pengemudi";

        $global_function=new global_function();
        $global_function->clear_all_session();

        Session::put('PekaEmployee','class="current" ');
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
            $sql="call krp.sp_PekaEmployee_update("
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
            $sql="call krp.sp_PekaEmployee_delete("
                    . "'".$id."');";
            DB::select($sql);
            Session::put('alert-success','Data Berhasil DiHapus');
            return redirect('/admin-user/PekaEmployee-list/0');


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
                'exec sp_PekaEmployee_list

                ',
                [


                ]
        );

        return response()->json($response);
    }

    public static function get(Request $request){
        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = DB::select(
                'exec sp_PekaEmployee_get
                        ?
                ',
                [
                        $request->UserName

                ]
        );

        return response()->json($response);
    }

    public static function connect_ldap1(Request $request){
        $client = new Client();
        $res = $client->request('POST', 'https://apps.pertamina.com/api/digital_absensi/Users/loginLDAP', [
                'username' => 'trainee03',
                'password' => '123@ptm'
        ]);
        echo $res->getStatusCode();
        // 200
        echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'

            // {
            //     "status": true,
            //     "message": "User login successful"
            //   }

        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = $res->getBody();

        return response()->json($response);
    }

    public static function connect_ldap(Request $request){
        $param=array(
            'username' => 'trainee03',
            'password' => '123@ptm'
        );
        $param_set = json_encode($param);
        $link = curl_init('https://apps.pertamina.com/api/digital_absensi/Users/loginLDAP');
        curl_setopt($link, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($link, CURLOPT_POSTFIELDS,$param_set);
        curl_setopt($link, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($link, CURLOPT_HTTPHEADER,array(
            'Content-type: application/json'
        ));
        $contents=curl_exec($link);


        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = $contents;
        return response()->json($response);
    }
}
