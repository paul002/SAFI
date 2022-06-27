<?php 
    include "inc/header.php";
?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-info-circle">&nbsp;&nbsp;</i>About</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
            					<!-- Button trigger modal -->
            <?php if($_SESSION['nCreate'] != 0) :  ?> 
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addPost">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Role
            </button>
            <?php endif; ?>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="about.php">About</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Secretariate</li>
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
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Status</th>
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
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
<?php include "inc/footer.php"; ?>

<!-- ADMINISTRATION MODAL -->
<form id="adminform" enctype="multipart/form-data">
	<div class="modal fade" id="addPost" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="adminDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-book fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="adminDialogLabel">New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 text-center" id="image-placeholder">
                        <div class="container">
                            <div class="col-md-4 mx-auto">
                            <img src="" class="mb-3" id="photo" width="200">
                            <button id="removeImage" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash">&nbsp;</i>Remove Image</button>
                            </div>                            
                        </div>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>First Name</label>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Last Name</label>
                        </div>                      
                        <div class="col-md-10 mb-3">
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Position</label>
                        </div>                      
                        <div class="col-md-10 mb-3">
                            <select id="organogram" name="organogram" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-12">
                            <textarea name="bioContent" id="bioEditor">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label>Profile photo</label>
                        <input type="file" name="profilePhoto" id="profilePhoto" class="form-control">
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
  <div class="modal fade" id="roleDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
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
                <input type="hidden" id="delRole" value="">
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
	CKEDITOR.replace( 'bioEditor' );
</script>
<script>
    var loadAdministrationData = $('#posts').DataTable({
        "searching":true,
        "processing":false,
        "serverMethod": "post",
        "ajax":{
            url: "scripts/load_administration.php"
        }
        ,
        "columns": [
                { data: 'photo' },
                { data: 'firstName' },
                { data: 'lastName' },
                { data: 'position' },
                { data: 'isActive' },
                { data: 'createdBy' },
                { data: 'dateCreated' },
                { data: 'action' }
            ]            
    });
    function loadOrganogram(id, val){ 
        $.ajax({
            url: "scripts/load_organogram.php",
            type: "POST",
            success:function(data){
                var s = '<option value="'+id+'">'+val+'</option>';  
                for (var i = 0; i < data.length; i++) {  
                   s += '<option value="' + data[i].id + '">' + data[i].position + '</option>';  
                }  
               $("#organogram").html(s);               
            }
        });
    }
    $(document).ready( function () {
        loadAdministrationData.ajax.reload();
        $('.alert').hide();
    } );
    
    //  New
    $('.new').on('click', function(){
        //console.log('data');
        $('#firstName').val('');
        $('#lastName').val('');
        $('profile').val('');
        $('#image-placeholder').hide();
        $('#id').val(0);

        //  Editor
        var editor = CKEDITOR.instances['bioEditor'];
        editor.setData('');
        document.getElementById('adminDialogLabel').innerHTML = "New Administration Role";
        document.getElementById('photo').src="";
        loadOrganogram(-1, "-- Please Select role --");
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Save';
    });

    
    //  Edit        
    $('#posts').on('click','.edit', function(){
        var id = $(this).data('id');
        var firstName = $(this).data('fname');
        var lastName = $(this).data('lname');
        var bioData = $(this).data('bio');
        var isActive = $(this).data('isactive');
        var imageFile = $(this).data('image');
        var organogramId = $(this).data('oid');
        var position = $(this).data('position');
        if(imageFile == ""){
            $('#image-placeholder').hide();
        }else{
            $('#image-placeholder').show();
        }
        //  Checkbox Value
        if(isActive == 1){
            $('#isActive').prop('checked', true);
        }else{
            $('#isActive').prop('checked', false);
        }
        $('#id').val(id);
        $('#firstName').val(firstName);
        $('#lastName').val(lastName);
        loadOrganogram(organogramId, position);
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Update';


        //Editor
        var editor = CKEDITOR.instances['bioEditor'];
        editor.setData(bioData);
        document.getElementById('adminDialogLabel').innerHTML = "Edit Administration Role";
        document.getElementById('photo').src="../../images/profiles/"+imageFile;

        $('#addPost').modal('show');
    });

    // GET POST ID TO DELETE MODAL
    $('#posts').on('click','.del',function(){
        var adminId = $(this).data('id');
        $('#roleDeleteModal').modal('show');
        $('#delRole').val(adminId);
    });


    // SAVE/UPDATE
    $('#adminform').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        data.append('bioContent', CKEDITOR.instances['bioEditor'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/administration_add.php",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;  
                $('#adminform')[0].reset();     
                $('#addPost').modal('hide');
                loadAdministrationData.ajax.reload();
            }
        }); 
    });

    // REMOVE POST IMAGE
    $('#adminform').on('click','#removeImage', function(){
        var adminProfileId = $('#id').val();
        $.ajax({
            url: "scripts/remove_post_image.php",
            type: "POST",
            dataType: "JSON",
            data:{adminProfile:adminProfileId},
            success:function(response){
                var message = response['response']['message'];
                if(message == 1){
                    $('#image-placeholder').hide();
                }else{
                    $('#image-placeholder').show();
                }
                loadAdministrationData.ajax.reload();
            }
        });
    });

    // DELETE POST
    $('#comfirmDel').on('click',function(){
        var adminId = $('#delRole').val();
        $.ajax({
            type: "POST",
            dataType:"JSON",
            url: "scripts/delete_scripts.php",
            data: {adminId:adminId},
            success: function(data){
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#roleDeleteModal').modal('hide');
                loadAdministrationData.ajax.reload();
            }
        });
    });

</script>