<?php
namespace wcf\system\cache\builder;
use wcf\data\user\group\UserGroupList; 
use wcf\system\cache\builder\AbstractCacheBuilder; 

/**
 * Caches the groups which have a verification. 
 * 
 * @author 	Joshua Rüswegg
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	system.dashboard.box
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationGroupsCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @see wcf\system\cache\AbstractCacheBuilder::rebuild()
	 */
	public function rebuild(array $parameters) {
		$availableGroups = array();
		$groupList = new UserGroupList();
		$groupList->readObjects();

		foreach ($groupList->getObjects() as $group) {
			if ($group->getGroupOption('pluginStoreVerification')) {
				$availableGroups[$group->groupID] = $group->getGroupOption('pluginStorePackageName');
			}
		}
		
		return $availableGroups; 
	}
}