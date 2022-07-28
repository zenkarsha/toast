var countdown = Date.now(),
    currentTime = Date.now();

$(document).ready(function(){

  createImage();

  //form submit
  $("#default-submit").click(function() {
    $('#directpost').val('');
    $('#generateForm').attr("target","_self").submit();
  });
  $("#showcase-submit").click(function() {
    $('#directpost').val('2');
    $('#generateForm').attr("target","_self").submit();
  });

  //item settings
  $('body').delegate('#text', 'blur', function() {
    createImage();
  });
  $('body').delegate('#text', 'keydown', function() {
    countdown = Date.now();
  });
  $('body').delegate('#text', 'keyup', function() {
    setTimeout(function(){
      currentTime = Date.now();
      if((currentTime - countdown) >= 240 ) {
        $('#loading').show();
        createImage();
      }
    }, 250);
  });
  $('body').delegate('input[name=bgcolor]', 'change', function() {
    createImage();
  });
});

//ajax function
function createImage(){
  $('#loading').show();
  $.ajax({
    url: 'generate',
    dataType: 'html',
    type:'POST',
    data: {
      text: $("#text").val(),
      directpost: 1
    },
    success: function(result){
      $("#coverprint").html(result);
      $('#loading').hide();
    }
  });
}

// scroll to top
$(window).scroll(function (event) {
  var scroll = $(window).scrollTop();
  var height = $(window).height();
  if(scroll > height*0.5)
    $('.gototop').show();
  else
    $('.gototop').hide();
});
$('.gototop').click(function(){
  $('html,body').animate({scrollTop: 0},'fast');
});
