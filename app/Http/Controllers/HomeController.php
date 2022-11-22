<?php

namespace App\Http\Controllers;


use App\Client;
use App\Taylor;
use App\Convection;
use Illuminate\Http\Request;

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

        $clients_count = Client::count();
        $convections_count = Convection::count();
        $taylors_count = Taylor::count();

        return view('home', [

            'clients_count' => $clients_count,
            'convections_count' => $convections_count,
            'taylors_count' => $taylors_count,
            'totals_count' => $taylors_count + $convections_count + $clients_count,

        ]);
    }
}
