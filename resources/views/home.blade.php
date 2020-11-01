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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}
<script>
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $('#btnAddTask').click(function (e){
           e.preventDefault();
          $('#modalAddTask').modal('show');
       });

       $('#btnStoreTask').click(function (e){
           e.preventDefault();

           let data = $('#frmAddTask').serialize();

           $.ajax({
               type:'post',
               url: '/task/store',
               data: data,
               success: function (res){
                    if(!res.error){
                        console.log(res.message)
                        toastr.success(res.message);
                        $('#modalAddTask').modal('hide');
                        location.reload();
                    }else {
                        console.log(res.message)
                        toastr.error(res.message);
                    }
               }
           })
       });

       $('.btn-edit').click(function (e){
           e.preventDefault();

           let id = $(this).attr('data-id');

           $.ajax({
               type:'get',
               url:'/task/'+id+'/edit',
               success: function (res){
                   if(!res.error){
                       $('#task-name-edit').val(res.task.name);
                       $('#status-edit').val(res.task.status);
                       $('#frmEditTask').attr('data-id',id);
                       $('#modalEditTask').modal('show');
                   }
               }
           })
       });

        $('#btnUpdateTask').click(function (e){
            e.preventDefault();

            let data = $('#frmEditTask').serialize();
            let id = $('#frmEditTask').attr('data-id');
            $.ajax({
                type:'put',
                url: '/task/update/'+id,
                data: data,
                success: function (res){
                    if(!res.error){
                        console.log(res.message)
                        toastr.success(res.message);
                        $('#modalEditTask').modal('hide');
                        location.reload();
                    }else {
                        console.log(res.message)
                        toastr.error(res.message);
                    }
                }
            })
        });

    });
</script>
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

                <div>
                    <a href="" class="btn btn-success" id="btnAddTask">Thêm mới</a>
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

                                        <button type="submit" class="btn btn-primary btn-edit" data-id="{{$task->id}}">
                                            <i class="fa fa-btn fa-edit"></i>Chỉnh sửa
                                        </button>

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

@section('modals')
    <div class="modal fade" id="modalAddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="frmAddTask">
                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Tên công việc</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control"
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



                        <!-- Add Task Button -->

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnStoreTask">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="frmEditTask">
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Tên công việc</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name-edit" class="form-control"
                                       value="{{ old('task') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="task-status" class="col-sm-3 control-label">Trạng thái</label>

                            <div class="col-sm-6">
                                <select name="status" id="status-edit" class="form-control">
                                    <option value="0" >Chưa làm</option>
                                    <option value="1">Đang làm</option>
                                    <option value="-1" >Không làm</option>
                                    <option value="2">Đã làm xong</option>
                                </select>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateTask">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection


