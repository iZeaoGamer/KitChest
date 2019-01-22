<?php

namespace KitChest\Command;

use KitChest\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class KitChestGiveCommand extends PluginCommand{

    public function __construct(Main $plugin){
        parent::__construct("kitgive", $plugin);
        $this->setAliases(["kitgive"]);
        $this->setPermission("kit.give");
        $this->setDescription("KitChest Give Command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(TextFormat::RED . "Use this command in-game");
        }
        if(!$sender->hasPermission("kit.give")){
            $sender->sendMessage(TextFormat::RED . "You do not have permission to use this command.");
        }
        if(!isset($args[1])){
            $sender->sendMessage("Usage: /kitgive <kit name> <player>");
            return false;
        }
        $player = $args[1];
        if (!($player instanceof Player)) {
            $sender->sendMessage(TextFormat::RED . "The player $args[1] is either not online or does not exist.");
            return true;
        }
        if($args[0] === "test"){
             $player = $args[1];
            $inv = $args[1]->getInventory();
            $inv->addItem(Item::get(Item::CHEST, 10, 1)->setCustomName(TextFormat::GREEN . "Test Kit"));
            if($player instanceof Player){
            $sender->sendMessage(TextFormat::GREEN . "You have given $args[1] a $args[0] kit!");
                $senderName = $sender->getName();
                $player->sendMessage(TextFormat::GREEN . "You have been given the $args[1] kit by $senderName!);
        }
        return true;
    }
}
