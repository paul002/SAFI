let loadPosts = $("#pages").DataTable({
  searching: true,
  processing: false,
  dataSrc: "",
  ajax: {
    type: "POST",
    url: "scripts/loadPosts.php",
    data: { type: "page" },
    // dataFilter: function(data){
    //     var json = jQuery.parseJSON( data );
    //     console.log(json)
    // }
  },
  columns: [
    {
      data: "title",
    },
    {
      data: "description",
    },
    {
      data: "isPublished",
    },
    {
      data: "createdBy",
    },
    {
      data: "postDate",
    },
    {
      data: "action",
    },
  ],
});

function loadWidgets() {
  $.ajax({
    url: "scripts/load_widgets.php",
    type: "POST",
    success: function (data) {
      let s = "";
      for (var i = 0; i < data["data"].length; i++) {
        s +=
          '<div class="form-group mx-4">' +
          '<input type="checkbox" name="' +
          data["data"][i].widgetName +
          '" id="' +
          data["data"][i].widgetName +
          '">' +
          '<label for="' +
          data["data"][i].widgetName +
          '" class="form-label"> &nbsp;' +
          data["data"][i].widgetName +
          "</label>" +
          "</div>";
      }
      $("#widgets").html(s);
    },
  });
}

// New
$(".new").on("click", function () {
  $("#pageTitle").val("");
  $("#postDescription").val("");
  $("#id").val(0);

  document.getElementById("save").innerHTML =
    '<i class="fas fa-fw fa-save">&nbsp;</i>Save';
});

// SAVE/UPDATE POST
$("#page_form").on("submit", function (e) {
  e.preventDefault();
  var data = new FormData(this);
  // for (var pair of data.entries()) {
  //     console.log(pair[0] + ': ' + pair[1]);
  // }
  $.ajax({
    type: "POST",
    url: "scripts/post_add.php",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
  }).done(function (data) {
    let message = data["response"]["message"];
    let cl = data["response"]["cl"];
    let icon = data["response"]["fa"];
    $(".alert").show();
    $(".alert").addClass("alert-" + cl);
    $(".icon").addClass(icon);
    document.getElementById("message").innerHTML = message;
    $("#page_form")[0].reset();
    $("#addPage").modal("hide");
    loadPosts.ajax.reload();
  });
});

//  Edit
$("#pages").on("click", ".edit", function () {
  var id = $(this).data("id");
  $.ajax({
    type: "GET",
    dataType: "JSON",
    url: "scripts/loadPosts.php",
    data: {
      id: id,
    },
    success: function (data) {
      console.log(data[0]["pageTitle"]);
      $("#id").val(data[0]["pageId"]);
      $("#postTitle").val(data[0]["pageTitle"]);
      $("#postDescription").val(data[0]["description"]);
      $("#metakey").val(data[0]["metaKey"]);
      $("#metavalue").val(data[0]["metaValue"]);
      $("#pageContent").val(data[0]["content"]);

      //Checkbox Value
      let isPublished = data[0]["isPublished"];
      if (isPublished == 1) {
        $("#isPublished").prop("checked", true);
      } else {
        $("#isPublished").prop("checked", false);
      }

      document.getElementById("save").innerHTML =
        '<i class="fas fa-fw fa-save">&nbsp;</i>Update';
      document.getElementById("pageDialogLabel").innerHTML = "Edit Post";
      $("#addPage").modal("show");
    },
  });
});

// GET POST ID TO DELETE MODAL
$("#pages").on("click", ".del", function () {
  var postId = $(this).data("id");
  $("#postDeleteModal").modal("show");
  $("#delPost").val(postId);
});

// DELETE POST
$("#comfirmDel").on("click", function () {
  let postId = $("#delPost").val();
  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: "scripts/delete_scripts.php",
    data: {
      postId: postId,
    },
    success: function (data) {
      console.log(data);
      let message = data["response"]["message"];
      let cl = data["response"]["cl"];
      let icon = data["response"]["fa"];
      $(".alert").show();
      $(".alert").addClass("alert-" + cl);
      $(".icon").addClass(icon);
      document.getElementById("message").innerHTML = message;
      $("#postDeleteModal").modal("hide");
      loadPosts.ajax.reload();
    },
  });
});
