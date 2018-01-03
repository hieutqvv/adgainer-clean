<div class="col-md-3 fields active" data-name="impressions">
    <a href="javascript:void(0)">
        <section class="panel">
            <div class="panel-body">
                <span class="title">@lang('language.Impr')<br></span>
                <span class="content">
                    <i class="small-blue-stuff fa fa-circle"></i>
                    @if (ctype_digit($summaryReport['impressions']) || $summaryReport['impressions'] === null)
                        <td>{{ number_format($summaryReport['impressions'], 0, '', ',') }}</td>
                    @elseif (is_float($summaryReport['impressions']))
                        <td>{{ number_format($summaryReport['impressions'], 2, '.', ',') }}</td>
                    @endif
                    <br>
                </span>
            </div>
        </section>
    </a>
</div>
<div class="col-md-3 fields" data-name="clicks">
    <a href="javascript:void(0)">
        <section class="panel">
            <div class="panel-body">
                <span class="title">@lang('language.clicks')<br></span>
                <span class="content">
                    <i class="small-blue-stuff"></i>
                    @if (ctype_digit($summaryReport['clicks']) || $summaryReport['clicks'] === null)
                        <td>{{ number_format($summaryReport['clicks'], 0, '', ',') }}</td>
                    @elseif (is_float($summaryReport['clicks']))
                        <td>{{ number_format($summaryReport['clicks'], 2, '.', ',') }}</td>
                    @endif
                    <br>
                </span>
            </div>
        </section>
    </a>
</div>
<div class="col-md-3 fields" data-name="cost">
    <a href="javascript:void(0)">
        <section class="panel">
            <div class="panel-body">
                <span class="title">@lang('language.cost')<br></span>
                <span class="content">
                    <i class="small-blue-stuff"></i>
                    <i class="fa fa-rmb"></i>
                    <td>{{ number_format($summaryReport['cost'], 0, '', ',') }}</td>
                    <br>
                </span>
            </div>
        </section>
    </a>
</div>
<div class="col-md-3 fields" data-name="averageCpc">
    <a href="javascript:void(0)">
        <section class="panel">
            <div class="panel-body">
                <span class="title">@lang('language.AvgCPC')<br></span>
                <span class="content">
                    <i class="small-blue-stuff"></i>
                    <i class="fa fa-rmb"></i>
                    @if (ctype_digit($summaryReport['averageCpc']))
                        <td>{{ number_format($summaryReport['averageCpc'], 0, '', ',') }}</td>
                    @elseif (is_float($summaryReport['averageCpc']) || $summaryReport['averageCpc'] === null)
                        <td>{{ number_format($summaryReport['averageCpc'], 2, '.', ',') }}</td>
                    @endif
                    <br>
                </span>
            </div>
        </section>
    </a>
</div>
<div class="col-md-3 fields" data-name="averagePosition">
    <a href="javascript:void(0)">
        <section class="panel">
            <div class="panel-body">
                <span class="title">@lang('language.Avg_pos')<br></span>
                <span class="content">
                    <i class="small-blue-stuff"></i>
                    @if (ctype_digit($summaryReport['averagePosition']))
                        <td>{{ number_format($summaryReport['averagePosition'], 0, '', ',') }}</td>
                    @elseif (is_float($summaryReport['averagePosition']) || $summaryReport['averagePosition'] === null)
                        <td>{{ number_format($summaryReport['averagePosition'], 2, '.', ',') }}</td>
                    @endif
                    <br>
                </span>
            </div>
        </section>
    </a>
</div>
