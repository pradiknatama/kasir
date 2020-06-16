<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelBarang;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;

class produkControll extends Controller
{
  public function index(){
    $view=modelBarang::all();
    return view('kasir.produk',compact('view'));
  }
  public function GetAddProduct(){
    return view('kasir.createProduk');
  }

  public function validator(Request $request){
    $rules = [
      'code' => 'required|string|max:10|unique:produk',
      'nama_produk' => 'required|string|max:100',
      'stock' => 'required|integer',
      'harga' => 'required|integer',
      // 'foto' => 'nullable|image|mimes:jpg,png,jpeg'
    ];
      return Validator::make($request->all(), $rules);
  }
  public function tambahProduk(Request $request){
    $validator = $this->validator($request);
    if($validator->passes()){
      $fileName=$request->file('foto')->getClientOriginalName();
      $request->file('foto')->move("image/produk/",$fileName);
      $insert=modelBarang::create([
        'id_user'=>Auth::user()->id,
        'code'=>$request->code,
        'nama_produk'=>$request->nama_produk,
        'stock'=>$request->stock,
        'harga'=>$request->harga,
        'foto'=>$request->file('foto')->getClientOriginalName(),
      ]);
      return redirect('produk')
      ->with(['success' =>  $insert->nama_produk . ' Ditambahkan']);
    }else{
      echo "salah";
      return Redirect::back()
      ->withErrors($validator)
      ->withInput();
    }
  }
  public function getEdit($id){
    $edit=modelBarang::findOrFail($id);
    return view('kasir.editProduk',compact('edit'));
  }
  public function kasir(){
    $products=modelBarang::orderBy('created_at','DESC')->get();
    return view('kasir.kasir',compact('products'));
  }
  public function show(Request $request){
    $produk = Produk::find($request->id);
    return response()->json($produk);
  }
}
