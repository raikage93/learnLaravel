<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
        $slide=Slide::all();
        return view('admin/slide/danhsach',['slide'=>$slide]);

    }
    public function getThem(){
        return view('admin/slide/them');
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required|unique:Slide,Ten',
            'NoiDung'=>'required',
            'link'=>'required',

        ],[
            'Ten.unique'=>'Đã tồn tại tên slide',
            'Ten.required'=>"Bạn phải nhập tên slide",
            'NoiDung.required'=>'Bạn cần nhập nội dung',
            'link.required'=>'Bạn cần nhập link'
        ]);

        $slide=new Slide;
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        $slide->link=$request->link;
        if($request->hasFile('Hinh')){
            $file=$request->Hinh;
            $duoi=$file->getClientOriginalExtension();
            $type=array("jpg","png","jpeg");
            if(in_array($duoi,$type,TRUE)==FALSE){
                return redirect('admin/slide/them')->with('loi','File không đúng định dạng');
            }
           $name=$file->getClientOriginalName();
           $Hinh=str_random(4)."_".$name;
           while(file_exists("upload/slide/".$Hinh)){
            $Hinh=str_random(4)."_".$name;
           }
          $file->move("upload/slide/",$Hinh);
          $slide->Hinh=$Hinh;
           }else{
               $slide->Hinh="";
           }
           $slide->save();
           return redirect('admin/slide/them')->with('thongbao','Thêm thành công slide');
    }
    public function getSua($id){
        $slide=Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
        $slide=Slide::find($id);
        $this->validate($request,[
            'Ten'=>'required|unique:Slide,Ten',
            'NoiDung'=>'required',
            'link'=>'required',

        ],[
            'Ten.unique'=>'Đã tồn tại tên slide',
            'Ten.required'=>"Bạn phải nhập tên slide",
            'NoiDung.required'=>'Bạn cần nhập nội dung',
            'link.required'=>'Bạn cần nhập link'
        ]);

       
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        $slide->link=$request->link;
        if($request->hasFile('Hinh')){
            $file=$request->Hinh;
            $duoi=$file->getClientOriginalExtension();
            $type=array("jpg","png","jpeg");
            if(in_array($duoi,$type,TRUE)==FALSE){
                return redirect('admin/slide/them')->with('loi','File không đúng định dạng');
            }
           $name=$file->getClientOriginalName();
           $Hinh=str_random(4)."_".$name;
           while(file_exists("upload/slide/".$Hinh)){
            $Hinh=str_random(4)."_".$name;
           }
          $file->move("upload/slide/",$Hinh);
          unlink("upload/slide/".$slide->Hinh);
          $slide->Hinh=$Hinh;
           }
           $slide->save();
           return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');

    }
    public function getXoa($id){
        $slide=Slide::find($id);
        unlink("upload/slide/".$slide->Hinh);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Đã xóa thành công slide');

    }
}
