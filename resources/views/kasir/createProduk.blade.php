@extends('layouts.dashboard')
@section('content')
  <div class="container-fluid">
    <div class="panel panel-profile">
      <div class="clearfix">
          <div class="panel-heading">
          <form class="form-horizontal" action="{{url('/createProduk')}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="">Kode Produk</label>
                <input type="text" name="code" required
                    maxlength="10"
                    class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('code') }}</p>
            </div>
            <div class="form-group">
                <label for="">Nama Produk</label>
                <input type="text" name="nama_produk" required
                    class="form-control {{ $errors->has('nama_produk') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('nama_produk') }}</p>
            </div>
            <div class="form-group">
                <label for="">Stok</label>
                <input type="number" name="stock" required
                    class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('stock') }}</p>
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="number" name="harga" required
                    class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('harga') }}</p>
            </div>
              <div class="form-group">
                <label for="">Foto</label>
                <input type="file" name="foto" class="form-control">
                <p class="text-danger">{{ $errors->first('foto') }}</p>
              </div>
              <div class="form-group">
                  <div class="text-center">
                    <input type="submit" id="confirmedit" class="btn btn-primary" value="Simpan"/>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
              </div>
            </form>
          </div>
          <!-- END TABBED CONTENT -->
        </div>
        <!-- END RIGHT COLUMN -->
      </div>
    </div>

@endsection
