<?php
namespace friscowz\hc\enchants;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;

use friscowz\hc\Myriad;

class SilkTouch extends VanillaEnchant implements Listener{

    public function __construct(Myriad $plugin){
        $plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    }
	
	/*
	 * @void onBreak
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 * ignoreCancelled true
	 */
	
	public function onBreak(BlockBreakEvent $event): void{
	    $item = $event->getItem();
	    $block = $event->getBlock();
	    if($item->hasEnchantment(Enchantment::SILK_TOUCH) and $block->getId() !== 52){
		   $drops = [];
		   foreach($event->getDrops() as $drop){
		      if($drop->getId() == $block->getId() and $drop->getDamage() == $block->getDamage()){
		        $drops[] = $drop;
		      }else{
		       $it = Item::get($block->getId(), $block->getDamage(), 1);
		        $drops[] = $it;
		      }
		   }
		   $event->setDrops($drops);
		}
	}
}