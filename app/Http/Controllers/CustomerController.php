<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule; // این خط را اضافه کنید


class CustomerController extends Controller
{
    public function index(Request $request){
        
            if($request->has('query') && trim($request->input('query')) !== ''){
    
                $QUER = $request->input('query');
                $customers = Customer::where('name' ,'LIKE' ,  '%' . $QUER . '%')->paginate(10);
                
            }else{
                $customers = Customer::paginate(10);
            }
            
            return Inertia::render('Customers/Index', [
                'customers' => $customers,
                
            ]);
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:15',
        ]);

        Customer::create($request->all());
        return response()->json([
            'message' => 'Customer updated successfully',
            'Allcustomers' => Customer::paginate(10),
        ]);



    }
    public function update(Request $request, Customer $customer)

    {  
        $request->validate([
            'name' => 'required|string|max:255',
        'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('customers')->ignore($customer->id),
        ]]);

        $customer->update($request->all());
        return response()->json([
            'message' => 'Customer updated successfully',
            'Allcustomers' => Customer::paginate(10),
        ]); }
    public function destroy(Customer $customer)
    {
        $customer->delete();
        $allcustomers = Customer::paginate(10);
        return response()->json([
            'message' => 'Customer updated successfully',
            'allcustomers' => $allcustomers,
        ]);
    }
    public function show(){
        return Inertia::render('Customers/Create');
    }
    public function edit(Customer $customer){
        
       return  Inertia::render('Customers/edit' ,['cus' => $customer]);
    }
    // public function search(Request $request){
    //     $request->validate([
    //         "query" => "required|max:255|string"
    //     ]);
    //     $query = $request->query;
    //     $customers = Customer::where('name' , 'LIKE' ,'%{$query}%')->get();
    //     return Inertia::render('Customers/Index', [
    //         'customerssearch' => $customers
    //     ]);

    // }
}
