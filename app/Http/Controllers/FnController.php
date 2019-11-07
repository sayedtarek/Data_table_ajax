<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FnController extends Controller
{
     public function index()
    {  
        return view('users.index',compact('users'));
    }


     public function details(Request $request)
    {
    	
        $columns = array( 
                            0 =>'user_id', 
                            1 =>'username',
                            2=> 'first_name',
                            3=> 'last_name',
                            4=> 'gender',
                            5=> 'status'
                            
                        );
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $users = User::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $users =  User::where('user_id','LIKE',"%{$search}%")
                            ->orWhere('username', 'LIKE',"%{$search}%")
                            ->orWhere('first_name', 'LIKE',"%{$search}%")
                            ->orWhere('last_name', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhere('gender', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('user_id','LIKE',"%{$search}%")
                            ->orWhere('username', 'LIKE',"%{$search}%")
                            ->orWhere('first_name', 'LIKE',"%{$search}%")
                            ->orWhere('last_name', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhere('gender', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $nestedData['user_id'] 		= $user->user_id;
                $nestedData['username'] 	= $user->username;
                $nestedData['first_name'] 	= $user->first_name;
                $nestedData['last_name']	= $user->last_name;
                $nestedData['status'] 		= $user->status;
                $nestedData['gender']	    = $user->gender;

                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
	                    "draw"            => intval($request->input('draw')),  
	                    "recordsTotal"    => intval($totalData),  
	                    "recordsFiltered" => intval($totalFiltered), 
	                    "data"            => $data   
                    );

        echo json_encode($json_data); 


    }

}
