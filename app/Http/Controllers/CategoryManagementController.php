<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Categories::select('*')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="categories/'.$row->id.'" class="edit btn btn-primary btn-sm">Update</a><button class="btn btn-danger btn-delete" data-remote="http://127.0.0.1:8000/categories/' . $row->id . '">Delete</button>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return View('categoriesmanagement.show-categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('categoriesmanagement.create-categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user();
      
        //
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255|unique:categories',
                'description'            => 'required|max:500',
                
               
            ],
            [
                'name.unique'         => trans('validation.categoryNameTaken'),
                'name.required'       => trans('validation.categoryNameRequired'),
                'description.required' => trans('validation.descriptionRequired'),
                
            ]
        );
     


        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $categories = Categories::create([
            'user_id'   =>Auth::user()->id,
            'name'             => strip_tags($request->input('name')),
            'description'       => strip_tags($request->input('description')),
           
           
        ]);
        
        $categories->save();
        Alert::success('Success', 'Category created successfully');

        return redirect()->route('categories');
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
          //
         $categories=Categories::where('id', $id)->first();
    
         return view('categoriesmanagement.edit-categories', compact('categories'));
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
            
                'name'            => 'alpha_dash',
                'description'             => 'alpha_dash',

            ],
            [
               
                'name.required' => trans('validation.categoryNameRequired'),
                'description.required'  => trans('validation.descriptionRequired'),
               
            ]
        );
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

           
            $name = strip_tags($request->input('name'));
            $description = strip_tags($request->input('description'));
            Categories::where('id',$id)->update(['name' => $name, 'description' => $description]);
            Alert::success('Success', 'categories updated successfully');
            return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id !=='' ) {
            
            $query=Categories::where('id',$id);
            $query->delete();
            DB::table('products')->where('category_id', $id)->delete();
          
            Alert::success('Success', 'Category deleted successfully');
            return redirect('categories');
           
        }

         Alert::error('Error', 'Category not deleted');
        return back()->with('error');
    }
}
