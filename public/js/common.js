var link = window.location.pathname;
var prefixRoute = getRoutePrefix();

$('.selectpicker').selectpicker();
/*
=======
* stop drop-down menu form disappearing on clicking
*/
$('.dropdown-menu.tasks-bar input').click(function (event) {
    event.stopPropagation(); 
});

$('.dropdown-menu.date-option .custom-li').click(function () {
    $('.dropdown-menu.date-option').click(function (event) {
        event.stopPropagation();
    });
});
/*
*
* onclicking effect of custom date picker
* hide dropdown-menu excluding custom row
* show calendar for date picking
* adjust height of ul of time period selection
*/
$('.dropdown-menu .custom-li').click(function () {
    $('.dropdown-divider').hide();
    $('.selected-time .dropdown-menu.extended.tasks-bar li').not('.custom-li').hide();
    $('.custom-date').show();
    $('.selected-time .dropdown-menu.extended.tasks-bar').css('height', 'auto');
});
/*
*
* onclicking effect of cancel custom date picker
* show dropdown-menu excluding custom row
* hide calendar for date picking
* adjust height of ul of time period selection
*/
$('.btn-danger').click(function () {
    $('.dropdown-divider').show();
    $('.selected-time .dropdown-menu.extended.tasks-bar li').not('.custom-li').show();
    $('.custom-date').hide();
    $('.selected-time .dropdown-menu.extended.tasks-bar').css('height', '294px');
});

/*
*
* display no data found message on table if no data found
*/
function processDataTable(response) {
    if(response.displayNoDataFoundMessageOnTable) {
        $('.no-data-found-table.hidden-no-data-found-message-table')
            .removeClass('hidden-no-data-found-message-table');
    } else {
        $('.no-data-found-table')
            .addClass('hidden-no-data-found-message-table');
    }
}
$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getAccountReports(page);
        }
    }
});

function sendingRequestTable() {
    $('.loading-gif-on-table').removeClass('hidden-table');
    setTimeout(function() {
        $('.loading-gif-on-table').show();
    }, 10);
}

function completeRequestTable()
{
    $('.loading-gif-on-table').addClass('hidden-table');
}
/*
*
* onclicking apply button
* display selected columns
* update table with selected columns
*/
$(".apply-button").click(function () {
    var array = [];
    if (!array['fieldName']) {
        array['fieldName'] = [];
    }

    if(!array['paginaton']) {
        array['pagination'] = $("input[name='resultPerPage']:checked").val();
    }

    $.each($("input[name='fieldName']:checked"), function () {
        array['fieldName'].push($(this).val());
    });
    $.ajax({
        url: prefixRoute + "/update-table",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'pagination' : array['pagination'],
            'fieldName' : array['fieldName'],
        },
        beforeSend : function () {
            setTimeout(function() {
                $('#columnsModal').modal('hide');
            }, 1);
            setTimeout(function() {
                sendingRequestTable();
            }, 200);
        },
        success: function(response) {
            $('.table_data_report').html(response.tableDataLayout);
            $('.summary_report').html(response.summaryReportLayout);
            processDataTable(response);
            history.pushState("", "", link);
        },
        error : function (response) {
            alert('Something went wrong!');
        },
        complete : function () {
            completeRequestTable();
        }
    });
});

$('input[name="fieldName"]:checkbox').change(function() {
    filterColumnChecked();
});

function filterColumnChecked() {
    var array= [];
    $.each($("input[name='fieldName']:checked"), function() {
        array.push($(this).val());
    });
    if (array.length === 1) {
        $("input[name='fieldName']:checked").attr("disabled", true);
    } else if(array.length > 1) {
        $("input[name='fieldName']:checkbox").removeAttr('disabled');
    }
}
filterColumnChecked();
/*
*
* onclicking date button
* update table with selected time period
*/
$('.date-option li:not(.custom-li, .custom-date)').click(function () {
    var option = $(this).data('date');
    var milestone = getFilterDate(option);
    $.ajax({
        url : prefixRoute + "/update-table",
        type : "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            'startDay' : milestone['startDay'],
            'endDay' : milestone['endDay'],
            'timePeriodTitle' : milestone['timePeriodTitle'],
        },
        beforeSend : function () {
            sendingRequestTable();
        },
        success : function (response) {
            $('.table_data_report').html(response.tableDataLayout);
            $('.summary_report').html(response.summaryReportLayout);
            processDataTable(response);
            history.pushState("", "", link);
        },
        error : function (response) {
            alert('Something went wrong!');
        },
        complete : function () {
            completeRequestTable();
        }
    });
});

$('.apply-custom-period').click(function() {
    var option = $('.custom-li').data('date');
    var startDay = $('.dpd1').val();
    var endDay = $('.dpd2').val();
    var milestone = getFilterDate(option);
    $.ajax({
        url : prefixRoute + "/update-table",
        type : "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            'startDay' : startDay,
            'endDay' : endDay,
            'timePeriodTitle' : milestone['timePeriodTitle'],
        },
        beforeSend : function () {
            sendingRequestTable();
        },
        success : function (response) {
            $('.table_data_report').html(response.tableDataLayout);
            $('.summary_report').html(response.summaryReportLayout);
            processDataTable(response);
            history.pushState("", "", link);
        },
        error : function (response) {
            alert('Something went wrong!');
        },
        complete : function () {
            completeRequestTable();
        }
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
        case 'showZero' :
            statusTitle = 'Show 0';
            status = 'showZero';
            break;
        case 'hideZero' :
            statusTitle = 'Hide 0';
            status = 'hideZero';
            break;
    }
    $.ajax({
        url : prefixRoute + "/update-table",
        type : "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            'status' : status,
            'statusTitle' : statusTitle,
        },
        beforeSend : function () {
            sendingRequestTable();
        },
        success : function (response) {
            $('.table_data_report').html(response.tableDataLayout);
            $('.summary_report').html(response.summaryReportLayout);
            processDataTable(response);
            history.pushState("", "", link);
        },
        error : function (response) {
            alert('Something went wrong!');
        },
        complete : function () {
            completeRequestTable();
        }
    });
});
/*
*
* select all checkbox
*/
$("#selectAll").click(function () {
    if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
      filterColumnChecked();
    }
    else {
        $(':checkbox').each(function () {
            this.checked = false;
            $("input[name='fieldName']:checkbox")[0].checked = true;
            filterColumnChecked();
        });
    }
})
/*
*
* onclicking table header
* sort table
*/
$('.table_data_report').delegate('th', 'click', function() {
    var th = $("th").eq($(this).index());
    $.ajax({
        url : prefixRoute + "/update-table",
        type : "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            'columnSort' : th.text(),
        },
        success : function (response) {
            $('.table_data_report').html(response.tableDataLayout);
        }
    });
})

var timer;
function searchUp() {
    timer = setTimeout(function()
    {
        var keywords = $('#txtLiveSearch').val();
        if (keywords.length >= 0) {
            $.ajax({
                url: prefixRoute + "/live_search",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'keywords' : keywords,
                },
                success: function(result) {
                    $('#listSearch').empty();
                    $('#listSearch').html(result);
                }
            });
        }
    }, 500);
}

$('#listSearch').delegate('li', 'click', function() {
    $('#txtColumn').text($(this).text());
    if($(".selection-dropdown").hasClass("open")){
        $(".selection-dropdown").removeClass("open");
    }
})

$('.specific-filter-item').click(function() {
    $.ajax({
        url : prefixRoute + "/update-table",
        type : "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            'specificItem' : $(this).data('value'),
        },
        success : function (response) {
            $('.table_data_report').html(response.tableDataLayout);
        }
    });
});