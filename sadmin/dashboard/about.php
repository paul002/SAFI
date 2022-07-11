<?php include "inc/header.php";
// include "config/dbconn.php";
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-info-circle">&nbsp;&nbsp;</i>About</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
</nav>
<div class="alert alert-dismissible fade show" role="alert" style="border-radius:0;">
    <i class="fas icon">&nbsp;</i> <span id="message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Accordion -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#contactInfo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="contactInfo">
        <h6 class="m-0 font-weight-bold text-primary">Company Information</h6>
    </a>
    <!-- Card Content - Collapse -->
    <!-- <div class="collapse" id="contactInfo"> -->
    <div class="card-body">
        <form id="contactForm">
            <input type="hidden" name="companyId" class="companyId">
            <input type="hidden" name="contactAction" id="contactAction">
            <div class="form-row mb-2">
                <div class="col">
                    <label for="compName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="companyName" id="companyName">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="col-4 mb-2">
                    <label for="phoneNo" class="form-label">Phone No.</label>
                    <input type="text" class="form-control" name="phoneNo" id="phoneNo">
                </div>
                <div class="col-4 mb-2">
                    <label for="altPhoneNo" class="form-label">Alt. Phone No.</label>
                    <input type="text" class="form-control" name="altPhoneNo" id="altPhoneNo">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-6 mb-2">
                    <label for="address" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="col-6 mb-2">
                    <label for="address2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" name="address2" id="address2">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-4 mb-2">
                    <label for="physicalAddress" class="form-label">Physical Address</label>
                    <input type="text" class="form-control" name="physicalAddress" id="physicalAddress">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="postalCode" id="postalCode">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col-6 mb-3">
                    <label for="lat" class="form-label">Latitude</label>
                    <input type="text" class="form-control" name="lat" id="lat">
                </div>
                <div class="col-6 mb-3">
                    <label for="lon" class="form-label">Longitude</label>
                    <input type="text" class="form-control" name="lon" id="lon">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook">
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="col">
                    <label for="twitter" class="form-label">Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="linkedIn" class="form-label">LinkedIn</label>
                    <input type="text" class="form-control" name="linkedIn" id="linkedIn">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="mission">Mission</label>
                    <textarea class="form-control" name="mission" id="mission"></textarea>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="vision">Vision</label>
                    <textarea class="form-control" name="vision" id="vision" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="values">Values</label>
                    <textarea class="form-control" name="values" id="values" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <label for="aboutInfo">About Us</label>
                    <textarea class="form-control" name="aboutInfo" id="aboutInfo" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" id="btnSaveUpdate"><i class="fa fa-save"></i> Save</button>
        </form>
    </div>
    <!-- </div> -->
</div>


<?php include "inc/footer.php"; ?>
<script type="text/javascript">
    CKEDITOR.replace('aboutInfo');
    CKEDITOR.replace('mission');
    CKEDITOR.replace('vision');
    CKEDITOR.replace('values');

    $(document).ready(function() {
        $('.alert').hide();
        loadContent();
    });

    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('aboutInfo', CKEDITOR.instances['aboutInfo'].getData());
        formData.append('mission', CKEDITOR.instances['mission'].getData());
        formData.append('vision', CKEDITOR.instances['vision'].getData());
        formData.append('values', CKEDITOR.instances['values'].getData());

        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        $.ajax({
            url: "scripts/about_script.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
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
                loadContent();
            }
        });
    });

    function loadContent() {
        $.ajax({
            url: "scripts/about_script.php",
            type: "GET",
            dataType: "JSON",
            data: {
                page: "about"
            },
            success: function(data) {
                if (data != null) {
                    console.log(data.companyData[0]['social_media_links']);
                    CKEDITOR.instances['aboutInfo'].setData(data.companyData[0]['description']);

                    // SET Mission, Vision, Values
                    CKEDITOR.instances['mission'].setData(data.companyData[0]['mission']);
                    CKEDITOR.instances['vision'].setData(data.companyData[0]['vision']);
                    CKEDITOR.instances['values'].setData(data.companyData[0]['core_values']);

                    // SET Contacts Values
                    $('.companyId').val(data.companyData[0]['id']);
                    $('#companyName').val(data.companyData[0]['companyName']);
                    $('#email').val(data.companyData[0]['email']);
                    $('#phoneNo').val(data.companyData[0]['phone']);
                    $('#altPhoneNo').val(data.companyData[0]['altPhone']);
                    $('#address').val(data.companyData[0]['address']);
                    $('#address2').val(data.companyData[0]['address2']);
                    $('#physicalAddress').val(data.companyData[0]['physicalAddress']);
                    $('#city').val(data.companyData[0]['town']);
                    $('#postalCode').val(data.companyData[0]['postalCode']);
                    $('#lat').val(data.companyData[0]['latitude']);
                    $('#lon').val(data.companyData[0]['longitude']);
                    let socialLinks = data.companyData[0]['social_media_links'] == "" ? "{\"empty\":\"\"}" : data.companyData[0]['social_media_links'];
                    let jsonDataSocialMedia = JSON.parse(socialLinks);
                    $('#facebook').val(jsonDataSocialMedia['facebook']);
                    $('#twitter').val(jsonDataSocialMedia['twitter']);
                    $('#linkedIn').val(jsonDataSocialMedia['linkedIn']);

                }
            }
        });
    }
</script>