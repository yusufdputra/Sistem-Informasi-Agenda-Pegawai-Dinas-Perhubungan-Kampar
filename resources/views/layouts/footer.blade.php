<!-- Right Sidebar -->
@role('pegawai')
<div class="side-bar right-bar">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="mdi mdi-close-circle-outline"></i>
    </a>
    <h4 class="">Agenda Baru</h4>
    <div class="notification-list nicescroll">
        <ul class="list-group list-no-border user-list">
            @foreach ($agenda_baru AS $key=>$value)
            <li class="list-group-item">
                <a href="{{route ('agenda.index')}}" class="user-list-item">
                    <div class="icon bg-success">
                        <i class="mdi mdi-view-agenda"></i>
                    </div>
                    <div class="user-desc">
                        <span class="name">{{$value->jenis_agenda}}</span>
                        <span class="desc">{{$value->keterangan}}</span>
                        <span class="time">{{date("l, d-F-Y", strtotime($value->tanggal))}}</span>
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
@endrole
<!-- /Right-bar -->
<!-- jQuery  -->
</div>


<!-- Toastr js -->
<script src="{{asset('adminto/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('adminto/js/popper.min.js')}}"></script>
<script src="{{asset('adminto/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminto/js/detect.js')}}"></script>
<script src="{{asset('adminto/js/fastclick.js')}}"></script>
<script src="{{asset('adminto/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('adminto/js/waves.js')}}"></script>
<script src="{{asset('adminto/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('adminto/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('adminto/js/jquery.scrollTo.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('adminto/js/jquery.core.js')}}"></script>
<script src="{{asset('adminto/js/jquery.app.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('adminto/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('adminto/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/buttons.print.min.js')}}"></script>

<!-- Key Tables -->
<script src="{{asset('adminto/plugins/datatables/dataTables.keyTable.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('adminto/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminto/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Selection table -->
<script src="{{asset('adminto/plugins/datatables/dataTables.select.min.js')}}"></script>
<!-- Modal-Effect -->
<script src="{{asset('adminto/plugins/custombox/dist/custombox.min.js')}}"></script>
<script src="{{asset('adminto/plugins/custombox/dist/legacy.min.js')}}"></script>

<script src="{{asset('adminto/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<!-- time picker -->
<script src="{{asset('adminto/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<!-- file uploads js -->
<script src="{{asset('adminto/plugins/fileuploads/js/dropify.min.js')}}"></script>

<!-- select2 -->
<script src="{{asset('adminto/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // Select2
    $(".select2").select2();

    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (1M max).'
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        jQuery('#datepicker-autoclose').datepicker({

            format: "DD, dd-MM-yyyy",
            autoclose: true,
            todayHighlight: true,
        });
        // Default Datatable
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    title: 'Laporan Agenda Harian Dinas Perhubungan Kampar'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Laporan Agenda Harian Dinas Perhubungan Kampar'
                }
            ]
        });

        jQuery('.timepicker2').timepicker({
            showMeridian: false,
            icons: {
                up: 'mdi mdi-chevron-up',
                down: 'mdi mdi-chevron-down'
            }
        });

        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });

        // Responsive Datatable
        $('#responsive-datatable').DataTable();

        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>
</body>

</html>