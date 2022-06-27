<?php 
    include "inc/header.php";
?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users">&nbsp;&nbsp;</i> Users</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
            					<!-- Button trigger modal -->
            <?php if($_SESSION['nCreate'] != 0) :?>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addPost">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add New User
                </button>
            <?php endif; ?>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
            <div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;" >
            <i class="fas icon">&nbsp;</i> <span id="message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <table id="users" class="display hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>status</th>
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>status</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
<?php include "inc/footer.php"; ?>

<!-- USER MODAL -->
<form id="userForm" class="needs-validation" enctype="multipart/form-data" novalidate>
	<div class="modal fade" id="addUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="userDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-user fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="userDialogLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 text-center" id="image-placeholder">
                        <div class="container">
                            <div class="col-6 mx-auto">
                                <img src="" class="mb-3" id="profileImage" width="200">
                            </div>
                            <button id="removeImage" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash">&nbsp;</i>Remove Image</button>                            
                        </div>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name </label><span class="text-danger">*</span>
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required>                               
                                <div class="invalid-feedback">
                                    First name is required.
                                </div>  
                            </div>    
                         
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name </label><span class="text-danger">*</span>
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
                                <div class="invalid-feedback">
                                    Last name is requred
                                </div>                                  
                            </div>                                
                        </div>                         
                    </div>  
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Other Names</label>
                                <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Other names">
                                <div class="valid-feedback">
                                    Looks good
                                </div>                                 
                            </div>
                        </div>                       
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email </label><span class="text-danger">*</span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com" required>
                                <div class="invalid-feedback">
                                    Email is requred
                                </div> 
                            </div>
                        </div>                       
                    </div>                     
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Name </label><span class="text-danger">*</span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="username" required>
                                <div class="invalid-feedback">
                                    username is requred
                                </div>                                
                            </div>
                        </div>                       
                    </div>                                       
                    <div class="form-row" id="passrow">
                        <div class="form-group col-md-10">
                            <label>Password </label><span class="text-danger">*</span>
                            <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Password is requred
                            </div> 
                            <div class="invalid text-danger">
                                Password is requred
                            </div>                            
                            <input type="checkbox" id="showHide"> Show Password
                        </div>
                        <div style="line-height:6.2">
                            <button type="button" id="keyGen" class="btn btn-primary btn"><i class="fa fa-key">&nbsp;</i> Generate</button>
                        </div>                        
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="phoneNo" id="phoneNo" class="form-control" placeholder="0000000000">
                                <div class="valid-feedback">
                                    Looks good
                                </div> 
                            </div>
                        </div>                       
                    </div>                     
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>role </label><span class="text-danger">*</span>
                            <select id="userRole" name="userRole" class="form-control" required>
                            </select>
                            <div class="invalid-feedback user-role">
                                User Role is requred
                            </div>                             
                        </div>
                    </div>                           
                    <div class="form-row mb-3">
                        <label>Select profile Image</label>
                        <input type="file" name="imageFile" id="imageFile" class="form-control">
                        <div class="valid-feedback">
                            Looks good
                        </div> 
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="isActive" class="form-check-input" id="isActive">
                        <label class="form-check-label" for="isActive">Is Active</label>
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
  <div class="modal fade" id="userDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header  header-bg">
            <i class="fas fa-fw fa-trash fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
            <h5 class="modal-title" id="userModalLabel">Delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" id="delUser" value="">
                <i class="fas fa-fw fa-times text-danger fa-lg"></i>
                <span>Are you sure you want to delete this User?</span>
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
<script src="js/form-validation.js"></script>
<script>
    var loadPosts = $('#users').DataTable({
        "searching":true,
        "processing":false,
        "ajax":{
            url: "scripts/loadUsers.php"
        },
        "columns": [
            {data: 'fullName'},
            {data: 'username'},
            {data: 'email'},
            {data: 'phoneNo'},
            {data: 'status'},
            {data: 'createdBy'},
            {data: 'dateCreated'},
            {data: 'actions'}
        ]            
    });

    function loadRoles(id, val){ 
        $.ajax({
            url: "scripts/loadUserRole.php",
            type: "POST",
            success:function(response){
                var data = response.data;
                var s = '<option value="'+id+'">'+val+'</option>'; 
                for (var i = 0; i < data.length; i++) {
                   s += '<option value="' + data[i]['id'] + '">' + data[i]['role'] + '</option>';  
                }  
                $("#userRole").html(s);               
            }
        });
    }
    $(document).ready( function () {
        loadPosts.ajax.reload();
        $('.alert').hide();
    } );
    
    // New
    $('.new').on('click', function(){
        $("#userForm #firstName").focus();
        $('.invalid').hide();
        $('#image-placeholder').hide();
        $('#id').val(0);
        $('#firstName').val('');
        $('#lastName').val('');
        $('#middleName').val('');
        $('#username').val('');
        $('#email').val('');
        $('#password').val('');
        $('#phoneNo').val('');
        $('#isActive').prop('checked', false);
        $('#passrow').show();
        document.getElementById('profileImage').src="";
        loadRoles(-1, "-- Please Select Role --");
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Save';
        $('#addUser').modal('show');
    });

    
    //  Edit        
    $('#users').on('click','.edit', function(){
        var id = $(this).data('id');
        var firstName = $(this).data('firstname');
        var lastName = $(this).data('lastname');
        var middleName = $(this).data('middlename');
        var username = $(this).data('username');
        var imageFile = $(this).data('image');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        var roleId = $(this).data('roleid');
        var roleName = $(this).data('rolename');
        var isActive = $(this).data('isactive');
        $('#passrow').hide();
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
        $('#middleName').val(middleName);
        $('#username').val(username);
        $('#email').val(email);
        $('#passrow').hide();
        $('#phoneNo').val(phone);
        loadRoles(roleId, roleName);
        document.getElementById('save').innerHTML='<i class="fas fa-fw fa-save">&nbsp;</i>Update';
        document.getElementById('userDialogLabel').innerHTML = "Edit User";
        document.getElementById('profileImage').src="../../images/profiles/"+imageFile;

        $('#addUser').modal('show');
    });

    // GET POST ID TO DELETE MODAL
    $('#users').on('click','.del',function(){
        var userId = $(this).data('id');
        $('#userDeleteModal').modal('show');
        $('#delUser').val(userId);
    });

    // SAVE/UPDATE POST
    $('#userForm').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: "POST",
            url: "scripts/user_add.php",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                console.log(data);
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;  
                $('#userForm')[0].reset();     
                $('#addUser').modal('hide');
                loadPosts.ajax.reload();
            }
        }); 
    });

    // REMOVE POST IMAGE
    $('#userForm').on('click','#removeImage', function(){
        var userId = $('#id').val();
        $.ajax({
            url: "scripts/remove_post_image.php",
            type: "POST",
            dataType: "JSON",
            data:{userProfile:userId},
            success:function(response){
                var message = response['response']['message'];
                if(message == 1){
                    $('#image-placeholder').hide();
                }else{
                    $('#image-placeholder').show();
                }
            }
        });
    });

    // DELETE USER
    $('#comfirmDel').on('click',function(){
        var userId = $('#delUser').val();
        $.ajax({
            type: "POST",
            dataType:"JSON",
            url: "scripts/delete_scripts.php",
            data: {"userId":userId},
            success: function(data){
                var message = data['response']['message'];
                var cl = data['response']['cl'];
                var icon = data['response']['fa'];
                $('.alert').show();
                $('.alert').addClass('alert-'+cl);
                $('.icon').addClass(icon);
                document.getElementById('message').innerHTML = message;
                $('#userDeleteModal').modal('hide');
                loadPosts.ajax.reload();
            }
        });
    });

    $('#keyGen').on('click', function(){
        var key = keyGen();
        $('#password').val(key);
    })

    $('#showHide').on('click',function(){
        var passinput = document.getElementById("password");;
        if (passinput.type === "password") {
            passinput.type = "text";
        } else {
            passinput.type = "password";
        }
    })

    function keyGen() {
        var length = 12,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }
</script>