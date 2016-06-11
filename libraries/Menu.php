<?php
class Menu {

	/**
	 * Returns array of default menu.
	 * @author AngelaMisa 03/13/2015
	 * @return array
	 */
	public static function defaultList() {
		// Super User
		$super_user = false;

		if( auth()->check() )
			$super_user = auth()->user()->username == \Constant::SUPER_USER || auth()->user()->username == 'aldrin';
			#$super_user = true;

		// Menu Container
		$menu = [];

		// Dashboard
		$menu['dashboard'] = [
			'url' 	=> URL::to('/'),
			'title'	=> 'Dashboard',
			'icon'	=>'fa fa-dashboard fa-lg',
		];

		// Consulting
		$menu['consulting'] = [
			'url'		=> '',
			'title'		=> 'Consulting',
			'icon'		=>'fa fa-coffee fa-lg',
			'sub_menu'	=> []
		];

		// Main Category Group
		/*$menu['consulting']['sub_menu']['main_category_group'] = array(
				'url' 	=> URL::to('main_category_group'),
				'title' => 'Category Groups',
		);*/

		// Company Group
		$menu['consulting']['sub_menu']['company_group'] = [
			'url' 	=> URL::to('company_group'),
			'title'	=> 'Company Groups',
		];

		// Company
		$menu['consulting']['sub_menu']['company'] = [
			'url' 	=> URL::to('company'),
			'title'	=> 'Companies',
		];

		// Company Branches
		$menu['consulting']['sub_menu']['company_branch'] = [
				'url' 	=> URL::to('company_branch'),
				'title'	=> 'Company Branches',
		];

		// Announcement
		/*$menu['consulting']['sub_menu']['announcement'] = array(
				'url'   => URL::to('announcement'),
				'title' => 'Announcement',
		);*/

		#################### CATEGORY ####################
		$menu['category'] = [
			'url'		=> '',
			'title'		=> 'Category',
			'icon'		=>'fa fa-bars fa-lg',
			'sub_menu'	=> []
		];

		// Main Category
		$menu['category']['sub_menu']['main_category'] = [
			'url' 	=> URL::to('main_category'),
			'title'	=> 'Categories',
		];

		// Sub Category
		$menu['category']['sub_menu']['category'] = [
			'url' 	=> URL::to('category'),
			'title'	=> 'Sub Categories',
		];

		// Manufacturer
		$menu['category']['sub_menu']['manufacturer'] = [
			'url' 	=> URL::to('manufacturer'),
			'title'	=> 'Brands',
		];

		// Merchants
		$menu['category']['sub_menu']['vendor'] = [
			'url' 	=> URL::to('vendor'),
			'title'	=> 'Merchants',
		];

		// Payment
		/*$menu['category']['sub_menu']['payment'] = array(
				'url' 	=> URL::to('payment'),
				'title' => 'Payments',
		);*/
		
		// Merchant Branch
		/*$menu['category']['sub_menu']['vendor_branch'] = array(
				'url' 	=> URL::to('vendor_branch'),
				'title' => 'Merchant Branches',
		);*/
		
		// Merchant Product
		/*$menu['category']['sub_menu']['merchant_product'] = array(
				'url' 	=> URL::to('merchant_product'),
				'title' => 'Merchant Product Inventory',
		);*/	

		// Product
		$menu['category']['sub_menu']['product'] = [
			'url' 	=> URL::to('product'),
			'title'	=> 'Products',
		];

		// Group
		$menu['category']['sub_menu']['group'] = [
			'url' 	=> URL::to('group'),
			'title'	=> 'Product Groups',
		];

		// Upload
		$menu['category']['sub_menu']['upload'] = [
			'url' 	=> URL::to('upload'),
			'title'	=> 'Data Uploads',
		];

		// Upload
		$menu['category']['sub_menu']['upload/images/s3'] = [
			'url' 	=> URL::to('upload/images/s3'),
			'title'	=> 'Images Uploads',
		];

		// Featured Category
		$menu['category']['sub_menu']['featured_category'] = [
			'url' 	=> URL::to('featured_category'),
			'title'	=> 'Featured Categories',
		];

		// Company Featured Category
		$menu['category']['sub_menu']['company_featured_category'] = [
			'url' 	=> URL::to('company_featured_category'),
			'title'	=> 'Company Featured Categories',
		];

		// Export
		$menu['category']['sub_menu']['export'] = [
			'url' 	=> URL::to('export'),
			'title'	=> 'Export',
		];

		// Company Featured Category
		/*$menu['category']['sub_menu']['vendor_list'] = array(
				'url' 	=> URL::to('vendor_list'),
				'title' => 'Merchant List',
		);*/

		// Supply Chain
		$menu['supply_chain'] = [
			'url' 		=> '',
			'title'		=> 'Supply Chain',
			'icon'		=>'fa fa-chain fa-lg',
			'sub_menu'	=> []
		];

		// Size
		$menu['supply_chain']['sub_menu']['size'] = [
			'url' 	=> URL::to('size'),
			'title'	=> 'Product Classifications',
		];

		// Size Delivery
		$menu['supply_chain']['sub_menu']['size_delivery'] = [
			'url' 	=> URL::to('size_delivery'),
			'title'	=> 'Product Deliveries',
		];

		// Volume Matrix
		$menu['supply_chain']['sub_menu']['volume_matrix'] = [
			'url' 	=> URL::to('volume_matrix'),
			'title'	=> 'Volume Matrix',
		];

		// Cities
		$menu['supply_chain']['sub_menu']['regions'] = [
			'url' 	=> URL::to('regions'),
			'title'	=> 'Regions',
		];

		$menu['supply_chain']['sub_menu']['cities'] = [
			'url' 	=> URL::to('cities'),
			'title'	=> 'Cities',
		];
		// Blog
		/*$menu['blog'] = array(
				'url' 	=> '',
				'title' => 'Blog',
				'icon'	=>'fa fa-inbox fa-lg',
				'sub_menu' => []
		);
		
		// Post
		$menu['blog']['sub_menu']['blog_post'] = array(
				'url' => URL::to('blog_post'),
				'title' => 'Posts',
		);
		// comment
		$menu['blog']['sub_menu']['blog_comment'] = array(
				'url' => URL::to('blog_comment'),
				'title' => 'Comments',
		);
		// Category
		$menu['blog']['sub_menu']['blog_category'] = array(
				'url' => URL::to('blog_category'),
				'title' => 'Categories',
		);*/
		
		
		#################### Merchant Approvals - Bebe ####################
		/*$menu['approvals'] = array(
				'url' 	=> '',
				'title' => 'Approvals',
				'icon'	=>'fa fa-gavel fa-lg',
				'sub_menu' => []
		);

		$menu['approvals']['sub_menu']['merchant_product_new'] = array(
				'url' 	=> URL::to('merchant_product_new'),
				'title' => 'New Product Proposals',
		);

		$menu['approvals']['sub_menu']['product_quantity'] = array(
				'url' 	=> URL::to('product_quantity'),
				'title' => 'Product Inventory Updates',
		);

		$menu['approvals']['sub_menu']['merchant_product_price_history'] = array(
				'url' 	=> URL::to('merchant_product_price_history'),
				'title' => 'Product Prices Updates',
		);
		
		$menu['approvals']['sub_menu']['changes_batch'] = array(
				'url' 	=> URL::to('changes_batch'),
				'title' => 'Changes Log',
		);

		
		// System
		$menu['system'] = array(
				'url' 	=> '',
				'title' => 'System',
				'icon'	=>'fa fa-gear fa-lg',
				'sub_menu' => []
		);
		
		// User
		$menu['system']['sub_menu']['user'] = array(
				'url' 	=> URL::to('user'),
				'title' => 'System User',
		);
		
		if( $super_user ) {
			// User Group
			$menu['system']['sub_menu']['user_group'] = array(
					'url' 	=> URL::to('user_group'),
					'title' => 'System User Group',
			);
		}
		
		// Currency system
		$menu['system']['sub_menu']['currency'] = array(
				'url' 	=> URL::to('currency'),
				'title' => 'Currency',
		);
		
		// Payment system
		$menu['system']['sub_menu']['payment'] = array(
				'url' 	=> URL::to('payment'),
				'title' => 'Payment',
		);
		
		
		// Company
		$menu['system']['sub_menu']['company'] = array(
				'url' 	=> URL::to('company'),
				'title' => 'Companies',
		);
		
		// City
		$menu['system']['sub_menu']['city'] = array(
				'url' 	=> URL::to('city'),
				'title' => 'Cities',
		);		
		
		// Wallet
		$menu['system']['sub_menu']['wallet'] = array(
				'url' 	=> URL::to('wallet'),
				'title' => 'Wallets',
		);*/
				
		
		// Manage Permissions
		#dd(\Permission::getAll(auth()->user()->INTERNAL_GROUP_id));
		/*foreach( $menu as $key1=>$row) {
			$ctr = 0;
			if( !empty($row['sub_menu']) ) {
				foreach( $row['sub_menu'] as $key2=>$sm ){

					if( ! \Permission::check( $key2, 'read' ) && !$super_user) {
						unset( $menu[$key1]['sub_menu'][$key2]);
						$ctr++;
					}
				}
				
				if( $ctr == count($row['sub_menu']) )
					unset($menu[$key1]);
			}
		}*/

		// Return Menus
		return $menu;
	}
}