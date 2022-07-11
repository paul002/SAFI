<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user">&nbsp;&nbsp;</i>Work with us</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addVacancy">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Vacancy
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Work with us</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="vacancy_tbl" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Position</th>
            <th>Category</th>
            <th>Closing Date</th>
            <th>Status</th>
            <th>Location</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>Position</th>
            <th>Category</th>
            <th>Closing Date</th>
            <th>Status</th>
            <th>Location</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<div class="modal fade" id="addVacancy" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="vacancyDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-bg">
                <i class="fas fa-fw fa-file fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="vacancyDialogLabel">New Vacancy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="vacancy_form" action="scripts/add_vacancy.php" method="post">
                <div class="modal-body">
                    <div class="form-row mb-4">
                        <span style="font-size:.7em; font-style:italic">[Fields marked with <span class="text-danger">*</span> are mandatory]</span>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id" value="0">
                    <div class="form-row">
                        <div class="col-6">
                            <label>Position <span class="text-danger">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="Position">
                        </div>
                        <div class="col-6">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-6">
                            <label>Closing Date <span class="text-danger">*</span></label>
                            <input type="text" name="closing_date" id="closing_date" class="form-control" />
                        </div>
                        <div class="col-6">
                            <label>Location <span class="text-danger">*</span></label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Location">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <label style="margin-top: 10px;">Closed&nbsp;&nbsp;</label>
                        <input type="checkbox" name="status" id="status" />
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <textarea name="description" id="description" class="form-control"></textarea>
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
    CKEDITOR.replace('description');
</script>
<script type="text/javascript">
    let load_vacancy = $('#vacancy_tbl').DataTable({
        "searching": true,
        "processing": false,
        "serverMethod": "post",
        "dataSrc": "data",
        "ajax": {
            url: "scripts/load_vacancies.php"
        },
        "columns": [{
                data: 'position'
            },
            {
                data: 'category'
            },
            {
                data: 'closing_date'
            },
            {
                data: 'status'
            },
            {
                data: 'location'
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
        loadCategories(0, "-- Select Project Category --");
        $('#closing_date').datetimepicker({
            format: 'yyyy-mm-dd'
        });
    });

    function loadCategories(id, value) {
        $.ajax({
            url: "scripts/load_vacancy_categories.php",
            type: "GET",
            dataType: "json",
            data: {
                action: "reg"
            },
            success: function(data) {
                var s = '<option value="' + id + '">' + value + '</option>';
                for (var i = 0; i < data.data.length; i++) {
                    s += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $("#category").html(s);
            }
        });
    }

    // Submit data
    $('#vacancy_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('description', CKEDITOR.instances['description'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/add_vacancy.php",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data != null) {
                    $('#addVacancy').modal('hide');
                    var message = data['response']['message'];
                    var cl = data['response']['cl'];
                    var icon = data['response']['fa'];
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    $('#message').html(message);
                    $('#vacancy_form')[0].reset();
                    CKEDITOR.instances['description'].setData('');
                    load_vacancy.ajax.reload();
                }
            }
        })
    })

    // Load Edit Data
    $('#vacancy_tbl').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "scripts/load_vacancies.php",
            type: "GET",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                $('#id').val(data[0]['vacancy_id']);
                $('#position').val(data[0]['position']);
                $('#closing_date').val(data[0]['closing_date']);
                $('#location').val(data[0]['location']);
                let status = data[0]['status'];
                if(status == 1){
                    $('#status').prop('checked', true);
                }else{
                    $('#status').prop('checked', false);
                }
                loadCategories(data[0]['category_id'], data[0]['category']);
                CKEDITOR.instances['description'].setData(data[0]['description']);
                document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Update';
                document.getElementById('vacancyDialogLabel').innerHTML = "Edit Vacancy";
                $('#addVacancy').modal('show');
            }
        });
    });

    // GET Project ID TO DELETE MODAL
    $('#vacancy_tbl').on('click', '.del', function() {
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
            url: "scripts/add_vacancy.php",
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
                load_vacancy.ajax.reload();
            }
        });
    });
</script>