@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

          <a href="#tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary m-l-10 waves-light  mb-5">Tambah</a>

      </div>



      @if(\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
      </div>
      @endif

      @if(\Session::has('success'))
      <div class="alert alert-success">
        <div>{{Session::get('success')}}</div>
      </div>
      @endif


      <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Didaftarkan</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>

          @foreach ($pegawai as $key=>$value)
          
          <tr>
            <td>{{$key}}</td>
            <td>{{$value->nip}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->email}}</td>
            <td>
              @if($value->jenis_kelamin == "L")
              Laki-Laki
              @else
              Perempuan
              @endif
            </td>
            <td>{{$value->jabatan}}</td>
            <td>{{$value->created_at}}</td>
            <td>
              <a href="#edit-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-success btn-sm modal_edit"><i class="fa fa-edit"></i></a>
              <!-- 
              <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-danger btn-sm "><i class="fa fa-trash"></i></a> -->
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->

<div id="tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tambah Pegawai</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{route('pegawai.tambah')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nip" required="" placeholder="NIP">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nama" required="" placeholder="Nama">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <select class="custom-select" name="jenis_kelamin">
              <option selected="" disabled>Jenis Kelamin</option>
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <select class="custom-select" name="bidang">
              <option selected="" disabled>Pilih Bidang</option>
              @foreach ($bidang as $key=>$value)
              <option value="{{$value->id}}">{{$value->name}}</option>
              @endforeach
            </select>
          </div>
        </div>




        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="jabatan" required="" placeholder="Jabatan">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="email" autocomplete="off" name="email" required="" placeholder="Email Aktif">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nomor_hp" required="" placeholder="Nomor Hp">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" autocomplete="off" type="text" name="password" required="" placeholder="Password">
          </div>
        </div>


        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tambah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="edit-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Edit Pegawai</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{route('pegawai.update')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" id="edit_id">
        <div class="form-group row">
          <label class="col-2 col-form-label">NIP</label>
          <div class="col-md-10">
            <input class="form-control" type="text" autocomplete="off" id="edit_nip" name="nip" required="" placeholder="NIP">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-2 col-form-label">Nama</label>
          <div class="col-md-10">
            <input class="form-control" type="text" autocomplete="off" id="edit_nama" name="nama" required="" placeholder="Nama">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-2 col-form-label">Jenis Kelamin</label>
          <div class="col-md-10">
            <select class="custom-select" id="edit_jk" name="jenis_kelamin">
              <option selected="" disabled>Jenis Kelamin</option>
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-2 col-form-label">Bidang</label>
          <div class="col-md-10">
            <select class="custom-select" id="edit_bidang" name="bidang">
              <option selected="" disabled>Pilih Bidang</option>
              @foreach ($bidang as $key=>$value)
              <option value="{{$value->id}}">{{$value->name}}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-2 col-form-label">Jabatan</label>
          <div class="col-md-10">
            <input class="form-control" type="text" autocomplete="off" id="edit_jabatan" name="jabatan" required="" placeholder="Jabatan">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-2 col-form-label">Email</label>
          <div class="col-md-10">
            <input class="form-control" type="email" autocomplete="off" id="edit_email" readonly name="email" required="" placeholder="Email Aktif">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-2 col-form-label">Nomor Hp</label>
          <div class="col-md-10">
            <input class="form-control" type="text" autocomplete="off" id="edit_nomor_hp" name="nomor_hp" required="" placeholder="Nomor Hp">
          </div>
        </div>




        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Ubah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<script type="text/javascript">
  $('.modal_edit').click(function() {
    var id = $(this).data('id');
    $.ajax({
      url: '{{url("pegawai/edit")}}/' + id,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        $('#edit_id').val(id)
        $('#edit_nip').val(data['nip'])
        $('#edit_nama').val(data['name'])
        $('#edit_jk').val(data['jenis_kelamin'])
        $('#edit_bidang').val(data['id_bidang'])
        $('#edit_jabatan').val(data['jabatan'])
        $('#edit_nomor_hp').val(data['nomor_hp'])
        $('#edit_email').val(data['email'])
      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })
  });
</script>

@endsection