<?php 
    include "inc/header.php";
?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-archive">&nbsp;&nbsp;</i>Posts Archive</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="posts-page.php">Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posts Archive</li>
                </ol>
            </nav>            
            <div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;" >
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
                        <th>Posted By</th>
                        <th>Archive Date</th>
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
                        <th>Posted By</th>
                        <th>Archive Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
<?php include "inc/footer.php"; ?>

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
	CKEDITOR.replace( 'postEditor' );
</script>
<script>
    var loadPosts = $('#posts').DataTable({
        "searching":true,
        "processing":false,
        "serverMethod": "post",
        "dataSrc":"",
        "ajax":{
            url: "scripts/load_archive_posts.php"
        }
        ,
        "columns": [
                { data: 'title' },
                { data: 'description' },
                { data: 'category' },
                { data: 'createdBy' },
                { data: 'postDate' },
                { data: 'action' }
            ]            
    });
    $(document).ready( function () {
        loadPosts.ajax.reload();
        $('.alert').hide();
    } );

        // ARCHIVE POST
    $('#posts').on('click','.arch', function(){
        var postId = $(this).data('id');
        $.ajax({
            url: "scripts/archive_post.php",
            type: "POST",
            dataType: "JSON",
            data:{id:postId},
            success:function(response){
                var status = response[0]['status'];
                var message = response[0]['message'];
                var cl = response[0]['cl'];
                var icon = response[0]['fa'];

                if(status == 1){
                    $('.alert').show();
                    $('.alert').addClass('alert-'+cl);
                    $('.icon').addClass(icon);
                    document.getElementById('message').innerHTML = message;                     
                    loadPosts.ajax.reload();
                }else{
                    $('.alert').show();
                    $('.alert').addClass('alert-'+cl);
                    $('.icon').addClass(icon);
                    document.getElementById('message').innerHTML = message;                      
                }
            }
        });
    });

    // GET POST ID TO DELETE MODAL
    $('#posts').on('click','.del',function(){
        var postId = $(this).data('id');
        $('#postDeleteModal').modal('show');
        $('#delPost').val(postId);
    });
        // UNDO POST
    $('#posts').on('click','.undo',function(){
        var archiveId = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType:"JSON",
            url: "scripts/archive_post.php",
            data: {undo:"1", archiveId:archiveId}, 
            success: function(data){
                var message = data[0]['message'];
                var cl = data[0]['cl'];
                var icon = data[0]['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#postDeleteModal').modal('hide');
                loadPosts.ajax.reload();
            }
        });
    });

    // DELETE POST
    $('#comfirmDel').on('click',function(){
        var postId = $('#delPost').val();
        $.ajax({
            type: "POST",
            dataType:"JSON",
            url: "scripts/delete_archive_post_scripts.php",
            data: {"postId":postId},
            success: function(data){
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#postDeleteModal').modal('hide');
                loadPosts.ajax.reload();
            }
        });
    });

</script>