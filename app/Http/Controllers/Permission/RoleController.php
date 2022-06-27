<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\PivotUserRoleMenu;
use App\Models\RouteLimiter;
use App\Models\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function edit(UserRole $role){
        // Menampilkan Halaman Edit Role User Permission
        $routeLimiter = RouteLimiter::select('id', 'limiter', 'name')->whereNotNull('limiter')->get()->groupBy(['name']);
        $allowController = $routeLimiter->map(function($query, $keyQuery){
            // Mengelompokkan id berdasarkan limiter
            $limiter = $query->pluck('limiter')->unique();
            $limiterValue = [];
            foreach($limiter as $each){
                $limiterValue[$each] = $query->map(function($query) use ($each){
                    if($query->limiter == $each)
                    {
                        return $query->id;
                    }
                });
                // Menghilangkan Null
                $limiterValue[$each] = $limiterValue[$each]->reject(null);
            }
            return $limiterValue;
        });
        return view('permissions.roles.create-edit', compact('allowController', 'role'));
    }

    public function update(Request $request, RouteLimiter $role)
    {
        // dd($request->all());
        $this->validate($request,[
            'role' => 'required'
        ]);

        PivotUserRoleMenu::whereUserRoleId($role->id)->update([
            'is_active' => false
        ]);

        array_map(function($query) use ($role){
            array_walk($query, function($valueQuery, $keyQuery) use ($role){
                $nilai = explode(',', $valueQuery);
                foreach($nilai as $value){
                    PivotUserRoleMenu::updateOrCreate([
                        'user_role_id' => $role->id,
                        'route_limiter_id' => $value,
                    ], [
                        'is_menu' => $keyQuery == 'read' ? true : false,
                        'is_active' => true
                    ]);
                }
            });
        }, $request->role);

        return back()->with('status', 'Success update user role');
    }
}
