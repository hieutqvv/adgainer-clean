<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/css/morris.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />
    <link href="/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="/css/jquery-ui.structure.min.css" rel="stylesheet" />
    <link href="/css/jquery-ui.theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
      <script src="/js/respond.min.js"></script>
      <![endif]-->
</head>
<body class="full-width">
    <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
            <!--logo start-->
            <a href="index.html" class="logo">
                <img src="https://adgainersolutions.com/adgainer/application/images/logos/ad-gainer-logo-v1.1-250x54px-transp-bkgd-flat.png">
            </a>
            <!--logo end-->
            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li><a href="{{URL::asset('')}}account_report/language/en"><img src="/images/english.png"></a></li>
                    <li><a href="{{URL::asset('')}}account_report/language/ja"><img src="/images/jp.png"></a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">
                                {{Auth::user()->username}}
                            </span>
                            <b class="caret"></b> 
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="/logout"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row breadcrumb-list">
                    <div class="col-md-12">
                    <!--breadcrumbs start -->
                    {!! Breadcrumbs::render() !!}
                    <!--breadcrumbs end -->
                    </div>
                </div>
                <div class="row information">
                    <div class="element-title col-md-9 col-xs-12">
                        <section class="panel">
                            <div class="panel-body">
                                <span class="title">@lang('language.Account')<br></span>
                                <span class="element-name">
                                    <img src="/images/yahoo.png">
                                    Campaign name
                                </span>
                            </div>
                        </section>
                    </div>

                    <div class="col-md-3 col-xs-12 selected-time" id="add-time-period">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body" id="time-period">
                                @include('layouts.time-period')
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar date-option">
                            <li data-date="today">
                                <a href="#">
                                    <div class="desc">@lang('language.today')</div>
                                </a>
                            </li>
                            <li data-date="yesterday">
                                <a href="#">
                                    <div class="desc">@lang('language.yesterday')</div>
                                </a>
                            </li>
                            <li data-date="last7DaysToday">
                                <a href="#">
                                    <div class="desc">@lang('language.last_7_days')(@lang('language.including_today'))</div>
                                </a>
                            </li>
                            <li data-date="last7days">
                                <a href="#">
                                    <div class="desc">@lang('language.last_7_days')(@lang('language.excluding_today'))</div>
                                </a>
                            </li>
                            <li data-date="last30days">
                                <a href="#">
                                    <div class="desc">@lang('language.last_30_days')</div>
                                </a>
                            </li>
                            <li data-date="last90days">
                                <a href="#">
                                    <div class="desc">@lang('language.last_90_days')</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li data-date="thisWeek">
                                <a href="#">
                                    <div class="desc">@lang('language.this_week')</div>
                                </a>
                            </li>
                            <li data-date="thisMonth">
                                <a href="#">
                                    <div class="desc">@lang('language.this_month')</div>
                                </a>
                            </li>
                            <li data-date="thisQuarter">
                                <a href="#">
                                    <div class="desc">@lang('language.this_quarter')</div>
                                </a>
                            </li>
                            <li data-date="thisYear">
                                <a href="#">
                                    <div class="desc">@lang('language.this_year')</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li data-date="lastBusinessWeek">
                                <a href="#">
                                    <div class="desc">@lang('language.last_business_week') (@lang('language.Mon_Fri'))</div>
                                </a>
                            </li>
                            <li data-date="lastFullWeek">
                                <a href="#">
                                    <div class="desc">@lang('language.last_full_week')</div>
                                </a>
                            </li>
                            <li data-date="lastMonth">
                                <a href="#">
                                    <div class="desc">@lang('language.last_month')</div>
                                </a>
                            </li>
                            <li data-date="lastQuarter">
                                <a href="#">
                                    <div class="desc">@lang('language.last_quarter')</div>
                                </a>
                            </li>
                            <li data-date="lastYear">
                                <a href="#">
                                    <div class="desc">@lang('language.last_year')</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="custom-li" data-date="custom">
                                <a href="#">
                                    <div class="desc">@lang('language.custom')</div>
                                </a>
                            </li>
                            <li id="datepicker" class="custom-date">
                            <form action="#" class="form-horizontal tasi-form">
                                <div class="form-group row">
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <span style="width: 100%; float: right;">From</span>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control dpd1" id ="from" name="from" />
                                                <span class="input-group-addon dpd1-from">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <span style="width: 100%; float: right;">To</span>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control dpd2" id ="to" name="to" />
                                                <span class="input-group-addon dpd2-to">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both;">
                                        <button type="button" class="btn btn-primary apply-custom-period">Apply</button>
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row group">
                    <div class="col-md-8 col-xs-12 pull-left">
                        @yield('filter-list')
                    </div>
                    <div class="col-md-2 col-xs-12 selection-dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body" id="graph-column">
                                @include('layouts.graph-column')
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar">
                            <li>
                                <p class="heading">
                                <span class="glyphicon glyphicon-search"></span>
                                <input type="text" placeholder="@lang('language.Search_by_columns')" onkeyup="searchUp()" id="txtLiveSearch">
                                </p>
                            </li>
                            <div id="listSearch">
                                @foreach ($columnsLiveSearch as $columnsSearch)
                                <li>
                                    <a href="#">
                                        <div class="desc">{{ __('language.' .str_slug($columnsSearch,'_')) }}</div>
                                    </a>
                                </li>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-12 selection-dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body" id= "status-label">
                                    @include('layouts.status-title')
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar status-option">
                            <li data-status="showZero">
                                <a href="#">
                                    <div class="desc">@lang('language.show_0')</div>
                                </a>
                            </li>
                            <li data-status="hideZero">
                                <a href="#">
                                    <div class="desc">@lang('language.hide_0')</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row line-chart">
                    <div class="loading-gif-on-graph hidden-graph"></div>
                    <div class="no-data-found-graph hidden-no-data-found-message-graph">
                        <span class="no-data-found-message-graph">No data found for graph</span>
                    </div>
                    <section class="panel">
                        <div class="panel-body">
                            <div id="report-graph" class="graph"></div>
                        </div>
                    </section>
                </div>

                <div class="row statistic summary_report">
                    @include('layouts.summary_report')
                </div>

                <div class="row csv-file">
                    <div class="col-md-1 col-xs-6 icon dropdown">
                        <div class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="glyphicon glyphicon-download-alt"></div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu extended"  aria-labelledby="dropdownMenu1">
                            @yield('export')
                        </ul>
                    </div>
                    <div class="col-md-1 col-xs-6 columns">
                        <a data-toggle="modal" href="#columnsModal">
                        <section class="panel">
                            <div class="panel-body ">
                              @lang('language.Columns')
                            </div>
                        </section>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="columnsModal" tabindex="-1" role="dialog" aria-labelledby="columnsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Customize</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal">
                                        <div class="result-per-page">
                                            <p>Results per page</p>
                                            <div class="form-group">
                                                <input type="radio" name="resultPerPage" value="20" {{(int)$keyPagination === 20 ? 'checked' : ''}} > 20<br>
                                            </div> 

                                            <div class="form-group">
                                                <input type="radio" name="resultPerPage" value="50" {{(int)$keyPagination === 50 ? 'checked' : ''}}> 50<br>
                                            </div>

                                            <div class="form-group">
                                                <input type="radio" name="resultPerPage" value="100" {{(int)$keyPagination === 100 ? 'checked' : ''}}> 100
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="items-to-display">
                                            <p>Items to display</p>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" id="selectAll"> Select all
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            @include('layouts.fields_on_modal')
                                            <div class="clearfix"></div>
                                        </div>
                                        <div>
                                            <button type="button" class="apply-button btn btn-primary">Apply</button>
                                        </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>
                <div class="table_data_report" style="position: relative;">
                    @include('layouts.table_data')
                </div>
        </section>
    </section>
    <!--main content end-->
    <!-- Lib js -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery-date-range.js"></script>
    <script src="/js/morris.min.js"></script>
    <script src="/js/raphael-min.js"></script>
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <!-- Custom js-->
    <script>
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
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function (e) {
                getAccountReports($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        function getAccountReports(page) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url : getRoutePrefix() + '/update-table?page=' + page,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('.table_data_report').html('');
                    $('.table_data_report').html(data.tableDataLayout);
                    $('.summary_report').html(data.summaryReportLayout);
                    history.pushState("", "", '?page=' + page);
                },
                error: function (data) {

                    alert('Reports could not be loaded.');
                }
            });
        }

        function getRoutePrefix()
        {
            return '{{ $prefixRoute }}';
        }
    </script>
    <script src="/js/common-function.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/morris-script.js"></script>
</body>
</html>
