(function($) {
    $(function(){
        var request;
        
        //Dump Who: field on minus button click
        $('form').on('click', '.empty', function(e){
            e.preventDefault();
            $('#attendee').val("");
        });

        $('button.more').click(function(e){
            var data = $('#attendee').val("");
            request = $.ajax({
                url:'index.php/person',
                type: 'post',
                data: data,
                cache: false
                });    
            $('.well').removeClass('hidden');
    });
       
})(jQuery);