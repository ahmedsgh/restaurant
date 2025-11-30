<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{
    public $isOpen = false;
    public $roleId;
    public $name;
    public $selectedPermissions = [];
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'selectedPermissions' => 'array',
    ];

    public function render()
    {
        return view('livewire.admin.roles.index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::all()->groupBy(function ($permission) {
                return explode('_', $permission->name)[1] ?? 'other';
            }),
        ])->layout('layouts.admin', ['title' => __('all.Roles')]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        
        // Prevent editing Super Admin
        if ($role->name === 'Super Admin') {
            session()->flash('error', __('all.Cannot edit Super Admin role'));
            return;
        }
        
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'selectedPermissions' => 'array',
        ]);

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('message', __('all.Role created successfully'));
        $this->closeModal();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
            'selectedPermissions' => 'array',
        ]);

        $role = Role::findOrFail($this->roleId);
        
        // Prevent editing Super Admin
        if ($role->name === 'Super Admin') {
            session()->flash('error', __('all.Cannot edit Super Admin role'));
            return;
        }
        
        $role->update(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('message', __('all.Role updated successfully'));
        $this->closeModal();
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        
        // Prevent deleting Super Admin
        if ($role->name === 'Super Admin') {
            session()->flash('error', __('all.Cannot delete Super Admin role'));
            return;
        }
        
        // Check if role is assigned to any users
        if ($role->users()->count() > 0) {
            session()->flash('error', __('all.Cannot delete role that is assigned to users'));
            return;
        }
        
        $role->delete();
        session()->flash('message', __('all.Role deleted successfully'));
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->roleId = null;
        $this->name = '';
        $this->selectedPermissions = [];
        $this->resetValidation();
    }
    
    public function toggleAllPermissions($module)
    {
        $modulePermissions = Permission::all()
            ->filter(fn($p) => str_contains($p->name, '_' . $module))
            ->pluck('name')
            ->toArray();
        
        $allSelected = count(array_intersect($modulePermissions, $this->selectedPermissions)) === count($modulePermissions);
        
        if ($allSelected) {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $modulePermissions);
        } else {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $modulePermissions));
        }
    }
}
