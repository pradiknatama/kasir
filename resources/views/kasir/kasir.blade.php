@extends('layouts.dashboard')

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <!-- RECENT PURCHASES -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Kasir</h3>
            <div class="right">
              <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
              <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
            </div>
          </div>
          <form method="post" id="multiple_select_form">
            <div class="form-group">
              <label for="">Produk</label>
              <select id="produk_pilihan" class="form-control js-example-basic-single " style="width:100%" name="produk">
                @foreach ($products as $product)
                <option value="{{$product->id_produk}}">{{ $product->code }} - {{ $product->nama_produk }}</option>
              @endforeach
              </select>
              <div class="form-group">
                  <label for="">Qty</label>
                  <input type="number" name="qty"
                      v-model="cart.qty"
                      id="qty" value="1"
                      min="1" class="form-control">
              </div>
            </div>

            {{-- <br /><br /> --}}
            <input type="hidden" name="hidden_framework" id="hidden_framework" />
            <input type="submit" name="submit" class="btn btn-info" value="Submit" />
          </form>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
              <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Purchases</a></div>
            </div>
          </div>
        </div>
        <!-- END RECENT PURCHASES -->

      </div>
      <div class="col-md-5">
        <!-- MULTI CHARTS -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Detail Produk</h3>
            <div class="right">
              <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
              <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
            </div>
          </div>
          <div class="panel-body">
            <div v-if="product.nama_produk">
                <table class="table table-stripped">
                    <tr>
                        <th>Kode</th>
                        <td>:</td>
                        <td>@{{ product.code }}</td>
                    </tr>
                    <tr>
                        <th width="3%">Produk</th>
                        <td width="2%">:</td>
                        <td>@{{ product.name }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>:</td>
                        <td>@{{ product.price | currency }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-3" v-if="product.photo">
            <img :src="'/uploads/product/' + product.photo"
                height="150px"
                width="150px"
                :alt="product.name">
        </div>
          </div>
        </div>
        <!-- END MULTI CHARTS -->
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
  $(document).ready(function(){
  $("#produk_pilihan").on('change', function(e){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
  method : "POST",
  data : {
  "id" : e.target.value,
  },
  url : "{{url('/cariData')}}",
  success:function(z){
    alert(z.nama_produk);
  }
  })
  })
  })
</script>

@endsection
