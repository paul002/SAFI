<?php 
    include "inc/header.php";
?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-book">&nbsp;&nbsp;</i>Post Categories</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
            					<!-- Button trigger modal -->
            <?php if($_SESSION['nCreate'] != 0) :  ?>                  
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#AddCategory">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add New Category
                </button>
            <?php endif; ?>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="posts-page.php">Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posts Categories</li>
                </ol>
            </nav>             
            <div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;" >
            <i class="fas icon">&nbsp;</i> <span id="message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table id="categories" class="display hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
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
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
<?php include "inc/footer.php"; ?>

<!-- CATEGORIES MODAL -->
<form id="categories_form">
	<div class="modal fade" id="AddCategory" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="postDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-book fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="categoryDialogLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Category Name</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="catName" id="catName" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Description</label>
                        </div>                      
                        <div class="col-md-10 mb-3">
                            <textarea class="form-control" name="catDescription" id="catDescription">
                            </textarea>
                        </div>                  
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
  <div class="modal fade" id="categoryDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
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
                <input type="hidden" id="delCat" value="">
                <i class="fas fa-fw fa-times text-danger fa-lg"></i>
                <span>Are you sure you want to delete this Category?</span>
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
    var loadPCategories = $('#categories').DataTable({
        ajax:{
            url: "scripts/load_post_categories.php",
            dataSrc: ''
        },
        columns: [
                { data:"categoryName" },
                { data:"description"},
                { data:"createdBy" },
                { data:"dateCreated" },
                { data:"action" }
            ]            
    });

    $(document).ready( function(){
        loadPCategories.ajax.reload();
        $('.alert').hide();
    });
    
    // New
    $('.new').on('click', function(){
        $('#id').val(0);
        document.getElementById('categoryDialogLabel').innerHTML = "New Category";
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Save';
    });

    
    //  Edit        
    $('#categories').on('click','.edit', function(){
        var id = $(this).data('id');
        var categoryName = $(this).data('catname');
        var description = $(this).data('description');

        $('#id').val(id);
        $('#catName').val(categoryName);
        $('#catDescription').val(description);
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Update';
        document.getElementById('categoryDialogLabel').innerHTML = "Edit Category";
        $('#AddCategory').modal('show');
    });

    // GET POST ID TO DELETE MODAL
    $('#categories').on('click','.del',function(){
        var catId = $(this).data('id');
        $('#categoryDeleteModal').modal('show');
        $('#delCat').val(catId);
    });


    // SAVE/UPDATE CATEGORY
    $('#categories_form').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        // data.append('postContent', CKEDITOR.instances['postEditor'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/post_category_add.php",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                // console.log(data);
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;  
                $('#categories_form')[0].reset();     
                $('#AddCategory').modal('hide');
                loadPCategories.ajax.reload();
            }
        }); 
    });

    // DELETE POST
    $('#comfirmDel').on('click',function(){
        var catId = $('#delCat').val();
        $.ajax({
            type: "POST",
            dataType:"JSON",
            url: "scripts/delete_scripts.php",
            data: {catId:catId},
            success: function(data){
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#categoryDeleteModal').modal('hide');
                loadPosts.ajax.reload();
            }
        });
    });

</script>