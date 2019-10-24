<?php namespace App\Http\Controllers;
use App\Models\EmployeeManagement;


class EmployeeManagementController extends CrudController {
  //public $
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        parent::__construct();
    }

    function setListData( $data )
    {
      // dd($this->model);
      return $this->model;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//dd($this->current_user);
        return view('crud.employee-management.index');
    }
}