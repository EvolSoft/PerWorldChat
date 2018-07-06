<?php

/*
 * PerWorldChat v1.8 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */

namespace PerWorldChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PerWorldChat extends PluginBase {
	
    /** @var string */
	const PREFIX = "&a[&bPer&cWorld&dChat&a] ";
	
	/** @var array */
	public $cfg;
	
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    
    /**
     * Check if chat is disabled on the specified world
     * 
     * @param string
     * 
     * @return bool
     */
    public function isChatDisabled($level) : bool {
    	foreach($this->cfg["disabled-in-worlds"] as $item){
    	    if(strcasecmp($item, $level) == 0){
    	        return true;
    	    }
    	}
    	return false;
    }
}