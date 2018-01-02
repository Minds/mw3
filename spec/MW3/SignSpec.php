<?php

namespace spec\MW3;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use MW3\Cmd;

class SignSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('MW3\Sign');
    }

    function it_should_sign_request(Cmd $cmd)
    {
        $this->beConstructedWith($cmd);

        $cmd->exec("sign --privateKey='priv123' --tx='x012a'")->willReturn('executed!');

        $this->setPrivateKey('priv123')->shouldReturn($this);
        $this->setTx('x012a')->shouldReturn($this);
        $this->sign()->shouldReturn('executed!');
    }
}
