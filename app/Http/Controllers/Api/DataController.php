<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function pengumuman(){
        $prefix = "/mobile/pengumuman";
        $result= json_decode($this->url($prefix));
        if (!empty($result)){
            return response()->json($result);
        }
        return 0;
    }
}
