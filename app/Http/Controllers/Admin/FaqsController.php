<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        $faqs=Faq::orderBy('created_at','desc')->paginate(5);
        return view('admin.faqs.list',compact('faqs'));
    }
    public function cretae()
    {
        return view('admin.faqs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('admin.faqs.list');
    }
    public function edit(Request $request)
    {
        $faq = Faq::find($request->id);
        return view('admin.faqs.edit',compact('faq'));}
    public function update(Request $request){
        $faq = Faq::find($request->id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('admin.faqs.list')->with('success', 'تم تحديث السؤال بنجاح.');;
        
    }
    public function destroy(Request $request)
    {
        $faq = Faq::find($request->id);
        $faq->delete();
        return redirect()->route('admin.faqs.list')->with('success', 'تم حذف السؤال بنجاح.');
    }
}
