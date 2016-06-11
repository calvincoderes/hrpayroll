<?php

class CustomValidate { 
	
	public static function recordNotExisting($model, $data = [], $includes = [])
	{
		$error = [];
		
		foreach($data AS $key => $value){
			if(in_array($key, $includes) == false){
				unset($data[$key]);
			}
		}
		
		foreach($data AS $column => $value){
			$check = $model->whereRaw('LCASE(`' . $column . '`) = "' . strtolower($value) . '"')->count();
			
			if($check > 0)
				$error[$column] = sprintf(Lang::get('validation.custom.custom_validate.existing'), $column);
			
		}
		
		return $error;
	}
	
	public static function validateNotDuplicate($model, $data = [], $includes = [])
	{
		$temp = [];
		$error = [];
		$existing_count = 0;
	
		foreach($data AS $key => $value){
			if(in_array($key, $includes) == true)
				$temp[$key] = $value;
		}
	
		foreach($temp AS $column => $value){
			$valid_count = $model->whereRaw('LCASE(`' . strtolower($column) . '`) = "' . strtolower($value) . '" AND id != "' . $data['id'] . '"')->count();
			if($valid_count > 0)
				$error[$column] = sprintf(Lang::get('validation.custom.custom_validate.duplicate'), $column);
		}

		return $error;
	}
	
	public static function validateNonDataDuplicate($model, $data = [], $includes = [], $strict = false){
		$id = 0;
		$error = [];
		$model = $model;
		
		foreach($data AS $key => $value){
			if(in_array($key, $includes) == true)
				$temp[$key] = $value;
		}
		
		if(isset($data['id']))
			$id = $data['id'];
		
		$record = $model->whereRaw('id != "' . $id . '"')
			->where(function($query) use($temp){
				foreach( $temp AS $column => $value ){
					$query->whereRaw('LCASE(`' . strtolower($column) . '`) = "' . strtolower($value) . '"');
				}
			})
			->select('name', 'code', 'COMPANY_id')->first();
		
		if($record){
			$record = $record->toArray();
			if(count(array_diff($record, $temp)) == 0){
				foreach($temp AS $col => $val)
					$error[$col] = sprintf(Lang::get('validation.custom.custom_validate.duplicate'), $col);
			}
		}
		
		return $error;
	}
}
