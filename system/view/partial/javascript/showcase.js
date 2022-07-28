---
$path
$page
---

$('body').delegate('.thumbnail', 'click', function() {
  var href = $(this).data('href') + '?clear=1';
  $('#modal-iframe').attr('src',href);
});
$('.load-more').click(function(){
  $('.load-more').hide();
  $('.ajax-loading').fadeIn();
  $('#is-loading').val(1);
  var page = $('#page').val();
  $.ajax({
    url: '{{$path}}ajax-{{$page}}',
    dataType: 'html',
    type:'POST',
    data: {
      page: page
    },
    success: function(response){
      $('.ajax-loading').fadeOut();
      $('.load-more').fadeIn();
      if(response=='') {
        $('.load-more').remove();
        $('.ajax-loading').html('<small>沒了</small>');
      }
      else {
        var newpage = parseInt(page) + 1;
        $('#page').val(newpage);
        $('#is-loading').val(0);
        $('#showcase-list').append(response);
      }
    }
  });
});
