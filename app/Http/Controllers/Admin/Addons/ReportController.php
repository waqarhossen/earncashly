<?php

namespace App\Http\Controllers\Admin\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function all_offers()
    {
        return view('admin.reports.all_offers');
    }

    public function completed_offers()
    {
        return view('admin.reports.completed_offers');
    }
}