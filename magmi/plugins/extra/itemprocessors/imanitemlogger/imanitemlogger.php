<?php
/**
 * Class IManItemLogger
 * @author Randy Esplin
 *
 * Returns product information which is used in IMan Magento Connector.
*/ 
class Magmi_IManItemLogger extends Magmi_ItemProcessor
{
	private $response = "";
	private $count = 0;
	
    public function getPluginInfo()
    {
        return array(
            "name" => "IMan Item Logger",
            "author" => "ECInternet",
            "version" => "0.0.1",
            "url"=> "http://www.ecinternet.com"
        );
    }
	
    static public function getCategory()
    {
        return "EC Internet";
    }

    public function getPluginParams($params)
    {
    }

	// init function
	// Begin JSON response
    public function initialize($params)
    {
		//$this->log("Initialize();");
    }

	public function log($data, $type = 'ecinternet', $useprefix = true)
    {
        $this->_caller_log($data, $type);
    }
	
	// Runs after each item is processed
	public function processItemAfterId(&$item,$params = null)
	{   
		if ($params != null)
		{
			$sku = $params['sku'];
			$pid = $params['product_id'];
			$new = ($params['new'] != 1) ? "0" : "1";
		
			$this->log("<Record><Sku>$sku</Sku><New>$new</New><Id>$pid</Id></Record>");
		}

		return true;
	}
	
	// Runs before each item is processed
	public function processItemBeforeId(&$item,$params = null)
	{
		return true;
	}

	// Not sure when this is called.
	// Doesn't appear to run "before import"
	public function beforeImport()
	{
		return true;
	}
	
	// Runs "after import"
	public function afterImport()
	{
		return true;
	}
}
