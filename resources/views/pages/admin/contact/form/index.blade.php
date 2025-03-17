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
                        <li class="breadcrumb-item"><a href="#">Contact</a>
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
                            <h4 class="card-title">Contact</h4>
                            <a href="{{ route('admin.contact.form.export') }}" class="btn btn-success">Export</a>
                        </div>
                        <div class="card-datatable">
                            <table class="table" id="data-notif">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
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
                ajax: "{{ route('admin.contact.form.list') }}",
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'subject',
                    name: 'subject'
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
