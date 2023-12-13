<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreslideRequest;
use App\Http\Requests\UpdateslideRequest;
use App\Models\slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::all();
        return $slides;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreslideRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateslideRequest $request, slide $slide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slide $slide)
    {
        //
    }
}
