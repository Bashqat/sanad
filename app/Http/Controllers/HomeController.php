<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterOrganisation;
use Auth;

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
      $user_id=Auth::id();
      $org=MasterOrganisation::where('superadmin_id',$user_id)->get();
      if($org->isEmpty())
      {
        return view('dashboard.index');
      }
      else {
          return view('dashboard.dashboard');
      }

    }
}
