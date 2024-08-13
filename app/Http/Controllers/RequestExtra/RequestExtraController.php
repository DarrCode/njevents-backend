<?php

namespace App\Http\Controllers\RequestExtra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{RequestExtra, CustomerRequestExtra, Customer};

class RequestExtraController extends Controller
{

    function index(Request $request) {
        try {
            $reqs = RequestExtra::all();
            return response()->json($reqs);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    function myRequests(Request $request) {
        try {
            $user = auth('api')->user();
            $customer = Customer::find($user->customer_id);
            $cursos = $customer->requestExtras;

            return response()->json($cursos);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    function request(Request $request) {
        // try {

            foreach ($request['requests'] as $req) {
                $request_extra = RequestExtra::create($req);

                $customerExtra = new CustomerRequestExtra;
                $customerExtra->customer_id = $req['customer_id'];
                $customerExtra->request_extra_id = $request_extra->id;

                $customerExtra->save();
            }
            return response()->json([
                'success' => true
            ]);
        // } catch (\Throwable $th) {
        //     return response()->json($th);
        // }
    }

    function detailRequest(Request $request) {
        try {

            $req = RequestExtra::find($request['id'])->load('customers');
            return response()->json([
                'success' => true,
                'data' => $req,
            ]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
