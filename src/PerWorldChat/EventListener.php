<?php

/*
 * PerWorldChat (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 01/01/2015 05:32 PM (UTC)
 * Copyright & License: (C) 2014-2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldChat/blob/master/LICENSE)
 */

namespace PerWorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class EventListener extends PluginBase implements Listener{
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		$this->cfg = $this->plugin->getConfig()->getAll();
		$recipients = $event->getRecipients();
		for($i = 0; $i < count($recipients); $i++){
			$levelplayers = $recipients[$i];
			if($levelplayers instanceof Player){
				if($player->getLevel() != $levelplayers->getLevel()){
					$message[] = $i;
					foreach($message as $messages){
						unset($recipients[$i]);
						$event->setRecipients(array_values($recipients));
					}
				}
			}
		}
		//Checking Chat Disabled
		if($this->plugin->isChatDisabled($player->getLevel()->getName())){
		    //Check if log-chat-disabled is enabled
			if($this->cfg["log-chat-disabled"] == true){
				$player->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cChat is disabled in this world"));
			}
			$event->setCancelled(true);
		}
	}
}
?>
