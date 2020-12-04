<?php

namespace spec\MW3;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use MW3\Cmd;

class SignSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('MW3\Sign');
    }

    public function it_should_sign_request(Cmd $cmd)
    {
        $this->beConstructedWith($cmd);

        $cmd->exec("sign --privateKey='priv123' --tx='x012a'")->willReturn('executed!');

        $this->setPrivateKey('priv123')->shouldReturn($this);
        $this->setTx('x012a')->shouldReturn($this);
        $this->sign()->shouldReturn('executed!');
    }

    public function it_should_recover_address(Cmd $cmd)
    {
        $this->beConstructedWith($cmd);

        $cmd->exec("recoverAddress --message=\"123\" --signature=\"sig\"")->willReturn('0xaddress');

        $this->recoverAddress("123", "sig")->shouldReturn('0xaddress');
    }
}
