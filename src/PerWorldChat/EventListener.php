<?php

/*
 * PerWorldChat (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 04/01/2018 04:16 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */

namespace PerWorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class EventListener extends PluginBase implements Listener {
	
	public function __construct(PerWorldChat $plugin){
		$this->plugin = $plugin;
	}
	
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		$cfg = $this->plugin->getConfig()->getAll();
		//Check if chat is disabled
		if($this->plugin->isChatDisabled($player->getLevel()->getName())){
		    //Check if log-chat-disabled is enabled
		    if($cfg["log-chat-disabled"] == true){
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