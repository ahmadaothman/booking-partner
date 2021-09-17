<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = array();

        $data['action'] = route('setting');

        /*$data['airport_port_number'] = Setting::getSetting('airport_port_number') ? Setting::getSetting('airport_port_number')->setting_value : false;
        $data['airport_banner_number'] = Setting::getSetting('airport_banner_number') ? Setting::getSetting('airport_banner_number')->setting_value : false;

        if($request->method() == 'POST'){
            Setting::setSetting('airport_port_number',$request->input('airport_port_number'));
            Setting::setSetting('airport_banner_number',$request->input('airport_banner_number'));
            return redirect('setting');
        }*/
        $data['user'] = DB::table('users')->where('id', auth()->id())->first();

        if ($request->method() == 'POST') {
            $image = $request->file('image');

            if($image){
                $original_name = $image->getClientOriginalName();
                $extension = explode(".",$original_name);
                $extension = $extension[count($extension) - 1];
        
                $new_name =  rand() . "_" . $original_name;
        
                $path = $image->move(public_path('images'), $new_name);
        
               
                DB::table('users')->where('id', auth()->id())->update(['logo'=>'images/' . $new_name]);
            }

            if($request->input('password') != ""){
                DB::table('users')->where('id', auth()->id())->update(['password'=>Hash::make($request->input('password'))]);
            }

            return redirect('setting');
        }
       
        
        return view('setting',$data);
    }

    
}
