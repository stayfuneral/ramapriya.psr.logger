<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Ramapriya\Psr\Logger\Events\EventLogListener;

Loc::loadMessages(__FILE__);

class ramapriya_psr_logger extends CModule
{
    public $MODULE_ID = 'ramapriya.psr.logger';

    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_NAME         = Loc::getMessage('psr_logger_module_name');
        $this->MODULE_DESCRIPTION  = Loc::getMessage('psr_logger_module_description');
        $this->MODULE_VERSION      = $arModuleVersion['VERSION'] ? : '0.0.1';
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'] ? : date('Y-m-d H:i:s');
        $this->PARTNER_NAME        = Loc::getMessage('psr_logger_partner_name');
        $this->PARTNER_URI         = 'https://github.com/stayfuneral';
    }

    function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallEvents();
    }

    function DoUninstall()
    {
        $this->UnInstallEvents();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallEvents()
    {
        EventManager::getInstance()->registerEventHandlerCompatible(
            'main',
            'OnEventLogGetAuditTypes',
            $this->MODULE_ID,
            EventLogListener::class,
            'OnEventLogGetAuditTypes'
        );
    }

    public function UnInstallEvents()
    {
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnEventLogGetAuditTypes',
            $this->MODULE_ID,
            EventLogListener::class,
            'OnEventLogGetAuditTypes'
        );
    }
}
