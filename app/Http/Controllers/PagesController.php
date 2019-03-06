<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;

class PagesController extends Controller
{

    function __construct(){
        $theloai=TheLoai::all();
        $slide=Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
    function trangchu(){

 return view('pages.trangchu');
    }
    function lienhe(){
       
        return view('pages.lienhe');
    }
    function loaitin($id){
        $loaitin=LoaiTin::find($id);
        $tintuc=TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);

    }
}
