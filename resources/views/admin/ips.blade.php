@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6>
                        <i class="fa fa-internet-explorer fa-fw"></i>
                        IP
                        <a class="meta-item" href="{{ route('admin.ips',['blocked'=>1]) }}">Blocked</a>
                    </h6>
                </div>
                <div class="widget-body">
                    @if($ips->isEmpty())
                        <div style="text-align: center;"> 暂无IP信息</div>
                    @else
                        <table class="table table-hover table-striped table-bordered table-responsive"
                               style="overflow: auto">
                            <thead>
                            <tr>
                                <th>IP</th>
                                <th>Last User</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ips as $ip)
                                <tr>
                                    <td>{{ $ip->id }}</td>
                                    @if($ip->user)
                                        <td>
                                            {{--<a href="{{ route('user.show',$ip->user->name) }}">{{ $ip->user->name }}</a>--}}
                                            {{--@if(isAdminById($ip->user_id))--}}
                                                <span class="role-label">Admin</span>
                                            {{--@endif--}}
                                        </td>
                                    @else
                                        <td>NONE</td>
                                    @endif
                                    <td>
                                        @include('admin.partials.ip_button',['ip'=>$ip])
                                        <button class="btn btn-info swal-dialog-target"
                                                data-url="{{ route('ip.delete',$ip->id) }}"
                                                data-dialog-msg="确定删除IP{{ $ip->id }}?">
                                            <i class="fa fa-trash-o fa-fw"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{ $ips->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('assets/js/datatables/dataTables.bootstrap.css') }}">
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.min.js') }}"></script>
    <!-- Imported scripts on this page -->
    <script src="{{ asset('assets/js/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>

@endsection
