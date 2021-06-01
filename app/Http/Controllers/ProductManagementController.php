<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use Yajra\DataTables\DataTables;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
          if ($request->ajax()) {
            $data = Products::select('*')->latest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
     
                           $image = '<img src="'.$row->image.'" class="categories-img-block img-fluid" alt="Category-img">';
    
                            return $image;
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="products/'.$row->id.'" class="edit btn btn-primary btn-sm">Update</a><button class="btn btn-danger btn-delete" data-remote="http://127.0.0.1:8000/products/' . $row->id . '">Delete</button>';
    
                            return $btn;
                    })
                    ->rawColumns(['action','image'])
                   ->make(true);
        }
        
        return View('productsmanagment.show-products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          $categories=Categories::all();

         return view('productsmanagment.create-products', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'category_id'                => 'required',
                'name'                  => 'required',
                'description'            => 'required',
                'price'                    => 'required|numeric',
                'image'                  =>  'required|mimes:jpg,jpeg,png|max:2048',
               
            ],
            [
                
                'category_id.required'       =>  trans('validation.category'),
                'name.required'       =>  trans('validation.productNameTaken'),
                'description.required' =>  trans('validation.descriptionRequired'),
                'price.required'                =>  trans('validation.priceRequired'),
                'image.required'                =>  trans('validation.image'),
                
                
                //'article_type.required'       => trans('auth.article_typeRequired'),
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $currentUser = \Auth::user();
        
        $data['user_id']=$currentUser->id;
        
        
        if($request->File('image')) {
            $last_row = Products::latest()->first();
            if(!empty($last_row)){
                $id=$last_row->id+1;
            }else{
                $id=1;
            }
           $avatar = $request->file('image');
            $filename = 'products.'.$avatar->getClientOriginalExtension();
            //$save_path = base_path('resources/assets/images').'/messages/'.$id.'/messages/';
            $save_path = public_path('images').'/products/'.$id.'/products/';
            $path = $save_path.$filename;
            $public_path = '/images/products/'.$id.'/products/'.$filename;   
         /*    $avatar = $request->file('image');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/users/id/'.$id.'/uploads/images/avatar/';
            $path = $save_path.$filename;
            $public_path = '/images/profile/'.$id.'/avatar/'.$filename;   */
            File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
            $image = $public_path;
        }

         $products = Products::create(['name'=>$request->name,'description'=>$request->description,'image'=> $image,'price'=>$request->price,'category_id'=> $request->category_id,'user_id'=> $currentUser->id]);
        
        $products->save();
        
        Alert::success('Success', 'Product created successfully');
        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $products=Products::where('id', $id)->first();
         $categories=Categories::all();
    
         return view('productsmanagment.edit-products', compact('categories','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'category_id'                => 'required',
                'name'                  => 'required',
                'description'            => 'required',
                'price'                    => 'required',
               
               
            ],
            [
                
                'category_id.required'       =>  trans('validation.category'),
                'name.required'       =>  trans('validation.productNameTaken'),
                'description.required' =>  trans('validation.descriptionRequired'),
                'price.required'                =>  trans('validation.priceRequired'),
                
                
                //'article_type.required'       => trans('auth.article_typeRequired'),
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

           
        $name = strip_tags($request->input('name'));
        $description = strip_tags($request->input('description'));
        $price = strip_tags($request->input('price'));
        $category_id=$request->input('category_id');

        if($request->File('image')) {
           
           $avatar = $request->file('image');
            $filename = 'products.'.$avatar->getClientOriginalExtension();
            //$save_path = base_path('resources/assets/images').'/messages/'.$id.'/messages/';
            $save_path = public_path('images').'/products/'.$id.'/products/';
            $path = $save_path.$filename;
            $public_path = '/images/products/'.$id.'/products/'.$filename;   
         /*    $avatar = $request->file('image');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/users/id/'.$id.'/uploads/images/avatar/';
            $path = $save_path.$filename;
            $public_path = '/images/profile/'.$id.'/avatar/'.$filename;   */
            File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
            $image = $public_path;
            $products = Products::where('id',$id)->update(['name'=>$name,'description'=>$description,'image'=> $image,'price'=>$price,'category_id'=> $category_id]);
        }else{
            $products = Products::where('id',$id)->update(['name'=>$name,'description'=>$description,'price'=>$price,'category_id'=>  $category_id]);
        }
        Alert::success('Success', 'Products updated successfully');
        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if ($id !=='' ) {
            
            $query=Products::where('id',$id);
            $query->delete();
           
            Alert::success('Success', 'Product deleted successfully');
            return redirect('products');
           
        }

         Alert::error('Error', 'Product not deleted');
        return back()->with('error');
    }
}
