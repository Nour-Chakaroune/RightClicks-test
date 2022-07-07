<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departments;
use App\Models\tasks;
use App\Models\Requested;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class Admin extends Controller
{
    public function registration(){
        $dep=Departments::all();
        return view('Admin.registration',compact('dep'));
    }
    public function addNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' =>'required',
            'phone' => 'required|unique:users,phone',
            'department'=>'required',
        ],
        [
            'name.required'=>'Please enter user name',
            'email.required'=>'Please enter user email',
            'password.required'=>'Please enter user password',
            'role.required'=>'Please select user role',
            'phone.required'=>'Please enter user phone',
            'department.required'=>'Please select user department',
          ]
    );
        $data = $request->all();
        $check = $this->create($data);
        return back()->with('err','User has been added successfully.');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' =>$data['role'],
        'phone' =>$data['phone'],
        'depId' =>$data['department'],
      ]);
    }

    public function listUsers(){
        $us=User::with('getdepUser')->get();
        $dep=Departments::all();
        return view('admin.lstUsers',compact('us','dep'));
    }
    public function editUser(Request $request){
        $request->validate([
            'edtUname' => 'required',
            'edtUemail' => 'required',
            'edtUrole' =>'required',
            'edtUphone' => 'required',
            'edtUdep' => 'required',
            'edtUpswd' => 'required',
        ]
    );
        $task= User::find($request->id);
        $task->name = $request->edtUname;
        $task->email = $request->edtUemail;
        $task->phone = $request->edtUphone;
        $task->role = $request->edtUrole;
        $task->depId = $request->edtUdep;
        if($task->password != $request->edtUpswd)
            $task->password=Hash::make($request->edtUpswd);
        $task->update();
        return back()->with('err','User has been updated successfully.');
    }
    public function deleteUser($id){
        $r=Requested::with('getUserRequest')->where('UserId', $id)->count();
        if( $r == 0 ){
            $u=User::find($id);
            $u->delete();
            return back()->with('err','User has been deleted successfully.');
        }
        else
            return back()->with('cannotdelete','Cannot delete this department');
      }


    // Departments
    public function listDepartment(){
        $dep=Departments::all();
        return view('admin.lstDepartments',compact('dep'));
    }

    public function addDepartment(Request $request){
        $request->validate([
            'depname'=>'required|unique:Departments,name',
          ],
        [
          'depname.required'=>'Please enter department name',
        ]);
        return Departments::addDepartment($request);
    }

    public function editDepartment(Request $request){
        $request->validate([
            'edtdepname'=>'required',
        ]);
        return Departments::editDepartment($request);
    }

    public function deleteDepartment($id){
        return Departments::deleteDepartment($id);
      }


    //Task
    public function listTask(){
        $tks=tasks::all();
        return view('admin.lstTasks',compact('tks'));
    }

    public function addTask(Request $request){
        $request->validate([
        'tkname'=>'required',
        'tkdescp' => 'required',
        ],
        [
            'tkname.required'=>'Please enter task name',
            'tkdescp.required' => 'Please enter description',

        ]);
        return tasks::addTask($request);
    }

    public function editTask(Request $request){
        $request->validate([
            'edttkname'=>'required',
            'edttkdescp' => 'required',
        ]);
        return tasks::editTask($request);
    }

    public function deleteTask($id){
        return tasks::deleteTask($id);
    }

    //Requested
    public function assignTask(){
        $tks=tasks::all();
        $dep=Departments::all();
    return view('admin.assignTask',compact('tks','dep'));
    }
    public function check(Request $request){
        $request->validate([
        'department'=>'required',
        'task' => 'required',
        ]);
        $u=User::where('depId',$request->department)->count();
        if($u>0){
        return redirect()->back()->withInput($request->input());
        }
        else return back()->withErrors(['department'=>'Not found user in this department']);
    }

    public function setAssignTask(Request $request){
        $request->validate([
            'department'=>'required',
            'task'=>'required',
            'user'=>'required|array',
        ],
        [
            'department.required' => 'Please specify department.',
            'task.required' => 'The task name is required.',
            'user.required' => 'Please specify Users.',
        ]);
        return Requested::assigntask($request);
    }

    public function pendingTask(){
        $task=Requested::with('getdepRequest')->with('getUserRequest')->with('getTaskRequest')->where('completed','0')->get();
        return view('Admin.pendingtask',compact('task'));
    }

    //AccountUser
    public function accountUser(){
        return view('Admin.accountUser');
    }
    public function editAccount(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ],
        [
            'name.required'=>'Please enter user name',
            'email.required'=>'Please enter user email',
            'password.required'=>'Please enter user password',
            'phone.required'=>'Please enter user phone',
        ]
    );
        $task= User::where('id',Auth::user()->id)->first();
        $task->name = $request->name;
        $task->email = $request->email;
        $task->phone = $request->phone;
        if($task->password != $request->password)
            $task->password=Hash::make($request->password);
        $task->update();
        return back()->with('err','User has been updated successfully.');
    }

    public function userTask(){
        $r=Requested::with('getTaskRequest')->where('userId',Auth::user()->id)->where('completed',0)->get();
        return view('Admin.userTask',compact('r'));
    }

    public function taskCompleted($id){
        $t=Requested::find($id);
        $t->completed = 1;
        $t->update();
        return back()->with('err',' Great job :) ');
    }


}
