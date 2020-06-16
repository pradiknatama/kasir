@extends('layouts.dashboard')
@section('title')
    <title>kasir</title>
@endsection

@section('content')
  <h3 class="page-title">Manajemen Produk</h3>
  <div class="row">
    <div class="col-md-12">
      <!-- BASIC TABLE -->
      <div class="panel">
        <div class="panel-heading">
          <a href="produk/create" class="btn btn-primary">Tambah Produk</a>
        </div>
        @if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif

        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                {{-- <th>Kode Produk</th> --}}
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Last Update</th>
                <th>aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($view as $view)
                <tr>
                  <td>
                    <img src="{{ asset('image/produk/' . $view->foto) }}"
                        alt="{{ $view->foto }}" width="50px" height="50px">
                  </td>
                  <td>
                      <sup class="label label-success">({{ $view->code }})</sup>
                      <strong>{{ ucfirst($view->nama_produk) }}</strong>
                  </td>
                  <td>{{$view->stock}}</td>
                  <td>{{$view->harga}}</td>
                  <td>{{$view->updated_at}}</td>
                  <td>
                      <form action="" method="POST">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                          <a href="{{URL('/produk/edit',$view->id_produk)}}"
                              class="btn btn-warning btn-sm">
                              <i class="fa fa-edit"></i>
                          </a>
                          <button class="btn btn-danger btn-sm">
                              <i class="fa fa-trash"></i>
                          </button>
                      </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
