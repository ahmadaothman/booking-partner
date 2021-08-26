<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;

use Illuminate\Support\Facades\DB;

ini_set('memory_limit','1024M');

class Trip extends Model
{
    protected $table = 'trip';

    public function getcountryNameAttribute()
    {

        return Countries::where('cca2', $this->country)->first()->name_en;
    }

    public function getcountryFlagImojiAttribute()
    {

         return Countries::where('cca2', $this->country)->first()->flag->emoji;
    }

    public function getCountVehicleAttribute(){
        $vehicles = DB::table('trip_vehicle_pricing')->where('trip_id', $this->id)
            ->get();

        return $vehicles->count();
    }
}
