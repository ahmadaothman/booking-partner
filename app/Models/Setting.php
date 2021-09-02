<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    protected $table = 'setting';

    public static function setSetting($key,$value){
        $setting = DB::table('setting')->where('setting_key',$key)->first();

        if($setting){
            DB::table('setting')->where('setting_key',$key)->update(['setting_value'=>$value]);
        }else{
            DB::table('setting')->where('setting_key',$key)->insert(['setting_key'=>$key,'setting_value'=>$value]);
        }

        return true;
    }

    public static function getSetting($key){
        $setting = DB::table('setting')->where('setting_key',$key)->first();
        return $setting;
    }
}
