<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryTarificationResource;
use App\Models\CategoryTarification;
use App\Models\Tarification;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function test()
    {
        $data=Tarification::join('category_tarifications','category_tarifications.id','=','tarifications.category_tarification_id')
        ->groupBy('category_tarifications.name')
        ->get();
        return $data;
    }
}
