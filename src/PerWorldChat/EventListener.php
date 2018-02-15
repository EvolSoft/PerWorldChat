<?php

/*
 * PerWorldChat (v1.5) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 15/02/2018 02:47 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */

namespace PerWorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class EventListener extends PluginBase implements Listener {
	
    /** @var PerWorldChat */
    private $plugin;
    
	public function __construct(PerWorldChat $plugin){
		$this->plugin = $plugin;
	}
	
	/**
	 * @param PlayerChatEvent $event
	 */
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		if($this->plugin->isChatDisabled($player->getLevel()->getName())){
		    if($this->plugin->cfg["log-chat-disabled"]){
		        $player->sendMessage($this->plugin->translateColors("&", PerWorldChat::PREFIX . "&cChat is disabled on this world"));
		    }
		    $event->setCancelled(true);
		}
		$recipients = $event->getRecipients();
		foreach($recipients as $key => $recipient){
			if($recipient instanceof Player){
				if($recipient->getLevel() != $player->getLevel()){
					unset($recipients[$key]);
				}
			}
		}
		$event->setRecipients($recipients);
	}
}