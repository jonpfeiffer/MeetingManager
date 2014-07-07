(function($){
    $(function(){
        var people = $('.three');
        var id = getParameterByName('meeting_id');
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
            ajaxStart(moment().format("YYYY-MM-DD HH:mm"), id);
        });

        $('.mtg-end').click(function(){
            $('.timer').TimeCircles().stop();
            console.log($('.timer').TimeCircles().getTime());
            ajaxEnd(moment().format("YYYY-MM-DD HH:mm"), id);
            //set up routing so meetings with end times go to meeting summary
            location.href('http://jon.com/MVC/index.php/meeting?meeting_id' + id);
        });
       
        $('body').on('click', 'div.two', function(e){
            console.log($(this).parent().siblings('.hidden'));
            if($(this).parent().siblings('.hidden').length !== 0){
                $(this).parent().siblings('.hidden').removeClass('hidden');

            }else{
                $(this).parent().siblings('.due-date').addClass('hidden');
            }
        });
        
        $('body').on('click', '.assign', function(e){
            var person = $(this).parent().parent().attr('id');
            
            var data = $('#' + person).serialize();
            data += '&person_id=' + person;
            data += '&meeting_id=' + id;
            console.log(data);
            ajaxTask(data);
        })

        // $('body').on('click', 'div.two.button')

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
    function ajaxStart (timestamp, id) {
        var data = {datetime_start: timestamp,
                    datetime_end: null,
                    meeting_id: id};
        $.ajax({
            type: 'POST',
            url:  'timer_controller.php',
            data: data,
            cache: false
            }) 
            .success(function(json){
                console.log(json);
            })
    }

    function ajaxEnd (timestamp, id) {
        var data = {datetime_end: timestamp,
                    datetime_start: null,
                    meeting_id: id};
        $.ajax({
            type: 'POST',
            url:  'timer_controller.class.php',
            data: data,
            cache: false
            }) 
            .success(function(json){
                console.log(json);
            })
    }

    function ajaxTask (data){
        // var data = data;
        // {
        //     datetime_due: due,
        //     deliverable_text: text,
        //     meeting_id: id,
        //     person_id: person
        // };

        $.ajax({
            type: 'POST', 
            url: 'task_controller.class.php',
            data: data,
            cache: false
        })
        .success(function(json){
            console.log(json);
        })
    }

    function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
})(jQuery);