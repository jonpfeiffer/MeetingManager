 $(function(){
        $('div.time').TimeCircles(
            {start: true,
            time: {
                Days: {show: false},
                Hours: {show: false},
                Minutes: {show: true},
                Seconds: {show: false}
            }
        });
    });