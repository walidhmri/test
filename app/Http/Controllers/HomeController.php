<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {
        $query=$request->input('search');
        if($query){
               $faqs=Faq::where('question','like','%'.$query.'%')->orWhere('answer','like','%'.$query.'%')->orderBy('created_at','desc')->paginate(5);
        }else{
            $faqs=Faq::orderBy('created_at','desc')->paginate(5);
        }
        return view('faqs',compact('faqs'));
    }
    public function show($id) {
        $faq=Faq::findOrFail($id);
        return view('faq',compact('faq'));
    }
}
