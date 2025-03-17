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
                        <li class="breadcrumb-item"><a href="#">Gallery</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="content-body">
        <section class="bs-validation">
            @if ($data !== null)
            <form action="{{ route('admin.gallery.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.gallery.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Gallery
                                    @else
                                    Update Gallery
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" placeholder="Kata pertama (Highlight) kata kedua " class="form-control @error('title') border-danger @enderror" value="{{ $data ? $data->title : '' }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="subtitle" class="form-control @error('subtitle') border-danger @enderror" value="{{ $data ? $data->subtitle : '' }}">
                                    @error('subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Text Highlight 1</label>
                                    <input type="text" name="text_highlight1" class="form-control @error('text_highlight1') border-danger @enderror" value="{{ $data ? $data->text_highlight[0] : '' }}">
                                    @error('text_highlight1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Text Highlight 2</label>
                                    <input type="text" name="text_highlight2" class="form-control @error('text_highlight2') border-danger @enderror" value="{{ $data ? $data->text_highlight[1] : '' }}">
                                    @error('text_highlight2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <button type="submit"
                        data-initial-text="Update <i class='icon-paperplane ml-2'></i>"
                        data-loading-text="<i class='fas fa-spinner fa-spin'></i> Loading..."
                        class="btn btn-primary"> Save Changes </button>
                    </div>
                </div>
            </form>
        </section>
        <!-- Basic table -->
        <section id="ajax-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-datatable">
                            <table class="table" id="data-notif">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Informasi Dimensi Gambar</th>
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
                ajax: "{{ route('admin.gallery.index') }}",
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
                    data    : 'image',
                    render  : function (data , row ){
                        return `<img src="${data}" width="100">`
                    }
                },
                {
                    data: 'dimensi',
                    name: 'dimensi'
                },
                {
                    data: 'id',
                    render: (id) => /* html */`
                    <div class="btn-group">
                        <button class="btn btn-flat-dark dropdown-toggle" type="button" id="dropdownMenuButton100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://assets-vuexy.sobatteknologi.com/images/align-justify.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/admin/gallery/image/edit/${id}">Edit</a>
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
