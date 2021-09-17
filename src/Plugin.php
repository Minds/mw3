<?php
namespace MW3;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $dir = dirname(dirname(__FILE__));
        exec("npm --prefix $dir install");
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // do nothing
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // do nothing
    }
}
