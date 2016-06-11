<?php

use App\Models\UserGroup;

class Permission {

	public static function getAll( $user_group_id ) {
		/*$permission = new App\Models\UserPermission;
		$user_group = UserGroup::where('id', $user_group_id )->first();

		if( !Cache::has('permission_' . $user_group_id) ) {

			// Get All Routes
			$routes = Route::getRoutes();

			// Modules Data Container
			$modules = [];

			// Render All routes
			foreach( $routes as $value ) {

				// Route Method e.g. GET, POST
				$method = $value->getMethods()[0];

				// Route Path e.g. category/{id}
				$path 	= $value->getPath();

				// Check if Route Path is not included in common Routes
				if( !in_array( $path, explode(',',Constant::COMMON_ROUTES ) ) ) {

					// Disect Path's URI
					$parts = explode('/', $path);

					// Count number of disected Path's URI
					$count = count($parts);

					// If Count is One ( 1 ) and Method is GET, that's the main Module's path
					// e.g category/{id}, category/{id}/edit = The Main Module Path is 'category'
					if( $count == 1 && $method == 'GET' ) {

						// Main Module Path
						$route = $parts[0];

						// Module title based on Main Path
						$title = ucwords(str_replace('-', ' ', str_replace('_', ' ', $route)));
						$user_permission = array();

						if( $user_group_id  > 0 ) {
							
							$user_permission = $permission->where('INTERNAL_GROUP_id', $user_group_id)->where('route', '=', $route);
							
							if( $user_permission->count() )
								$user_permission = $user_permission->first();

						}
						

						$create = !empty($user_permission->create);
						$read = !empty($user_permission->read);
						$update = !empty($user_permission->update);
						$delete = !empty($user_permission->delete);

						$modules[$route] = [
							'title'	=> $title,
							'route' => $route,
							'icon'	=> !empty($user_permission->icon) ? $user_permission->icon : '',
							'auto_approved' => !empty($user_permission->auto_approved) ? $user_permission->auto_approved : false,
							'all_access' => $create && $read && $update && $delete,
							'create'=> $create,
							'read'	=> $read,
							'update'=> $update,
							'delete'=> $delete
						];
					}
				}

			}

			Cache::add('permission_' . $user_group_id, $modules, 15);

		} else {
			return Cache::get('permission_' . $user_group_id);			
		}*/
		return $modules;
	}
	
	public static function check( $route, $action, $user_group_id = null ) {
		/*$user_group_id = $user_group_id === null ? auth()->user()->USER_GROUP_id : null;
	
		$module = self::getAll( $user_group_id );
		
		return !empty( $module[$route][$action] );*/
		
	}
}