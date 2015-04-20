<?php
namespace wcf\data\user\group;
use wcf\system\cache\builder\PluginStoreVerificationGroupsCacheBuilder; 
use wcf\system\SingletonFactory; 

/**
 * Manages the pluginstore groups cache. 
 * 
 * @author 	Joshua Rüsweg
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	system.dashboard.box
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationGroupsCache extends SingletonFactory {
	
	/**
	 * list of cached groups
	 * @var	array<\wcf\data\user\group\UserGroup>
	 */
	protected $groups = array();
	
	/**
	 * @see	wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		$this->groups = PluginStoreVerificationGroupsCacheBuilder::getInstance()->getData();
	}
	
	/**
	 * Returns all groups.
	 * 
	 * @return	array<mixed>
	 */
	public function getGroups() {
		return $this->groups;
	}
	
	/**
	 * Returns all groups which are aviable for the current user.
	 * 
	 * @return	array<mixed>
	 */
	public function getAviableGroups() {
		$groups = array(); 
		
		foreach ($this->getGroups() as $groupID => $group) {
			if (!UserGroup::getGroupByID($groupID)->isMember()) {
				$groups[$groupID] = $group; 
			}
		}
		
		return $groups; 
	}
}