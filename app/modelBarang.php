<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelBarang extends Model
{
  protected $table = 'produk';
  protected $primaryKey = 'id_produk';
  protected $fillable = [
    'id_user','code','nama_produk','stock','harga','foto',

  ];
}
