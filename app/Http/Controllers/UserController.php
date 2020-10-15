<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', User::class);
        return view('theme.backoffice.pages.user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('theme.backoffice.pages.user.create',[
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, User $user)
    {
        $user = $user -> store($request);
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('theme.backoffice.pages.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        if(isset($_GET['view'])){
            $view = $_GET['view'];
        }else{
            $view = null;
        }

        return view($user->edit_view($view),[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->my_update($request);
        if(isset($_GET['view'])){
            $view = $_GET['view'];
        }else{
            $view = null;
        }
        return redirect()->route($user->user_show(), $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        alert('Éxito', 'Usuario eliminado', 'success');
        return redirect()->route('backoffice.user.index');
    }

    /**
    *Mostrar formulario para asignar rol
    *
    */
    public function assign_role(User $user)
    {
        $this->authorize('assign_role', $user);
        return view('theme.backoffice.pages.user.assign_role', [
            'user'=>$user,
            'roles'=>Role::all(),
        ]);
    }

    /**
    *Asignar los roles en la base de datos
    *
    */
    public function role_assignment(Request $request, User $user)
    {
        $this->authorize('assign_role', $user);
        $user->role_assignment($request);
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
    *Mostrar el formulario para asignar los permisos
    *
    */
    public function assign_permission(User $user)
    {
        $this->authorize('assign_permission', $user);
        return view('theme.backoffice.pages.user.assign_permission', [
            'user' => $user,
            'roles' => $user->roles
        ]);
    }

    /**
    *Asignar los permisos en la tabla pivote de la base de datos
    *
    */
    public function permission_assignment(Request $request, User $user)
    {
        $this->authorize('assign_permission', $user);
        $user->permissions()->sync($request->permissions);
        alert('Éxito', 'Permisos asignados', 'success');
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
    *Mostrar el formulario para importar usuarios
    *
    */
    public function import(User $user)
    {
        $this->authorize('import', $user);
        return view('theme.backoffice.pages.user.import');
    }

    /**
    *Importar usuario desde una hoja de excel
    *
    */
    public function make_import(Request $request, User $user)
    {
        $this->authorize('import', $user);
        Excel::import(new UsersImport, $request->file('excel'));
        alert('Éxito', 'Usuaios importados', 'success');
        return redirect()->route('backoffice.user.index');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('theme.frontoffice.pages.user.profile', [
            'user' => $user,
        ]);
    }
}
