<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function belongs(User $user, Expense $expense){
        return ((int)$user->id === (int)$expense->user_id);
    }
}
