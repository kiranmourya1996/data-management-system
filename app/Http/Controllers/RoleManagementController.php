<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Roles;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PermissionRole;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Roles::select('*')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="roles/'.$row->id.'" class="edit btn btn-primary btn-sm">Update</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return View('rolesmanagement.show-roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $permission=Permission::all();
         return view('rolesmanagement.create-roles',compact('permission'));
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
                'name'                  => 'required|alpha_dash|max:255|unique:roles',
                
                
               
            ],
            [
                'name.unique'         => trans('validation.NameTaken'),
                'name.required'       => trans('validation.NameRequired'),
               
                
            ]
        );
     


        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $roles = Roles::create([
            'name'             => strip_tags($request->input('name')),
            'slug'             => strip_tags($request->input('name')),
           
        ]);
      // $permission=$request->input('permission');
        $permisions=$request->input('permisions');
       // foreach($permisions as $value){
            
       //      $category_name[]=$value->category_name;
            
       //  }
       // $roles->attachRole($request->input('permission'));
       
        $roles->permission()->attach($permisions);
        $roles->save();
        Alert::success('Success', 'Roles created successfully');

        return redirect()->route('roles');
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
         $permission=Permission::all();
         $permissionrole=DB::table('permission_role')->where('role_id',$id)->pluck('permission_id')->all();
        
         $roles=Roles::where('id', $id)->first();
    
         return view('rolesmanagement.edit-roles', compact(['roles','permission','permissionrole']));
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
                

            ],
            [
               
                'name.required' => trans('validation.NameRequired'),
                
               
            ]
        );
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            $permisions=$request->input('permisions');
            $name = strip_tags($request->input('name'));
            
            $query=DB::table('permission_role')->where('role_id',$id)->delete();
          
            $roles= Roles::find($id);
            $roles->permission()->attach($permisions);
            Roles::where('id',$id)->update(['name' => $name]);
            Alert::success('Success', 'Role updated successfully');
            return redirect()->route('roles');
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
