<?php

namespace Ramapriya\Psr\Events;

use Bitrix\Main\Localization\Loc;
use Ramapriya\Psr\Logger\Interfaces\ModuleInterface;

Loc::loadMessages(__FILE__);

class EventLogListener
{


    public static function OnEventLogGetAuditTypes(): array
    {
        return [
            ModuleInterface::EVENT_LOG_AUDIT_TYPE_ID_LOGGER => Loc::getMessage('event_log_item_id_logger')
        ];
    }
}
