<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\SidebarMenuSingle;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function edit(){
        $nameController = SidebarMenuSingle::get()->groupBy('name');

        return view('permissions.create-edit', compact('nameController'));
    }
}
