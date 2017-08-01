<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="images/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Account report</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
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
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">
                                kakeya@scuti.asia
                            </span>
                            <b class="caret"></b> 
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class="fa fa-key"></i> Log Out</a></li>
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
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <div class="breadcrumb-item-detail">
                                <span class="title">Account<br></span>
                                <a data-toggle="dropdown" id="dropdownMenu1" class="dropdown-toggle" href="#">
                                    <span class="content">Account name</span>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar" id="dropdownMenu1">
                                    <li>
                                        <p class="heading">
                                        <span class="glyphicon glyphicon-search"></span> 
                                        <input type="text" placeholder="Search for account">
                                        </p>
                                    </li>
                                    <div class="dropdown-menu scroll-menu">
                                    <li>
                                        <a href="#">
                                            <div class="desc">All engine accounts</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">
                                                <img src="images/yahoo.png">
                                                All Yahoo Japan accounts
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">
                                                <img src="images/yahoo.png">
                                                Samsung
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">
                                                <img src="images/yahoo.png">
                                                Oppo
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">
                                                <img src="images/yahoo.png">
                                                Nokia
                                            </div>
                                        </a>
                                    </li>
                                    </div>
                                </ul>
                            </div>
                        </li>
                        <li class="breadcrumb-item">
                            <div class="breadcrumb-item-detail">
                                <span class="title">Campaign<br></span>
                                <a data-toggle="dropdown" id="dropdownMenu2" class="dropdown-toggle" href="#">
                                    <span class="content">All campaign (5)</span>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar" id="dropdownMenu2">
                                    <li>
                                        <p class="heading">
                                        <span class="glyphicon glyphicon-search"></span>
                                        <input type="text" placeholder="Search for campaign">
                                        </p>
                                    </li>
                                    <div class="dropdown-menu scroll-menu">
                                    <li>
                                        <a href="#">
                                            <div class="desc">All campaigns</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">test 1</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">test 2</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">test 3</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">test 4</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="desc">test 5</div>
                                        </a>
                                    </li>
                                    </div>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!--breadcrumbs end -->
                    </div>
                </div>
                <div class="row information">
                    <div class="col-md-4 col-xs-12">
                        <section class="panel">
                            <div class="panel-body">
                                <span class="title">Account<br></span>
                                <span class="element-name">
                                    <img src="images/yahoo.png">
                                    Campaign name
                                </span>
                            </div>
                        </section>
                    </div>

                    <div class="col-md-3 col-xs-12 selected-time">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body">
                                    <span class="title">Last 90 days<br></span>
                                    <span>Feb 18, 2017 - May 18, 2017</span>
                                    <strong class="caret"></strong>
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar">
                            <li>
                                <a href="#">
                                    <div class="desc">Today</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Yesterday</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last 7 days( include today)</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last 7 days( exclude today)</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last 30 days</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last 90 days</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="#">
                                    <div class="desc">This week</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">This month</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">This quarter</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">This year</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="#">
                                    <div class="desc">Last business week (Mon – Fri)</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last full week</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last month</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last quarter</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Last year</div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="custom-li">
                                <a href="#">
                                    <div class="desc">Custom</div>
                                </a>
                            </li>
                            <li id="datepicker" class="custom-date">
                            <form action="#" class="form-horizontal tasi-form">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">From</span>
                                        <input type="text" class="form-control dpd1" name="from">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="to">
                                        <button type="button" class="btn btn-primary">Apply</button>
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
                        <ul class="panel">
                            <li class="panel-body">
                                <a href="campaign-list.html">
                                    CAMPAIGNS
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="#">
                                    AD GROUPS
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="keywords.html">
                                    KEYWORDS
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="ad-list.html">
                                    ADS
                                </a>
                            </li>
                            <li class="panel-body separator">
                            </li>
                            <li class="panel-body">
                                <a href="prefectures.html">
                                    PREFECTURES
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="time-zone.html">
                                    BY TIME ZONE
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="days-of-the-week.html">
                                    BY DAYS OF THE WEEK
                                </a>
                            </li>
                            <li class="panel-body">
                                <a href="./devices.html">
                                    DEVICES
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-12 selection-dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body">
                                    <span>Columns
                                    <strong class="caret selection"></strong>
                                    </span>
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar">
                            <li>
                                <a href="#">
                                    <div class="desc">Clicks</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-12 selection-dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <section class="panel">
                            <div class="panel-body">
                                    <span>Show all
                                    <strong class="caret selection"></strong>
                                    </span>
                            </div>
                        </section>
                        </a>
                        <ul class="col-md-2 dropdown-menu extended tasks-bar">
                            <li>
                                <a href="#">
                                    <div class="desc">Show all</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Show all but removed</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="desc">Show enabled</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row line-chart">
                    <canvas id="myChart" width="400" height="110"></canvas>
                </div>

                <div class="row statistic">
                    <div class="col-md-2 active">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">Clicks<br></span>
                                    <span class="content"><i class="fa fa-circle"></i>5,341<br> </span>
                                    <span class="explication">Adv: 30,858(17.3%)</span>
                                </div>
                            </section>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">Impr<br></span>
                                    <span class="content">28,400<br> </span>
                                    <span class="explication">Adv: 1,409,701(2.01%)</span>
                                </div>
                            </section>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">Cost<br></span>
                                    <span class="content"><i class="fa fa-rmb"></i>272,061<br> </span>
                                    <span class="explication">Adv: <i class="fa fa-rmb"></i>2,337,088(11,6%)</span>
                                </div>
                            </section>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">CTR<br></span>
                                    <span class="content">18.8%<br> </span>
                                    <span class="explication">Adv: 2.19%(859%)</span>
                                </div>
                            </section>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">AvgCPC<br></span>
                                    <span class="content"><i class="fa fa-rmb"></i>51<br> </span>
                                    <span class="explication">Adv: <i class="fa fa-rmb"></i>76(67.3%)</span>
                                </div>
                            </section>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#">
                            <section class="panel">
                                <div class="panel-body">
                                    <span class="title">Avg pos<br></span>
                                    <span class="content">1.0<br> </span>
                                    <span class="explication">Adv: 2.8(35.6%)</span>
                                </div>
                            </section>
                        </a>
                    </div>    
                </div>

                <div class="row csv-file">
                    <div class="col-md-1 col-xs-6 icon dropdown">
                        <div class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="glyphicon glyphicon-download-alt"></div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu extended"  aria-labelledby="dropdownMenu1">
                           
                            <li><a href="{{ route('export_csv') }}">CSV</a></li>
                            <li><a href="{{ route('export_excel') }}">Excel</a></li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-xs-6 columns">
                        <a data-toggle="modal" href="#columnsModal">
                        <section class="panel">
                            <div class="panel-body ">
                              Columns
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
                                                <input type="radio" name="resultPerPage" value="20" checked> 20<br>
                                            </div> 

                                            <div class="form-group">
                                                <input type="radio" name="resultPerPage" value="50"> 50<br>
                                            </div>

                                            <div class="form-group">
                                                <input type="radio" name="resultPerPage" value="100"> 100
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
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="cost"> Cost
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="impressions"> Impr
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="clicks"> Clicks
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="ctr"> CTR
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="averageCpc"> AvgCPC
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="averagePosition"> Avg Pos
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="invalidClicks"> InvalidClicks
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="invalidClickRate"> InvalidClickRate
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="impressionShare"> ImpressionShare
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="exactMatchImpressionShare"> ExactMatchImpressionShare
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="budgetLostImpressionShare"> BudgetLostImpressionShare
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="qualityLostImpressionShare"> QualityLostImpressionShare
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="trackingURL"> TrackingURL
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="conversions"> Conversions
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="convRate"> ConvRate
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="convValue"> ConvValue
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="costPerConv"> CostPerConv
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="valuePerConv"> ValuePerConv
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="allConv"> AllConv
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="allConvRate"> AllConvRate
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="allConvValue"> AllConvValue
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="costPerAllConv"> CostPerAllConv
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="valuePerAllConv"> ValuePerAllConv
                                                </div> 

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="network"> Network
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="device"> Device
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="day"> Day
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="dayOfWeek"> DayOfWeek
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="quarter"> Quarter
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="month"> Month
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="fieldName" value="week"> Week
                                                </div>
                                            </div>
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

                <div class="row report-table">
                    <div class="col-md-12">
                    <table class="table table-striped" id="reportTable">
                        <thead>
                            <tr>
                                @foreach($fieldNames as $fieldName)
                                <th>
                                    <a href="#">{{ $fieldName }}</a>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($yssAccountReports as $yssAccountReport)
                            <tr>
                                @if($yssAccountReport->account_id)
                                    <td>{{ $yssAccountReport->account_id }}</td>
                                @endif
                                @if($yssAccountReport->cost)
                                    <td>{{ $yssAccountReport->cost }}</td>
                                @endif
                                @if($yssAccountReport->impressions)
                                    <td>{{ $yssAccountReport->impressions }}</td>
                                @endif
                                @if($yssAccountReport->clicks)
                                    <td>{{ $yssAccountReport->clicks }}</td>
                                @endif
                                @if($yssAccountReport->ctr)
                                    <td>{{ $yssAccountReport->ctr }}</td>
                                @endif
                                @if($yssAccountReport->averageCpc)
                                    <td>{{ $yssAccountReport->averageCpc }}</td>
                                @endif
                                @if($yssAccountReport->averagePosition)
                                    <td>{{ $yssAccountReport->averagePosition }}</td>
                                @endif
                                @if($yssAccountReport->invalidClicks)
                                    <td>{{ $yssAccountReport->invalidClicks }}</td>
                                @endif
                                @if($yssAccountReport->invalidClickRate)
                                    <td>{{ $yssAccountReport->invalidClickRate }}</td>
                                @endif
                                @if($yssAccountReport->impressionShare)
                                    <td>{{ $yssAccountReport->impressionShare }}</td>
                                @endif
                                @if($yssAccountReport->exactMatchImpressionShare)
                                    <td>{{ $yssAccountReport->exactMatchImpressionShare }}</td>
                                @endif
                                @if($yssAccountReport->budgetLostImpressionShare)
                                    <td>{{ $yssAccountReport->budgetLostImpressionShare }}</td>
                                @endif
                                @if($yssAccountReport->qualityLostImpressionShare)
                                    <td>{{ $yssAccountReport->qualityLostImpressionShare }}</td>
                                @endif
                                @if($yssAccountReport->trackingURL)
                                    <td>{{ $yssAccountReport->trackingURL }}</td>
                                @endif
                                @if($yssAccountReport->conversions)
                                    <td>{{ $yssAccountReport->conversions }}</td>
                                @endif
                                @if($yssAccountReport->convRate)
                                    <td>{{ $yssAccountReport->convRate }}</td>
                                @endif
                                @if($yssAccountReport->convValue)
                                    <td>{{ $yssAccountReport->convValue }}</td>
                                @endif
                                @if($yssAccountReport->costPerConv)
                                    <td>{{ $yssAccountReport->costPerConv }}</td>
                                @endif
                                @if($yssAccountReport->valuePerConv)
                                    <td>{{ $yssAccountReport->valuePerConv }}</td>
                                @endif
                                @if($yssAccountReport->allConv)
                                    <td>{{ $yssAccountReport->allConv }}</td>
                                @endif
                                @if($yssAccountReport->allConvRate)
                                    <td>{{ $yssAccountReport->allConvRate }}</td>
                                @endif
                                @if($yssAccountReport->allConvValue)
                                    <td>{{ $yssAccountReport->allConvValue }}</td>
                                @endif
                                @if($yssAccountReport->costPerAllConv)
                                    <td>{{ $yssAccountReport->costPerAllConv }}</td>
                                @endif
                                @if($yssAccountReport->valuePerAllConv)
                                    <td>{{ $yssAccountReport->valuePerAllConv }}</td>
                                @endif
                                @if($yssAccountReport->network)
                                    <td>{{ $yssAccountReport->network }}</td>
                                @endif
                                @if($yssAccountReport->device)
                                    <td>{{ $yssAccountReport->device }}</td>
                                @endif
                                @if($yssAccountReport->day)
                                    <td>{{ $yssAccountReport->day }}</td>
                                @endif
                                @if($yssAccountReport->dayOfWeek)
                                    <td>{{ $yssAccountReport->dayOfWeek }}</td>
                                @endif
                                @if($yssAccountReport->quarter)
                                    <td>{{ $yssAccountReport->quarter }}</td>
                                @endif
                                @if($yssAccountReport->month)
                                    <td>{{ $yssAccountReport->month }}</td>
                                @endif
                                @if($yssAccountReport->week)
                                    <td>{{ $yssAccountReport->week }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>Total - all networks</td>
                            </tr>
                            <tr>
                                <td class="paginator">
                                    {{ $yssAccountReports->links('pagination') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
        </section>
    </section>
    <!--main content end-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery-date-range.js"></script>
    <!-- Custom js-->
    <script src="js/common.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
</body>
<script>
    $(document).ready(function() { 
        $("#reportTable").tablesorter(); 
    }); 
</script>
</html>