@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      @role('admin')

      <a href="{{route('agenda.tambah')}}" class="btn btn-primary m-l-10 waves-light  mb-2">Tambah</a>
      @else



      <div class="form-group row m-l-5">
        <button onclick="agenda_today()" class="btn btn-success waves-effect m-l-5 waves-light m-b-30">Lihat Hari Ini</button>
        <button onclick="agenda_semua()" class="btn btn-warning waves-effect m-l-5 waves-light m-b-30">Lihat Semua</button>
        <label class="pull-right m-l-10 col-form-label">Atau Cari Agenda</label>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Day, dd/mm/yyyy" id="datepicker-autoclose">
            <div class="input-group-append">
              <span class="input-group-text">
                <a onclick="agenda_day()" href="#">
                  <i class="ti-search"></i></span>
              </a>
            </div>
          </div><!-- input-group -->
        </div>
      </div>

      @endrole

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
            <th>Nomor Surat</th>
            <th>Hari/Tanggal</th>
            <th>Jam</th>
            <th>Tempat</th>
            <th>Jenis Agenda</th>
            <th>Tujuan Agenda</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>File Upload</th>
            @role('admin')
            <th>Aksi</th>
            @endrole
          </tr>
        </thead>



        <tbody>
          @foreach ($agenda AS $key=>$value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->nomor_surat}}</td>
            <td>{{date("l, d-F-Y", strtotime($value->tanggal))}}</td>
            <td>{{$value->jam}} s/d {{$value->jam2}}</td>
            <td>{{$value->tempat}}</td>
            <td>{{$value->jenis_agenda}}</td>
            @if($value->tujuan_jenis == 'tujuan_orang')
            <td>Bpk/Ibu {{$value->users[0]['name']}}</td>
            @elseif ($value->tujuan_jenis == 'tujuan_bidang')
            <td>Bidang {{$value->bidang[0]['name']}}</td>
            @endif
            <td>{{$value->keterangan}}</td>
            <td>
              <?php
              $date = new DateTime(($value->tanggal));
              $now = new DateTime();
              $now->modify('-1 day');
              ?>
              @if($date < $now ) Selesai @else - @endif </td>
            <td>
              @if ($value->file_upload != null)
              <a href="\storage\{{$value->file_upload}}" target="_BLANK" class="btn btn-rounded btn-info btn-sm"><i class="fa fa-file-pdf-o"></i></a>
              @else
              Tidak Terlampir
              @endif
            </td>
            @role('admin')
            @if($date < $now ) <td>-</td>
              @else
              <td>
                <div class="row">
                  <a href="{{route('agenda.edit',$value->id)}}" class="btn btn-rounded btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                  <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>
                </div>
              </td>
              @endif
              @endrole
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Hapus Agenda</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('agenda.hapus')}}" method="POST">
        {{csrf_field()}}
        <div>
          <input type="hidden" id='id_hapus' name='id'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus agenda ini?</h5>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">Hapus</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>
<!-- end row -->
<script type="text/javascript">
  $('.hapus').click(function() {
    var id = $(this).data('id');
    $('#id_hapus').val(id);
  });


  function agenda_today() {
    const date_format = new Date()
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    var today = days[date_format.getDay()] + ', ' + date_format.getDate() + '-' + monthNames[(date_format.getMonth())] + '-' + date_format.getFullYear()

    $('#datatable-buttons').DataTable()

    function filterData() {
      $('#datatable-buttons').DataTable().search(
        today
      ).draw()
    }
    filterData()
  }

  function agenda_semua() {
 
    $('#datatable-buttons').DataTable()

    function filterData() {
      $('#datatable-buttons').DataTable().search(
        ''
      ).draw()
    }
    filterData()
  }

  function agenda_day() {
    const date_format = document.getElementById('datepicker-autoclose').value
    $('#datatable-buttons').DataTable()

    function filterData() {
      $('#datatable-buttons').DataTable().search(
        date_format
      ).draw()
    }
    filterData()
  }
</script>

@endsection