<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;

class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc=TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem(){
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){
       $this->validate($request,[
        'LoaiTin'=>'required',
        'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
        'TomTat'=>'required',
        'NoiDung'=>'required'
       ],[
        'LoaiTin.required'=>'Bạn phải chọn loại tin',
        'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
        'TomTat.required'=>'Bạn chưa nhập tóm tắt',
        'NoiDung.required'=>'Bạn chưa nhập nội dung',
        'TieuDe.unique'=>'Đã tồn tại tiêu đề'

       ]);
       $tintuc=new TinTuc;
       $tintuc->TieuDe=$request->TieuDe;
       $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
       $tintuc->TomTat=$request->TomTat;
       $tintuc->NoiDung=$request->NoiDung;
       $tintuc->NoiBat=$request->NoiBat;
       $tintuc->idLoaiTin=$request->LoaiTin;
       $tintuc->SoLuotXem=0;
       if($request->hasFile('Hinh')){
        $file=$request->Hinh;
        $duoi=$file->getClientOriginalExtension();
        $type=array("jpg","png","jpeg");
        if(in_array($duoi,$type,TRUE)==FALSE){
            return redirect('admin/tintuc/them')->with('loi','File không đúng định dạng');
        }
       $name=$file->getClientOriginalName();
       $Hinh=str_random(4)."_".$name;
       while(file_exists("upload/tintuc/".$Hinh)){
        $Hinh=str_random(4)."_".$name;
       }
      $file->move("upload/tintuc/",$Hinh);
      $tintuc->Hinh=$Hinh;
       }else{
           $tintuc->Hinh="";
       }
       $tintuc->save();
       return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
        $tintuc=TinTuc::find($id);
        return view ('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id){
        $tintuc=TinTuc::find($id);
        $this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
           ],[
            'LoaiTin.required'=>'Bạn phải chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
            'TieuDe.unique'=>'Đã tồn tại tiêu đề'
    
           ]);
           
           $tintuc->TieuDe=$request->TieuDe;
           $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
           $tintuc->TomTat=$request->TomTat;
           $tintuc->NoiDung=$request->NoiDung;
           $tintuc->NoiBat=$request->NoiBat;
           $tintuc->idLoaiTin=$request->LoaiTin;
           $tintuc->SoLuotXem=0;
           if($request->hasFile('Hinh')){
            $file=$request->Hinh;
            $duoi=$file->getClientOriginalExtension();
            $type=array("jpg","png","jpeg");
            if(in_array($duoi,$type,TRUE)==FALSE){
                return redirect('admin/tintuc/them')->with('loi','File không đúng định dạng');
            }
           $name=$file->getClientOriginalName();
           $Hinh=str_random(4)."_".$name;
           while(file_exists("upload/tintuc/".$Hinh)){
            $Hinh=str_random(4)."_".$name;
           }
          $file->move("upload/tintuc/",$Hinh);
          unlink("upload/tintuc/".$tintuc->Hinh);

          $tintuc->Hinh=$Hinh;
           }
           $tintuc->save();
           return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');
        
    }
    public function getXoa($id){
        $tintuc=TinTuc::find($id);
       
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa Thành Công');
    }
}
