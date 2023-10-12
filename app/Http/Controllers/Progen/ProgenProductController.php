<?php

namespace App\Http\Controllers\Progen;

use App\Http\Controllers\Controller;
use App\Models\Progen\ProgenCustomer;
use App\Models\Progen\ProgenCustomerProduct;
use Illuminate\Http\Request;

class ProgenProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progenProducts = ProgenCustomerProduct::where('progen_customer_id', $id)->paginate(15);
        
        return view('progen.products.show',
            [
                'progenProducts' => $progenProducts
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        dd('sono qui');
        return view('progen.customers.products.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
