@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
                    <small>Add</small>
                </h1>

                @if (count($errors)>0)
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                    {{$err}}
                        
                    @endforeach
                  </div>
                @endif
                @if (session('thongbao'))
                <div>
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                </div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/loaitin/them" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên loại tin</label>
                        <input type="text" placeholder="Tên loại tin " name="Ten" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="TheLoai" class="form-control">
                                <option value="0">Please Choose Category</option>
                                @foreach ($theloai as $tl)
                                <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>    
@endsection