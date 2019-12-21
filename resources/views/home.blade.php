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

<!--Content-->
@section('title')
    Laravel Todo - Basic
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
                    <table class="table table-striped task-table">
                        <thead>
                        <th>Tên công việc</th>
                        <th>Trạng thái</th>
                        <th>Độ ưu tiên</th>
                        <th> </th>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    @if($task->status == 0)
                                        <div>{{ $task->name }}</div>
                                    @else
                                        <div><strike>{{ $task->name }}</strike></div>
                                    @endif
                                </td>

                                <td>
                                    @if($task->status == 0)
                                        <div>Chưa làm</div>
                                    @elseif($task->status == 1)
                                        <div>Đang làm</div>
                                    @elseif($task->status == -1)
                                        <div>Không làm</div>
                                    @elseif($task->status == 2)
                                        <div>Đã làm</div>
                                    @endif
                                </td>

                                <td>
                                    @if($task->priority == 0)
                                        <div>Bình thường</div>
                                    @elseif($task->priority == 1)
                                        <div>Quan trọng</div>
                                    @elseif($task->priority == 2)
                                        <div>Khẩn cấp</div>
                                    @endif
                                </td>

                                <!-- Task Complete Button -->
                                <td>
                                    @if($task->status == 0 || $task->status == 1)
                                        <a href="{{ route('task.complete',$task->id) }}" type="submit" class="btn btn-success">
                                            <i class="fa fa-btn fa-check"></i>Hoàn thành
                                        </a>
                                    @elseif($task->status == 2)
                                        <a href="{{ route('task.reComplete',$task->id) }}" type="submit" class="btn btn-success">
                                            <i class="fa fa-btn fa-redo"></i>Làm lại
                                        </a>
                                    @endif
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    <form action="{{ route('task.show',$task->id) }}" method="GET">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-btn fa-info-circle"></i>Chi tiết
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ route('task.edit',$task->id) }}" method="GET">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-edit"></i>Chỉnh sửa
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


