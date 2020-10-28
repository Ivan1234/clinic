<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dob', 'email', 'password',
    ];

    protected $dates = ['dob'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //RELACIONES
    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }

    public function roles(){
        return $this->belongsToMany('App\Role')->withTimestamps();
    }
    //ALMACENAMIENTO

    public function store($request)
    {
        $user = self::create($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        $roles = [$request->role];
        $user -> role_assignment(null, $roles);
        alert('Éxito', 'Usuario creado con éxito', 'success');
        return $user; 
    }

    public function my_update($request)
    {
        self::update($request->all());
        alert('Éxito', 'Usuario actualizado', 'success');
    }

    public function role_assignment($request, array $roles = null)
    {
        if(is_null($roles)){
            $roles = $request->roles;
        }
        else{
            $roles = $roles;
        }

        $this->permission_mass_assignment($roles);
        $this->roles()->sync($roles);
        $this->verify_permission_integrity($roles);
        alert('Éxito', 'Roles asignados', 'success');
    }

    //VALIDACIÓN
    public function is_admin()
    {
        $admin=config('app.admin_role');
        if($this->has_role($admin)){
            return true;
        }
        else{
            return false;
        }
    }

    public function has_role($id)
    {
        foreach($this->roles as $role){
            if($role->id == $id || $role->slug == $id){
                return true;
            }
        }

        return false;
    }

    public function has_any_role(array $roles)
    {
        foreach($roles as $role){
            if($this->has_role($role)){
                return true;
            }
        }

        return false;
    }

    public function has_permission($id)
    {
        foreach($this->permissions as $permission){
            if($permission->id == $id || $permission->slug == $id){
                return true;
            }
        }

        return false;
    }

    //RECUPERACIÓN DE INFORMACIÓN
    public function age()
    {
        if(!is_null($this->dob)){
            $age = $this->dob->age;
            if($age == 1){
                $years = "año";
            }
            else{
                $years = "años";
            }

            $msj = $age.' '.$years;
        }
        else{
            $msj = "indefinido";
        }

        return $msj;
    }

    public function visible_users()
    {
        if($this->has_role(config('app.admin_role'))){
            $users = self::all();
        }

        if($this->has_role(config('app.secretary_role'))){
            $users =  self::whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.doctor_role'),
                    config('app.patient_role'),
                ]);
            })->get();
        }


        if($this->has_role(config('app.doctor_role'))){
             $users =  self::whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.patient_role'),
                ]);
            })->get();
        }

        return $users;
    }

    public function visible_roles(){
        if($this->has_role(config('app.admin_role'))){
            $roles = Role::all();
        }

        if($this->has_role(config('app.secretary_role'))){
            // $roles = Role::where('slug', config('app.patient_role'))->orWhere('slug', config('app.doctor_role'))->get();
            $roles = Role::where('slug', config('app.patient_role'))->get();
        }

        return $roles;
    }

    //OTRAS OPERACIONES
    public function verify_permission_integrity(array $roles)
    {
        $permissions = $this->permissions;
        foreach($permissions as $permission){
            if(!in_array($permission->role->id, $roles)){
                $this->permissions()->detach($permission->id);
            }
        }
    }

    public function permission_mass_assignment(array $roles)
    {
        foreach($roles as $role){
            if(!$this->has_role($role)){
                $role_obj=\App\Role::findOrFail($role);
                $permissions = $role_obj->permissions;
                $this->permissions()->syncWithoutDetaching($permissions);
            }
        }
    }

    public function edit_view($view = null)
    {
        $auth = auth()->user();

        if(!is_null($view) && $view=='frontoffice'){
            return 'theme.frontoffice.pages.user.edit';
        }else if($auth->has_any_role([config('app.admin_role'), config('app.secretary_role')])){
            return 'theme.backoffice.pages.user.edit';
        }else{
            return 'theme.frontoffice.pages.user.edit';
        }

    }

    public function user_show($view = null)
    {
        $auth = auth()->user();


        if(!is_null($view) && $view=='frontoffice'){
            return 'frontoffice.user.profile';
        }else if($auth->has_any_role([config('app.admin_role'), config('app.secretary_role')])){
            return 'backoffice.user.show';
        }else{
            return 'frontoffice.user.profile';
        }           
    }
}
