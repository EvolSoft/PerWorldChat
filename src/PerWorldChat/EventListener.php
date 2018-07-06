<?php

/*
 * PerWorldChat v1.8 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */


namespace PerWorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class EventListener implements Listener {
	
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
		        $player->sendMessage(TextFormat::colorize(PerWorldChat::PREFIX . "&cChat is disabled on this world"));
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