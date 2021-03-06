<?php
include "inc/header.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar-alt">&nbsp;&nbsp;</i>Events</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="New Post"><i class="fas fa-plus fa-sm text-white-50"></i> New Post</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm new" data-toggle="modal" data-target="#addEvent">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Event
    </button>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Events</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<table id="events_tbl" class="display hover" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loading DataTable -->
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<?php include "inc/footer.php"; ?>

<!-- POSTS MODAL -->
<div class="modal fade" id="addEvent" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="EventDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-bg">
                <i class="fas fa-fw fa-file fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="eventDialogLabel">New Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="event_form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-row mb-4">
                        <span style="font-size:.7em; font-style:italic">[Fields marked with <span class="text-danger">*</span> are mandatory]</span>
                    </div>
                    <!-- HOLD ID VALUE -->
                    <input type="hidden" id="id" name="id" value="0">
                    <div class="form-row">
                        <div class="col-">
                            <label>Event Title <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Event Title">
                        </div>
                        <div class="col-6">
                            <label>location <span class="text-danger">*</span></label>
                            <input type="text" name="location" id="location" class="form-control" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <label>Start Date <span class="text-danger">*</span></label>
                            <input type="text" name="start_date" id="start_date" class="form-control" />
                        </div>
                        <div class="col-2">
                            <label>Time <span class="text-danger">*</span></label>
                            <input type="text" name="start_time" id="start_time" class="form-control"/>
                        </div>
                        <div class="col-4">
                            <label>End Datetime <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" class="form-control"/>
                        </div>
                        <div class="col-2">
                            <label>Time <span class="text-danger">*</span></label>
                            <input type="text" name="start_date" id="start_date" class="form-control" data-provide="datetimepicker" />
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-8">
                            <label>Featured</label>
                            <input type="file" name="featuredImage" id="featuredImage" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Preview</label>
                            <div class="text-center" style="width:150; height:80; border: 1px solid #c0c0c0; border-radius: 4px">
                                <img src="img/placeholder-image-icon-21.jpg" id="featuredImagePreview" alt="featuredImage" width="244" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm save" name="save" id="save"><i class="fas fa-fw fa-save">&nbsp;</i>Save</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times">&nbsp;</i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="postDeleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  header-bg">
                <i class="fas fa-fw fa-trash fa-lg" style="padding-top: 8px">&nbsp;&nbsp;</i>
                <h5 class="modal-title" id="postModalLabel">Delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
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
    CKEDITOR.replace('description');
</script>
<script type="text/javascript">
    let load_events = $('#events_tbl').DataTable({
        "searching": true,
        "processing": false,
        "serverMethod": "post",
        "dataSrc": "data",
        "ajax": {
            url: "scripts/load_events.php"
        },
        "columns": [{
                data: 'name'
            },
            {
                data: 'description'
            },
            {
                data: 'start_date'
            },
            {
                data: 'end_date'
            },
            {
                data: 'location'
            },
            {
                data: 'action'
            }
        ]
    });
    $(document).ready(function() {
        $('.alert').hide();
    });

    $('#featuredImage').on('change', function() {
        const files = this.files;
        if (!files || files.length == 0)
            return;
        const file = files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            $('#featuredImagePreview').attr('src', reader.result);
        };

    })

    // Submit data
    $('#event_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('description', CKEDITOR.instances['description'].getData());
        $.ajax({
            type: "POST",
            url: "scripts/add_event.php",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data != null) {
                    $('#addEvent').modal('hide');
                    var message = data['response']['message'];
                    var cl = data['response']['cl'];
                    var icon = data['response']['fa'];
                    $('.alert').show();
                    $('.alert').addClass('alert-' + cl);
                    $('.icon').addClass(icon);
                    $('#message').html(message);
                    $('#event_form')[0].reset();
                    $('#featuredImagePreview').attr('src', 'img/placeholder-image-icon-21.jpg');
                    CKEDITOR.instances['description'].setData('');
                    load_events.ajax.reload();
                }
            }
        })
    })

    // Load Edit Data
    $('#events_tbl').on('click', '.edit', function() {
        var id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: "scripts/load_events.php",
            type: "GET",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                $('#id').val(data[0]['event_id']);
                $('#name').val(data[0]['name']);
                $('#start_date').val(data[0]['start_date']);
                $('#end_date').val(data[0]['end_date']);
                $('#location').val(data[0]['location']);
                $('#featuredImagePreview').attr('src', '../../assets/images/events/' + data[0]['featImg']);
                CKEDITOR.instances['description'].setData(data[0]['description']);
                document.getElementById('save').innerHTML = '<i class="fas fa-fw fa-save">&nbsp;</i>Update';
                document.getElementById('eventDialogLabel').innerHTML = "Edit Event";
                $('#addEvent').modal('show');
            }
        });
    });

    // GET Project ID TO DELETE MODAL
    $('#events_tbl').on('click', '.del', function() {
        var id = $(this).data('id');
        $('#postDeleteModal').modal('show');
        $('#delPost').val(id);
    });

    // DELETE Project
    $('#comfirmDel').on('click', function() {
        var id = $('#delPost').val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "scripts/add_event.php",
            data: {
                eventId: id
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
                load_events.ajax.reload();
            }
        });
    });
</script>