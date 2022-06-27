<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-file">&nbsp;&nbsp;</i>Impact Areas</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addPage">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Impact Area
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Impact Area</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="pages" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Published</th>
            <th>Created By</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Published</th>
            <th>Created By</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<form id="page_form">
    <div class="modal fade" id="addPage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="pageDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-file fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="pageDialogLabel">New Impact Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="postType" name="postType" value="page">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Title</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="postTitle" id="postTitle" class="form-control" placeholder="Page Title">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Description</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="postDescription" id="postDescription" class="form-control" placeholder="Page Description">
                            <span style="font-size:.7em; font-style:italic">[discription is not visible to the public]</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Meta key</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="metakey" id="metakey" class="form-control" placeholder="Meta Key">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Meta value</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="metavalue" id="metavalue" class="form-control" placeholder="Meta Value">
                            <span style="font-size:.7em; font-style:italic">[key words should be separated by commas]</span>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-2 mb-3">
                            <label>Content</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" name="pageContent" id="pageContent"></textarea>
                            <span style="font-size:.7em; font-style:italic">[page content should be raw html markup e.g &lt;h1&gt;...&lt;/h1&gt;]</span>
                        </div>
                    </div>
                    <h5>Page Features</h5>
                    <h6>Sidebar</h6>
                    <div class="form-row">
                        <div class="form-group mx-4">
                            <input type="radio" name="sidebar" id="left" value="Left">
                            <label for="left" class="form-label">Left Sidebar</label>
                        </div>
                        <div class="form-group mx-4">
                            <input type="radio" name="sidebar" id="right" value="Left">
                            <label for="right" class="form-label">Left Sidebar</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="sidebar" id="none" value="none">
                            <label for="none" class="form-label">None</label>
                        </div>
                    </div>

                    <!-- Widgets -->
                    <h6>Widgets</h6>
                    <div class="form-row" id="widgets">
                        <div class="form-group">
                            <input type="checkbox" name="about" id="about">
                            <label for="about" class="form-label">about</label>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="isPublished" class="form-check-input" id="isPublished">
                        <label class="form-check-label" for="isPublished">Publish</label>
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
<script src="scripts/js/posts.js"></script>
<script>
    $(document).ready(function() {
    loadPosts.ajax.reload();
    $('.alert').hide();
    loadWidgets();
    $('#none').prop('checked', true);
    $('#isPublished').prop('checked', true);
});
</script>