<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class tasks extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['name','description'];
    public $timestamps=false;

    public static function addTask(Request $request){
        $tk=new tasks();
        $tk->name=$request->tkname;
        $tk->description=$request->tkdescp;
        $tk->save();
        return back()->with('err','Task has been added');
    }

    public static function editTask(Request $request){
        $t=tasks::find($request->id);
        $t->name=$request->edttkname;
        $t->description=$request->edttkdescp;
        $t->update();
        return back()->with('err','Record has been updated successfully.');
    }

    public static function deleteTask($id){
        $r=Requested::with('getTaskRequest')->where('taskId', $id)->count();
        if( $r == 0){
            $t=tasks::find($id);
            $t->delete();
            return back()->with('err','Task has been deleted successfully.');
        }
        else
            return back()->with('cannotdelete','Cannot delete this task');
    }
}
