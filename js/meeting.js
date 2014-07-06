(function($){
    $(function(){
        var people = $('.three');
        $('.timer').TimeCircles({start:false,time: {
                        Days: {show: false},
                        Hours: {show: true},
                        Minutes: {show: true},
                        Seconds: {show: true}
                        }});
       
        $('.mtg-start').click(function(){
            $('.timer').TimeCircles().start();
            $('.mtg-end').removeClass('disabled');
            $('.mtg-start').addClass('disabled');
            console.log(moment().format("YYYY-MM-DD HH:mm"));

        });

        $('.mtg-end').click(function(){
            $('.timer').TimeCircles().stop();
            console.log($('.timer').TimeCircles().getTime());
        });
       
        $('body').on('click', 'div.two', function(e){
            console.log($(this).parent().siblings('.hidden'));
            $(this).parent().siblings('.hidden').removeClass('hidden');
        });

        $('body').on('click', 'div.three', function(e){
            var startThis = $(this).children();
            console.log(startThis);
            var people = $('.three');
            
            if ($(this).hasClass('bg-success')){
                // console.log("fired");
                $(this).removeClass('bg-success');
                startThis.TimeCircles().stop();
            }else{
                    startThis.TimeCircles({time: {
                        Days: {show: false},
                        Hours: {show: false},
                        Minutes: {show: true},
                        Seconds: {show: false}
                        }}).start();
                    $(this).addClass('bg-success');
            }
        });
    });
})(jQuery);