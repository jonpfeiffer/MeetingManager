(function($){
    $(function(){
        $('body').on('click', 'div.tasklist', function(e){
            console.log($(this).children('.hidden'));
            if($(this).children('.hidden').length !== 0){
                $(this).children('.hidden').removeClass('hidden');

            }else{
                $(this).children('.list-group').addClass('hidden');
            }
        });
    });
})(jQuery);
