<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-book">&nbsp;&nbsp;</i>Posts</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <?php if ($_SESSION['nCreate'] != 0) : ?>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addPost">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Post
        </button>
    <?php endif; ?>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Posts</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="posts" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Published</th>
            <th>Posted By</th>
            <th>Post Date</th>
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
            <th>Category</th>
            <th>Published</th>
            <th>Posted By</th>
            <th>Post Date</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<form id="posts_form" enctype="multipart/form-data">
    <div class="modal fade" id="addPost" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="postDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-book fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="postDialogLabel">New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 text-center" id="image-placeholder">
                        <div class="container">
                            <img src="" class="mb-3" id="postImage" width="740">
                            <button id="removeImage" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash">&nbsp;</i>Remove Image</button>
                        </div>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Post Type</label>
                        </div>
                        <div class="col-md-10 mb-4">
                            <select id="postType" name="postType" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" id="eventFields">
                        <div class="col-md-2 mb-3">
                            <label>Event Date</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="date" name="datepicker" id="datepicker" class="form-control" placeholder="Event Date">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Event Time</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="timepicker" id="timepicker" class="form-control" placeholder="Event Date">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Location</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="location" id="location" class="form-control" placeholder="location">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Title</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="postTitle" id="postTitle" class="form-control" placeholder="Post Title">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Description</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="postDescription" id="postDescription" class="form-control" placeholder="Post Description">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Category</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <select id="category" name="category" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-12">
                            <textarea name="postContent" id="postEditor">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label>Select Featured Image</label>
                        <input type="file" name="featuredImage" id="featuredImage" class="form-control">
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

<script type="text/javascript">
    CKEDITOR.replace('postEditor');
</script>
<script>
    var loadPosts = loadPosts('posts','post');
    function loadCategories(id, val) {
        $.ajax({
            url: "scripts/load_post_categories.php",
            type: "POST",
            success: function(data) {
                var s = '<option value="' + id + '">' + val + '</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].id + '">' + data[i].categoryName + '</option>';
                }
                $("#category").html(s);
            }
        });
    }

    function loadPostTypes(id, val) {
        $.ajax({
            url: "scripts/load_post_types.php",
            type: "POST",
            dataType: "json",
            success: function(data) {
                var s = '<option value="' + id + '">' + val + '</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].id + '">' + data[i].type + '</option>';
                }
                $("#postType").html(s);
            }
        });
    }
    $(document).ready(function() {
        loadPosts.ajax.reload();
        $('.alert').hide();
        $('#eventFields').hide();
    });

    // Enable Events Fields when selected
    $('#postType').on('change', function() {
        var id = $('#postType').val();
        if (id == 3) {
            $('#eventFields').show();
        } else {
            $('#eventFields').hide();
        }
    })

    // New
    $('.new').on('click', function() {
        $('#postTitle').val('');
        $('#postDescription').val('');
        $('featuredImage').val('');
        $('#image-placeholder').hide();
        $('#id').val(0);

        //Editor
        var editor = CKEDITOR.instances['postEditor'];
        editor.setData('');
        document.getElementById('postDialogLabel').innerHTML = "New Post";
        document.getElementById('postImage').src = "";
        loadPostTypes(-1, "-- Please Select Post Type --");
        loadCategories(-1, "-- Please Select Post Category --");
        document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Save';
    });

    //  Edit        
    $('#posts').on('click', '.edit', function() {
        var id = $(this).data('id');
        var postTypeId = $(this).data('posttypeid');
        var postType = $(this).data('posttype');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var content = $(this).data('content');
        var isPublished = $(this).data('ispublished');
        var imageFile = $(this).data('image');
        var categoryId = $(this).data('catid');
        var categoryName = $(this).data('catname');
        if (imageFile == "") {
            $('#image-placeholder').hide();
        } else {
            $('#image-placeholder').show();
        }
        //  Checkbox Value
        if (isPublished == 1) {
            $('#isPublished').prop('checked', true);
        } else {
            $('#isPublished').prop('checked', false);
        }
        $('#id').val(id);
        $('#postTitle').val(title);
        $('#postDescription').val(description);
        loadPostTypes(postTypeId, postType);
        loadCategories(categoryId, categoryName);
        document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Update';


        //Editor
        var editor = CKEDITOR.instances['postEditor'];
        editor.setData(content);
        document.getElementById('postDialogLabel').innerHTML = "Edit Post";
        document.getElementById('postImage').src = "../../images/posts/" + imageFile;

        $('#addPost').modal('show');
    });

    // ARCHIVE POST
    $('#posts').on('click', '.arch', function() {
        var postId = $(this).data('id');
        $.ajax({
            url: "scripts/archive_post.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: postId
            },
            success: function(response) {
                var status = response[0]['status'];
                var message = response[0]['message'];
                var cl = response[0]['cl'];
                var icon = response[0]['fa'];

                if (status == 1) {
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    document.getElementById('message').innerHTML = message;
                } else {
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    document.getElementById('message').innerHTML = message;
                }
                loadPosts.ajax.reload();
            }
        });
    });

    // GET POST ID TO DELETE MODAL
    $('#posts').on('click', '.del', function() {
        var postId = $(this).data('id');
        $('#postDeleteModal').modal('show');
        $('#delPost').val(postId);
    });


    // SAVE/UPDATE POST
    $('#posts_form').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        data.append('postContent', CKEDITOR.instances['postEditor'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/post_add.php",
            data: data,
            dataType: "json",
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
                $('#posts_form')[0].reset();
                $('#addPost').modal('hide');
                loadPosts.ajax.reload();
            }
        });
    });

    // REMOVE POST IMAGE
    $('#posts_form').on('click', '#removeImage', function() {
        var postId = $('#id').val();
        $.ajax({
            url: "scripts/remove_post_image.php",
            type: "POST",
            dataType: "JSON",
            data: {
                remove: postId
            },
            success: function(response) {
                var message = response['response']['message'];
                if (message == 1) {
                    $('#image-placeholder').hide();
                } else {
                    $('#image-placeholder').show();
                }
            }
        });
    });

    // DELETE POST
    $('#comfirmDel').on('click', function() {
        var postId = $('#delPost').val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "scripts/delete_scripts.php",
            data: {
                "postId": postId
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
                loadPosts.ajax.reload();
            }
        });
    });
</script>