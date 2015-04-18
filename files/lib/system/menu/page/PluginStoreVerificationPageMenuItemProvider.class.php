<?php
namespace wcf\system\menu\page; 
use wcf\data\user\group\PluginStoreVerificationGroupsCache; 
use wcf\system\menu\page\DefaultPageMenuItemProvider; 
use wcf\system\WCF; 

/**
 * PageMenuItemProvider for the verification page.
 * 
 * @author 	Joshua Rüsweg
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	system.menu.page
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationPageMenuItemProvider extends DefaultPageMenuItemProvider {
	
	/**
	 * Hides the button when there are no active items
	 * 
	 * @see	\wcf\system\menu\page\PageMenuItemProvider::isVisible()
	 */
	public function isVisible() {
		// hide item for guests
		if (!WCF::getUser()->userID) {
			return false; 
                }
		
		// hide menu item, if we haven't aviable items
		if (!count(PluginStoreVerificationGroupsCache::getInstance()->getAviableGroups())) {
			return false; 
		}
		
		return true; 
	}
}