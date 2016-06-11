<?php
error_reporting(E_ALL); ini_set('display_errors', 1); 

final class MySQLiDriver {
	private $connection;
	
	public function __construct($hostname, $username, $password, $database) {
		$this->connection = new mysqli($hostname, $username, $password, $database);
		
		if(mysqli_connect_error()) {
			exit('Error: Could not make a database connection using ' . $username . '@' . $hostname . '<br />Error: ' . $this->connection->connect_error . '<br />Error No: ' . $this->connection->connect_errno);
		}
		
		$this->connection->query("SET NAMES 'utf8'");
		$this->connection->query("SET CHARACTER SET utf8");
		$this->connection->query("SET CHARACTER_SET_CONNECTION=utf8");
		$this->connection->query("SET SQL_MODE = ''");
		$this->connection->query("SET time_zone = '" . date('P') . "'");
		
  	}
		
  	public function query($sql) {
		$object = $this->connection->query($sql);

		if ($object) {
			if (is_object($object)) {
				$i = 0;

				$data = array();

				while ($result = $object->fetch_assoc()) {
					$data[$i] = $result;
					$i++;
				}

				$object->free();

				$query = new stdClass();
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows = $i;

				unset($data);

				return $query;	
    		} else {
				return TRUE;
			}
		} else {
      		exit('Error: ' . $this->connection->error . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
    	}
  	}
	
	public function escape($value) {
		return $this->connection->real_escape_string($value);
	}
	
  	public function countAffected() {
    	return $this->connection->affected_rows;
  	}

  	public function getLastId() {
    	return $this->connection->insert_id;
  	}	
	
	public function __destruct() {
		$this->connection->close();
	}
}

function debug($data) {
	echo "<pre>";
	var_dump($data);
	exit;
}

list($hostname, $username, $password, $database) = array('prod.c3hpuypcrb8r.ap-southeast-1.rds.amazonaws.com', 'prod', 'BH1QY32X7tSG', 'store');

$db_store =  new MySQLiDriver($hostname, $username, $password, $database);

// PRODUCT PRICE CHECKER
$products = $db_store->query("INSERT INTO `logs` (`name`, `code`, `type`, `remarks`, `expected_result`, `invalid_result`)
SELECT products.`name`, products.`code`, 'Product Price Checker', '', products.`price`, PRODUCT_price
FROM `company_products`
INNER JOIN `products` ON products.id = company_products.`PRODUCT_id` 
WHERE PRODUCT_price > 0
AND products.`stock_status` = 1
AND NOW() BETWEEN products.`available_from` AND products.`available_to`
AND BRANCH_id <> 'storm'
HAVING (( PRODUCT_price / products.price ) * 100) < 90");

// PRODUCT QUANTITY CHECKER
$products = $db_store->query("INSERT INTO `logs` (`name`, `code`, `type`, `remarks`, `expected_result`, `invalid_result`)
SELECT products.`name`, products.`code`, 'Product Quantity Checker', '',
	0,
	(SELECT SUM(`quantity`) FROM `product_quantities` WHERE PRODUCT_id = products.id) AS `quantity`
FROM products
HAVING quantity < 0");

// WALLETS CHECKER
$db_store->query("INSERT INTO `store`.`logs` (`name`, `code`, `type`, `remarks`, `expected_result`, `invalid_result`)
SELECT USER_id, USER_id, 'Negative Wallets', '', 0, SUM(`points`) AS `available`
FROM `wallets`.`transactions`
GROUP BY USER_id
HAVING available < 0");

copy('/tmp/flexben.sql', '/tmp/flexben/flexben-' . date("Y-m-d-h-i-A") . '.sql');
copy('/tmp/store.sql', '/tmp/store/store-' . date("Y-m-d-h-i-A") . '.sql');
copy('/tmp/accounts.sql', '/tmp/accounts/accounts-' . date("Y-m-d-h-i-A") . '.sql');
copy('/tmp/wallets.sql', '/tmp/wallets/wallets-' . date("Y-m-d-h-i-A") . '.sql');
copy('/tmp/oauth2.sql', '/tmp/oauth2/oauth2-' . date("Y-m-d-h-i-A") . '.sql');

/*$store_dump = exec("sudo mysqldump --databases flexben -h prod.c3hpuypcrb8r.ap-southeast-1.rds.amazonaws.com -u prod -P 3306 -p'BH1QY32X7tSG' > flexben.sql");

debug($store_dump);

/*$store_import = shell_exec("mysql -uroot -p store" . date("Ymdhis") . " < store.sql");

list($hostname, $username, $password, $database) = array('localhost', 'root', '', 'store');

$db =  new MySQLiDriver($hostname, $username, $password, $database);

$unusal_prices = $db->query("SELECT company_products.*, ( PRODUCT_price / products.price ) * 10 AS `percentage`
FROM `company_products`
INNER JOIN `products` ON products.id = company_products.`PRODUCT_id` 
WHERE PRODUCT_price > 0
AND products.`stock_status` = 1
AND NOW() BETWEEN products.`available_from` AND products.`available_to`
HAVING percentage < 10");*/


?>
