<?php

namespace Tests;

use App\Models\Expense;
use PHPUnit\Framework\TestCase;

class TestExpense extends TestCase
{
    public function testStoreExpense()
    {
        $expense = new Expense();
        $this->assertTrue($expense->store([
            "user_id"    => 1,
            "description" => "teste teste teste",
            "date"    => "2023-05-20",
            "value" => 18.5
        ]));
        
    }

    public function testFindExpenseById()
        {
            $expense = new Expense();
            $this->expectNotNull($expense->findClientByID(3));
        }
}
