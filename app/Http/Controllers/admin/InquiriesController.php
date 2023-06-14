<?php

namespace App\Http\Controllers\admin;

use App\DataTables\InquiriesDataTable;
use App\Http\Controllers\Controller;

class InquiriesController extends Controller
{
    function index(InquiriesDataTable$dataTable){
        $title = __("p.inquiries_list");
        return $dataTable->render("admin.inquiries.index" , compact("title"));
    }
}
