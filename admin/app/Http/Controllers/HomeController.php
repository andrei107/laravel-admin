<?php

namespace App\Http\Controllers;

use App\Models\CMS\ReceiptModel;
use App\Models\CMS\MenuModel;
use App\Models\CMS\AdviceModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'receiptCount' => ReceiptModel::all()->count(),
            'menuCount' => MenuModel::all()->count(),
            'adviceCount' => AdviceModel::all()->count(),
        ]);
    }
}
