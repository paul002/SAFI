<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-bars">&nbsp;&nbsp;</i>Menu</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Menu Item
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item">Menu</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="menu" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Label</th>
            <th>Level</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>Label</th>
            <th>Level</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- MODAL -->
<form id="menuForm">
    <div class="modal fade" id="addMenu" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="adminDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-bars fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="adminDialogLabel">New Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control" name="txtlabel" id="txtlabel" placeholder="Label" aria-label="txtlabel">
                        </div>
                        <div class="col">
                            <select name="ddlMenuLevel" id="ddlMenuLevel" class="form-control form-select" aria-label="Default select example">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="cboSelectParent">
                            <select name="ddlParentMenu" id="ddlParentMenu" class="form-control form-select" aria-label="Default select example">
                            </select>
                        </div>
                        <div class="col">
                            <select name="ddlPage" id="ddlPage" class="form-control form-select" aria-label="Default select example">
                            </select>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="isActive" class="form-check-input" id="isActive">
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm save" name="save" id="save"><i class="fas fa-fw fa-save">&nbsp;</i>Save</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times">&nbsp;</i>Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="contactId" name="contactId">
                    <i class="fas fa-fw fa-times text-danger fa-lg"></i>
                    <span>Are you sure you want to delete this Contact?</span>
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

<script>
    // var loadmenu = $('#menu').DataTable({
    //     "ajax": "scripts/load_menu_list.php"
    // });
    var loadmenu = $('#menu').DataTable({
        "searching": true,
        "processing": false,
        "ajax": {
            url: "scripts/load_menu_list.php",
            type: "POST",
            dataType: "JSON"
        },
        "columns": [{
                data: 'label'
            },
            {
                data: 'level'
            },
            {
                data: 'parent'
            },
            {
                data: 'isActive'
            },
            {
                data: 'buttons'
            }
        ]
    });
    $(document).ready(function() {
        loadmenu.ajax.reload();
        $('.alert').hide();
        $('#hasSubCol').hide();
        $('#cboSelectParent').hide();
        loadMenuLevel(0, '-- Select Menu Level --');
        loadPageList(0, '-- Select Page --');
    });

    // New
    $('.new').on('click', function() {
        $('#id').val(0);
        $('#name').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#department').val('');
        $('#isChecked').prop('checked', false);
        $('#addMenu').modal('show');

    });

    // Edit
    $('#menu').on('click', '.edit', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var email = $(this).data('email');
        var department = $(this).data('department');

        $('#id').val(id);
        $('#name').val(name);
        $('#phone').val(phone);
        $('#email').val(email);
        $('#department').val(department);
        $('#isChecked').prop('checked', false);
        $('#addMenu').modal('show');
    });

    // SAVE/UPDATE
    $('#menuForm').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: "scripts/menu_add.php",
            type: "POST",
            dataType: "JSON",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-' + cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#addMenu').modal('hide');
                loadmenu.ajax.reload();
            }
        });
    })

    $('#contacts').on('click', '.del', function() {
        var id = $(this).data('id');
        $('#contactId').val(id);
        $('#deleteModal').modal('show');
    })

    $('#comfirmDel').on('click', function() {
        var id = $('#contactId').val();
        $.ajax({
            url: "scripts/delete_scripts.php",
            type: "POST",
            dataType: "JSON",
            data: {
                contactId: id
            },
            success: function(data) {
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-' + cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#deleteModal').modal('hide');
                loadContacts.ajax.reload();
            }
        });
    })

    function loadMenuLevel(id, val) {
        $.ajax({
            url: "scripts/load_menu_level.php",
            dataType: "json",
            success: function(response) {
                var data = response.data;
                var s = '<option value="' + id + '">' + val + '</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i]['level'] + '">' + data[i]['description'] + '</option>';
                }
                $("#ddlMenuLevel").html(s);
            }
        });
    }
    $("#ddlMenuLevel").on('change', function() {
        let menuLevel = $('#ddlMenuLevel').val();
        if (menuLevel == 1) {
            $('#cboSelectParent').hide();
        }
        if (menuLevel == 2) {
            loadMenuList(0, '-- Select Parent Menu --', menuLevel);
            $('#cboSelectParent').show();
        }
        if (menuLevel == 3) {
            loadMenuList(0, '-- Select Parent Menu --', menuLevel);
            $('#cboSelectParent').show();
        }
    });

    function loadMenuList(id, val, menuLevel) {
        $.ajax({
            url: "scripts/load_parent_menu_list.php",
            dataType: "json",
            type: "POST",
            data: {level:menuLevel},
            success: function(response) {
                var data = response.data;
                var s = '<option value="' + id + '">' + val + '</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i]['id'] + '">' + data[i]['label'] + '</option>';
                }
                $("#ddlParentMenu").html(s);
            }
        });
    }

    function loadPageList(id, val) {
        $.ajax({
            url: "scripts/load_page_list.php",
            dataType: "json",
            success: function(response) {
                var data = response.data;
                var s = '<option value="' + id + '">' + val + '</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>';
                }
                $("#ddlPage").html(s);
            }
        });
    }
    // $("#chkHasSub").on('click', function() {
    //         if($(this).prop("checked") == true){
    //             $('#cboSelectParent').show();
    //         }
    //         else if($(this).prop("checked") == false){
    //             $('#cboSelectParent').hide();
    //         }
    // });
</script>