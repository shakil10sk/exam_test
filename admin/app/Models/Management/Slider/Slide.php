<?php

namespace App\Models\Management\Slider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;
use Illuminate\Support\Facades\Request;
class Slide extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'caption', 'photo', 'sequence','is_process', 'union_id', 'status', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    //get slides
    public static function getSlides()
    {
        $data = Slide::where('union_id', Auth::user()->union_id)->whereNull('deleted_at')->orderBy('sequence', 'asc')->get();
        return $data;
    }

    //store slide
    public static function store($request)
    {
        $id = Slide::create($request->except('_token', 'photo'))->id;

        if($request->hasFile('photo')){
            $photo = $request->photo;
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = Auth::user()->union_id.$id.'.'.$fileExtension;
            Image::make($photo)->resize(960, 322)->save(base_path('public/assets/images/slider/'.$fileName), 100);
            Slide::find($id)->update([
                'photo'      => $fileName
            ]);
        }

        return true;
    }

    //get slide order by sequence
    public static function sequence()
    {
        $data = Slide::where('union_id', Auth::user()->union_id)->orderBy('sequence', 'desc')->get();
        return $data;
    }

    //get sequence
    public static function GetSequence()
    {
        $data = Slide::where('union_id', Auth::user()->union_id)->orderBy('sequence', 'desc')->first()->sequence;
        return $data;
    }

    //update status
    public static function updateStatus($id)
    {
        $status = Slide::where('union_id', Auth::user()->union_id)->where('id', $id)->first()->status;

        if ($status){
            Slide::find($id)->update([
                'status'        => false,
                'updated_by'    => Auth::user()->employee_id,
                'updated_by_ip' => Request::ip()
            ]);
        }else{
            Slide::find($id)->update([
                'status'        => true,
                'updated_by'    => Auth::user()->employee_id,
                'updated_by_ip' => Request::ip()
            ]);
        }
        return true;
    }

    //update slide
    public static function updateSlide($request)
    {
        Slide::find($request->id)->update($request->except('_token', 'photo'));

        if($request->hasFile('photo')){
            $photo = $request->photo;
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = Auth::user()->union_id.$request->id.'.'.$fileExtension;
            Image::make($photo)->resize(960, 322)->save(base_path('public/assets/images/slider/'.$fileName), 100);
            Slide::find($request->id)->update([
                'photo'      => $fileName
            ]);
        }

        return true;
    }

    //update sequence
    public static function updateSequence($request)
    {
        foreach ($request->seq as $key => $item)
        {
            Slide::find($item)->update([
                'sequence' => $key+1,
                'updated_by' => Auth::user()->id,
                'updated_by_ip' => $request->ip()
            ]);
        }
        return true;
    }



    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
            $query->updated_by = Auth::user()->id;
        });

        static::deleting(function ($query) {

            $query->is_process = 0;
            $query->updated_by = 3699;
            $query->save();

        });


    }


}
