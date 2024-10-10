<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\User;// این خط را اضافه کنید
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
            'Allcustomers' => Customer::where('name' , $request->email),
        ]);



    }
    public function update(Request $request, Customer $customer)

    {   $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit articles']);
        $role->givePermissionTo($permission);


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
            'Allcustomers' => Customer::find($customer->id),
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


    public function dash(User $user){
        return Inertia::render('Dashboard' ,[]);

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
