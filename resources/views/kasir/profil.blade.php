@extends('layouts.dashboard')
@section('content')
  <div class="container-fluid">
    <div class="panel panel-profile">
      <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
          <!-- PROFILE HEADER -->
          <div class="profile-header">
            <div class="overlay"></div>
            <div class="profile-main">
              @if ($view->foto=='')
                <img src="{{ URL::to('/image/empty.jpg' ) }}" class="img-circle" alt="Avatar">
              @else
                {{-- <img src="{{ URL::to('/image/empty.jpg' ) }}" class="img-circle" alt="Avatar"> --}}
                <img src="{{ URL::to('/image/'.$view->foto ) }}" height="200px" width="200px" class="img-circle" alt="Avatar">
              @endif

              <h3 class="name">{{$view->nama}}</h3>
              <span class="online-status status-available">Available</span>
            </div>
            <div class="profile-stat">
              <div class="row">
                <div class="col-md-4 stat-item">
                  45 <span>Projects</span>
                </div>
                <div class="col-md-4 stat-item">
                  15 <span>Awards</span>
                </div>
                <div class="col-md-4 stat-item">
                  2174 <span>Points</span>
                </div>
              </div>
            </div>
          </div>
          <!-- END PROFILE HEADER -->
          <!-- PROFILE DETAIL -->
          <div class="profile-detail">
            <div class="profile-info">
              <h4 class="heading">Basic Info</h4>
              <ul class="list-unstyled list-justify">
                <li>Nama Pemilik <span>{{$view->nama}}</span></li>
                <li>Nama Toko <span>{{$view->nama_toko}}</span></li>
                <li>Alamat <span>{{$view->alamat}}</span></li>
                <li>No. Telp <span>{{$view->phone}}</span></li>
              </ul>
            </div>
            <br>
            <div class="profile-info">
              <h4 class="heading">Social</h4>
              <ul class="list-inline social-icons">
                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
              </ul>
            </div>


          </div>
          <!-- END PROFILE DETAIL -->
        </div>
        <!-- END LEFT COLUMN -->
        <!-- RIGHT COLUMN -->
        <div class="profile-right">
          <div class="panel-heading">
          <form class="form-horizontal" action="{{url('/updateProfil')}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="">Nama Pemilik</label>
                <input type="text" name="nama" value="{{$view->nama}}" required
                    maxlength="10"
                    class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('nama') }}</p>
            </div>
            <div class="form-group">
                <label for="">Nama Toko</label>
                <input type="text" name="nama_toko" value="{{$view->nama_toko}}" required
                    maxlength="10"
                    class="form-control {{ $errors->has('nama_toko') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('nama_toko') }}</p>
            </div>
            <div class="form-group">
                <label for="">Nama Toko</label>
                <input type="text" name="nama_toko" value="{{$view->nama_toko}}" required
                    maxlength="10"
                    class="form-control {{ $errors->has('nama_toko') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('nama_toko') }}</p>
            </div>

            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi"
                    cols="5" rows="5"
                    class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" >{{$view->deskripsi}}</textarea>
                <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
            </div>

            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat"
                    cols="5" rows="5"
                    class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}" >{{$view->alamat}}</textarea>
                <p class="text-danger">{{ $errors->first('alamat') }}</p>
            </div>
            <div class="form-group">
                <label for="">No.Telp</label>
                <input type="number" min="0" name="phone" value="{{$view->phone}}" required
                    maxlength="10"
                    class="form-control {{ $errors->has('phone') ? 'is-invalid':'' }}">
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            </div>
              <div class="form-group">
                <label for="">Foto</label>
                <input type="file" name="foto" class="form-control">
                <p class="text-danger">{{ $errors->first('foto') }}</p>
              </div>
              <div class="form-group">
                  {{-- <div class="col-md-6 col-md-offset-4"> --}}
                  <div class="text-center">
                    <input type="button" id="confirmedit" class="btn btn-primary" value="Edit"/>
                    <div class="text-center"><a href="#" class="btn btn-primary" id="btnupdate" data-toggle="modal" data-target="#modalEdit">Edit Profile</a></div>
                    {{-- <button type="button" class="btn btn-primary" id="btnupdate" data-toggle="modal" data-target="#modalEdit">
                        Update
                    </button> --}}
                      <input type="hidden" name="_token" value="{{ Session::token() }}">
                  {{-- </div> --}}
              </div>

              <div class="modal fade" id="modalEdit" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Konfirmasi Update</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <p>Anda akan menyimpan data yang telah diedit. Lanjutkan?</p>
                    </div>
                    <div class="modal-footer">
                      <input type="button" data-dismiss="modal" class="btn btn-danger" value="Batal"/><input type="submit" class="btn btn-success" value="simpan"/>
                      {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button> <button type="submit" class="btn btn-success">Simpan</button> --}}
                      {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button> <button class="btn btn-danger" type="submit">Simpan</button> --}}
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- END TABBED CONTENT -->
        </div>
      </div>
        <!-- END RIGHT COLUMN -->
      </div>
    </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
        $( ".form-control" ).prop( "disabled", true );
        $('#btnupdate').hide();
    });

    $("#confirmedit").click(function(){
        $('#btnupdate').show();
        $('#confirmedit').hide();
        $( ".form-control" ).prop( "disabled", false );
    });
    $(document).ready(function() {
        $( ".resize" ).prop( "disabled", true );
        $('#btnupdate').hide();
    });

    $("#confirmedit").click(function(){
        $('#btnupdate').show();
        $('#confirmedit').hide();
        $( ".resize" ).prop( "disabled", false );
    });
  </script>

@endsection
