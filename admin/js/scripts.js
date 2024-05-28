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
  });

  initializeSummernote();

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
});
