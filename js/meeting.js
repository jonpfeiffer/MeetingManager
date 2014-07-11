(function($){
    $(function(){
        var people = $('.three');
        var id = getParameterByName('meeting_id');
        
       
        $('.mtg-start').click(function(){
            $('.timer').TimeCircles({time: {
                        Days: {show: false},
                        Hours: {show: true},
                        Minutes: {show: true},
                        Seconds: {show: true}
                        }});
            $('.mtg-end').removeClass('disabled');
            $('.mtg-start').addClass('disabled');
            ajaxStart(moment().format("YYYY-MM-DD HH:mm"), id);
        });

        $('.mtg-end').click(function(){
            $('.timer').TimeCircles().stop();
            var allClocks = $('.time');
            allClocks.each(function(){
                $(this).TimeCircles().stop();

                var time = $(this).TimeCircles().getTime();
                time = new String(time);
                console.log(time);
                time = time.toString();
                console.log(time);
                time = time.split(".");
                console.log(time);
                time = Math.abs(time[0]);
                console.log(time);
                var junk = $(this).attr('class');
                junk = junk.split(" ");
                var good = junk[1].slice(0,2);
                // console.log(good);

                ajaxTime(good, id, time);
            });
            // console.log($('.timer').TimeCircles().getTime());
            ajaxEnd(moment().format("YYYY-MM-DD HH:mm"), id);
            // //set up routing so meetings with end times go to meeting summary
            var newLocation = 'http://jon.com/MVC/index.php/meeting?meeting_id=' + id;
            window.location = newLocation;
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
            $(this).parent().parent().parent().addClass('hidden');
            $(this).siblings('.form-control').empty();
            ajaxTask(data);
        })

        // $('body').on('click', 'div.two.button')

        $('body').on('click', 'div.three', function(e){
            var startThis = $(this).children();
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
            console.log(startThis.TimeCircles().getTime());
        });
    });
    function ajaxStart (timestamp, id) {
        var data = {datetime_start: timestamp,
                    meeting_id: id};
        $.ajax({
            type: 'POST',
            url:  'http://jon.com/MVC/index.php/start',
            data: data,
            cache: false
            }) 
            .success(function(json){
                console.log(json);
            })
    }

    function ajaxEnd (timestamp, id) {
        var data = {datetime_end: timestamp,
                    meeting_id: id};
        $.ajax({
            type: 'POST',
            url:  'http://jon.com/MVC/index.php/end',
            data: data,
            cache: false
            }) 
            .success(function(json){
                console.log(json);
            })
    }

    function ajaxTime (person, meeting, time) {
        var data = {person_id: person,
                    meeting_id: meeting,
                    speaking_duration: time};
        $.ajax({
            type: 'POST',
            url:  'http://jon.com/MVC/index.php/time',
            data: data,
            cache: false
            }) 
            .success(function(json){
                console.log(json);
            })
    }

    function ajaxTask (data){
        
        $.ajax({
            type: 'POST', 
            url: 'http://jon.com/MVC/index.php/task',
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