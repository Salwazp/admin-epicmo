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
    <!-- Galleries table -->
    <section id="ajax-galleries-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Galleries</h4>
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">Add Gallery</a>
                    </div>
                    <div class="card-datatable">
                        <table class="table" id="data-galleries">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Highlight Text</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Gallery Images table -->
    <section id="ajax-gallery-images-datatable" class="mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Gallery Images</h4>
                        <a href="{{ route('admin.gallery.image.create') }}" class="btn btn-primary">Add Image</a>
                    </div>
                    <div class="card-datatable">
                        <table class="table" id="data-gallery-images">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Display Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        // Galleries DataTable
        var galleriesTable = $('#data-galleries').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.gallery.index') }}",
                data: function(d) {
                    d.table_type = 'galleries';
                }
            },
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'highlight_text',
                name: 'highlight_text'
            },
            {
                data: 'description',
                name: 'description',
                render: function(data) {
                    // Limit description length to prevent table overflow
                    return data.length > 50 ? data.substr(0, 50) + '...' : data;
                }
            },
            {
                data: 'id',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(id) {
                    return `
                    <div class="btn-group">
                        <button class="btn btn-flat-dark dropdown-toggle" type="button" id="dropdownMenuButton${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://assets-vuexy.sobatteknologi.com/images/align-justify.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${id}">
                            <a class="dropdown-item" href="/admin/gallery/edit/${id}">Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="return deleteGallery(${id})">Delete</a>
                        </div>
                    </div>
                    `;
                }
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
                            return 'Details of Gallery: ' + data['title'];
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
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });

        // Gallery Images DataTable
        var imagesTable = $('#data-gallery-images').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.gallery.index') }}",
                data: function(d) {
                    d.table_type = 'gallery_images';
                }
            },
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
                data: 'image',
                name: 'image',
                render: function(data) {
                    return `<img src="${data}" width="100" class="img-thumbnail">`;
                }
            },
            {
                data: 'display_order',
                name: 'display_order'
            },
            {
                data: 'id',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(id) {
                    return `
                    <div class="btn-group">
                        <button class="btn btn-flat-dark dropdown-toggle" type="button" id="dropdownImgButton${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://assets-vuexy.sobatteknologi.com/images/align-justify.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownImgButton${id}">
                            <a class="dropdown-item" href="/admin/gallery/image/edit/${id}">Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="return deleteImage(${id})">Delete</a>
                        </div>
                    </div>
                    `;
                }
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
                            return 'Details of Gallery Image';
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
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    });

    function deleteGallery(id){
        var table = $('#data-galleries').DataTable();
        showDeleteConfirmation(id, table, 'Gallery');
    }

    function deleteImage(id){
        var table = $('#data-gallery-images').DataTable();
        showDeleteConfirmation(id, table, 'Image', true);
    }

    function showDeleteConfirmation(id, table, itemType, isImage = false) {
        clearToastObj = toastr['error'](
            `Are You Sure You Want To Delete This ${itemType}?<br /><br /><button type="button" class="btn btn-danger btn-sm delete">Yes</button>`,
            'Confirmation',
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
                
                // Construct the correct URL based on whether it's an image or gallery
                const deleteUrl = isImage 
                    ? `/admin/gallery/image/delete/${id}`  // Specific URL for image deletion
                    : `/admin/gallery/delete/${id}`;       // URL for gallery deletion
                
                $.ajax({
                    method: "GET",
                    url: deleteUrl,
                    success: function (data) {
                        toastr['success'](`Successfully Deleted ${itemType}.`, 'Success', {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                        table.ajax.reload();
                    },
                    error: function (data) {
                        toastr['error'](`Failed to delete ${itemType}. Please try again.`, 'Error', {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true
                        });
                    }
                });
            });
        }
    }
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