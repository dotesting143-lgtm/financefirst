<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $name, $email, $username, $password, $confirmPassword, $role, $userId;
    public $roles = [
        1 => 'Administrator',
        2 => 'Broker',
        3 => 'Broker Plus',
        4 => 'Management',
    ];
    public $isEditing = false;
    public $isOpen = 0;

    // NEW PROPERTIES
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $perPage = 20;
    public $viewAll = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'username' => 'required|unique:users,username',
        'password' => 'required|min:8',
        'confirmPassword' => 'required|min:8|same:password',
        'role' => 'required|in:1,2,3,4',
    ];

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $paginationTheme = 'tailwind';

    // SORTING METHOD
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function store()
    {
        $this->rules['username'] = $this->userId 
            ? 'required|unique:users,username,' . $this->userId 
            : 'required|unique:users,username';

        if ($this->userId) {
            unset($this->rules['password'], $this->rules['confirmPassword']);
        }

        $this->validate($this->rules);

        $fields = $this->getFields();

        User::updateOrCreate(['id' => $this->userId], $fields);

        session()->flash('message', 
            $this->userId ? 'User data updated successfully.' : 'User data created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    
    public function create()
    {
        $this->isEditing = false;
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $fields = $this->getFields();
        foreach($fields as $key => $val) {
            $this->$key = '';
        }
    }

    private function getFields() {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'role' => $this->role,
        ];

        if (!$this->userId || $this->password) {
            $data['password'] = Hash::make($this->password);
        }

        return $data;
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->role = $user->role;
        $this->password = '';
        $this->confirmPassword = '';

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        $query = User::orderBy($this->sortField, $this->sortDirection);

        $perPage = $this->viewAll ? User::count() : $this->perPage;

        return view('livewire.users', [
            'allusers' => $query->paginate($perPage),
        ]);
    }


    public function toggleViewAll()
    {
        $this->viewAll = !$this->viewAll;
        $this->resetPage(); // force back to page 1
    }


}
