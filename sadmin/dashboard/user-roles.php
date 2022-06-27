<?php 
    include "inc/header.php";
?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users">&nbsp;&nbsp;</i> Users</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
                        <!-- Button trigger modal -->
    <?php if($_SESSION['nCreate'] != 0) :?>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Role
        </button>
    <?php endif; ?>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="users-page.php">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>
    <div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;" >
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <table id="tblRoles" class="display hover" style="width:100%">
        <thead>
            <tr>
                <th>Role</th>
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
                <th>Role</th>
                <th>status</th>
                <th>Created By</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
<?php include "inc/footer.php"; ?>

<!-- MODAL -->
<form id="rolesForm">
	<div class="modal fade" id="addRoles" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="rolesDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header header-bg">
                    <i class="fas fa-fw fa-book fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                    <h5 class="modal-title" id="rolesDialogLabel">New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <span style="font-size:.8em; font-style:italic;">[For this role to take effect, add permissions under <strong>actions</strong> button after creating]</span>
                    </div>                    
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Role </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-10 mb-3">
                            <input type="text" name="roleName" id="roleName" class="form-control" placeholder="Name">
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
                <input type="hidden" id="roleId" name="roleId">
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

  <!-- PERMISSIONS MODAL -->
  <div class="modal fade" id="permissionsModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="permissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header  header-bg">
            <i class="fas fa-fw fa-user-lock fa-lg" style="padding-top: 8px">&nbsp;&nbsp;&nbsp;&nbsp;</i>
            <h5 class="modal-title" id="permissionsModalLabel">&nbsp;Permissions</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="container">
                    <input type="hidden" class="form-control" id="permId" name="permId">
                    <input type="hidden" class="form-control" id="userRoleId" name="userRoleId">
                    <label>Role Name</label>
                    <input type="text" class="form-control" id="userRoleName" name="userRoleName" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="container">
                    <h5 class="modal-title" id="permissionsModalLabel">&nbsp;Permissions</h5>
                    <hr class="sidebar-divider d-none d-md-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><input type="checkbox" id="create"> Create</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="read"> Read</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="update"> Update</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="delete"> Delete</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="execute"> Execute</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mb-3">
                <div class="container">
                    <h5 class="modal-title" id="permissionsModalLabel">&nbsp;Modules</h5>
                    <hr class="sidebar-divider d-none d-md-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><input type="checkbox" id="menu"> Menu</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="home"> Home</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="posts"> Posts</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="pages"> Pages</li>
                            <li class="breadcrumb-item"><input type="checkbox" id="users"> Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mb-3">
                <div class="container">
                    <h5 class="modal-title" id="permissionsModalLabel">&nbsp;Dashboard</h5>
                    <hr class="sidebar-divider d-none d-md-block">
                    <select name="dashboard" id="dashboard" class="form-control">
                        <option value="-1">-- Select Dashboard --</option>
                    </select>
                </div>
            </div>             
        </div>       
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" id="savePermissions"><i class="fas fa-fw fa-check">&nbsp;</i>Save</button>
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times">&nbsp;</i>Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script src="scripts/js/user-roles.js"></script>