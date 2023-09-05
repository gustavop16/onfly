<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Models\User;

class ExpenseRepository 
{
    private $expense_model;
    
    public function expenseModel()
    {
        if(!isset($this->expense_model)){
            $this->expense_model = new Expense();
        }
        return $this->expense_model;
    }

    public function create(array $attributes)
    {           
        return $this->expenseModel()->create($attributes);
    }
    
    public function getAll(){
        return $this->expenseModel()->all();
    }
    
    public function getById($id){
        return $this->expenseModel()->find($id);
    }

    public function getByUser($user_id){
        return $this->expenseModel()->where('user_id', $user_id)->get();
    }

    public function update(array $attributes, Expense $expense)
    {   
        return $expense->update($attributes);
    }

    public function destroy(Expense $expense){   
        return $expense->delete();
    }

}
