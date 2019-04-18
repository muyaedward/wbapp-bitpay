<?php

namespace Muyaedward\WbappBitpay\Traits;

use Muyaedward\WbappBitpay\Exceptions\InvalidConfigurationException;

trait CreateKeypairTrait
{
    public function validateAndLoadConfig()
    {
        $config = config('wbapp-bitpay');

        if ('livenet' != $config['network'] && 'testnet' != $config['network']) {
            throw InvalidConfigurationException::invalidNetworkName();
        }

        if (! class_exists($config['key_storage'])) {
            throw InvalidConfigurationException::invalidStorageClass();
        }

        if ('' === trim($config['key_storage_password'])) {
            throw InvalidConfigurationException::invalidOrEmptyPassword();
        }

        $this->config = $config;
    }

    protected function writeNewEnvironmentFileWith()
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->keyReplacementPattern(),
            'BITPAY_TOKEN='.$this->token,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['wbapp-bitpay.token'], '/');

        return "/^BITPAY_TOKEN{$escaped}/m";
    }
}
