<?php

namespace Ramapriya\Psr\Logger;

use CEventLog;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Ramapriya\Psr\Logger\Interfaces\ModuleInterface;

/**
 * Логгер, который пишет сообщения в журнал событий Битрикс
 */
class EventLogLogger implements LoggerInterface, ModuleInterface
{

    public function emergency($message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        $fields = [
            'SEVERITY' => strtoupper($level),
            'AUDIT_TYPE_ID' => self::EVENT_LOG_AUDIT_TYPE_ID_LOGGER,
            'MODULE_ID' => self::MODULE_ID,
            'ITEM_ID' => $message,
            'DESCRIPTION' => !empty($context) ? $this->prepareDescription($context) : ''
        ];

        CEventLog::Add($fields);
    }

    private function prepareDescription(array $context): string
    {
        $description = '';

        foreach ($context as $title => $value) {
            $description .= sprintf('%s<br>', $this->convertArrayToMessage($value, $title));
        }

        return $description;
    }

    private function convertArrayToMessage(array $data, string $title = null): string
    {
        $message = '';

        if (gettype($title) === 'string' && strlen($title) > 0) {
            $message .= sprintf('%s<br><br>', $title);
        }



        foreach ($data as $key => &$value) {
            if (empty($value)) {
                continue;
            }
            if (is_array($value)) {

                if (count($value) > 1) {
                    $value = sprintf(
                        '[%s]',
                        implode(', ', $value)
                    );
                } else {
                    $value = $value[0];
                }

            }



            $message .= sprintf('%s: %s<br>', $key, $value);
        }

        return $message;
    }
}
