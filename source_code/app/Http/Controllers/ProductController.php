<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product = Product::paginate(10);
        $dm = Category::all();
    
        return view('spica.pages.tables.basic-table')->with('product',$product)->with('dm',$dm);
    }

    public function searchdsspdm(Request $request)
    {
        $tukhoa = Product::where('danhmuc','like','%'.$request->danhmuc.'%')->get();
    
        $dm = Category::all();
        return view('spica.pages.tables.basic-table')->with('tukhoa',$tukhoa)->with('dm',$dm)->with('textdm',$request->danhmuc);

    }

    public function searchdssp(Request $request)
    {
        $dm = Category::all();

        $tukhoa = Product::where('tensanpham','like','%'.$request->tukhoa.'%')->orWhere('id','like','%'.$request->tukhoa.'%')->get();
    
    
        return view('spica.pages.tables.basic-table')->with('tukhoa',$tukhoa)->with('tukhoatext',$request->tukhoa)->with('dm',$dm);
    }
    
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
        $cate=Category::all();
        return view('spica.pages.tables.themsanpham')->with('dm',$cate);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cate=Category::all();
        $product= new Product;
        $product->tensanpham = $request->tensanpham;
        $product->danhmuc = $request->danhmuc;
        $product->gia = $request->gia;
        $product->mota = $request->mota;
        $product->soluong = $request->soluong;

        if ($request->hasFile('hinhanh')) {
        
            // Lưu ảnh mới
            $image = $request->file('hinhanh')->getClientOriginalName();
            $request->file('hinhanh')->move(public_path('images'), $image);
            $product->hinhanh=$image;
        }


        $product->save();


        return redirect()->route('Product.create')->with('dm',$cate)->with('success','Đã thêm sản phẩm!');
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
        $product=Product::find($id);
        $cate=Category::all();
        return view('spica.pages.tables.chinhsua')->with('pd',$product)->with('dm',$cate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cate=Category::all();
        $product=Product::find($id);
        $product->tensanpham = $request->tensanpham;
        $product->danhmuc = $request->danhmuc;
        $product->gia = $request->gia;
        $product->mota = $request->mota;
        $product->soluong = $request->soluong;

        if ($request->hasFile('hinhanh')) {
        
            // Lưu ảnh mới
            $image = $request->file('hinhanh')->getClientOriginalName();
            $request->file('hinhanh')->move(public_path('images'), $image);
            $product->hinhanh=$image;
        }


        $product->save();


        return redirect()->route('Product.edit',['Product'=> $id] )->with('pd',$product)->with('dm',$cate)->with('success','Đã cập nhật sản phẩm!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::paginate(10);
    
        Product::where('id',$id)->delete();
        return redirect()->route('Product.index' )->with('product',$product)->with('success','Đã xóa mặt hàng!!');
    }
}
