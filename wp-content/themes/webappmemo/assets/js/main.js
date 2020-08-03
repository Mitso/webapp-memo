jQuery(document).ready(function($) {
  let startButton = $(':button');

  $(".article__tag").each(function() {
    if ($.trim($(this).html()).length !== 0 ) {
      $(this).next().addClass('separator');
    }
  });


  $('.list__input').click(function(e){
    $('.list__input').next().removeClass('selected');
    $(this).next().addClass('selected');
    setTimeout(function(e){
      $('#FormDribble').submit(function(e) {
        e.preventDefault();
        let filter = $('#FormDribble');
        console.log(filter);
        $.ajax({
          url:filter.attr('action'),
          data: {
            action : 'filter_function',
          },
          type:filter.attr('method'), // POST
          beforeSend:function(xhr){
            filter.find('#submit').text('Processing...'); // changing the button label
          },

          success:function(data){
            filter.find('#submit').text('Apply filter');
            $('#response').html(data); // insert data
              console.log('==>',data);
          }
        });
        return false;
      });

    },800)

  });









});
