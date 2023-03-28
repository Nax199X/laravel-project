<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //customer register page
    public function register()
    {
        return view('customer.register');
    }
    //crate customer account
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phoneNumber' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer#register')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $this->getCustomerData($request);

        //MVC = model view controller

        //create
        //modal cll data=>arry

        Customer::create($data);

        return back()->with(['insertSuccess' => 'User Information Recorted..']);
    }
    //customer list page

    function list() {
        $data = Customer::paginate(10); //object

        return view('customer.list')->with(['customer' => $data]);
    }

    // customer info see more...
    public function seeMore($id)
    {
        // $data = Customer::where('customer_id', "=", $id)->get(); //object nae htote

        $data = Customer::where('customer_id', $id)->get()->toArray(); //array nae htote

        return view('customer.seeMore')->with(['customer' => $data]);
    }

    //delete customer data
    public function delete($id)
    {
        Customer::where('customer_id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Customer Data Deleted!']);
    }

    //edit customer data
    public function edit($id)
    {
        $data = Customer::where('customer_id', $id)->first(); //object

        return view('customer.edit')->with(['customer' => $data]);
    }

    //update customer id
    public function update($id, Request $request)
    {$validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'gender' => 'required',
        'dateOfBirth' => 'required',
        'phoneNumber' => 'required',
    ], [
        'name.required' => " Please fill Name ",
    ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->getCustomerData($request);
        $updateData['id'] = $id;
        Session::put('Customer_Data', $updateData);
        return redirect()->route('customer#confirm');
        // Customer::where('customer_id', $id)->update($updateData);
        // return redirect()->route('customer#list')->with(['updateSuccess' => 'Customer Data Successfully Update']);
    }

    public function confirm()
    {

        return view('customer.confirm')->with(['customer' => Session::get('Customer_Data')]);
    }

    //real update customer data
    public function realUpdate()
    {
        $data = Session::get('Customer_Data');
        $id = $data['id'];
        unset($data['id']); //remove id in customer data array
        Session::forget('Customer_data');

        Customer::where('customer_id', $id)->update($data);
        return redirect()->route('customer#list')->with(['updateSuccess' => 'Updated!']);
    }
    //request customer data
    private function getCustomerData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->dateOfBirth,
            'phone' => $request->phoneNumber,

        ];
    }

}
