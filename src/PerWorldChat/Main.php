<?php

/*
 * PerWorldChat (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 02:04 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */

namespace PerWorldChat;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{
	
	//About Plugin Const
	const PRODUCER = "EvolSoft";
	const VERSION = "1.1";
	const MAIN_WEBSITE = "http://www.evolsoft.tk";
	//Other Const
	//Prefix
	const PREFIX = "&a[&bPer&cWorld&dChat&a] ";
	
	public $cfg;
	
	public function translateColors($symbol, $message){
		
		$message = str_replace($symbol."0", TextFormat::BLACK, $message);
		$message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
		$message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
		$message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
		$message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
		$message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
		$message = str_replace($symbol."6", TextFormat::GOLD, $message);
		$message = str_replace($symbol."7", TextFormat::GRAY, $message);
		$message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
		$message = str_replace($symbol."9", TextFormat::BLUE, $message);
		$message = str_replace($symbol."a", TextFormat::GREEN, $message);
		$message = str_replace($symbol."b", TextFormat::AQUA, $message);
		$message = str_replace($symbol."c", TextFormat::RED, $message);
		$message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
		$message = str_replace($symbol."e", TextFormat::YELLOW, $message);
		$message = str_replace($symbol."f", TextFormat::WHITE, $message);
		
		$message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
		$message = str_replace($symbol."l", TextFormat::BOLD, $message);
		$message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
		$message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
		$message = str_replace($symbol."o", TextFormat::ITALIC, $message);
		$message = str_replace($symbol."r", TextFormat::RESET, $message);
		
		return $message;
	}
	
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
        $this->logger = Server::getInstance()->getLogger();
        $this->logger->info($this->translateColors("&", Main::PREFIX . "&ePerWorldChat &dv" . Main::VERSION . " &edeveloped by&d " . Main::PRODUCER));
        $this->logger->info($this->translateColors("&", Main::PREFIX . "&eWebsite &d" . Main::MAIN_WEBSITE));
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    
    public function getFormat(Player $player, $level, $message){
    	$tmp = $this->getConfig()->getAll();
    	$format = $tmp["chat-format"];
    	$format = str_replace("{MESSAGE}", $message, $format);
    	$format = str_replace("{PLAYER}", $player->getName(), $format);
    	$format = str_replace("{WORLD}", $level, $format);
    	return $format;
    }
    
    public function SendLevelMessage($level, $message){
    	$tmp = $this->getConfig()->getAll();
    	$level = strtolower($level);
    	if($this->getServer()->getLevelByName($level)){
    		foreach($this->getServer()->getLevelByName($level)->getPlayers() as $players){
    			$players->sendMessage($this->translateColors("&", $message));
    		}
    		//Check log-on-console
    		if($tmp["log-on-console"] == true){
    			Server::getInstance()->getLogger()->info($this->translateColors("&", $message));
    		}
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function isChatDisabled($level){
    	$level = strtolower($level);
    	$tmp = $this->getConfig()->getAll();
    	$ltmp = array();
    		for($i = 0; $i <= count($tmp["disabled-in-worlds"])-1; $i++){
    			$name = strtolower($tmp["disabled-in-worlds"][$i]);
    			$ltmp[$name] = "";
    		}
    	return isset($ltmp[$level]);
    }
}
?>
