<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Extra, Payment};
use App\Services\Log\LogService;
use App\Models\PaginatorTrait;

class ExtrasController extends Controller {
	use PaginatorTrait;

    function index(Request $request) {
        try {
            $extras = PaginatorTrait::paginate( Extra::class , $request , filter_fields : [ "first_name" , "dni", "status" , "phone"]);

            return response()->json($extras);
        } catch (Exception $e) {

        }
    }

    function detail(Request $request) {
        try {
            $extra = Extra::where('id', $request['id'] )->first();

            return response()->json([
                'success' => true,
                'data' => $extra
            ]);
        } catch (Exception $e) {

        }
    }

    function getPayments(Request $request) {
        try {
            $where_params = [];
            if( isset($request["id"]) ){
                $where_params[] = [ "extra_id" , $request["id"]];
            }
            $payments = PaginatorTrait::paginate( Payment::class , $request , filter_fields : [ 'status', 'multas', 'bonos', 'total', 'fecha_pago' ], where_params : $where_params );

            return response()->json($payments);
        } catch (Exception $e) {

        }
    }

    function createExtra(Request $request) {
        $existing_extra = Extra::where("dni" , $request["dni"])->first();

        if( $existing_extra ){
            throw new \Exception("existing_extra_dni", 1001 );
        }

        LogService::insert( $request["dni"] , 1 , "Insert Extra" , "ExtraController::store");

        try {
            $extra = Extra::create($request->all());

            $auth = auth('api')->user();
            $user = User::find($auth->id);
            $user->extra_id = $extra->id;
            $user->save();

            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            LogService::insert( $request["dni"] , 3 , "[ERROR]Insert Extra: "->$e->getMessage() , "ExtraController::store");
        }
    }
}
