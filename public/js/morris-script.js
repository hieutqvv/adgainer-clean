var Script = function () {

    //morris chart

    $(function () {
        var lineChart;
        initMorris();
        getMorris();
        $('.statistic .col-md-2').click(function() {
            var $active = $('.statistic .col-md-2.active');
            labels = $(this).data('name');
            $(this).addClass('active');
            $active.removeClass('active');
            var columnName = $(this).data('name');
            updateMorris(columnName);
        });

        $('.date-option li').click(function() {
            var option = $(this).data('date');
            var milestone = getFilterDate(option);
            $('.selected-time').removeClass('open');
            $.ajax({
                url : "/display-graph",
                type : "POST",
                headers: {
                    'X-CSRF-TOKEN': $
                    ('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    'startDay' : milestone['startDay'],
                    'endDay' : milestone['endDay'],
                    'timePeriodTitle' : milestone['timePeriodTitle'],
                },
                beforeSend : function () {
                    sendingRequest();
                },
                success : function (response) {
                    var data = [];
                    for(var i = 0; i < response.data.length; i++) {
                        data.push({ "date" : response.data[i].day, "clicks" : response.data[i].data });
                    }
                    setMorris(data);
                    $('#time-period').html(response.timePeriodLayout);
                },
                error : function (response) {
                    alert('Something went wrong!');
                },
                complete : function () {
                    completeRequest();
                },
            });
        });
        /*
        *
        * onclicking status button
        * update table with selected status
        */
        $('.status-option li').click(function () {
            var option = $(this).data('status');
            var status;
            switch(option) {
                case 'all' : 
                    status = '';
                    break;
                case 'disabled' : 
                    status = 'disabled';
                    break;
                case 'enabled' :
                    status = 'enabled';
                    break;
            }
            $.ajax({
                url : "/display-graph",
                type : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    'status' : status,
                },
                beforeSend : function () {
                    sendingRequest();
                },
                success : function (response) {
                    var data = [];
                    for(var i = 0; i < response.data.length; i++) {
                        data.push({ "date" : response.data[i].day, "clicks" : response.data[i].data });
                    }
                    setMorris(data);
                    $('#time-period').html(response.timePeriodLayout);
                },
                error : function (response) {
                    alert('Something went wrong!');
                },
                complete : function () {
                    completeRequest();
                },
            });
        });
        /*
        *
        * onclicking column button
        * update graph with selected column
        */
        $('#listSearch').delegate('li', 'click', function() {
            $.ajax({
                url : "/display-graph",
                type : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    'graphColumnName' : $(this).text(),
                },
                beforeSend : function () {
                    sendingRequest();
                },
                success : function (response) {
                    var data = [];
                    for(var i = 0; i < response.data.length; i++) {
                        data.push({ "date" : response.data[i].day, "clicks" : response.data[i].data });
                    }
                    setMorris(data);
                    $('#time-period').html(response.timePeriodLayout);
                },
                error : function (response) {
                    alert('Something went wrong!');
                },
                complete : function () {
                    completeRequest();
                },
            });
        });
        // initialise graph
        function initMorris()
        {
            lineChart = Morris.Line({
                element: 'report-graph',
                xkey: 'date',
                ykeys: ['clicks'],
                labels: ['Clicks'],
                lineColors:['#0d88e0'],
                parseTime:false,
                hideHover:false,
                lineWidth:'3px',
                pointSize: 0,
                smooth: false,
                redraw: true,
            });
            }

        function setMorris(data)
        {
            lineChart.setData(data);
        }
        // set graph with `click` for y-axis
        function getMorris()
        {
            $.ajax({
                url : '/display-graph',
                type : 'GET',
                beforeSend : function () {
                    sendingRequest();
                },
                success: function(response) {
                    var data = [];
                    for(var i = 0; i < response.data.length; i++) {
                        data.push({ "date" : response.data[i].day, "clicks" : response.data[i].data });
                    }
                    setMorris(data);
                    $('#time-period').html(response.timePeriodLayout);
                },
                error : function (response) {
                    alert('Something went wrong!');
                },
                complete : function () {
                    completeRequest();
                },
            });
        }

        function updateMorris(columnName)
        {
            $.ajax({
                url : '/display-graph',
                type : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    'graphColumnName' : columnName,
                },
                beforeSend : function () {
                    sendingRequest();
                },
                success : function(response)
                {
                    var data = [];
                    for(var i = 0; i < response.data.length; i++) {
                        data.push({ "date" : response.data[i].day, "clicks" : response.data[i].data });
                    }
                    setMorris(data);
                    $('#time-period').html(response.timePeriodLayout);
                },
                error : function (response) {
                    alert('Something went wrong!');
                },
                complete : function () {
                    completeRequest();
                },
            });
        }
    });

}();
