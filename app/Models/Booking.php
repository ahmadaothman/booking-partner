<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    protected $table = 'booking';

    public function getTripAttribute(){
        $trip = DB::table('trip')->where('id', $this->trip_id)->first();

        return $trip;
    }

    public function getRoundTripAttribute(){
        $trip = DB::table('trip')->where('id', $this->return_trip_id)->first();

        return $trip;
    }

    public function getPartnerAttribute(){
        $agent = DB::table('users')->where('id', $this->agent_id)->first();

        return $agent;
    }

    public function getVehicleAttribute(){
        $vehicle = DB::table('booking_vehicles')
        ->where('trip_type','one_way')
        ->where('booking_id', $this->id)->first();

        return $vehicle;
    }

    public function getReturnVehicleAttribute(){
        $vehicle = DB::table('booking_vehicles')
        ->where('trip_type','return')
        ->where('booking_id', $this->id)->first();

        return $vehicle;
    }

    public function getGetPessengersAttribute(){
        $pessengers = DB::table('booking_people')
        ->where('booking_id', $this->id)->get();

        return $pessengers;
    }

    
}
