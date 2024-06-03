$(document).ready(function () {
  if (window.location.pathname.includes('posts.php')) {
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
  }
});

var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$('body').prepend(div_box);
$('#load-screen')
  .delay(700)
  .fadeOut(600, function () {
    $(this).remove();
  });

// function loadUsersOnline() {
//   $.get('functions.php?onlineusers=result', function (data) {
//     $('.users-online').text(data);
//     // console.log(`data: ${data}`);
//   });
// }

// setInterval(function () {
//   loadUsersOnline();
// }, 5000);
