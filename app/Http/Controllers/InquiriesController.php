<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function index()
    {
        return view("website.inquiry.index");
    }
}
