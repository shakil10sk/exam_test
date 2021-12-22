<?php

namespace App\Http\Controllers\Management\Slider;

use App\Http\Controllers\Controller;
use App\Models\Management\Slider\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    //view slider
    public function index()
    {
        $slides = Slide::getSlides();
        // dd($slides);
        return view('management.slider.view_slider', ['slides' => $slides]);
    }

    //store slide
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:150',
            'photo'         => 'required|mimes:jpg,png,jpeg',
            'caption'       => 'string|max:200|nullable'
        ],[
            'title.required'    => 'স্লাইডার টাইটেল দিন....',
            'title.string'      => 'স্লাইডার টাইটেল দিন....',
            'title.max'         => 'স্লাইডার টাইটেল ১০০ অক্ষরের নিচে দিন....',

            'photo.required'    => 'স্লাইডার ফটো দিন....',
            'photo.mimes'       => 'স্লাইডার ফটো (jpg, png, jpeg) ফরমেট দিন....',
            'caption.string'    => 'স্লাইডার ক্যাপশন দিন....',
            'caption.max'       => 'স্লাইডার ক্যাপশন ২০০ অক্ষরের নিচে দিন....'
        ]);

        $request['union_id']        = Auth::user()->union_id;
        $request['created_by']      = Auth::user()->employee_id;
        $request['created_by_ip']   = $request->ip();
        if(count(Slide::sequence()) == 0){
            $request['sequence'] = 1;
        }else{
            $request['sequence'] = Slide::GetSequence() + 1;
        }
        $data = Slide::store($request);
        if ($data){
            Alert::toast('স্লাইডার অ্যাড হয়েছে!','success');
            return redirect()->back();
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }



    //update slider status
    public function updateStatus($id)
    {
        $data = Slide::updateStatus($id);
        return back();
    }

    //get slide
    public function getSlide(Request $request)
    {
        $data = Slide::find($request->id);
        return $data;
    }

    //update slide
    public function updateSlide(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:150',
            'photo'         => 'mimes:jpg,png,jpeg|nullable',
            'caption'       => 'string|max:200|nullable'
        ],[
            'title.required'    => 'স্লাইডার টাইটেল দিন....',
            'title.string'      => 'স্লাইডার টাইটেল দিন....',
            'title.max'         => 'স্লাইডার টাইটেল ১০০ অক্ষরের নিচে দিন....',

            'photo.mimes'       => 'স্লাইডার ফটো (jpg, png, jpeg) ফরমেট দিন....',
            'caption.string'    => 'স্লাইডার ক্যাপশন দিন....',
            'caption.max'       => 'স্লাইডার ক্যাপশন ২০০ অক্ষরের নিচে দিন....'
        ]);

        $request['updated_by']      = Auth::user()->employee_id;
        $request['updated_by_ip']   = $request->ip();

        $data = Slide::updateSlide($request);
        if ($data){
            Alert::toast('স্লাইডার আপডেট হয়েছে!','success');
            return redirect()->back();
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //update sequence
    public function updateSequence(Request $request)
    {
        $res = Slide::updateSequence($request);
        if ($res){
            return ['success' => 'yes'];
        }
    }

    //delete slide
    public function deleteSlide(Request $request)
    {
        Slide::whereId($request->id)->update([
            'deleted_at' => date('Y-m-d 00:00:00'),
            'is_process' => 0
        ]);

        return back();
    }
}
