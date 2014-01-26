<?php
namespace wcf\form;
use wcf\data\user\group\UserGroup;
use wcf\data\user\group\UserGroupList;
use wcf\data\user\UserEditor;
use wcf\system\exception\HTTPUnauthorizedException;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\SystemException;
use wcf\system\exception\UserInputException;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\HeaderUtil;
use wcf\util\HTTPRequest;
use wcf\util\StringUtil;

/**
 * Verification Form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	GNU Lesser General Public License, version 2.1 <http://opensource.org/licenses/LGPL-2.1>
 * @package	com.devlabor.wcf.store.verification
 * @subpackage	form
 * @category	WoltLab Community Framework
 */
class PluginStoreVerificationForm extends AbstractForm {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.header.menu.store.verification';

	/**
	 * selected group id
	 * @var    integer
	 */
	public $groupID = 0;

	/**
	 * store username
	 * @var    string
	 */
	public $username = '';

	/**
	 * store password
	 * @var    string
	 */
	public $password = '';

	/**
	 * list of groups
	 * @var    array
	 */
	public $availableGroups = array();

	/**
	 * group object
	 * @var    null
	 */
	public $group = null;

	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_GET['id'])) $this->groupID = intval($_GET['id']);
	}

	/**
	 * @see	\wcf\form\IForm::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();

		if (isset($_POST['groupID'])) $this->groupID = intval($_POST['groupID']);
		if (isset($_POST['username'])) $this->username = StringUtil::trim($_POST['username']);
		if (isset($_POST['password'])) $this->password = StringUtil::trim($_POST['password']);

		$this->group = new UserGroup($this->groupID);
		if ($this->group === null) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		$this->readGroups();
	}

	/**
	 * Reads groups.
	 */
	protected function readGroups() {
		$this->availableGroups = array();

		$groupList = new UserGroupList();
		$groupList->readObjects();

		foreach ($groupList->getObjects() as $group) {
			if ($group->getGroupOption('pluginStoreVerification') && !$group->isMember()) {
				$this->availableGroups[$group->groupID] = $group->getGroupOption('pluginStorePackageName');
			}
		}
	}

	/**
	 * @see	\wcf\form\IForm::validate()
	 */
	public function validate() {
		parent::validate();

		$this->readGroups();

		// groupID
		if (!in_array($this->groupID, array_keys($this->availableGroups))) {
			throw new UserInputException('groupID');
		}

		// username
		if (empty($this->username)) {
			throw new UserInputException('username');
		}

		// password
		if (empty($this->password)) {
			throw new UserInputException('password');
		}

		// authenticate
		$url = $this->group->getGroupOption('pluginStoreURL') . '?packageName=' . $this->group->getGroupOption('pluginStoreIdentifier');

		// send request
		try {
			$request = new HTTPRequest($url, array(
				'auth' => array(
					'username' => $this->username,
					'password' => $this->password
				)
			));
			$request->execute();
		}
		catch (HTTPUnauthorizedException $e) {
			throw new UserInputException('username', 'authFailed');
		}
		catch (SystemException $e) {
			throw new UserInputException('groupID', 'unknownError');
		}
	}

	/**
	 * @see	\wcf\form\IForm::save()
	 */
	public function save() {
		parent::save();

		$userEditor = new UserEditor(WCF::getUser());
		$userEditor->addToGroup($this->group->groupID);

		$this->saved();

		$redirectURL = $this->group->getGroupOption('pluginStoreRedirectURL');
		if (empty($redirectURL)) $redirectURL = LinkHandler::getInstance()->getLink('');

		// forward to index
		HeaderUtil::delayedRedirect($redirectURL, WCF::getLanguage()->get('wcf.store.verification.redirect.message'));
		exit;
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'availableGroups' => $this->availableGroups,
			'groupID' => $this->groupID,
			'username' => $this->username,
			'password' => $this->password
		));
	}

	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function show() {
		// check permission
		if (!WCF::getUser()->userID) {
			throw new PermissionDeniedException();
		}

		parent::show();
	}
}
