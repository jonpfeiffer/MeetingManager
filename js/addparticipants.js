(function($) {
    $(function(){
        var request;
        
        //Dump Who: field on minus button click
        $('form').on('click', '.empty', function(e){
            e.preventDefault();
            $('#attendee').val("");
        });

        $('form').on('click', '.more', function(e){
            e.preventDefault();
            var data = $('#participants').serialize();
            request = $.ajax({
                url:'addparticipants.php',
                type: 'post',
                data: data
            });
            
        });
    });
})(jQuery);