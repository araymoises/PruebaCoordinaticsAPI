<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $transaction = new Transaction();

            $transaction->description         = $request->description;
            $transaction->quantity            = $request->quantity;
            $transaction->transaction_type_id = $request->transactionTypeID;
            $transaction->save();
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => 'false',
                    'content' => '',
                    'error'   => $th
                ], 500
            );
        }

        return response()->json(
            [
                'success' => 'true',
                'content' => $transaction
            ], 200
        );
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $transactions = Transaction::all();
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => 'false',
                    'content' => ''
                ], 500
            );
        }
        
        return response()->json(
            [
                'success' => 'true',
                'content' => $transactions
            ], 200
        );
    }

    /**
     * Calculate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function calculate()
    {
        $incoming_transaction = DB::table('transactions')
            ->where('transaction_type_id', '=', 1)
            ->sum('quantity');

        $outcoming_transaction = DB::table('transactions')
            ->where('transaction_type_id', '=', 2)
            ->sum('quantity');

            return response()->json(
                [
                    'success' => 'true',
                    'content' => [
                        [
                            'name' => 'Ingresos',
                            'quantity' => $incoming_transaction,
                        ],
                        [
                            'name' => 'Egresos',
                            'quantity' => $outcoming_transaction,
                        ],
                    ]
                ], 200
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        if($transaction){
            $transaction->delete(); 
            return response()->json(
                [
                    'success' => 'true',
                    'content' => ''
                ], 200
            );
        }else
            return response()->json(
                [
                    'success' => 'false',
                    'content' => ''
                ], 404
            );
    }
}
