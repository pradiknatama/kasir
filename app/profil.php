<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profil extends Model
{
  protected $table = 'profil';
  protected $primaryKey = 'idProfil';
  protected $fillable = [
    'id_user','nama','nama_toko','deskripsi','alamat', 'phone','foto',

  ];

  public $timestamps=false;
}
