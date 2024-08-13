<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Customer, Payment, User};
use App\Services\Log\LogService;
use App\Models\PaginatorTrait;

class CustomersController extends Controller {
	use PaginatorTrait;

    function index(Request $request) {
        try {
            $customers = PaginatorTrait::paginate( Customer::class , $request , filter_fields : [ "first_name" , "dni", "status" , "phone"]);

            return response()->json($customers);
        } catch (Exception $e) {

        }
    }

    function detail(Request $request) {
        try {
            $customer = Customer::where('id', $request['id'] )->first();

            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        } catch (Exception $e) {

        }
    }

    function getPayments(Request $request) {
        try {
            $where_params = [];
            if( isset($request["id"]) ){
                $where_params[] = [ "customer_id" , $request["id"]];
            }
            $payments = PaginatorTrait::paginate( Payment::class , $request , filter_fields : [ 'status', 'multas', 'bonos', 'total', 'fecha_pago' ], where_params : $where_params );

            return response()->json($payments);
        } catch (Exception $e) {

        }
    }

    function createCustomer(Request $request) {
        $existing_customer = Customer::where("nif" , $request["nif"])->first();

        if( $existing_customer ){
            throw new \Exception("existing_customer_nif", 1001 );
        }

        LogService::insert( $request["nif"] , 1 , "Insert Customer" , "CustomerController::store");

        try {
            $customer = Customer::create($request->all());

            $auth = auth('api')->user();
            $user = User::find($auth->id);
            $user->customer_id = $customer->id;
            $user->save();

            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            LogService::insert( $request["nif"] , 3 , "[ERROR]Insert Customer: "->$e->getMessage() , "CustomerController::store");
        }
    }
}
