<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = array();

        $data['action'] = route('setting');

        $data['airport_port_number'] = Setting::getSetting('airport_port_number') ? Setting::getSetting('airport_port_number')->setting_value : false;
        $data['airport_banner_number'] = Setting::getSetting('airport_banner_number') ? Setting::getSetting('airport_banner_number')->setting_value : false;

        if($request->method() == 'POST'){
            Setting::setSetting('airport_port_number',$request->input('airport_port_number'));
            Setting::setSetting('airport_banner_number',$request->input('airport_banner_number'));
            return redirect('setting');
        }
        
        return view('setting',$data);
    }

    
}
