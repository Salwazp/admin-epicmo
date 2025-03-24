<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://www.sobat-teknologi.com" target="_blank">__</a>V.01.05.021</span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="/app-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="/app-assets/vendors/js/editors/quill/quill.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/app-assets/js/scripts/components/components-dropdowns.js"></script>
<script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
<script src="/app-assets/js/scripts/forms/form-quill-editor.js"></script>
<script src="/app-assets/js/scripts/forms/form-file-uploader.js" defer></script>
<script src="/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="/app-assets/js/scripts/forms/form-select2.js"></script>
<script src="/app-assets/js/scripts/forms/form-input-mask.js"></script>
<script src="/app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
<script src="/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

<script type="text/javascript">
    var loadFile = function (event) {
        var output = document.getElementById('foto_profile_1');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile2 = function (event) {
        var output = document.getElementById('foto_profile_2');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile3 = function (event) {
        var output = document.getElementById('foto_profile3');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile4 = function (event) {
        var output = document.getElementById('foto_profile4');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $(function (){
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });

        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    });
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#features' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

{{-- <script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script> --}}
<script>
    $(function(){
        $('form').on('submit', function(e){
            var btn = $(this).find('button[type=submit]'),
            loadingText = "<i class='fas fa-spinner fa-spin'></i> Loading...";
            btn.html(loadingText).addClass('disabled').attr('disabled', true);
        });
    })
</script>