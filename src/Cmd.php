<?php
/**
 * Execute the web3 transaction
 */
namespace MW3;

class Cmd
{

    protected $bin;

    public function __construct()
    {
        $this->bin = dirname(dirname(__FILE__)) . 'index.js';
    }

    /**
     * Execute the tranaction
     * @param string - the command to execute
     * @return string
     */
    public function exec($cmd)
    {
        $cmd = "{$this->bin} $cmd";
        return trim((string) shell_exec($cmd));
    }

}