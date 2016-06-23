<?php

class Magmi_FullIndexer extends Magmi_GeneralImportPlugin
{
	protected $_mdh;

	public function getPluginInfo()
	{
		return array(
			"name" => "ECInternet Full Indexer",
			"author" => "Randy Esplin",
			"version" => "0.0.1",
			"url"=> "http://www.ecinternet.com"
		);
	}

	static public function getCategory()
	{
		return "EC Internet";
	}

	public function afterImport()
	{
		$tstart = microtime(true);

		$this->log("Running FullIndexer plugin...", "info");
		$out = $this->_mdh->exec_cmd("php shell/indexer.php", "--reindexall", $this->_mdh->getMagentoDir());
		$this->log($out, "info");

		$tend = microtime(true);
		$this->log("Done in " . round($tend - $tstart, 2) . " seconds.", "info");

		if (Magmi_StateManager::getState() == "canceled")
		{
			exit();
		}

		return true;
	}

	public function initialize($params)
	{
		$this->log("Initialize FullIndexer...", "info");

		$magdir = Magmi_Config::getInstance()->getMagentoDir();
		$this->_mdh = MagentoDirHandlerFactory::getInstance()->getHandler($magdir);
	}
}