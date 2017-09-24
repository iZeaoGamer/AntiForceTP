<?php

namespace Angel\AntiTP;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;


use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{
  
  public $tper = [];
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function antiTP(PlayerCommandPreprocessEvent $ev){
    $command = strtolower(explode(" ", $ev->getMessage())[0]);
    if($ev->getPlayer()->isOp() or $ev->getPlayer()->hasPermission("pocketmine.command.teleport")){
      if($command == "./tp" || $command == "/tp"){
        $ev->getPlayer()->setGamemode(4);
        $this->tper[strtolower($ev->getPlayer()->getName())] = strtolower($ev->getPlayer()->getName());
      }
      // cancels event if force tped and run blocked force tp command
      if(isset($this->tper[strtolower($ev->getPlayer()->getName())])){
        if($command == "/sethome" || $command == "./sethome"){
          $ev->setCancelled(true);
          $ev->getPlayer()->sendMessage("This Command is Disabled Since You Force Tped! , Remove this by tping to spawn!");
        }
      }
      
      if($command == "/spawn" || $command == "./spawn"){
        unset($this->tper[strtolower($ev->getPlayer()->getName())]);
        $ev->getPlayer()->sendMessage("Forced TPed removed!");
        $ev->getPlayer()->setGamemode(0);
      }
    }
  }
}
        
          
      
      
          
