<?php
/**
 * Sign a transaction
 */
namespace MW3;

class Sign
{
    private $cmd;
    private $tx;
    private $privateKey;

    public function __construct($cmd = null)
    {
        $this->cmd = $cmd ?: new Cmd;
    }

    /**
     * Set the private key
     * @param string $key - the private key
     * @return $this
     */
    public function setPrivateKey($key)
    {
        $this->privateKey = $key;
        return $this;
    }

    /**
     * Set the transactiosn
     * @param array | string - the transaction
     * @return $this
     */
    public function setTx($tx)
    {
        if (!is_string($tx)) {
            $tx = json_encode($tx);
        }
        $this->tx = $tx;
        return $this;
    }

    /**
     * Sign the transaction
     * @return string
     */
    public function sign()
    {
        $cmd = "sign --privateKey='{$this->privateKey}' --tx='{$this->tx}'";
        return $this->cmd->exec($cmd);
    }

    /**
     * Will return the ETH address that signed the message
     * @param string $message
     * @param string $signature
     * @return string
     */
    public function recoverAddress(string $message, string $signature): string
    {
        $cmd = "recoverAddress --message=\"$message\" --signature=\"$signature\"";
        return $this->cmd->exec($cmd);
    }
}
