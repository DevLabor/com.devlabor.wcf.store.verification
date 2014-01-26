<?php
namespace wcf\system\dashboard\box;
use wcf\data\user\group\UserGroupList;
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
		$availableGroups = array();
		$groupList = new UserGroupList();
		$groupList->readObjects();

		foreach ($groupList->getObjects() as $group) {
			if ($group->getGroupOption('pluginStoreVerification') && !$group->isMember()) {
				$availableGroups[$group->groupID] = $group->getGroupOption('pluginStorePackageName');
			}
		}

		return (WCF::getUser()->userID && !empty($availableGroups));
	}
}
