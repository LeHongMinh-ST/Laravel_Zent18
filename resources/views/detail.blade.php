@extends('master')

<!--style-->
@section('css')
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 1px;
        }

        .task-table tbody tr td:nth-child(2) {
            width: 120px;
        }

        .task-table tbody tr td:nth-child(3) {
            width: 100px;
        }

        footer {
            margin-top: 300px;
        }
    </style>
@endsection

<!-- JavaScripts -->
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@endsection

@section('tilte')
    show
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tasks -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách công việc hiện tại
                </div>

                <div class="panel-body">
                    <p>Tên công việc: {{$task->name}}</p>
                    <p>Nội dung: {{$task->contents}}</p>
                    <p>Thời gian hoàn thành: {{$task->deadline}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
