<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository 
{
    private $user_model;
    
    public function userModel()
    {
        if(!isset($this->user_model)){
            $this->user_model = new User();
        }
        return $this->user_model;
    }

    public function create(array $attributes)
    {           
        $attributes['password']     = \Hash::make($attributes['password']);
        $user = $this->userModel()->create($attributes);
        return $user;
    }
    
    public function getAll(){
        return $this->userModel()->all();
    }
    
    public function getById($id){
        return $this->userModel()->find($id);
    }

    public function getByEmail($email){
        return $this->userModel()->where('email', $email)->first();
    }

    public function update(array $attributes, User $user)
    {   
        if(isset($attributes['password'])){
            $attributes['password'] = \Hash::make($attributes['password']);
        }
        return $user->update($attributes);
    }

    public function destroy(User $user){   
        return $user->delete();
    }

}
