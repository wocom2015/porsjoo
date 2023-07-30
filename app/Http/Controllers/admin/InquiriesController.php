<?php

namespace App\Http\Controllers\admin;

use App\DataTables\InquiriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;


class InquiriesController extends Controller
{
    function index(InquiriesDataTable$dataTable){
        $title = __("p.inquiries_list");
        return $dataTable->render("admin.inquiries.index" , compact("title"));
    }


    function destroy($id){
        Inquiry::where("id" , $id)->delete();
            return back();
    }
}
