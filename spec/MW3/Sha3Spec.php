<?php

namespace spec\MW3;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use MW3\Cmd;

class Sha3Spec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('MW3\Sha3');
    }

    function it_should_hash_the_string(Cmd $cmd)
    {
        $this->beConstructedWith($cmd);

        $cmd->exec("sha3 --str='hashme'")->willReturn('hashed!');

        $this->setString('hashme')->shouldReturn($this);
        $this->hash()->shouldReturn('hashed!');
    }

}
