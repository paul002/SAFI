<?php
include "inc/header.php";

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800" id="pageTitle"></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="pages.php">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page" id="breadcrumbCurrentPage">page title</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<input type="hidden" id="id" name="id" value="<?= $id; ?>">
<nav class="navbar navbar-inverse navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active mx-2">
                    <button class="btn btn-default"><i class="fa fa-image"></i>&nbsp;Upload Image</button>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2 mx-2" type="text" placeholder="Event Date" aria-label="Search">
                <input class="form-control me-2 mx-2" type="text" placeholder="Location" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div id="page_content">
</div>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<form id="page_form">
    <div class="modal fade" id="addPage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="pageDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-file fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="pageDialogLabel">New Page</h5>
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
<script>
    $(document).ready(function() {
        let id = $('#id').val();
        $('.alert').hide();
        loadPageContents(id);
    });

    function loadPageContents(id) {
        $.ajax({
            url: 'scripts/load_page_list.php?id=' + id,
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                let pageTitle = '<i class="fas fa-fw fa-file">&nbsp;&nbsp;</i>' + response.pageTitle;
                $('#pageTitle').html(pageTitle);
                $('#breadcrumbCurrentPage').html(response.pageTitle);
                const widgets = JSON.parse(response.widgets);
                const data = widgets['data'];
                loadWidgets(data)
                // for (var i = 0; i < data.length; i++) {
                //     about = data[i].about;
                //     if (about == 1) loadWidgets('about');
                // }
            }
        });
    }

    function loadWidgets(data) {
        for (var i = 0; i < data.length; i++) {
            let about = data[i].about;
            let events = data[i].about;
            let services = data[i].about;
            let video = data[i].about;
            if (about == 1) loadEditor('about');
            if (events == 1) loadEditor('events');
            if (services == 1) loadEditor('services');
            if (video == 1) loadEditor('video');
        }
    }

    function loadEditor(key) {
        $.ajax({
            url: 'scripts/load_widgets.php?key=' + key,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                let widgetName = response.widgetName;
                let content = response.content;
                let widgetsTools = '<div class="row">' +
                    '<div class="container">' +
                    '<div class="d-sm-flex align-items-center justify-content-between mb-4">' +
                    '<h4 class="h3 mb-0 text-gray-800">' + capitalizeFirstLetter(widgetName) + '</h4>' +
                    '<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a>' +
                    '<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a>' +
                    '<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a>' +
                    '<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a>' +
                    '</div></div>';
                let textEditor = '<div class="col-12 mb-3">' +
                    '<textarea class="form-control" name="' + widgetName + '" id="' + widgetName + '" rows="3">' +
                    '</textarea>' +
                    '<button type="submit" class="btn btn-primary btn-sm my-2" id="btn' + widgetName + '"><i class="fa fa-save"></i>  Save</button>' +
                    '</div></div>';
                $('#page_content').append(textEditor);
                CKEDITOR.replace(widgetName);
                CKEDITOR.instances[widgetName].setData(content);
            }
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>