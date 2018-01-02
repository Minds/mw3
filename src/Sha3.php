<?php
/**
 * Sha3 Hash
 */
namespace MW3;

class Sha3
{

    private $cmd;
    private $string;

    public function __construct($cmd = null)
    {
        $this->cmd = $cmd ?: new Cmd;
    }

    /**
     * Set the string
     * @param string $string - the string to hash
     * @return $this
     */
    public function setString($string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Hash
     * @return string
     */
    public function hash()
    {
        $cmd = "sha3 --str='$this->string'";
        return $this->cmd->exec($cmd);
    }

}