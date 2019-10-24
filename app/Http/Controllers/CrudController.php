<?php namespace App\Http\Controllers;

use App\Models;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrudController extends Controller {

	// Table - Required
	public $table;

	// Table Columns
	public $columns;

	// Model - Required
	public $model;

	// Current Model
	public $crud_table;

	// Views
	public $list_view;
	public $create_view;
	public $edit_view;
	public $show_view;

	// Variables to be rendered on views
	public $data = [];

	// Error Container,c  
	public $error = [];

	// Pagination Limit
	public $limit = 10;

	// Localization
	public $local = 'en';

	// Breadcrumbs
	public $breadcrumbs = [];

	// Check if Super User
	public $super_user;

	// Validation Rules
	public $rules = [];

	// URL Requests
	public $url_requests = '';

	// API
	public $api;

	// Image
	public $image;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		
		// Before Construct
		$this->beforeConstruct();

		// Authentication
		$this->middleware('auth');

		// Get First URL Segment - Treated as base route
		$base = \StringHelper::clean( strtolower( \Request::segment(1) ) );

		// Get Primary Table
		$this->table = !$this->table ? $base : $this->table;
		// Initialize Model
		$this->model = app( '\App\Models\\' . studly_case($this->table) );
		
		// Get Table Columns
		$this->columns = \Schema::getColumnListing( $this->model['table'] );

		// Initialize API
		//$this->api = new \API( 'http://localhost/api/', '_d8b2fd2b3831e2a0235228d8a417c624e5b1c8f4');

		// Super User
		#$this->super_user = auth()->user()->username == 'admin' || auth()->user()->username == 'aimonbio';
		$this->super_user = true; //auth()->user()->username == 'admin';

		// Image Resizer Class
		$this->image = new \ImageHelper();

		// Image Resizer Sample
		// $this->image->make(\Config::get('app.uploads') .'placeholder.png', 500, 500, \Config::get('app.uploads') .'placeholder2.png');

		// Get All URL Requests
		$this->data['query_string'] = \StringHelper::getURLQueries( \URL::full() );

		// User Group
		$this->data['user_group_name'] = 'Administrator';

		if( auth()->check() )
			if( auth()->user()->userGroup )
				$this->data['user_group_name'] = auth()->user()->userGroup()->first()->name;

		// Share URL Requests on View
		\View::share('query_string', $this->data['query_string'] );

		// Set Languages to template
		\View::share( 'base', $base );
		foreach( trans( 'crud-' . $this->table ) as $key=>$lang )
			\View::share( $key, trans( 'crud-' . $this->table . '.' . $key ) );

		// Blank Placeholder for Select
		\View::share('select', [ '' => '--Select--' ] );

		// CRUD Views
		$this->list_view = 'crud.' . $this->table . '-index';
		$this->create_view = 'crud.' . $this->table . '-form';
		$this->edit_view = 'crud.' . $this->table . '-form';
		$this->show_view = 'crud.' . $this->table . '-show';

		// After Construct
		$this->afterConstruct();
	}

	/**
	 * Before Construct
	 *
	 * @return Response
	 */
	public function beforeConstruct() {

	}

	/**
	 * After Construct
	 *
	 * @return Response
	 */
	public function afterConstruct() {

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Function to call if there are changes in Lists
		$this->model = $this->setListData( \Request::all() );

		// dd($this->model);
		// dd(\App\Models\EmployeeManagement::where());
		// Get Results
		if( $this->limit > 0 )
			$this->data['results'] = $this->model->paginate( $this->limit );
		else
		
			$this->data['results'] = $this->model->get();

		// Add data
		$this->data = $this->addListData( $this->data );


		// Render List View
		return view( $this->list_view )->with( $this->data );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data = $this->addFormData( $this->data );

		if( !\Request::ajax() )
			return view( 'crud.' . $this->table . '-index')->with( $this->data );

		return view( $this->create_view )->with( $this->data );
	}

	/**
	 * Manage Data Before Inserting
	 * @param $data
	 * @return mixed
	 */
	public function beforeStore( $data )
	{
		return $data;
	}

	/**
	 * Manage Data After Inserting
	 * @param $data, $object
	 * @return mixed
	 */
	public function afterStore( $data, $model )
	{
		return $data;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = $this->beforeStore( \Request::all() );
		$this->validation( $data );

		if (!count($this->error) )
		{
			$model = $this->model;

			$changes_data = [];
			foreach( array_keys( $data ) as $key ) {
				if( !is_array( $data[$key] ) && in_array( $key, $this->columns ) ) {
					$model->{$key} = $data[$key];
					$changes_data[$key] = $data[$key];
				}
			}

			if( auth()->check() ) {
				$model->created_by = auth()->user()->lastname . ', ' . auth()->user()->firstname;
			}

			// Proceed saving changes if user default changes status is automatically approved
			$success = ucwords( str_replace('_', ' ', $this->table) );

			#if( auth()->user()->change_status == \Constant::CHANGES_APPROVED ) {
				$model->save();
				$success .= trans('default.success_added');
			#} else
			#	$success .= trans('default.success_pending');

			//$this->addLogs( !empty($model->id) ? $model->id : 0, $changes_data);

			\Session::flash( 'success', $success );

			$this->afterStore( $data, $model );

		}

		$query_srting = \StringHelper::getURLQueries( \URL::full() );

		$url = url( $this->table ) . $query_srting;

		if( \Request::ajax() )
			return [ 'url' => $url, 'error' =>  [ 'count' => count( $this->error ), 'messages' => $this->error ] ];

		return \Redirect::to( $url );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		$this->data['result'] = $this->model->where( $this->crud_table . '.id', '=', $id )->first();
		$this->data = $this->addShowData( $this->data, $id );

		if( !\Request::ajax() )
			return view( 'crud.' . $this->table . '-index')->with( $this->data );

		return view( $this->show_view )->with( $this->data );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id )
	{
		$this->data['result'] = $this->model->where( $this->crud_table . '.id', '=', $id )->first();

		$this->data = $this->addFormData( $this->data, $id );

		if( !\Request::ajax() )
			return view( 'crud.' . $this->table . '-index')->with( $this->data );

		return view( $this->edit_view )->with( $this->data );
	}

	/**
	 * Manage Data Before Editing
	 * @param  $data
	 * @return Response
	 */
	public function beforeUpdate( $data )
	{
		return $data;
	}

	/**
	 * Manage Data After Editing
	 * @param  $data, $object
	 * @return Response
	 */
	public function afterUpdate( $data, $model )
	{
		return $data;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$data = \Request::all();
		$data['id'] = $id;

		$data = $this->beforeUpdate( $data );
		$this->validation( $data );

		if( !count($this->error) )
		{
			$model = $this->model->find( $id );

			foreach( array_keys( $data ) as $key ) {
				// Check valid columns
				if( !is_array( $data[$key] ) && in_array( $key, $this->columns ) && $key != 'id' ) {

					// Get Changed Data
					if( $model->{$key} != $data[$key])
						$model->{$key} = $data[$key];
				}
			}
			if( auth()->check() ) {
				 if( $model->updated_by !== null )
					$model->updated_by = auth()->user()->lastname . ', ' . auth()->user()->firstname;
			}

			// Proceed saving changes if user default changes status is automatically approved
			$success = ucwords( str_replace('_', ' ', $this->table) );

			$model->save();
			$success .= trans('default.success_modified');

			\Session::flash( 'success', $success );

			$this->afterUpdate( $data, $model );

		}

		$query_srting = \StringHelper::getURLQueries( \URL::full() );

		$url = url( $this->table ) . $query_srting;

		if( \Request::ajax() )
			return [ 'url' => $url, 'error' =>  [ 'count' => count( $this->error ), 'messages' => $this->error ] ];

		return \Redirect::to( $url );
	}

	/**
	* Action Before Deletion of Data
	* @param $object
	* @return $object
	*/
	public function beforeDestroy( $object ) {
		return $object;
	}

	/**
	* Action After Deletion of Data
	* @param $id
	* @return $data
	*/
	public function afterDestroy( $id ) {
		return $this->model->where('id', '=', $id)->first();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id )
	{
		$object = $this->model->find( $id );
		$object = $this->beforeDestroy( $object );
		$object->deleted_at = date('Y-m-d H:i:s');
		$object->save();
		$object->delete();
		$this->afterDestroy( $id );
		$query_srting = \StringHelper::getURLQueries( \URL::full() );
		$url = url( $this->table ) . $query_srting;

		$success = ucwords( str_replace('_', ' ', $this->table) );
		$success .= trans('default.success_deleted');
		\Session::flash( 'warning', $success );

		return [ 'url' => $url ];
	}

	/**
	 * Set List Filters
	 *  - Use to create filter and Manipulate Model
	 * @return Null
	 * */
	protected function setListData( $data )
	{
		return $this->model;
	}

	/**
	* Add List Data - Additional Data on List
	* @param $data
	* @return response
	*/
	protected function addListData( $data )
	{
		return $data;
	}

	/**
	* Add Form Data - Addional Data on Form
	* @param $data, $id
	* @return $data
	*/
	protected function addFormData( $data, $id=null )
	{
		return $data;
	}

	/**
	* Add Show Data - Addional Data on Show
	* @param $data
	* @return response
	*/
	protected function addShowData( $data, $id )
	{
		return $data;
	}

	/**
	 * Data Validator
	 * @param $data
	 * @return N/A
	 * */
	public function validation( $data )
	{
		$validator = \Validator::make( $data, $this->rules );
		$messages = $validator->messages();

		foreach( $this->rules as $field => $rule ) {
			$errors = $messages->get($field);
			if(!empty($this->error[$field])) {
				$errors = array_merge($errors, $this->error[$field]);
				if($errors)
					$this->error[$field] = $errors;

			} else {
				if($errors)
					$this->error[$field] = $errors;
			}
		}

		return $data;
	}
}
