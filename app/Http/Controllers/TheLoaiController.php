<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{   
    public function getXoa($id){
        $theloai=TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa thành công');
    }


    public function getDanhSach(){
        $theloai= TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getSua($id){
        $theloai=TheLoai::find($id);


        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai=TheLoai::find($id);
        $this->validate($request,
      [
        'Ten'=>'required|min:3|max:30|unique:TheLoai,Ten'
      ],
      [
        'Ten.required'=>'Bạn cần nhập thể loại',
        'Ten.unique'=>'Đã tồn tại thể loại',
        'Ten.min'=>'Bạn cần nhập lớn hơn 3 kí tự',
        'Ten.max'=>'Bạn cần nhập bé hơn 30 kí tự'
      ]  
        
    );
   
    $theloai->Ten=$request->Ten;
    $theloai->TenKhongDau=changeTitle($request->Ten);
    $theloai->save();
    return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function postThem(Request $request){
        $this->validate($request,
        [
            'Ten'=>'required|min:3|max:30|unique:TheLoai,Ten'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập thể loại',
            'Ten.min'=>'Tên phải lớn hơn 3 kí tự',
            'Ten.max'=>'Tên không được quá 30 kí tự',
            'Ten.unique'=>'Đã tồn tại thể loại'
        ]
        );
        $theloai=new TheLoai;
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau=changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
        
    }
}
