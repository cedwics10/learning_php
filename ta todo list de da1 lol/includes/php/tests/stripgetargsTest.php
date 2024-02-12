<?php
use PHPUnit\Framework\TestCase as TestCase;

class stripgetargsTest extends TestCase
{
    public function testEmptyQmark() 
    {
        $this->assertEquals(make_stripped_get_args_link([], []), '?', 'Test qmark_mark function with no arguments.');
    }

    public function testEmptyWStringQmark()
    {
        $this->assertEquals(make_stripped_get_args_link([], [], 'test'), '?test', 'Test qmark_mark function with no arguments except a text.');
    }

    public function testEmptyWMockQmark()
    {
        $this->assertEquals(make_stripped_get_args_link([], [], 'test'), '?test', 'Test qmark_mark function with no arguments except a text.');
    }

    public function testOneMockGetQmark()
    {
        $this->assertEquals(make_stripped_get_args_link([], ['test' => 'ok'], ''), '?test=ok', 'Test qmark_mark function with one mock get argument.');
    }

    public function testTwoMockMinusOneGetQmark()
    {
        $_GET['its'] = 'notok';
        $this->assertEquals(make_stripped_get_args_link(['its'], ['test' => 'ok'], ''), '?test=ok', 'Test qmark_mark function with one removed get key.');
    }

    public function testTwoReplaceGetKey()
    {
        $_GET['its'] = 'notok';
        $this->assertEquals(make_stripped_get_args_link(['its'], ['its' => 'ok'], ''), '?its=ok', 'Test qmark_mark function with one replaced get key.');
    }

    public function testOneMockTwoGetQmark()
    {
        $_GET['its'] = 'notok';
        $_GET['test'] = 'ok';
        $this->assertEquals(make_stripped_get_args_link(['its'], ['but' => 'ilikeit'], ''), '?but=ilikeit&amp;test=ok', 'Test qmark_mark function : case of four $_GET arguments minus two removed and one new arg, no anchor text.');
    }

    public function testTwoMockTwoGetAnchortQmark()
    {
        $_GET['its'] = 'notok';
        $_GET['his'] = 'test';
        $_GET['test'] = 'ok';
        $_GET['to'] = 'you';

        $this->assertEquals(make_stripped_get_args_link(['its', 'to'], ['but' => 'ilikeit'], '#index'), '?but=ilikeit&amp;his=test&amp;test=ok#index', 'Test qmark_mark function : case of four $_GET arguments minus two removed and two new args and default text.');
    }
    # Create tests with injecting $_GET into the assertEqual
}

?>