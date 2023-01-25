<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $permissions = Permission::all();

            return view('admin.permissions.index', [
                'permissions' => $permissions
            ]);
        }

        /**
         * Show form for creating permissions
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.permissions.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|unique:users,name'
            ]);

            Permission::create($request->only('name'));

            return redirect()->route('admin.permissions.index')
                ->withSuccess(__('Permission created successfully.'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  Permission  $post
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $permission = Permission::find($id);
            return view('admin.permissions.edit', [
                'permission' => $permission
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  Permission  $permission
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $permission = Permission::find($id);
            $request->validate([
                'name' => 'required|unique:permissions,name,'.$permission->id
            ]);

            $permission->update($request->only('name'));

            return redirect()->route('admin.permissions.index')
                ->withSuccess(__('Permission updated successfully.'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Post  $post
         * @return \Illuminate\Http\Response
         */
        public function destroy( $id)
        {

            Permission::find($id)->delete();

            return redirect()->route('admin.permissions.index')
                ->withSuccess(__('Permission deleted successfully.'));
        }
}
