<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $selectedRole = '';
    public $userId;
    public $isOpen = false;

    protected $queryString = ['search'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->with('roles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.users.index', [
            'users' => $users,
            'roles' => Role::all(),
        ])->layout('layouts.admin', ['title' => __('all.Users')]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'selectedRole' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($this->selectedRole);

        session()->flash('message', __('all.User created successfully.'));
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->first()?->name ?? '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->isOpen = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'selectedRole' => 'required|exists:roles,name',
        ];

        // Only validate password if it's being changed
        if ($this->password) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $this->validate($rules);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();
        $user->syncRoles([$this->selectedRole]);

        session()->flash('message', __('all.User updated successfully.'));
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        // Prevent deleting the current user
        if ($id == auth()->id()) {
            session()->flash('error', __('all.You cannot delete your own account.'));
            return;
        }

        $user = User::findOrFail($id);
        
        // Prevent deleting Super Admin users
        if ($user->hasRole('Super Admin')) {
            session()->flash('error', __('all.Cannot delete Super Admin users.'));
            return;
        }

        $user->delete();
        session()->flash('message', __('all.User deleted successfully.'));
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = '';
        $this->userId = null;
    }
}
