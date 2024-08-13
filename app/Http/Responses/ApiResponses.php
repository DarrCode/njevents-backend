<?php

namespace App\Http\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait ApiResponse
{
    public function successResponse($message, $data = null, $code = 200) {
        $response = [
            'success' => true,
            'message' => $message,
            'code' => $code
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    public function failResponse(\Exception $e , $data = null , $code = 200 ){
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
            'error' => $e->getCode(),
            //'stack' => $e->getTraceAsString(),
            'code' => $code
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    public function createdRowResponse( $entity , $code = 200 , $objects_created , $additional_data = null , $only_fillable_fields = true ){
        $response = [
            'success' => true,
            'message' => $entity." created successfully",
            'code' => $code
        ];

        $response['data']["count"] = 0;
        $response['data']["items"] = [];

        if (!is_null($objects_created)) {
            foreach ($objects_created as $item_object_created) {
                if( $only_fillable_fields ){
                    $item_2_add = [];
                    $item_2_add["id"] = $item_object_created->id;
                    foreach ($item_object_created->getFillable() as $item_field_fillable) {
                        $item_2_add[ $item_field_fillable ] = $item_object_created[ $item_field_fillable ];
                    }
                }else{
                    $item_2_add = $item_object_created;
                }
                $response['data']["items"][] = $item_2_add;
            }
            $response['data']["count"] = count($objects_created);
        }

        $this->addAdditionalData( $response , $additional_data );

        return response()->json($response, $code);
    }

    public function deletedRowResponse( $entity , $code = 200 , $deleted_object , $additional_data = null ){

        $response = [
            'success' => true,
            'message' => $entity." deleted successfully",
            'code' => $code
        ];

        if( !$deleted_object ){
            $response["success"] = false;
            $response["message"] = "Item not found";
            $response["code"] = 404;
            $code = 404;
        }

        $this->addAdditionalData( $response , $additional_data );

        return response()->json($response, $code);
    }

    public function updatedRowResponse( $entity , $code = 200 , $updated_object , $additional_data = null ){

        $response = [
            'success' => true,
            'message' => $entity." updated successfully",
            'code' => $code
        ];
        if( $updated_object ){
            $response['data']["count"] = 1;
            $response['data']["items"] = [ $updated_object->toArray() ];
        }else{
            $response["success"] = false;
            $response["message"] = "Item not found";
            $response["code"] = 404;
            $code = 404;
        }

        $this->addAdditionalData( $response , $additional_data );

        return response()->json($response, $code);
    }

    private function addAdditionalData( &$response , $additional_data ){
        if( !is_null($additional_data) && is_object($additional_data)){
            $response['additional_data'] = $additional_data->toArray();
        }
    }

    public function detailResponse( $entity , $code = 200 , $object_detail ){

        if( $object_detail ){
            $response["success"] = true;
            $response["code"] = $code;
            $response["message"] = $entity." obtained successfully";
            $response["data"]["items"] = $object_detail->toArray();
            $response["data"]["count"] = 1;
        }else{
            $response["success"] = false;
            $response["code"] = 404;
            $response["message"] = "Not found";
            $code = 404;
        }

        return response()->json($response, $code);

    }

    public function listResponse( $entity , $code = 200 , $objects_listed ){

        $response["success"] = true;
        $response["code"] = $code;
        $response["message"] = $entity." listed successfully";
        if ($objects_listed instanceof LengthAwarePaginator || $objects_listed instanceof Paginator) {
            $response["data"]["items"] = $objects_listed->items();
            $response["data"]["count"] = count( $response["data"]["items"] );
            $response["pagination"]["total"] = $objects_listed->total();
            $response["pagination"]["perPage"] = $objects_listed->perPage();
            $response["pagination"]["currentPage"] = $objects_listed->currentPage();
            $response["pagination"]["lastPage"] = $objects_listed->lastPage();
        }elseif( is_array($objects_listed) ){
            $response["data"]["items"] = $objects_listed;
            $response["data"]["count"] = count( $objects_listed );
            $response["pagination"]["total"] = 1;
            $response["pagination"]["perPage"] = 1;
            $response["pagination"]["currentPage"] = 1;
            $response["pagination"]["lastPage"] = 1;
        }else{
            $response["data"]["items"] = [];
            $response["data"]["count"] = 0;
            $response["pagination"]["total"] = 0;
            $response["pagination"]["perPage"] = 0;
            $response["pagination"]["currentPage"] = 0;
            $response["pagination"]["lastPage"] = 0;
        }

        return response()->json($response, $code);
    }
}
