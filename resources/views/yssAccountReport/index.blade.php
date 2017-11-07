@extends('layouts.master')

@section('title')
    Account Report
@stop

@section('filter-list')
    <ul class="panel">
        <li class="panel-body">
            <a href="{{ route('campaign-report') }}">
                @lang('language.CAMPAIGNS')
            </a>
        </li>
        <li class="panel-body">
            <a href="{{ route('adgroup-report') }}">
                @lang('language.AD_GROUPS')
            </a>
        </li>
        <li class="panel-body">
            <a href="{{ route('keyword-report') }}">
                @lang('language.KEYWORDS')
            </a>
        </li>
        <li class="panel-body">
            <a href="{{ route('ad-report') }}">
                @lang('language.ADS')
            </a>
        </li>
        <li class="panel-body separator">
        </li>
        <li class="panel-body">
            <a href="javascript:void(0)">
                @lang('language.PREFECTURES')
            </a>
        </li>
        <li class="panel-body specific-filter-item" data-value="hourofday">
            <a href="javascript:void(0)">
                @lang('language.BY_TIME_ZONE')

        <li class="panel-body specific-filter-item" data-value="dayOfWeek">
            <a href="javascript:void(0)">
                @lang('language.BY_DAYS_OF_THE_WEEK')
            </a>
        </li>
        <li class="panel-body specific-filter-item" data-value="device">
            <a href="javascript:void(0)">
                @lang('language.DEVICES')
            </a>
        </li>
    </ul>
@stop

@section('export')
    <li><a href="{{ url('/account_report/export_csv') }}">@lang('language.CSV')</a></li>
    <li><a href="{{ url('/account_report/export_excel') }}">@lang('language.Excel')</a></li>
@stop

