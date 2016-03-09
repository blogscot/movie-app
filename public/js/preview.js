// When a user creates a new advert, allow them to preview the image url
$(document).ready(function() {
  $('#preview-btn').on('click', function() {
    var url = $('#image_url').val();
    if (url != "") {
      $('img').attr('src', url);
    }
  });
});