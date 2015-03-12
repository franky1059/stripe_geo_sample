<?php




class App {

	public $_layoutscript = 'base';

	public $request;

	public $action_data = array();


	public function __construct($request=array())
	{
		$this->request = $request;

	}


	public function process_action()
	{
		$action_name = '';
		if(isset($this->request['action'])) {
			$action_name = $this->request['action'];
		} else {
			$action_name = 'index';
		}
		$action_function_name = 'action_'.$action_name;
		$this->$action_function_name();
		$this->action_data['view_content'] = $this->get_view($action_name);
	}


	public function get_view( $view_path, $args = array() ){
		$args = array_merge($this->action_data, $args);
		extract( $args );
		unset( $args );

		ob_start();
		require ABSPATH.'/view/template/'.$view_path.'.php';
		return ob_get_clean();
	}


	public function display( $template_path = '', $args = array() ){
		$args['content'] = $this->action_data['view_content'];
		unset($this->action_data['view_content']);
		$args = array_merge($this->action_data, $args);
		extract( $args );
		unset( $args );

		ob_start();

		if($template_path) {
			$this->_layoutscript = $template_path;
		}

		require ABSPATH.'/view/layout/'.$this->_layoutscript.'.php';
		return ob_get_clean();
	}	



	// ACTIONS START TODO: put in subclasses later
	public function action_index()
	{
			// FM Debug
			if(defined('FM_DEBUG') && FM_DEBUG == true) 
			{
			echo "<pre>";
			print_r("File: ".__FILE__);
			echo "<br />";
			print_r("Line: ".__LINE__);
			echo "<br />";        
			print_r("Inside ".__METHOD__." of class ".__CLASS__); 
			echo "<br />\$_SERVER: <br />";
			print_r($_SERVER);
			echo "<br />";
			echo "<br />";
			echo "</pre>"; 
			//die();
			}	

			echo geoip_country_code_by_name($_SERVER['SERVER_ADDR']);

		$price_region = Prices::resolvePriceRegion($_REQUEST);
		$this->action_data['price'] = constant('Prices::'. $price_region);
	}


	public function action_purchase()
	{

		// TODO: put in separate payment handler class (for multiple processing providers)
		if(isset($_POST['stripeToken'])) {
			$token  = $_POST['stripeToken'];

			// TODO: put stripe version dir in config
			require_once(ABSPATH.'lib/stripe-php-2.1.1/vendor/autoload.php');

			\Stripe\Stripe::setApiKey(Conf::STRIPE_SECRET_KEY);

			$customer = \Stripe\Customer::create(array(
			  'email' => 'customer@example.com',
			  'card'  => $token
			));

			$msg = '';
			$capture_results = false;
			try {
			  $charge = \Stripe\Charge::create(array(
			      'customer' => $customer->id,
			      'amount'   => 5000,
			      'currency' => 'usd'
			  ));
			  $capture_results = $charge->id;
			} catch ( Exception $e ) {
				$e_body = $e->getJsonBody();
			  	$e_err  = $e_body['error'];		
				$msg = $e_err['message'];
				//return false;
			}		  

			// FM Debug
			if(defined('FM_DEBUG') && FM_DEBUG == true) 
			{
			echo "<pre>";
			print_r("File: ".__FILE__);
			echo "<br />";
			print_r("Line: ".__LINE__);
			echo "<br />";        
			print_r("Inside ".__METHOD__." of class ".__CLASS__); 
			echo "<br />\$charge: <br />";
			print_r($charge);
			echo "<br />\$msg: <br />";
			print_r($msg);
			echo "<br />";
			echo "<br />";
			echo "</pre>"; 
			//die();
			}		  

			if($capture_results === false) {
				header("Location: " .'index.php?action=purchaseresultsfail' ) ;
			} else {
				$this->recordCharge($charge);
				header("Location: " .'index.php?action=purchaseresultspass&orderid='.$charge->id ) ;	
			}
		}
	}

	private function recordCharge($charge = null)
	{
		// TODO: put in charge record handler (for multiple storage mediums)
		if($charge) {
			require_once(ABSPATH.'lib/parsecsv-for-php-master/parsecsv.lib.php');

			$csv_path = Conf::DATA_PATH.'/_data.csv';
			$csv = new parseCSV();
			$csv->save($csv_path, array(
				array(
					$charge->created, 
					$charge->id, 
					$charge->customer, 
					$charge->amount, 
					$charge->currency)), 
				true);
			unset($csv);
		}
	}


	public function action_purchaseresultspass()
	{
		$this->action_data['orderid'] = $_REQUEST['orderid'];
	}


	public function action_purchaseresultsfail()
	{
		// display error with link back to home
	}


}