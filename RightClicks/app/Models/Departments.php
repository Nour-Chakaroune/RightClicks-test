<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Departments extends Model
{
    use HasFactory;
    protected $table='departments';
    protected $fillable=['name'];
    public $timestamps=false;

    public static function addDepartment(Request $request)
    {
        $dep=new Departments();
        $dep->name=$request->input('depname');
        $dep->save();
        return back()->with('err','Department has been added');
    }
    public static function editDepartment(Request $request)
    {
        $d=Departments::find($request->id);
        $d->name = $request->edtdepname;
        $d->update();
        return back()->with('err','Record has been updated successfully.');
    }
    public static function deleteDepartment($id)
    {
        $u=User::with('getdepUser')->where('depID', $id)->count();
        if( $u == 0){
            $d=Departments::find($id);
            $d->delete();
            return back()->with('err','Department has been deleted successfully.');
        }
        else
            return back()->with('cannotdelete','Cannot delete this department');

      }


}

