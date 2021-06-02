<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use DB;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('id','!=',1)->latest();
           
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('user') ){
                                $style='display:block;';
                        }else{
                                $style='display:none;';
                        }
                            
                           $btn = '<a href="users/'.$row->id.'" class="edit btn btn-primary btn-sm" style="'. $style.'">Update</a><button class="btn btn-danger btn-delete" data-remote="http://127.0.0.1:8000/users/' . $row->id . '" style="'. $style.'">Delete</button>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

           
            
        }
        
        return View('usersmanagement.show-users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        
         $roles=Role::where('id', '!=', 1)->get();
    
        return view('usersmanagement.create-user', compact('roles'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
            
                'first_name'            => 'alpha_dash',
                'last_name'             => 'alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
               
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name'       => strip_tags($request->input('first_name')),
            'last_name'        => strip_tags($request->input('last_name')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
           
        ]);
        $user->attachRole($request->input('role'));
        $user->save();
        
       $details = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        \Mail::to($request->input('email'))->send(new \App\Mail\SendMailUser($details));
       
        Alert::success('Success', 'User created successfully');

        return redirect()->route('users');
        //
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
         $roles=Role::where('id', '!=', 1)->get();
         $currentRole=DB::table('role_user')->where('user_id', $id)->first();
         

        $user=User::select('*')->where('id',$id)->first();
         return view('usersmanagement.update-user', compact('user','roles','currentRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
            
                'first_name'            => 'alpha_dash',
                'last_name'             => 'alpha_dash',

            ],
            [
               
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
               
            ]
        );
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

           
            $user->first_name = strip_tags($request->input('first_name'));
            $user->last_name = strip_tags($request->input('last_name'));
            $userRole = $request->input('role');
            if ($userRole !== null) {
                $user->detachAllRoles();
                $user->attachRole($userRole);
            }
            $user->save();
            Alert::success('Success', 'User updated successfully');
            return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        
        if ($user->id !== $currentUser->id) {
          
            $user->save();
            $user->delete();

             Alert::success('Success', 'User deleted successfully');
            return redirect('users');
        }
        Alert::error('Error', 'User not deleted');
        return back()->with('error');
    }

    

}
