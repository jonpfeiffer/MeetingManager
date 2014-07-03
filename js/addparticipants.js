(function($) {
    $(function(){
        var i = 0;
        //Dump Who: field on minus button click
        $('form').on('click', '.empty', function(e){
            e.preventDefault();
            $('#attendee').val("");
        });

        $('.more').click(function(){
            i += 1;
            // console.log(i);
            var data = $('#attendee').val();
            var button = $('<span class="input-group-btn"><button type="button" class="btn btn-sm rem">X</button></span>');
            var item = $('<input type="text" class="form-control input-sm" readonly></input>');
            var container = $('<div class="input-group"></div>')
            var outer = $('<div class="form-group"></div>');
            var count = 'attendee-' + i;
            // console.log(count);
            item.attr('name', count);
            item.attr('id', count);
            item.val(data);
            container.append(button);
            container.prepend(item);
            outer.append(container);
            $('#attendee').val("");
            $('.participants').append(outer);
            $('.well').removeClass('hidden');
        });

        $('.done').click(function() {
            // var attendeecount = $('[id^=attendee]').length();
            // $('#count').val(attendeecount);
            var attendeelist = $('[id^=attendee-]');
            for(var i = 0; i < attendeelist.length; i++){
                if(attendeelist[i].value === ""){
                    attendeelist[i].parentNode.remove();
                }    
            }
            $('#attendee').parent().remove();
            $('#meetingform').submit();
        });
    });
       
})(jQuery);