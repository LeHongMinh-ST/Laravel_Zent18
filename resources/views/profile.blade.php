@extends('master')

@section('title')
    Chi tiết
@endsection

@section('content')
    <p>Họ và tên: {{$name}}</p>
    <p>Năm sinh: {{$year}}</p>
    <p>Trường: {{$school}}</p>
    <p>Quê quán: {{$from}}</p>
    <p>Giới thiệu: {!! $detail !!}</p>
    <p>Mục tiêu: {{$target}}</p>
@endsection
