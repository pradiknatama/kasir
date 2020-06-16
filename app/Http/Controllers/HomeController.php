<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as Auth;
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
      $level=Auth::user()->level;
      switch ($level) {
        case '1':
          return $this->dashbordLevel1();
          break;
        case '2':
          return $this->dashbordLevel2();
          break;
        default:
      }
        // return view('home');
    }
    protected function dashbordLevel1(){
      $kasir=DB::table('Users')
      ->select('users.*')
      ->get();
      return view('admin.index',compact('kasir'));
    }
    protected function dashbordLevel2(){
      $kasir=DB::table('profil')
      ->join('users', 'profil.id_user', '=', 'users.id')
      ->select('profil.*', 'users.*')
      ->where('users.level','=',2)
      ->first();
      return view('kasir.index',compact('kasir'));
    }
}
