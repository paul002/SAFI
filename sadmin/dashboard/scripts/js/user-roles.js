var userId = $('#userAccountId').val();

var loadUserRoles = $('#tblRoles').DataTable({
    "searching":true,
    "processing":false,
    "ajax":{
        url: "scripts/loadUserRole.php",
        type: "POST",
        data: {userId:userId},
        dataType:"JSON"
    },
    "columns":[
        {data: 'role'},
        {data: 'isActive'},
        {data: 'createdBy'},
        {data: 'dateCreated'},
        {data: 'actions'}
    ]       
});

$(document).ready( function () {
    loadUserRoles.ajax.reload();
    $('.alert').hide();
});

// New
$('.new').on('click', function(){
    $('#id').val(0);
    $('#roleName').val('');
    $('#addRoles').modal('show');
    $('#isActive').prop('checked', false);

});

// Edit
$('#tblRoles').on('click', '.edit', function(){
    var id = $(this).data('id');
    var roleNname = $(this).data('role');
    var status = $(this).data('isactive');
    $('#id').val(id);
    $('#roleName').val(roleNname);
    if(status == 1)$('#isActive').prop('checked', true);
    else $('#isActive').prop('checked', false);
    $('#addRoles').modal('show');
});

// Permissions
$('#tblRoles').on('click', '.permissions', function(){
    var permId = $(this).data('permid');
    var id = $(this).data('roleid'); 
    var roleName = $(this).data('role');
    var create = $(this).data('ncreate');
    var read = $(this).data('nread');
    var update = $(this).data('nupdate');
    var ndelete = $(this).data('ndelete');
    var execute = $(this).data('nexecute');
    var home = $(this).data('home');
    var menu = $(this).data('menu');
    var posts = $(this).data('posts');
    var pages = $(this).data('pages');
    var users = $(this).data('users');
    $('#permId').val(permId);
    $('#userRoleId').val(id);
    $('#userRoleName').val(roleName);
    if(create == 1) $('#create').prop('checked', true); else $('#create').prop('checked', false);
    if(read == 1) $('#read').prop('checked', true); else $('#read').prop('checked', false);
    if(update == 1) $('#update').prop('checked', true); else $('#update').prop('checked', false);
    if(ndelete == 1) $('#delete').prop('checked',true); else $('#delete').prop('checked',false);
    if(execute == 1) $('#execute').prop('checked', true); else $('#execute').prop('checked', false);
    if(menu == 1) $('#menu').prop('checked', true); else $('#menu').prop('checked', false);
    if(posts == 1) $('#home').prop('checked', true); else $('#home').prop('checked', false);
    if(posts == 1) $('#posts').prop('checked', true); else $('#posts').prop('checked', false);
    if(pages == 1) $('#pages').prop('checked', true); else $('#pages').prop('checked', false);
    if(users == 1) $('#users').prop('checked', true); else $('#users').prop('checked', false);
    if(permId != 0){
        document.getElementById('savePermissions').innerHTML = '<i class="fas fa-fw fa-check">&nbsp;</i> Update';        
    }else{
        document.getElementById('savePermissions').innerHTML = '<i class="fas fa-fw fa-check">&nbsp;</i> Save';        
    }
    $('#permissionsModal').modal('show');
});

// Save/Update Permissions
$('#savePermissions').on('click', function(){
    var permId = $('#permId').val();
    var roleId = $('#userRoleId').val();
    var roleName = $('#userRoleName').val();
    var _create = 0;
    var _read = 0;
    var _update = 0;
    var _delete = 0;
    var _execute = 0
    var _menu = 0;
    var _home = 0;
    var _posts = 0;
    var _pages = 0;
    var _users = 0;

    if($('#create').prop('checked')) _create = 1; else _create = 0;
    if($('#read').prop('checked')) _read = 1; else _read = 0;
    if($('#update').prop('checked')) _update = 1; else _update = 0;
    if($('#delete').prop('checked')) _delete = 1; else _delete = 0;
    if($('#execute').prop('checked')) _execute = 1; else _execute = 0;
    if($('#menu').prop('checked')) _menu = 1; else _menu = 0;
    if($('#home').prop('checked')) _home = 1; else _home = 0;
    if($('#posts').prop('checked')) _posts = 1; else _posts = 0;
    if($('#pages').prop('checked')) _pages = 1; else _pages = 0;
    if($('#users').prop('checked')) _users = 1; else _users = 0;

    data = {permId, roleId, roleName, _create, _read, _update, _delete, _execute, _menu, _home, _posts, _pages, _users};

    $.ajax({
        url: "scripts/permission_add.php",
        data: data,
        type: "POST",
        dataType: "JSON",
        success: function(data){
            var message = data['response']['message'];
            var cl = data['response']['cl'];
            var icon = data['response']['fa'];
            $('.alert').show();
            $('.alert').addClass('alert-'+cl);
            $('.icon').addClass(icon);
            document.getElementById('message').innerHTML = message;   
            $('#permissionsModal').modal('hide');                
            loadUserRoles.ajax.reload();
        }
    })
})

// SAVE/UPDATE
$('#rolesForm').on('submit', function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
        url: "scripts/roles_add.php",
        type: "POST",
        dataType: "JSON",
        data: data,
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
            $('#addRoles').modal('hide');                
            loadUserRoles.ajax.reload();
        }
    });
})

$('#tblRoles').on('click','.del', function(){
    var id = $(this).data('id');
    $('#roleId').val(id);
    $('#deleteModal').modal('show');
})

$('#comfirmDel').on('click', function(){
    var id = $('#roleId').val();
    $.ajax({
        url: "scripts/delete_scripts.php",
        type: "POST",
        dataType: "JSON",
        data:{roleId:id},
        success: function(data){
            var message = data['response']['message'];
            var cl = data['response']['cl'];
            var icon = data['response']['fa'];
            $('.alert').show();
            $('.alert').addClass('alert-'+cl);
            $('.icon').addClass(icon);
            document.getElementById('message').innerHTML = message;   
            $('#deleteModal').modal('hide');                
            loadUserRoles.ajax.reload();
        }
    });        
})