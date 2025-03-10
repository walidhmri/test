<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class LocaleController extends Controller
{

    public function setlocale($language)
    {
        if(in_array($language, ['en', 'fr', 'ar','tm'])){
           App::setlocale($language);
              Session::put('locale', $language);
        }
        return back();
    }
}
