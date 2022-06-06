<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct(Income $income)
    {
        $this->income = $income;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = $this->income->with('customer')->get();

        return response()->json($incomes, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $income = $this->income->create(
            [
                'customer_id'  => $request->customer_id,
                'description'  => $request->description,
                'amount'       => $request->amount,
                'income_date'  => $request->income_date,
                'tax_year'     => $request->tax_year
            ]
        );
        return response()->json($income, 201);    
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = $this->income->with('customer')->find($id);
        if ($income === null) {
            return response()->json(['message' => 'Income not found'], 404);
        }
        return response()->json($income, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $income = $this->income->find($id);
        if (!$income) {
            return response()->json(['message' => 'Unable to update, Income not found'], 404);
        }

        $income->update($request->all());
        return response()->json($income, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = $this->income->find($id);
        if (!$income) {
            return response()->json(['message' => 'Unable to remove, Income not found'], 404);
        }
        $income->delete();
        return response()->json(['msg' => 'Income deleted'], 200);
    }
}
