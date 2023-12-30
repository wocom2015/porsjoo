<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\slide;
use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, slider $slider)
    {

        $slider = Slider::all()->first();
        $slides = Slide::all()->where("slider_id", $slider->id);
        foreach ($slides as $slide) {
            if ($request->get($slide->id)) continue;
            $slide->delete();
        }
        if (!$request->file("slide")) {
            return $this->index($request);
        }
        $file = $request->file('slide');
        $extension = $file->getClientOriginalExtension();
        $name = Str::random(20);
        $fileName = $name . '.' . $extension;
        $path = 'storage/slides';
        $request->file('slide')->move($path, $fileName);
        Slide::create([
            'slider_id' => $slider->id,
            'url' => $path . '/' . $fileName
        ]);
        return back()->with('success', __("messages.slider_updated_successfully"));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("p.slider_configurations");
        $configs['slides'] = Slide::all();
        return view('admin.configurations.slider', compact("title", "configs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slider $slider)
    {
        //
    }

    public function addSlide(Request $request)
    {
    }

    public function addSlide_2(Request $request)
    {
        $slides = Configuration::where("slides")->first();
        if (!$slides) {
            Slide::create([
                'item' => 'slides',
                'value' => ';'
            ]);
        }
        $file = $request->file('slide');
        $extension = $file->getClientOriginalExtension();
        $name = Str::random(20);
        $fileName = $name . '.' . $extension;
        $path = storage_path() . '/app/public/slides';

        $request->file('slide')->move($path, $fileName);
    }

    public function removeSlide(Request $request)
    {

    }

}
