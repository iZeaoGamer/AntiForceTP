<?php

namespace Angel\AntiTP;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;


use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{
  
  public $tped = [];
  
  public $antiTP = [];
  public $blocked = [];
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    
    $cmds = [
      "/tp",
      "./tp",
      "/god",
      "./god",
        ];
        foreach($cmds as $cmd){
            $this->antiTP[$cmd]=1;
        }
    
        $cmds = [
      "/sethome",
      "./sethome",
        ];
        foreach($cmds as $cmd){
            $this->blocked[$cmd]=1;
        }
  }
  
  public function antiTP(PlayerCommandPreprocessEvent $ev){
    $command = strtolower(explode(" ", $ev->getMessage())[0]);
    if($ev->getPlayer()->isOp() or $ev->getPlayer()->hasPermission("pocketmine.command.teleport")){
      if(isset($this->antiTP[$command])){
        $ev->getPlayer()->setGamemode(4);
        $this->tped[strtolower($ev->getPlayer()->getName())] = strtolower($ev->getPlayer()->getName());
      }
      // cancels event if force tped and run blocked force tp command
      if(isset($this->tped[strtolower($ev->getPlayer()->getName())])){
        if(isset($this->blocked[$command])){
          $ev->setCancelled(true);
          $ev->getPlayer()->sendMessage("This Command is Disabled Since You Force Tped!");
        }
      }
      
      if($command == "/spawn" || $command == "./spawn"){
        unset($this->tped[strtolower($ev->getPlayer()->getName())]);
      }
    }
  }
  
  public function entityTP(\pocketmine\event\entity\EntityTeleportEvent $ev){
    $pos = new Position(10000, 10000, 10000);
    if($ev->getTO() == $pos){
      $p = $ev->getEntity();
      if($p instanceof Player){
        $ev->setCancelled(true);
        $p->sendMessage("You cant tp that far away bro!);
        }
}
}
}
        
          
      
      
          
