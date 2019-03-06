@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>{{$tintuc->TieuDe}}</small>
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
            <div class="alert alert-danger">
                {{session('loi')}}
            </div>
        @endif
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            <option value="0">Chọn Thể Loại</option>
                            @foreach ($theloai as $tl)
                                <option
                                @if ($tl->id==$tintuc->loaitin->theloai->id)
                                    {{"selected"}}
                                @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                            <option value="0">Chọn Loại Tin</option>
                            @foreach ($loaitin as $lt)
                                <option
                                @if ($lt->id==$tintuc->loaitin->id)
                                    {{"selected"}}
                                @endif
                                
                                value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea class="form-control ckeditor" id="demo" name="TomTat" rows="3" > {{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="form-control ckeditor" name="NoiDung" id="demo" rows="5">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="300px"></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input 
                            @if ($tintuc->NoiBat==1)
                                {{"checked"}}
                            @endif
                            name="NoiBat" value="1" checked="" type="radio">Nổi bật
                        </label>
                        <label class="radio-inline">
                            <input
                            @if ($tintuc->NoiBat==0)
                                {{"checked"}}
                            @endif
                            name="NoiBat" value="0" type="radio">Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người đăng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                      
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>
                   @foreach ($tintuc->comment as $cm)
                   <tr class="odd gradeX" align="center">
                    <td>{{$cm->id}}</td>
                    
                    <td>{{$cm->user->name}}</td>
                    <td>{{$cm->NoiDung}}</td>
                    <td>{{$cm->created_at}}</td>
                    
                    
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                    
                </tr>
                   @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>    
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                 var idTheLoai=$(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection