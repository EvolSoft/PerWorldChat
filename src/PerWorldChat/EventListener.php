<?php

/*
 * PerWorldChat (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 02:05 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
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
		$message = $event->getMessage();
		$message = $this->plugin->getFormat($player, $player->getLevel()->getName(), $message);
		//Check if the chat is disabled in the world
		if($this->plugin->isChatDisabled($player->getLevel()->getName())){
			//Check if log-chat-disabled is enabled
			if($this->cfg["log-chat-disabled"] == true){
				$player->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cChat is disabled in this world"));
			}
			$event->setCancelled(true);
		}else{
			$this->plugin->SendLevelMessage($player->getLevel()->getName(), $message);
			$event->setCancelled(true);
		}
	}

}
?>
