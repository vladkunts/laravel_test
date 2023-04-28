<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Client;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        return view('transactions.index', [
            'transactions' => Transaction::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = new Transaction;
        $transaction->client()->associate(Client::find($request->client_id));
        $transaction->transaction_date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->save();

        return back()
            ->with('success','Transaction has been added.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(string $id)
    {
        return view('transactions.edit')->with('transaction', Transaction::find($id));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(UpdateTransactionRequest $request, string $id)
    {
        $transaction = Transaction::find($id);
        if($request->client_id)
            $transaction->client()->associate(Client::find($request->client_id));
        if($request->date)
            $transaction->transaction_date = $request->date;
        if($request->amount)
            $transaction->amount = $request->amount;

        $transaction->save();

        return back()
            ->with('success','Transaction has been updated.');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(string $id)
    {
        Transaction::find($id)->delete();
        return back();
    }
}
