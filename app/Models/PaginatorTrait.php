<?php

namespace App\Models;

trait PaginatorTrait{

	public static function paginate( $model , $request , $where_params = [] , $order_raw = "id desc" , $perPage = 10 , $filter_fields = [] , $with = "" , $arr_trimed_fields = [] , $arr_select_fields = [] ){
		if( isset($request["perPage"])){
			$perPage = $request["perPage"];
		}

		if( isset($request["filter"])){
			foreach ($filter_fields as $item_filter_field) {
				$where_params[] = [ $item_filter_field , $request["filter"] , "LIKE" ];
			}
		}

		$model_query = $model::query();
		foreach ($where_params as $item_where) {
			if( count($item_where) == 2 ){
				//filter equal
				$model_query->where( $item_where[0] , "=" , $item_where[1] );
			}else{
				//3rd field, it's the operator
				$model_query->orWhere( $item_where[0] , "LIKE" , "%".$item_where[1]."%" );
			}
		}

		//si en el modelo incorporamos un método search podemos añadir búsquedas concretas
		if( isset($request["search"]) ){
			if( method_exists($model, "search")){
				$model::search( $request["search"] , $model_query );
			}
		}

		if( is_array($with)){
			foreach ($with as $item_with) {
				$model_query->with($item_with);
			}

		}elseif( strlen($with)>0 ){
			//$model_query->with("customer");
			$model_query->with($with);
		}

		if( count($arr_select_fields)>0 ){
			$model_query = $model_query->select( $arr_select_fields );
		}

		$paginator = $model_query->orderByRaw( $order_raw )->paginate( $perPage );

		if( count($arr_trimed_fields)>0 ){

		    $paginator->getCollection()->transform(function ($item) use ($arr_trimed_fields) {
		    	foreach ($arr_trimed_fields as $item_trimed_field) {
		    		$field_name = $item_trimed_field;
		    		$length = 200;
		    		if( is_array($item_trimed_field)){
		    			$field_name = $item_trimed_field[0];
		    			$length = $item_trimed_field[1];
		    		}
			        if (strlen($item->{$field_name}) > $length) {
			            $item->{$field_name} = substr($item->{$field_name}, 0, $length) . '...';
			        }
		    	}
		    	return $item;
		    });
		}

		return( $paginator );
	}
}
