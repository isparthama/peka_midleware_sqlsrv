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
use Illuminate\Support\Collection;
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

    public static function is_ok($ldap_data){
        try {
            $val=$ldap_data->dataLDAP->Data->value;
            return true;
        } catch(\Throwable  $e) {
            return false;
        }
    }
    public static function get(Request $request){
        $isldap=0;
        $peka_employee = [];
        $response['status'] = 'FAIL';
        $ldap_array=self::periksa_ldap($request->UserName,$request->Password);
        $ldap_data = json_decode(json_encode($ldap_array), FALSE);
        if (self::is_ok($ldap_data)){
            $response['value']=$ldap_data->dataLDAP->Data->value;
            if ($ldap_data->dataLDAP->Data->value=true){
                foreach ($ldap_data->dataSAP as $dataSAP){
                    DB::select(
                            'exec sp_DB_SAP_Employee_insert
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
                                $dataSAP->EMPLOYEE_NOPEK,
                                $dataSAP->EMPLOYEE_NOPEK,
                                $dataSAP->USERNAME,
                                $dataSAP->EMPLOYEE_EMAIL,
                                $dataSAP->EMPLOYEE_NAMA,
                                $dataSAP->GENDER,
                                $dataSAP->EMPLOYEE_POSIDI,
                                $dataSAP->EMPLOYEE_POSTEXT,
                                $dataSAP->EMPLOYEE_CC,
                                $dataSAP->COSTCENTERNAME                            ]
                    );
                }
                
                $isldap=1;
                $peka_employee= DB::select(
                        'exec sp_PekaEmployee_get_ldap
                                ?
                        ',
                        [
                            $ldap_data->dataLDAP->Data->Email

                        ]
                );
                $response['db']='sap_employee';
                $response['is_empty']=empty($peka_employee);
                if (empty($peka_employee)){
                    $peka_employee= DB::select(
                            'exec sp_PekaEmployee_get
                                    ?
                            ',
                            [
                                    $request->UserName

                            ]
                    );
                    $response['db']='peka_employee';
                }
                $response['ldap_data'] = $ldap_data;
            } else {
                $peka_employee= DB::select(
                        'exec sp_PekaEmployee_get
                                ?
                        ',
                        [
                                $request->UserName

                        ]
                );
                $response['db']='peka_employee';
            }
            if (!empty($peka_employee)){
                $response['status'] = 'SUCCESS';
            }
        }

        $response['code'] = 200;
        $response['data'] =$peka_employee;
        $response['isldap'] = $isldap;

        return response()->json($response);
    }

    public static function connect_ldap(Request $request){
        $array = self::periksa_ldap($request->username,$request->password);

        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = $array;
        return response()->json($response);
    }

    public static  function periksa_ldap($username,$password){
        $param=array(
            'username' => $username,
            'password' => $password,
            'appname' => ''
        );
        $param_set = json_encode($param);
        $link = curl_init('https://apps.pertamina.com/api/login/Users/loginLDAP');
        curl_setopt($link, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($link, CURLOPT_POSTFIELDS,$param_set);
        curl_setopt($link, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($link, CURLOPT_HTTPHEADER,array(
            'Content-type: application/json'
        ));
        $contents=curl_exec($link);
        return json_decode($contents,true);
    }
}
