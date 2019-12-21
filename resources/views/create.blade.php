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
    create
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thêm công việc mới
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->

                    <!-- New Task Form -->
                    <form action="{{ route('task.store') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Tên công việc</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control"
                                       value="{{ old('task') }}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Mô tả công việc</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" name="content" id="task-content" cols="45" rows="10"
                                          style="resize: vertical "></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Deadline</label>

                            <div class="col-sm-6">
                                <input type="datetime" name="deadline" id="task-deadline" class="form-control"
                                       value="{{ old('task') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="task-status" class="col-sm-3 control-label">Trạng thái</label>

                            <div class="col-sm-6">
                                <select name="status" id="" class="form-control">
                                    <option value="0" >Chưa làm</option>
                                    <option value="1">Đang làm</option>
                                    <option value="-1" >Không làm</option>
                                    <option value="2">Đã làm xong</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <label for="task-name" class="col-sm-3 control-label">Độ ưu tiên</label>

                            <div class="col-sm-6">
                                <select name="priority" id="" class="form-control">
                                    <option value="0" >Bình thường</option>
                                    <option value="1">Quan trọng</option>
                                    <option value="2" >Khẩn cấp</option>
                                </select>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Thêm công việc
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
