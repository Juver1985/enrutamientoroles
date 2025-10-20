<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
       $proveedor = Supplier::all(); // Variable para el Foreach
        return view('admin.suppliers.index', compact('proveedor')); // Redirecciona a la vista Listado
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show form for creating a new supplier
         return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_name'  => 'nullable|string|max:255',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'      => 'nullable|string|max:255',
        ]);

        $supplier = new Supplier();
        $supplier->supplier_name = $request->post('supplier_name');
        $supplier->contact_name  = $request->post('contact_name');
        $supplier->phone         = $request->post('phone');
        $supplier->email         = $request->post('email');
        $supplier->address       = $request->post('address');
         $supplier->save();

        return redirect()->route('admin.suppliers.create')
                 ->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);

    $data = $request->validate([
        'supplier_name' => 'required|string|max:255',
        'contact_name'  => 'nullable|string|max:255',
        'phone'         => 'nullable|string|max:50',
        'email'         => 'nullable|email|max:255',
        'address'       => 'nullable|string|max:255',
    ]);

    $supplier->update($data);

    return redirect()->route('admin.suppliers.index')
        ->with('success', 'Proveedor actualizado exitosamente');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Supplier $supplier)
{
    $supplier->delete();

    return redirect()->route('admin.suppliers.index')
          ->with('danger', 'Proveedor eliminado exitosamente');
}
}
