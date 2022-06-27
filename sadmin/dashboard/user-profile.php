<?php 
    include "inc/header.php";
    include_once "config/dbconn.php";
    $db = new db_conn();
    $id = $_SESSION['userId'];
    $userQuery = "SELECT * FROM `users` WHERE `id` = $id";
    $userObject = $db->fetchObject($userQuery);
    $image = "empty.png";
    if(!empty($imagePath)){
        $image = $imagePath;
    }
?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user">&nbsp;&nbsp;</i> <?=$_SESSION['username'];?> Profile</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
            					<!-- Button trigger modal -->
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#changePass">
                <i class="fas fa-user-shield fa-sm text-white-50"></i> Change Password
            </button>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;" >
            <i class="fas icon">&nbsp;</i> <span id="message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <div class="row">
                <div class="col-md-4">
                    <div class="container">
                        <div class="row mb-3 text-center" style="margin:0;">
                            <!-- Profile Image -->
                            <div class="card" style="width: 18rem;">
                                <img src="<?="../../images/profiles/".$image;?>" class="card-img-top" alt="profileImage" width="80px">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$userObject->username;?></h5>
                                    <p class="card-text"><?=$userObject->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">in-Active</span>' ?></p>
                                    <a href="#"><i class="fa fa-camera">&nbsp;</i>Change photo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- profile content -->
                <div class="col-md-8" style="margin:0">
                    <!-- <div class="container"> -->
                        <div class="row" style="margin:0;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6" style="width:700px">
                                           <h6><strong>First Name</strong></h6>
                                           <p><?=$userObject->firstName;?></p>
                                           <h6><strong>Last Name</strong></h6>
                                           <p><?=$userObject->lastName;?></p>
                                           <h6><strong>Other Names</strong></h6>
                                           <p><?=$userObject->middleName;?></p>
                                           <h6><strong>Phone No.</strong></h6>
                                           <p><?=$userObject->phoneNo;?></p>
                                           <h6><strong>Email</strong></h6>
                                           <p><?=$userObject->email;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
<?php include "inc/footer.php"; ?>

<!-- USER MODAL CHANGE PASSWORD-->
<form id="changePassForm">
	<div class="modal fade" id="changePass" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="userDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-user-shield fa-lg" style="padding-top: 8px">&nbsp;&nbsp;&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="userDialogLabel"> Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id" value="<?=$id;?>">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password </label><span class="text-danger">*</span>
                                <input type="password" name="password" id="password" class="form-control" required>  
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password </label><span class="text-danger">*</span>
                                <input type="password" name="confirmPass" id="confirmPass" class="form-control" required>                                  
                            </div>                                
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
<script src="js/form-validation.js"></script>
<script>

    $(document).ready( function () {
        $('.alert').hide();
    });

    // SAVE/UPDATE POST
    $('#changePassForm').on('submit', function(e){
        e.preventDefault();
        if($('#password').val() != $('#confirmPass').val()){
            var message = "Password doest not match";
            var cl = "danger";
            var icon = "fa-exclamation-triangle";
            $('.alert').show();
            $('.alert').addClass('alert-'+cl);
            $('.icon').addClass(icon);
            document.getElementById('message').innerHTML = message;
            $('#password').val('');
            $('#confirmPass').val('');
            $('#changePass').modal('hide');
        }else{
            var data = new FormData(this);
            $.ajax({
                type: "POST",
                url: "scripts/update_password.php",
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
                    $('#changePassForm')[0].reset();     
                    $('#changePass').modal('hide');
                    loadPosts.ajax.reload();
                }
            }); 
        }
    });

    // REMOVE POST IMAGE
    $('#posts_form').on('click','#removeImage', function(){
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