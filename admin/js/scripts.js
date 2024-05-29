$(document).ready(function () {
  $('#selectAllBoxes').click(function () {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  }); // Missing closing bracket for the click function

  initializeSummernote();
});

function initializeSummernote() {
  try {
    $('#summernote').summernote({
      placeholder: 'Insert content here...',
      tabsize: 2,
      height: 100,
    });
  } catch (error) {
    console.log(error);
  }
}

var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$('body').prepend(div_box);
$('#load-screen')
  .delay(700)
  .fadeOut(600, function () {
    $(this).remove();
  });
