<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\ChiTietBill;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $dms =Category::all();
        
     
      if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('index')->with('tenmang',$dms)->with('hover',$hover);
    }else{
        return view('index')->with('kiemtralogin','check')->with('tenmang',$dms);
    }

    }






    public function chitietdonhanguser(Request $request)
    {
        $ct=ChiTietBill::where('id_dh',$request->id)->get();
        $bill =Bill::find($request->id);
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('chitietdh')->with('hover',$hover)->with('bill',$bill)->with('ct',$ct);
    }





    public function donhanguser()
    {
        $bill = Bill::where('id_user',auth()->user()->id)->orderBy('created_at','desc')->paginate(4);
        if(auth()->check()){
            $hover=Cart::where('id_user',auth()->user()->id)->get();
            return view('donhanguser')->with('hover',$hover)->with('bill',$bill);
        }else{
            return view('donhanguser')->with('kiemtralogin','check')->with('bill',$bill);
        }

    }




    public function themvaogio(Request $request)
    {
        $pd = Product::find($request->idsp);

        $cart= Cart::where('id_sp',$request->idsp)->where('id_user',auth()->user()->id)->first();
        $product= Product::where('id',$request->idsp)->first();
        if($request->sluong > $product->soluong ){
         return redirect()->back()->with('over', 'Quá số lượng tồn kho');

        }
        else{
        if($cart){
             $total = $cart->soluong + $request->sluong;
             $cart->soluong=$total;
             $cart->save();
         }else{
            $cart= new Cart();
            $cart->id_user = auth()->id();
            $cart->id_sp = $request->idsp;
            $cart->hinhanh = $pd->hinhanh;
            $cart->tensanpham = $pd->tensanpham;
            $cart->gia = $pd->gia;
            $cart->soluong = $request->sluong;
            $cart->save();
            
         }
         return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
        }

    }





    public function chitietsp(Request $request)
    {
       
        $pd = Product::find($request->input('#SP'));
 
     
      if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('chitietsp')->with('hover',$hover)->with('sanpham',$pd);
    }else{
        return view('chitietsp')->with('kiemtralogin','check')->with('sanpham',$pd);
    }

    }





    public function indexfruit()
    {
       $a='Tất Cả Sản Phẩm';
       $dms =Category::all();
       $sps= Product::paginate(8);
    
      if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('fruit')->with('hover',$hover)->with('tenmang',$dms)->with('sp',$sps)->with('nhanbiet',$a);
    }else{
        return view('fruit')->with('kiemtralogin','check')->with('tenmang',$dms)->with('sp',$sps)->with('nhanbiet',$a);
    }

    }
    
    public function indexfruitDK(Request $request)
    {
      
         $danhmuc = $request->query('Category');
         $a=$danhmuc;
        $locdanhmuc = Product::where('danhmuc', '=', $danhmuc)->paginate(8);

       $dms =Category::all();
      if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('fruit')->with('tenmang',$dms)->with('sp',$locdanhmuc)->with('nhanbiet',$a)->with('hover',$hover);
    }else{
         
      return view('fruit')->with('tenmang',$dms)->with('sp',$locdanhmuc)->with('nhanbiet',$a)->with('kiemtralogin','check');
    }
      
     
    }
    public function search(Request $request)
    {
         $tukhoa = $request->tukhoa;
        $search = Product::where('tensanpham','like', '%'.$tukhoa.'%')->paginate(8);
        $a=$tukhoa;
       $dms =Category::all();
     
     if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('fruit')->with('tenmang',$dms)->with('sp',$search)->with('timkiem',$a)->with('hover',$hover);
    }else{
         
      return view('fruit')->with('tenmang',$dms)->with('sp',$search)->with('timkiem',$a)->with('kiemtralogin','check');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function DanhMucAdmin()
    {
       $dm=Category::paginate(8);
       return view('spica.pages.tables.danhmuc')->with('dm',$dm);
    }
  
     public function create()
    {
       
        return view('spica.pages.tables.themdanhmuc');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dm= new Category;
        $dm->tendanhmuc = $request->tendanhmuc;


        if ($request->hasFile('hinhanh')) {
        
            // Lưu ảnh mới
            $image = $request->file('hinhanh')->getClientOriginalName();
            $request->file('hinhanh')->move(public_path('images'), $image);
            $dm->hinhanh=$image;
        }


        $dm->save();


        return redirect()->route('createDanhMucAdmin')->with('success','Đã thêm danh mục!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dm=Category::find($id);
        return view('spica.pages.tables.editdanhmuc')->with('dm',$dm);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dm=Category::paginate();
        $cate=Category::find($id);
        $cate->tendanhmuc = $request->tendanhmuc;


        if ($request->hasFile('hinhanh')) {
        
            // Lưu ảnh mới
            $image = $request->file('hinhanh')->getClientOriginalName();
            $request->file('hinhanh')->move(public_path('images'), $image);
            $cate->hinhanh=$image;
        }


        $cate->save();


        return redirect()->route('editDanhMucAdmin',['id'=> $id] )->with('dm',$dm)->with('success','Đã cập nhật danh mục!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
  //
    }
    public function deletedm(string $id)
    {
        $dm = Category::paginate(8);
    
        Category::where('id',$id)->delete();
        return redirect()->route('DanhMucAdmin' )->with('dm',$dm)->with('success','Đã xóa danh mục !!');
    }
    public function huydonhang(Request $request)
    {
        $bill = Bill::find($request->id);
        $bill->trangthai = 'Hủy';
        $bill->save();
        return redirect()->route('donhanguser')->with('success','Hủy thành công');
    }
}
