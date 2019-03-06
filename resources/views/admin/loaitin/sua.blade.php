@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
                    <small>Edit</small>
                </h1>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{$err}}
                        @endforeach
                    </div>
                @endif
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Loại tin</label>
                        <input type="text" class="form-control" value="{{$loaitin->Ten}}" name="Ten">
                    </div>
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select name="TheLoai" class="form-control">
                               
                                @foreach ($theloai as $tl)
                                <option @if (($tl->Ten)==($loaitin->theloai->Ten))selected @endif  value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default">Category Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection