@extends('layouts.master')

@section('title')
    Account Report
@stop

@section('export')
    <li><a href="{{ url('/campaign-report/export_csv') }}">CSV</a></li>
    <li><a href="{{ url('/campaign-report/export_excel') }}">Excel</a></li>
@stop