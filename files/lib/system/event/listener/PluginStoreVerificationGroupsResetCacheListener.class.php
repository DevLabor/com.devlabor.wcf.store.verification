<?php
namespace wcf\system\event\listener;
use wcf\system\cache\builder\PluginStoreVerificationGroupsCacheBuilder; 

/**
 * Eventlistener to reset a cache. 
 * 
 * @author	Joshua Rüsweg
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	system.dashboard.box
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationGroupsResetCacheListener implements IParameterizedEventListener {

	/**
	 * @see \wcf\system\event\listener\IParameterizedEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {
		$events = array('create', 'update', 'delete', 'copy');
		
		if (in_array($eventObj->getActionName() , $events)) {
			PluginStoreVerificationGroupsCacheBuilder::getInstance()->reset(); 
		}
	}

}
