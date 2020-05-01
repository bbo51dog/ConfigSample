<?php

namespace bbo51dog\config;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

    private $join;

    private $quit;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $config = new Config($this->getDataFolder().'Config.yml', Config::YAML, [
            'join' => '%nameさんがログインしました',
            'quit' => '%nameさんがログアウトしました',
        ]);
        $this->join = $config->get('join');
        $this->quit = $config->get('quit');
    }

    public function onJoin(PlayerJoinEvent $event){
        $name = $event->getPlayer()->getName();
        $message = str_replace('%name', $name, $this->join);
        $event->setJoinMessage($message);
    }

    public function onQuit(PlayerQuitEvent $event){
        $name = $event->getPlayer()->getName();
        $message = str_replace('%name', $name, $this->quit);
        $event->setQuitMessage($message);
    }
}