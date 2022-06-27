<?php 
    include "inc/header.php"; 
    include "scripts/site-home.php";

    $homeQuery = "SELECT * FROM `home`";
    $obj = $db->fetchObject($homeQuery);
    $homeId = $obj->id;

?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home">&nbsp;&nbsp;</i>Home Page</h1>
          </div>
            <?php if(isset($message)) { ?>
					<div class="alert alert-<?=$cl;?> alert-dismissible fade show" role="alert" style="border-radius:0;" >
					  <?=$message;?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
		    <?php } ?>
          <!-- Content Row -->
          <div class="row">
                <div class="container">
                    <form action="" method="POST">
                        <?php $homeId ? $homeId : 0; ?>
                        <h4>Widgets</h4>
                        <hr class="sidebar-divider">
                        <div class="row">
                            <input type="text" value="<?=$homeId;?>" name="homeId" id="homeId" hidden>
                            <div class="col-md-2">
                                <label>Documents download</label>
                            </div>
                            <div class="col-md-2">
                            <input type="checkbox" name="chkDownloads" id="chkDownloads" <?php if($obj->showDocuments == 1) echo "checked";?> >
                            </div>
                            <div class="col-md-2">
                                <label>Locale Info</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkLocaleInfo" id="chkLocaleInfo" <?php if($obj->showLocationInfo == 1) echo "checked";?> >
                            </div>
                            <div class="col-md-2">
                                <label>Gallery</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkGallery" id="chkGallery" <?php if($obj->showGallery == 1) echo "checked";?>>
                            </div>                             
                        </div>                                           
                        <div class="row">
                            <div class="col-md-2">
                                <label>Notices</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkNotices" id="chkNotices" <?php if($obj->showNotices == 1) echo "checked";?>>
                            </div>
                            <div class="col-md-2">
                                <label>Side Image</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkSideImage" id="chkSideImage" <?php if($obj->showAdImg == 1) echo "checked";?>>
                            </div>
                            <div class="col-md-2">
                                <label>Upcoming Events</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkUpcomingEvents" id="chkUpcomingEvents" <?php if($obj->showUpcomingEvents == 1) echo "checked"; ?>>
                            </div>                             
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Directory</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="chkDirectory" id="chkDirectory" <?php if($obj->showInterests == 1) echo "checked"; ?>>
                            </div>                            
                        </div>                        
                        <hr class="sidebar-divider">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-save">&nbsp;</i>Save</button>
                    </form>
                </div>
          </div>

          <!-- Call to Action -->
          <div class="row" style="margin-top:20px">
              <div class="container">
                <h4>Call to action</h4>
                <hr class="sidebar-divider">                  
                <form action="" method="POST">
                    <?php $homeId ? $homeId : 0; ?>
                    <input type="text" value="<?=$homeId;?>" name="homeId" id="homeId" hidden>
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Short Description</label>
                    <input type="text" name="shortDesc" class="form-control">
                    <hr class="sidebar-divider">
                    <button type="submit" name="callToAction" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-save">&nbsp;</i>Save</button>
                </form>
              </div>
          </div>

<?php include "inc/footer.php"; ?>
