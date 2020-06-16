<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\profil;
use Auth;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\User;

class profilControl extends Controller
{
  public function index(){
    $view=profil::where('id_user',Auth::user()->id)->first();
    return view('kasir.profil',compact('view'));
  }
  public function validator(Request $request){

    $rules = [
      'nama' => 'required|string',
      'phone' => 'required|digits_between:10,13',
      'alamat' => 'required|string',
      // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048'

    ];

    return Validator::make($request->all(), $rules);
  }
  public function updateProfile(Request $request){
    $edit1= User::all()->where('id',Auth::user()->id)->first();
    $edit = profil::all()->where('id_user',Auth::user()->id)->first();

    $validator = $this->validator($request);
    if($validator->passes()){

      if ($request->file('foto')=="") {
        $edit->foto=$edit->foto;
      }else{
        $fileName   = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move("image/", $fileName);
        $edit->foto= $fileName;

      }
      // if ($request->hasfile('foto')){
      //       $file = $request->file('foto');
      //       $extension = $file->getClientOriginalExtension();
      //       $filename = md5(time()).'.'.$extension;
      //       $file->move(public_path().'\imagineprofil',$filename);
      //       $edit->foto=$filename;
      //   } else {
      //       return $request;
      //       $edit->foto='';
      //   }
      $edit1->name=$request->nama;
      $edit->nama = $request->nama;
      $edit->nama_toko = $request->nama_toko;
      $edit->deskripsi = $request->deskripsi;
      $edit->alamat = $request->alamat;
      $edit->phone = $request->phone;


      $edit->update();
      $edit1->save();
      return Redirect::back();

    }else{

      return Redirect::back()
      ->withErrors($validator)
      ->withInput();

    }
  }
}
