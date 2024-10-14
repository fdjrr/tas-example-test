<?php

namespace App\Livewire\User;

use App\Models\PerPage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    #[Url]
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Url]
    public $per_page = 25;

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public $listeners = [
        'confirmedDelete',
    ];

    public $id;

    public $mode = 'store';
    public $titleMode = 'Create User';

    public $name;
    public $email;

    public function delete($id)
    {
        $this->id = $id;

        $this->confirm('Are you sure?', [
            'text'        => 'Data User will be deleted!',
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function confirmedDelete()
    {
        $user = User::find($this->id);

        if ($user) {
            $user->delete();

            return $this->alert('success', 'Berhasil', [
                'text' => 'Data User deleted successfully!',
            ]);
        } else {
            return $this->alert('error', 'Gagal', [
                'text' => 'Data User not found!',
            ]);
        }
    }

    public function create()
    {
        $this->mode      = 'store';
        $this->titleMode = 'Create User';
        $this->reset([
            'name',
            'email',
        ]);

        $this->dispatch('openUserModal');
    }

    public function store()
    {
        $this->validate([
            'name'  => 'required|min:3',
            'email' => 'required|email|unique:users,email',
        ], attributes: [
            'name'  => 'Name',
            'email' => 'Email',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make('password'),
        ]);

        return $this->flash('success', 'Berhasil', [
            'text' => 'Data User created successfully!',
        ], route('users.index', [
                'search' => $user->name,
            ]));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->mode      = 'update';
            $this->titleMode = 'Edit User';

            $this->id    = $user->id;
            $this->name  = $user->name;
            $this->email = $user->email;

            $this->dispatch('openUserModal');
        } else {
            return $this->alert('error', 'Gagal', [
                'text' => 'Data User not found!',
            ]);
        }
    }

    public function update()
    {
        $this->validate([
            'name'  => 'required|min:3',
            'email' => "required|email|unique:users,email,{$this->id}",
        ], attributes: [
            'name'  => 'Name',
            'email' => 'Email',
        ]);

        $user = User::find($this->id);
        if ($user) {
            $user->update([
                'name'  => $this->name,
                'email' => $this->email,
            ]);

            return [
                $this->alert('success', 'Berhasil', [
                    'text' => 'Data User updated successfully!',
                ]),
                $this->dispatch('closeUserModal'),
            ];
        } else {
            return $this->alert('error', 'Gagal', [
                'text' => 'Data User not found!',
            ]);
        }
    }

    public function render()
    {
        $users = User::query()->filter([
            'search' => $this->search,
        ])->orderBy('name')->paginate($this->per_page)->withQueryString();

        return view('livewire.user.index', [
            'page_meta' => [
                'title' => 'Data Users',
            ],
            'users'     => $users,
            'per_pages' => PerPage::all(),
        ]);
    }
}
