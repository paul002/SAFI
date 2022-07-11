<?php
include "inc/header.php";

$categoryId = $_GET['id'];

$cq = "SELECT * FROM `uploads_category` WHERE `id` = $categoryId";
$cqObj = $db->fetchObject($cq);
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-upload">&nbsp;&nbsp;</i>Uploads</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addUploads">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Document
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page">Uploads</li>
        <li class="breadcrumb-item active" aria-current="page"><?=$cqObj->category;?></li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<input type="hidden" id="fileCategory" value="<?=$categoryId;?>">
<table id="documents" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>File Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>File Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- UPLOADS MODAL -->
<div class="modal fade" id="addUploads" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="uploadDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-bg">
                <i class="fas fa-fw fa-upload fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="uploadDialogLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadsForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id" value="0">
                    <input type="hidden" id="upload" name="upload">
                    <div class="form-row">
                        <div class="col-6 mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-6 mb-3">
                            <label>Category</label>
                            <Select name="category" id="category" class="form-control"></Select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-12">
                            <textarea name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label>File</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm save" name="save" id="save"><i class="fas fa-fw fa-save">&nbsp;</i>Save</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times">&nbsp;</i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="postDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  header-bg">
                <i class="fas fa-fw fa-trash fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="roleModalLabel">Delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="delPost" value="">
                    <i class="fas fa-fw fa-times text-danger fa-lg"></i>
                    <span>Are you sure you want to delete this Role?</span>
                </div>
                <div>
                    <span style="font-size:.7em; font-style:italic">[Once deleted, you cannot <b>undo</b> the changes]</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="comfirmDel"><i class="fas fa-fw fa-check">&nbsp;</i>Yes</button>
                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times">&nbsp;</i>Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
<script>
    var fileCategory = $('#fileCategory').val();
    var loadDocuments = $('#documents').DataTable({
        "searching": true,
        "processing": false,
        "serverMethod": "post",
        "ajax": {
            url: "scripts/load_uploads.php?id="+fileCategory
        },
        "columns": [{
                data: 'fileType'
            }, {
                data: 'title'
            },
            {
                data: 'description'
            },
            {
                data: 'category'
            },
            {
                data: 'action'
            }
        ]
    });

    $(document).ready(function() {
        loadDocuments.ajax.reload();
        $('.alert').hide();
        loadCategories(0, "-- Select Category --");
    });

    function loadCategories(id, value) {
        $.ajax({
            url: "scripts/load_uploads_categories.php",
            type: "post",
            dataType: "json",
            success: function(data) {
                var s = '<option value="' + id + '">' + value + '</option>';
                for (var i = 0; i < data.data.length; i++) {
                    s += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $("#category").html(s);
            }
        });
    }

    //  Submit Data
    $('#uploadsForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('description', CKEDITOR.instances['description'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/add_file_to_upload.php",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data != null) {
                    $('#addUploads').modal('hide');
                    var message = data['response']['message'];
                    var cl = data['response']['cl'];
                    var icon = data['response']['fa'];
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    $('#message').html(message);
                    $('#uploadsForm')[0].reset();
                    CKEDITOR.instances['description'].setData('');
                    loadDocuments.ajax.reload();
                }
            }
        })
    })

    // GET File ID TO DELETE MODAL
    $('#documents').on('click', '.del', function() {
        var id = $(this).data('id');
        $('#postDeleteModal').modal('show');
        $('#delPost').val(id);
    });

    // DELETE File
    $('#comfirmDel').on('click', function() {
        var id = $('#delPost').val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "scripts/add_file_to_upload.php",
            data: {
                fileId: id
            },
            success: function(data) {
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-' + cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#postDeleteModal').modal('hide');
                loadDocuments.ajax.reload();
            }
        });
    });
</script>