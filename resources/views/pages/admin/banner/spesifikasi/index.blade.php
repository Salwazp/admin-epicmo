@extends('layouts.admin.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Spesifikasi</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="content-body">

        <!-- Basic table -->
        <section id="ajax-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Spesifikasi</h4>
                            <a href="{{ route('admin.banner.spesifikasi.create', $banner->id) }}" class="btn btn-primary">Add Data</a>
                        </div>
                        <div class="card-datatable">
                            <table class="table" id="data-notif">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Vessel Name</th>
                                        <th>Image</th>
                                        <th>Year Built</th>
                                        <th>Vessel Type</th>
                                        <th>Capacity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Basic table -->
    </div>

    @endsection

    @section('script')
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#data-notif').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.banner.spesifikasi.index', $banner->id) }}",
                columns: [
                {
                    data: null, "sortable": false,
                    render: function (data, type, row, meta) { return ''; },
                },
                {
                    data: null, "sortable": false,
                    render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; },
                },
                {
                    data: 'vessel_name',
                    name: 'vessel_name'
                },
                {
                    data    : 'image',
                    render  : function (data , row ){
                        return `<img src="${data}" width="100">`
                    }
                },
                {
                    data: 'year_built',
                    name: 'year_built'
                },
                {
                    data: 'vessel_type',
                    name: 'vessel_type'
                },
                {
                    data: 'capacity',
                    name: 'capacity'
                },
                {
                    data: 'id',
                    render: (id) => /* html */`
                    <div class="btn-group">
                        <button class="btn btn-flat-dark dropdown-toggle" type="button" id="dropdownMenuButton100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://assets-vuexy.sobatteknologi.com/images/align-justify.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/admin/banner/spesifikasi/edit/${id}">Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="return hapus(${id})">Delete</a>
                        </div>
                    </div>
                    `
                },
                ],
                columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets: 0
                }
                ],
                dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                orderCellsTop: true,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details of ' + data['full_name'];
                            }
                        }),
                        type: 'column',
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                drawCallback: () => {
                    $('.delete').click(function () {
                        const id = $(this).data(id)
                    })
                }
            });
        });

        function hapus(id){
            var table = $('#data-notif').DataTable();
            clearToastObj = toastr['error'](
                'Are You Delete?<br /><br /><button type="button" class="btn btn-danger btn-sm delete">Yes</button>',
                'Deleted',
                {
                    closeButton: true,
                    timeOut: 0,
                    extendedTimeOut: 0,
                    tapToDismiss: false,
                }
                );

            if (clearToastObj.find('.delete').length) {
                clearToastObj.delegate('.delete', 'click', function () {
                    toastr.clear(clearToastObj, { force: true });
                    clearToastObj = undefined;
                    $.ajax({
                        method: "GET",
                        url: "/admin/banner/spesifikasi/delete/" + id,
                        success: function (data) {
                            toastr['success']('Successfully Delete Data.', 'Successfully', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                            });
                            table.ajax.reload();
                        },
                        error: function (data) {
                            toastr['success']('👋 Chocolate oat cake jelly oat cake candy jelly beans pastry.', 'Progress Bar', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                        }
                    });
                });
            }
        }
    </script>
    <script>
        $(function (){
            $('.hapus').on('click', function () {
                var id = $(this).attr('data-id');
                console.log(id);
            });
        });
    </script>
    @if(Session::get('create'))
        <script type="text/javascript">
            $(document).ready(function(){

                // Success Type
                toastr['success']('Successfully Create Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });

            });
        </script>
    @endif

    @if(Session::get('update'))
        <script type="text/javascript">
            $(document).ready(function(){

                // Success Type
                toastr['success']('Successfully Update Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });

            });
        </script>
    @endif

@endsection
