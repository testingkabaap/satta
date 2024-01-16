/* bootstrap form validation */
(function () {
  "use strict";
  window.addEventListener(
    "load",
    function () {
      /* Fetch all the forms we want to apply custom Bootstrap validation styles to */
      var forms = document.getElementsByClassName("form-needs-validation");
      /* Loop over them and prevent submission */
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();

var SITE_URL = $("input#hidden_site_url_input").val();
var BASE_URL = $("input#hidden_base_url_input").val();
var ADMIN_SITE_URL = $("input#hidden_admin_site_url_input").val();
var GET_ROW_DATA_URL = ADMIN_SITE_URL + "/action/get_data";
var DELETE_ROW_DATA_URL = ADMIN_SITE_URL + "/action/delete_data";

$(document).ready(function () {

  $(document).on("submit", "form.reload-page-form", function (e) {
    e.preventDefault();
    var cForm = $(this);
    var url = cForm.attr("action");
    var error_box = cForm.find(".error-box");
    var closest_modal = cForm.closest(".modal");
    error_box.html("");
    var data = new FormData(cForm[0]);
    submit_form_data_ajax(url, data, function (output) {
      $('html, body').animate({
        'scrollTop': error_box.position().top
      });
      closest_modal.animate({ scrollTop: 0 }, 'slow');
      try {
        var res = JSON.parse(output);
        if (res.status) {
          setErrorText(error_box, 200, res.message);
          if (
            res.data != undefined &&
            res.data.redirect != undefined &&
            res.data.redirect != null &&
            res.data.redirect != ""
          ) {
            var redirect_time = 500;
            if (
              res.data != undefined &&
              res.data.redirect_time != undefined &&
              res.data.redirect_time != null &&
              res.data.redirect_time >= 0
            ) {
              redirect_time = res.data.redirect_time;
            }
            setTimeout(function () {
              window.location.replace(res.data.redirect);
            }, redirect_time);
          }
          if (
            res.data != undefined &&
            res.data.clear_form != undefined &&
            res.data.clear_form != null &&
            res.data.clear_form == true
          ) {
            cForm[0].reset();
            cForm.removeClass('was-validated');
          }
          if (
            res.data != undefined &&
            res.data.reload != undefined &&
            res.data.reload != null &&
            res.data.reload == true
          ) {
            var reload_time = 1000;
            if (
              res.data != undefined &&
              res.data.reload_time != undefined &&
              res.data.reload_time != null &&
              res.data.reload_time >= 0
            ) {
              reload_time = res.data.reload_time;
            }
            setTimeout(function () {
              location.reload();
            }, reload_time);
          }
        } else {
          setErrorText(error_box, 400, res.message);
        }
      } catch (e) {
        setErrorText(error_box, 400, "Some Error #" + e);
      }
    });
  });


  $(document).on("click", "button.dynamicViewBtn", function () {
    var thisE = $(this);
    var id = thisE.attr("data-id");
    var table_name = thisE.attr("data-table-name");

    var formData = new FormData();
    formData.append("id", id);
    formData.append("table_name", table_name);
    submit_form_data_ajax(GET_ROW_DATA_URL, formData, function (output) {
      try {
        var res = JSON.parse(output);
        if (res.status) {
          var tbody = "";
          $.each(res.data.record, function (k, v) {
            tbody += '<tr><td>' + k + '</td><td>' + v + '</td></tr>';
          });
          $("#viewDataModal").find("tbody").html(tbody);
          $("#viewDataModal").modal("show");
        } else {
          setErrorToast(res.status_code, res.message);
        }
      } catch (e) {
        setErrorToast(400, e);
      }
    });

  });

  $(document).on("click", "button.dynamicDeleteBtn", function () {
    var thisE = $(this);
    var id = thisE.attr("data-id");
    var table_name = thisE.attr("data-table-name");

    var parentTr = thisE.closest("tr");
    var formData = new FormData();
    formData.append("id", id);
    formData.append("table_name", table_name);

    if (confirm("Are you sure want to delete?")) {
      submit_form_data_ajax(DELETE_ROW_DATA_URL, formData, function (output) {
        try {
          var res = JSON.parse(output);
          if (res.status) {
            parentTr.remove();
            setErrorToast(res.status_code, res.message);
          } else {
            setErrorToast(res.status_code, res.message);
          }
        } catch (e) {
          setErrorToast(400, e);
        }
      });
    } else {
      setErrorToast(400, "Delete Cancel");
    }
  });

  $(document).on('click', 'img.image-preview', function () {
    $(this).next('input.image-input').click();
  });
  $(document).on('change', 'input.image-input', function () {
    var previewImage = $(this).prev('img.image-preview');
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        previewImage.attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });

  $(document).on("keydown", ".linkTitleInput", function () {
    var tID = $(this).data("target-id");
    if (tID != null && tID != "") {
      var slug = $(this).val();
      slug = slug.replace(/[^a-zA-Z-]/g, "-");
      $("#" + tID).val(slug.toLowerCase());
    }
  });

});

function generateHiddenInputs(data) {
  var hiddenInputs = "";
  $.each(data, function (k1, v1) {
    if (typeof (v1) != 'object') {
      hiddenInputs += '<input type="hidden" name="' + k1 + '" value="' + v1 + '">';
    }
  });
  return hiddenInputs;
}

/* BEGIN:: SET ERROR TEXT FUNCTION */
function setErrorText(element, status, msg) {
  var c = "alert alert-";
  if (status == 200) {
    c += "success";
  } else if (status == 400) {
    c += "danger";
  }
  element.html('<div class="' + c + '"  role="alert">' + msg + "</div>");
}

function setErrorToast(status, msg) {
  var status_class = "bg-success";
  if (status == 400) {
    status_class = "bg-danger";
  }
  $(document).Toasts('create', {
    class: status_class,
    autohide: true,
    delay: 3000,
    title: 'Admin',
    subtitle: '',
    body: msg
  });
}
/* END:: SET ERROR TEXT FUNCTION */

var pageLoader = '<div id="uniquePageLoader"><style>body{overflow: hidden;}</style><div class="ctbx"><div class="imglbx"><img src="' + BASE_URL + 'assets-admin/img/icon/page-loader.svg" alt="Loader Image"></div></div></div>';

/* BEGIN:: AJAX FUNCTION */
function submit_form_data_ajax(
  url,
  data,
  onComplete = function (output) {
    console.log(output);
  },
  onError = function (err) {
    console.error(err);
    setErrorToast(400, err);
  }
) {
  /* ajax function */
  $.ajax({
    type: "POST",
    enctype: "multipart/form-data",
    url: url,
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function () {
      $("body").prepend(pageLoader);
    },
    success: function (data) {
      onComplete(data);
    },
    error: function (err) {
      onError(err);
    },
    complete: function () {
      $("#uniquePageLoader").remove();
    },
  });
}
/* END:: AJAX FUNCTION */