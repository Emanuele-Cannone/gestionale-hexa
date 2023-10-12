<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UserRoleList extends Component
{

    use WithPagination;

    public $searchUser = '';

    public $perPage = 15;

    /**
     * @return void
     */
    public function loadMore(): void
    {
        $this->perPage += 5;
    }

    protected $listeners = ['role_user' => 'change'];

    public function render()
    {
        $users = User::paginate($this->perPage);

        $roles = Role::all();

        if(!empty($this->searchUser)){
            $users = User::where('name','LIKE','%'.$this->searchUser.'%')->paginate($this->perPage);
        }

        return view('livewire.user-role-list', [
            'users' => $users,
            'roles' => $roles
        ]);
    }


}
