<?php

class Constant {

	const USER_TYPE			= 2; // Web Content - User Type
	
	const USER_MANAGER		= 'manager';
	const USER_ASSOCIATE	= 'associate';
	
	// Archived Status
	const ARCHIVED 			= 1;
	const NOT_ARCHIVED 		= 0;
	
	const STATUS_PENDING	= 1;
	const STATUS_WORKING	= 2;
	const STATUS_DONE		= 3;
	
	// Product Type
	const TYPE_DEFAULT				= 0;
	const TYPE_TRAVEL_BUDDY			= 1;
	const TYPE_LOADING_BAY			= 2;
	const TYPE_E_CONSULTA			= 3;
	const TYPE_MOTOR				= 4;
	const TYPE_MUTUAL_FUND			= 5;
	const TYPE_UNILAB_PRESCRIPTION	= 6;
	const TYPE_INSURANCES			= 7;
	
	// Fulfillment Voucher Type
	const TYPE_HOME_DELIVERY			= 0;
	const TYPE_BRANCH_REDEMPTION		= 1;
	const TYPE_PICK_UP_BRANCH			= 2;
	
	// Voucher Type
	const NON_VOUCHER					= 0; // Default
	const PHYSICAL_VOUCHER				= 1; // Fulfilled thru Home Delivery or Branch Pick-up
	const SERVICE_VOUCHER				= 2; // Fulfilled thru Branch Service Redemption

	// Shipping Type
	const SHIPPING_TYPE_NO_DELIVERY					= 0;
	const SHIPPING_TYPE_SUPPLIER_CLIENT_OFFICE		= 1;
	const SHIPPING_TYPE_SUPPLIER_PICKUP				= 2;
	const SHIPPING_TYPE_OFFSITE_WAREHOUSE_DELIVERY	= 3;
	const SHIPPING_TYPE_SUPPLIER_DELIVERY			= 4;
	const SHIPPING_TYPE_STORM_OFFICE_PICKUP			= 5;
	
	// Platform Type
	const WEBCONTENT						= 1;
	const MERCHANT							= 2;
	
	// Platform Type
	const FSA								= 'FSA';
	const HW								= 'HW';
	
	const PRODUCT_FIELD_CLASSIFICATION		= 1;
	const PRODUCT_FIELD_DESCRIPTION			= 2;
	const PRODUCT_FIELD_BRAND				= 3;
	const PRODUCT_FIELD_BENSTORE_PRICE		= 4;
	const PRODUCT_FIELD_STATUS				= 5;
	const PRODUCT_FIELD_CATEGORY			= 6;
	const PRODUCT_FIELD_REBATE				= 7;
	const PRODUCT_FIELD_QUANTITY			= 8;
	const PRODUCT_FIELD_TAG					= 9;
	const PRODUCT_FIELD_UNTAG_BRANCH		= 10;
	const PRODUCT_FIELD_TAG_BRANCH			= 11;
	const PRODUCT_FIELD_DURATION			= 12;
	const PRODUCT_FIELD_IMAGE				= 13;
	const PRODUCT_FIELD_VOUCHER				= 14;
	const PRODUCT_FIELD_PRODUCT_NAME		= 15;
	const PRODUCT_FIELD_WALLET				= 16;
	const PRODUCT_FIELD_PRIORITY_SHIPPING	= 17;
	const PRODUCT_FIELD_TRANSFER_PRICE		= 18;
	
	

	const COMMON_ROUTES		= '/,dashboard,/auth/login,/auth/logout';
	
	const SUPER_USER		= 'admin';
	
	
	const BATCH_CREATED		= 0;
	const BATCH_PENDING		= 1;
	
	
	// Changes Status
	const CHANGES_CREATED	= 0;
	const CHANGES_PENDING	= 1;
	const CHANGES_VALIDATED	= 2;
	const CHANGES_APPROVED	= 3;
	const CHANGES_UPDATED	= 4;
	const CHANGES_DELETED	= 5;
	const CHANGES_REJECTED	= 50;

	// Product Delivery Sources
	const SOURCE_DEFAULT = 'default';
	const SOURCE_DELIVERY_MATRIX = 'delivery_matrix';
	const SOURCE_MERCHANT_PICKUP_BRANCHES = 'branch_pickup';
	const SOURCE_MERCHANT_SERVICE_REDEMPTION_BRANCHES = 'branch_redemption';
	const SOURCE_MERCHANT_HOME_DELIVERY_AREAS = 'home_delivery';

	// Product Delivery Options
	const PRODUCT_DELIVERY_BRANCH_PICK_UP				= 0;
	const PRODUCT_DELIVERY_BRANCH_SERVICE_REDEMPTION	= 1;
	const PRODUCT_DELIVERY_HOME_DELIVERY				= 2;
	const PRODUCT_DELIVERY_OFFICE_DELIVERY				= 3;
	const PRODUCT_DELIVERY_BENEFITS_FAIR				= 4;
	const PRODUCT_DELIVERY_REWARDS_FAIR					= 5;

	// Export Types
	const EXPORT_MERCHANT	= 'Merchant';
	const EXPORT_BRAND		= 'Brand';
	const EXPORT_PRODUCT	= 'Product';
	
	// Changes batch type list
	const CHANGES_BATCH_TYPE_USER		= 0;
	const CHANGES_BATCH_TYPE_VENDOR		= 1;
	const CHANGES_BATCH_TYPE_CUSTOMER	= 2;

	// Product Quantity Status List
	const PRODUCT_QUANTITY_REJECTED			= 1;
	const PRODUCT_QUANTITY_PENDING			= 2;
	const PRODUCT_QUANTITY_APPROVED			= 3;
	const PRODUCT_QUANTITY_ARCHIVED			= 4;
	const PRODUCT_QUANTITY_ORDER_CANCELLED	= 5;

	// Transfer Price (Merchant Product Price History) Status List
	const TRANSFER_PRICE_REJECTED 		= 1;
	const TRANSFER_PRICE_PENDING 		= 2;
	const TRANSFER_PRICE_APPROVED 		= 3;
	const TRANSFER_PRICE_ARCHIVED 		= 4;

	// Transfer Price Status List
	const LINK_MAIN_CATEGORY = 'Main Category';
	const LINK_SUB_CATEGORY = 'Category';
	
	// CRUD
	const CRUD_CREATE 	= 'create';
	const CRUD_READ 	= 'read';
	const CRUD_UPDATE	= 'update';
	const CRUD_DELETE	= 'delete';
	
	// Order Status List in DB
	const ORDER_TOPUP												= 0;
	const ORDER_PROCESSING									= 1;
	const ORDER_ORDERED_FROM_SUPPLIER		= 2;
	const ORDER_RECEIVED											= 3;
	const ORDER_FOR_DELIVERY								= 4;
	const ORDER_DELIVERED										= 5;
	const ORDER_CANCELLED										= 6;
	const ORDER_BILLED												= 7;
	const ORDER_FORFEITED										= 8;
	const ORDER_ON_HOLD											= 9;
	
	// Stock Status
	const IN_STOCK = 1;
	const OUT_STOCK = 0;
	
	const PENDING = 0;
	const ACTIVATED = 1;
	
	// Approved
	const YES = 1;
	const NO = 0;
		
	// Table Name ( Merchant Product )
	const TABLE_NAME_MERCHANT_PRODUCT 		= 'merchant_product';

	// S3 Images Path
	const S3_MERCHANT_IMAGES_PATH 			= '//s3.amazonaws.com/sb-development-rep/img/merchant_product/';

	public static function getVoucherTypes() {
		return [
			self::NON_VOUCHER 					=> 'Non Voucher',
			self::PHYSICAL_VOUCHER 				=> 'Physical Voucher',
			self::SERVICE_VOUCHER				=> 'Service Voucher',
		];
	}

	public static function productDeliverySources() {
		return [
			self::SOURCE_DEFAULT								=> 'Default',
			self::SOURCE_DELIVERY_MATRIX						=> 'Delivery Matrix',
			self::SOURCE_MERCHANT_PICKUP_BRANCHES				=> 'Merchant Pickup Branches',
			self::SOURCE_MERCHANT_SERVICE_REDEMPTION_BRANCHES	=> 'Merchant Service Redemption Branches',
			self::SOURCE_MERCHANT_HOME_DELIVERY_AREAS			=> 'Home Delivery Areas'
		];
	}

	public static function productDeliveryOptions() {
		return [
			self::PRODUCT_DELIVERY_BRANCH_PICK_UP				=> 'Branch Pick-Up',
			self::PRODUCT_DELIVERY_BRANCH_SERVICE_REDEMPTION	=> 'Branch Service Redemption',
			self::PRODUCT_DELIVERY_HOME_DELIVERY				=> 'Home Delivery',
			self::PRODUCT_DELIVERY_OFFICE_DELIVERY				=> 'Office Delivery',
			self::PRODUCT_DELIVERY_BENEFITS_FAIR				=> 'Benefits Fair',
			self::PRODUCT_DELIVERY_REWARDS_FAIR					=> 'Rewards Fair'
		];
	}
	
	public static function getFulfillmentTypes() {
		return [
			self::TYPE_HOME_DELIVERY 		=> 'HOME DELIVERY',
			self::TYPE_BRANCH_REDEMPTION 	=> 'BRANCH REDEMPTION',
			self::TYPE_PICK_UP_BRANCH		=> 'BRANCH PICK-UP',
		];
	}
	
	public static function getProductTypes() {
		return [
			self::TYPE_DEFAULT 				=> 'Default',
			self::TYPE_TRAVEL_BUDDY 		=> 'Travel Buddy',
			self::TYPE_LOADING_BAY			=> 'Loading Bay',
			self::TYPE_E_CONSULTA			=> 'E-Consulta',
			self::TYPE_MOTOR				=> 'Motor',
			self::TYPE_MUTUAL_FUND			=> 'Mutual Fund',
			self::TYPE_UNILAB_PRESCRIPTION	=> 'Unilab Prescription',
			self::TYPE_INSURANCES			=> 'Insurances'
		];
	}
	
	public static function geBatchTypeUsers( $prettify = false ) {
		$status = [
			self::CHANGES_BATCH_TYPE_USER	=> 'System User',
			self::CHANGES_BATCH_TYPE_VENDOR	=> 'Merchant',
			self::CHANGES_BATCH_TYPE_CUSTOMER	=> 'Customer'	
		];
		
		if ( $prettify ) {
			return array_map(function( $val ) {
				return ucwords(str_replace('_', ' ', $val));
			}, $status);
		}
		
		return $status;		
	}	
	
	public static function getChangeStatuses( $prettify = false ) {
		$status = [
				self::CHANGES_CREATED	=> 'Created',
				self::CHANGES_PENDING	=> 'Pending',
				self::CHANGES_VALIDATED	=> 'Validated',
				self::CHANGES_APPROVED	=> 'Approved',				
			];
		
		if ( $prettify ) {
			return array_map(function( $val ) {
				return ucwords(str_replace('_', ' ', $val));
			}, $status);
		}
		
		return $status;		
	}
	
	public static function getUsersLevels( $prettify = false ) {

		$level = [
				self::USER_MANAGER	 => 'manager',
				self::USER_ASSOCIATE => 'associate'
		];
	
		if ( $prettify ) {
			return array_map(function( $val ) {
				return ucwords(str_replace('_', ' ', $val));
			}, $level);
		}
	
		return $level;
	}
	
	
	
	
	
	public static function getProductFieldList() {
		$productField = [
				self::PRODUCT_FIELD_CLASSIFICATION		=> ['Delivery Rule' => 'Size|SIZE_id', 'Format' => 'AH-0251402 | Delivery Rule | SMALL'],
				self::PRODUCT_FIELD_DESCRIPTION			=> ['Description' => 'Product|flexben_description', 'Format' => 'AH-0251402 | Description | <p>Description</p>'],
				self::PRODUCT_FIELD_BRAND				=> ['Brand Code' => 'Manufacturer|MANUFACTURER_id', 'Format' => 'AH-0251402 | Brand Code | BELO'],
				self::PRODUCT_FIELD_BENSTORE_PRICE		=> ['SRP' => 'Product|benstore_price', 'Format' => 'AH-0251402 | SRP | 200'],
				self::PRODUCT_FIELD_STATUS				=> ['Stock Status' => 'Product|stock_status', 'Format' => 'AH-0251402 | Stock Status | Instock'],
				self::PRODUCT_FIELD_CATEGORY			=> ['Sub Category Code' => 'Category|CATEGORY_id', 'Format' => 'AH-0251402 | Sub Category Code | 401'],
				self::PRODUCT_FIELD_REBATE				=> ['Rebate' => 'Product|rebate', 'Format' => 'AH-0251402 | Rebate | 100'],
				self::PRODUCT_FIELD_TAG					=> ['Tag' => 'Product|tag', 'Format' => 'AH-0251402 | Tag | adarna,story,books,kids,children,family,baby,kids,childrens books,gift'],
				self::PRODUCT_FIELD_UNTAG_BRANCH		=> ['Untag Company Branch' => 'CompanyBranch', 'Format' => 'AH-0251402 | Untag Company Branch | 247C'],
				self::PRODUCT_FIELD_TAG_BRANCH			=> ['Tag Company Branch' => 'CompanyBranch', 'Format' => 'AH-0251402 | Tag Company Branch | 247C'],
				self::PRODUCT_FIELD_DURATION			=> ['Duration' => 'Product|duration', 'Format' => 'AH-0251402 | Duration | 8/21/2015-12/31/2016'],
				self::PRODUCT_FIELD_IMAGE				=> ['Image' => 'Product|flexben_image', 'Format' => 'AH-0251402 | Image | A-AdlawniMario.jpg'],
				self::PRODUCT_FIELD_VOUCHER				=> ['Voucher' => 'Product|voucher', 'Format' => 'AH-0251402 | Voucher | Yes'],
				self::PRODUCT_FIELD_PRODUCT_NAME		=> ['Product Name' => 'Product|name', 'Format' => 'AH-0251402 | Product Name | The Little Girl in a Box'],
				self::PRODUCT_FIELD_WALLET				=> ['Tag Wallet' => 'ProductWallet|WALLET_code', 'Format' => 'AH-0251402 | Tag Wallet | FSA'],
				self::PRODUCT_FIELD_PRIORITY_SHIPPING	=> ['Priority Shipping' => 'Product|priority_shipping', 'Format' => 'AH-0251402 | Priority Shipping | Yes'],
				self::PRODUCT_FIELD_TRANSFER_PRICE		=> ['Merchant Transfer Price' => 'Vendor', 'Format' => 'AH-0251402 | Merchant Transfer Price | PTX|600']
		];
	
		return $productField;
	}
	
	public static function getStockStatus(){
		$param = [
				self::IN_STOCK	=> 'In-Stock',
				self::OUT_STOCK	=> 'Out-Stock'
		];
		return $param;
	}

	
	public static function getWallets() {
		$param = [
				self::FSA	=> 'Flex Wallet',
				self::HW	=> 'Health Wallet'
		];
		return $param;
	}
	
	
	
	public static function getYesNo(){
		$param = [
				self::YES	=> 'Yes',
				self::NO	=> 'No'
		];
		return $param;
	}

	public static function getActivated(){
		$param = [
				self::ACTIVATED	=> 'Activated',
				self::PENDING	=> 'Pending'
		];
		return $param;
	}
	

	public static function getApproved(){
		$param = [
				self::YES => 'Yes',
				self::NO => 'No'
		];
		return $param;
	}
	
	
	public static function getLinkFormat(){
		$param = [
				self::LINK_MAIN_CATEGORY => 'Main Category',
				self::LINK_SUB_CATEGORY => 'Category'
		];
		return $param;
	}


	public static function getShippingType() {
		$shipping_type = [
				self::SHIPPING_TYPE_NO_DELIVERY 				=> 'No Delivery',
				self::SHIPPING_TYPE_SUPPLIER_CLIENT_OFFICE		=> 'Client Office',
				self::SHIPPING_TYPE_SUPPLIER_PICKUP				=> 'Supplier Pickup',
				self::SHIPPING_TYPE_OFFSITE_WAREHOUSE_DELIVERY	=> 'Offsite Warehouse',
				self::SHIPPING_TYPE_SUPPLIER_DELIVERY			=> 'Supplier Delivery',
				self::SHIPPING_TYPE_STORM_OFFICE_PICKUP			=> 'STORM Office Pickup'
		];
		return $shipping_type;
	}
	
	/**
	 * @author Bebe
	 * 10/15/15 09:25AM
	 */
	public static function getTransferPriceStatus(){

		$transfer_price_list = [
			self::TRANSFER_PRICE_REJECTED	=> 'Rejected',
			self::TRANSFER_PRICE_PENDING	=> 'Pending',
			self::TRANSFER_PRICE_APPROVED	=> 'Approved',
			self::TRANSFER_PRICE_ARCHIVED	=> 'Archived',
		];

		return $transfer_price_list;
	}


	/**
	 * @author Bebe
	 * 10/15/15 09:25AM
	 */
	public static function getProductQuantityStatus(){

		$transfer_price_list = [
			self::PRODUCT_QUANTITY_REJECTED		=> 'Rejected',
			self::PRODUCT_QUANTITY_PENDING		=> 'Pending',
			self::PRODUCT_QUANTITY_APPROVED	=> 'Approved',
			self::PRODUCT_QUANTITY_ARCHIVED		=> 'Archived',
		];

		return $transfer_price_list;
	}
	
	public static function getExportTypes(){

		$export_types = [

			self::EXPORT_PRODUCT	=> ['name'				=> 'Product',
										'fields_available'	=> 'name|code|brand|merchant|category|price|transfer_price|quantity|stock_status',
										'filter_available'	=> ['stock_status' => 'All:all|Yes:1|No:0', 'activated' => 'All:all|Yes:1|No:0'] ],

			self::EXPORT_MERCHANT	=> ['name'				=> 'Merchant',
										'fields_available'	=> 'name|code',
										'filter_available'	=> ['name' => 'nice'] ],

			self::EXPORT_BRAND		=> ['name'				=> 'Brand',
										'fields_available'	=> 'name|code',
										'filter_available'	=> ['name' => 'awtsu'] ]
		];

		return $export_types;
	}

	/**
	 * @author Bebe
	 * 10/19/15 02:53PM
	 */
	public static function getChangesHistoryStatus(){

		$changes_status_list = [
			self::CHANGES_CREATED		=> 'Created',
			self::CHANGES_PENDING		=> 'Pending',
			self::CHANGES_VALIDATED		=> 'Validated',
			self::CHANGES_APPROVED		=> 'Approved',
			self::CHANGES_UPDATED		=> 'Updated',
			self::CHANGES_DELETED		=> 'Deleted',
			self::CHANGES_REJECTED		=> 'Rejected',
		];

		return $changes_status_list;
	}
	
}