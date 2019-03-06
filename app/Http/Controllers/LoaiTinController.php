<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{

public function getDanhSach(){
    $loaitin=LoaiTin::all();
    return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
}
public function getXoa($id){
    $loaitin=LoaiTin::find($id);
    $loaitin->delete();
    return redirect('admin/loaitin/danhsach')->with('thongbao','Đã xóa thành công');
}
public function getThem(){
    $theloai=TheLoai::all();
    return view('admin.loaitin.them',['theloai'=>$theloai]);
}
public function postThem(Request $request){
    $this->validate($request,
        [
            'Ten'=>'required|min:3|max:30|unique:LoaiTin,Ten',
            'TheLoai'=>'required|not_in:0'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập loại tin',
            'Ten.min'=>'Tên phải lớn hơn 3 kí tự',
            'Ten.max'=>'Tên không được quá 30 kí tự',
            'Ten.unique'=>'Đã tồn tại loại tin',
            'TheLoai.required'=>' Bạn cần chọn thể loại',
            'TheLoai.not_in'=>'Hãy chọn một thể loại'
        ]
        );
        $loaitin=new LoaiTin;
        $loaitin->idTheLoai=$request->TheLoai;
        $loaitin->Ten=$request->Ten;
        $loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Đã thêm thành công');
}
public function getSua($id){
    $loaitin=LoaiTin::find($id);
    $theloai=TheLoai::all();

    return view('admin/loaitin/sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
}
public function postSua(Request $request,$id){
    
    $loaitin=LoaiTin::find($id);
    $this->validate($request,
    [
        'Ten'=>'required|min:3|max:30'
    ],
    [
        'Ten.required'=>'Bạn chưa nhập loại tin',
        'Ten.min'=>'Tên phải lớn hơn 3 kí tự',
        'Ten.max'=>'Tên không được quá 30 kí tự',
       
    ]
    );
    $loaitin->Ten=$request->Ten;
    $loaitin->TenKhongDau=changeTitle($request->Ten);
    $loaitin->idTheLoai=$request->TheLoai;
    $loaitin->save();
    return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Chỉnh sửa thành công');


}


}
