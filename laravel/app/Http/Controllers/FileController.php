<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FileController extends Controller
{
	public function importExportExcelORCSV(){
        return view('file_import_export');
    }
    public function importFileIntoDB(Request $request){
        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = [
                    'civility' => $value->civility,
                    'first_name' => $value->first_name,
                    'last_name' => $value->last_name,
                    'birth_date' => $value->birth_date,
                    'birth_location' => $value->birth_location,
                    'email' => $value->email,
                    'password' => bcrypt('password'),
                    'phone' => $value->phone,
                    'national_id' => $value->national_id,
                    'photo' => $value->photo,
                    'job' => $value->job,
                    'address' => $value->address,
                    'postal_code' => $value->postal_code,
                    'city' => $value->city,
                    'family_name' => $value->family_name,
                    'family_chef' => $value->family_chef,
                    ];
                }
                if(!empty($arr)){
                    \DB::table('users')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');      
    } 
    public function downloadExcelFile($type){
        $users = User::get()->toArray();
        return \Excel::create('expertphp_demo', function($excel) use ($users) {
            $excel->sheet('sheet name', function($sheet) use ($users)
            {
                $sheet->fromArray($users);
            });
        })->download($type);
    }
}
