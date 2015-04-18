<?php
namespace wcf\system\dashboard\box;
use wcf\data\user\group\PluginStoreVerificationGroupsCache; 
use wcf\system\WCF;

/**
 * DashboardBox for WoltLab Plugin-Store Verification.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	system.dashboard.box
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationSidebarDashboardBox extends AbstractSidebarDashboardBox {
	/**
	 * @see	\wcf\system\dashboard\box\AbstractContentDashboardBox::$templateName
	 */
	public $templateName = 'dashboardBoxPluginStoreVerificationSidebar';

	/**
	 * @see	\wcf\system\dashboard\box\AbstractContentDashboardBox::render()
	 */
	protected function render() {
		if (!MODULE_PLUGIN_STORE_VERIFICATION) {
			return '';
		}
		
		$availableGroups = PluginStoreVerificationGroupsCache::getInstance()->getAviableGroups(); 

		return (WCF::getUser()->userID && !empty($availableGroups));
	}
}
