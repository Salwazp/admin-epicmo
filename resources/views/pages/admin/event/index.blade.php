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
                        <li class="breadcrumb-item"><a href="#">Event</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Events table -->
    <section id="ajax-events-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Event</h4>
                        <a href="{{ route('admin.event.create') }}" class="btn btn-primary">Add Event</a>
                    </div>
                    <div class="card-datatable">
                        <table class="table" id="data-events">
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
    
    <!-- Event Categories table -->
    <section id="ajax-event-categories-datatable" class="mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Event Categories</h4>
                        <a href="{{ route('admin.event.category.create') }}" class="btn btn-primary">Add Category</a>
                    </div>
                    <div class="card-datatable">
                        <table class="table" id="data-event-categories">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Button Text</th>
                                    <th>Display Order</th>
                                    <th>Image</th>
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

        // Events DataTable
        var eventsTable = $('#data-events').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.event.index') }}",
                data: function(d) {
                    d.table_type = 'events';
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
                            <a class="dropdown-item" href="/admin/event/edit/${id}">Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="return deleteEvent(${id})">Delete</a>
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
                            return 'Details of Event: ' + data['title'];
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

        // Event Categories DataTable
        var categoriesTable = $('#data-event-categories').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.event.index') }}",
                data: function(d) {
                    d.table_type = 'categories';
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
                data: 'description',
                name: 'description',
                render: function(data) {
                    // Limit description length to prevent table overflow
                    return data.length > 50 ? data.substr(0, 50) + '...' : data;
                }
            },
            {
                data: 'button_text',
                name: 'button_text'
            },
            {
                data: 'display_order',
                name: 'display_order'
            },
            {
                data: 'image',
                name: 'image',
                render: function(data) {
                    return data ? `<img src="${data}" width="100" alt="Moment Image">` : 'No Image';
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
                        <button class="btn btn-flat-dark dropdown-toggle" type="button" id="dropdownCatButton${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://assets-vuexy.sobatteknologi.com/images/align-justify.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownCatButton${id}">
                            <a class="dropdown-item" href="/admin/event/category/edit/${id}">Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="return deleteCategory(${id})">Delete</a>
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
                            return 'Details of Event Category: ' + data['title'];
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

    function deleteEvent(id){
        var table = $('#data-events').DataTable();
        showDeleteConfirmation(id, table, 'Event');
    }

    function deleteCategory(id){
        var table = $('#data-event-categories').DataTable();
        showDeleteConfirmation(id, table, 'Category', true);
    }

    function showDeleteConfirmation(id, table, itemType, isCategory = false) {
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
                
                // Construct the correct URL based on whether it's a category or not
                const deleteUrl = isCategory 
                    ? `/admin/event/category/delete/${id}`  // Specific URL for category deletion
                    : `/admin/event/delete/${id}`;          // URL for event deletion
                
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