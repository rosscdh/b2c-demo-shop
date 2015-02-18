<?php

namespace Pyz\Zed\Acl\Business\Internal;

use ProjectA\Zed\Acl\Business\Internal\Install as CoreInstall;

/**
 * @property \ProjectA\Deprecated\Acl\Business\AclFactory $factory
 */
class Install extends CoreInstall
{

    const PAYONE_USERNAME = 'payone';

    public function install()
    {
        parent::install();
        return;
        $this->addPayoneResourceToGuestRole();
    }

    protected function addPayoneResourceToGuestRole()
    {
        $payoneGroup = $this->createDefaultGroup('Payment Transaction');
        $this->createDefaultResource('/payone\/transaction-status\/set\/*/', $payoneGroup);

        $guest = \ProjectA\Zed\Acl\Persistence\Propel\PacAclRoleQuery::create()->filterByName('Guest')->findOne();
        $this->createDefaultGroupPrivileges($guest, $payoneGroup);
    }
}