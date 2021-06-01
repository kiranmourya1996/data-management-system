<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class ExportCSVController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        //return Excel::download(new BulkExport, 'list.csv');
         $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=company_location.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        //$reviews = Reviews::getReviewExport($this->hw->healthwatchID)->get();
      
        $user_all = User::where('id','!=',1)->get();
     
        $columns = array('FirstName', 'LastName', 'Email');

        $callback = function() use ($user_all, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($user_all as $users) {
                
                fputcsv($file, array($users->first_name,$users->last_name,$users->email));
            }
            fclose($file);
        };
       
        //return response()->download($callback, 200, $headers);
        // return Response::stream($callback, 200, $headers);
        $http_response = \Illuminate\Http\Response::HTTP_OK;
        $response_header = [
             'Content-Type' =>'text/csv'
            ,'Content-Disposition' =>'attachment;filename="User-list.csv"'
        ];
        return response()->stream($callback,$http_response,$response_header); 
    }

}
