<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Requested extends Model
{
    use HasFactory;
    protected $table='request';
    protected $fillable=['depId','userId','taskId','completed'];
    public $timestamps=false;

    public function getdepRequest(){
        return $this->hasOne(Departments::class,'id','depId');
    }
    public function getUserRequest(){
        return $this->hasOne(User::class,'id','userId');
    }
    public function getTaskRequest(){
        return $this->hasOne(tasks::class,'id','taskId');
    }

    public static function assigntask(Request $request){
        foreach($request->user as $k){
            $task=new Requested();
            $task->depId=$request->department;
            $task->taskId=$request->task;
            $task->userId=$k;
            $task->completed=0;
            $task->save();
        }
        return back()->with('err','Record has been added successfully.');
    }

}
