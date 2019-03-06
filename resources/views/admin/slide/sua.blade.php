@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Thêm</small>
                
                </h1>
                @if (count($errors)>0)
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                       {{$err}}<br>
                    @endforeach
                  </div>
                @endif
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                @if (session('loi'))
                    <div class="alert alert-success">
                        {{session('loi')}}
                    </div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên Slide</label>
                        <input type="text" class="form-control" placeholder="Tên slide" name="Ten" value="{{$slide->Ten}}">
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                       <textarea name="NoiDung" id="demo" rows="3" class="form-control ckeditor">{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" value="{{$slide->link}}"  />
                    </div>
                    <div class="form-group">
                        <p><img src="upload/slide/{{$slide->Hinh}}" width="200px"></p>
                        <input type="file" name="Hinh">
                    </div>
                    <button type="submit" class="btn btn-default">Tạo Slide</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>    
@endsection