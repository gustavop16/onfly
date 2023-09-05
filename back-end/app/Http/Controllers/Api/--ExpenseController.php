<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Repositories\ExpenseRepository;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

    private $expense_repository;
    
    public function expenseRepository()
    {
        if(!isset($this->expense_repository)){
            $this->expense_repository = new ExpenseRepository();
        }
        return $this->expense_repository;
    }

    public function show(string $id)
    {
        $expense = $this->expenseRepository()->getById($id); 
        $this->authorize('belongs',$expense);   

        if (empty($expense)) {
          return response()->json(['error' => 'Despesa não encontrada!'], 400, ['X-Header-One' => 'Header Value']);
        }
        return new ExpenseResource($expense);
    }
   
    public function store(ExpenseRequest $request)
    {
        dd('aaaa');

        $input = $request->all();
        try {
            DB::beginTransaction();
                $expense = $this->expenseRepository()->create($input);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 400, ['X-Header-One' => 'Header Value']); 
        }
        return new ExpenseResource($expense);
    }

    public function update(ExpenseRequest $request, string $id)
    {
        $expense = $this->expenseRepository()->getById($id);  

        $this->authorize('belongs',$expense);
          
        if (empty($expense)) {
          return response()->json(['error' => 'Despesa não encontrada!'], 400, ['X-Header-One' => 'Header Value']);
        }

        $input  = $request->all();
        try {
            DB::beginTransaction();
            $response = $this->expenseRepository()->update($input, $expense);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 400, ['X-Header-One' => 'Header Value']); 
        }
        return new ExpenseResource($response);
    }

    public function destroy(string $id)
    {
        $expense = $this->expenseRepository()->getById($id);  
        $this->authorize('belongs',$expense);  
        
        if (empty($expense)) {
          return response()->json(['error' => 'Despesa não encontrada!'], 400, ['X-Header-One' => 'Header Value']);
        }

        try {
            DB::beginTransaction();
                $this->expenseRepository()->destroy($expense);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 400, ['X-Header-One' => 'Header Value']); 
        }
        return response()->json(['error' => 'Despesa excluída!'], 200, ['X-Header-One' => 'Header Value']);
    }
}
