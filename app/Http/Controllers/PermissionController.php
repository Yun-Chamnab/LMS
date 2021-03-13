<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use DB;



class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::get();
        return response()->json(['permission' => $permission]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);

        return response()->json(['data' => ['role' => $permission]]);
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        if(!$permission) {
            return response()->json(['message' => 'Permission not found.']);
        }

        return new PermissionResource($permission);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name
        ]);

        return new PermissionResource($permission);
    }

    public function delete($id)
    {
        DB::table("permissions")->where('id',$id)->delete();

        return response()->json(['message' => 'Permission Deleted.']);
    }
}
