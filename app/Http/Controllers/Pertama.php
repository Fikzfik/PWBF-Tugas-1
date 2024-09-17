<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class Pertama extends Controller
{
    public function Get_data_JU(){
        $hasil = DB::table('jenis_user')->get()->toArray();
        echo json_encode($hasil);
    }
}
