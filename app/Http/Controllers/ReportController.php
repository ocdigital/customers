<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function amountsByCustomers(Request $request){

    $amounts = DB::select("
        SELECT c.name, i.amount 
        FROM customers c 
        inner join incomes i on c.id = i.customer_id 
        where i.deleted_at is null and i.income_date = ?", [$request->income_date]);

    $sumAmounts = DB::select("
        SELECT c.name,sum(i.amount) as total 
        FROM customers c 
        inner join incomes i on c.id = i.customer_id  
        where i.deleted_at is null and i.income_date = ? GROUP BY c.name", [$request->income_date]);

    return response()->json([
        'amounts' => $amounts,
        'sumAmounts' => $sumAmounts
    ]);

    }


}
