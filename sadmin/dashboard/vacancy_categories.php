<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user">&nbsp;&nbsp;</i>Vacancy Categories</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addCategory">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Category
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="vacancy.php">Work with us</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vacancy Categories</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="categories_tbl" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<div class="modal fade" id="addCategory" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="categoryDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-bg">
                <i class="fas fa-fw fa-file fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="categoryDialogLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="category_form">
                <div class="modal-body">
                    <div class="form-row mb-4">
                        <span style="font-size:.7em; font-style:italic">[Fields marked with <span class="text-danger">*</span> are mandatory]</span>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id" value="0">
                    <div class="form-row">
                        <div class="col-6">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="col-6">
                            <label>Description <span class="text-danger"></span></label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                        </div>
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
<div class="modal fade" id="postDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  header-bg">
                <i class="fas fa-fw fa-trash fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="postModalLabel">Delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="delPost" value="">
                    <i class="fas fa-fw fa-times text-danger fa-lg"></i>
                    <span>Are you sure you want to delete this Post?</span>
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
    let load_categories = $('#categories_tbl').DataTable({
        "searching": true,
        "processing": false,
        "serverMethod": "post",
        "dataSrc": "data",
        "ajax": {
            url: "scripts/load_vacancy_categories.php"
        },
        "columns": [{
                data: 'name'
            },
            {
                data: 'description'
            },
            {
                data: 'action'
            }
        ]
    });
    $(document).ready(function() {
        $('.alert').hide();
        newform();
    });

    // Submit data
    $('#category_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "scripts/add_vacancy_category.php",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data != null) {
                    $('#addCategory').modal('hide');
                    var message = data['response']['message'];
                    var cl = data['response']['cl'];
                    var icon = data['response']['fa'];
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    $('#message').html(message);
                    $('#category_form')[0].reset();
                    load_categories.ajax.reload();
                    newform(); 
                }
            }
        })
    });

    // Load Edit Data
    $('#categories_tbl').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "scripts/load_vacancy_categories.php",
            type: "GET",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#id').val(data[0]['id']);
                $('#name').val(data[0]['name']);
                $('#description').val(data[0]['description']);
                document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Update';
                document.getElementById('categoryDialogLabel').innerHTML = "Edit Category";
                $('#addCategory').modal('show');
            }
        });
    });

    // GET Project ID TO DELETE MODAL
    $('#projects_tbl').on('click', '.del', function() {
        var id = $(this).data('id');
        $('#postDeleteModal').modal('show');
        $('#delPost').val(id);        
    });

    // DELETE Project
    $('#comfirmDel').on('click', function() {
        var id = $('#delPost').val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "scripts/add_vacancy_category.php",
            data: {
                vacancyId: id
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
                load_categories.ajax.reload();
            }
        });
    });

    function newform() {
        document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Save';
        document.getElementById('categoryDialogLabel').innerHTML = "New Category";
    }
</script>