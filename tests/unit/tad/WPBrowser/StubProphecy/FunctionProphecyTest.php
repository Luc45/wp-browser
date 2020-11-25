<?php namespace tad\WPBrowser\StubProphecy;

class FunctionProphecyTest extends \Codeception\Test\Unit
{
    /**
     * It should allow replacing an existing core function
     *
     * @test
     */
    public function should_allow_replacing_an_existing_core_function()
    {
        if (PHP_VERSION_ID >= 70000 && !extension_loaded('uopz')) {
            $this->markTestSkipped('uopz extension is required to run this test.');
        }

        FunctionProphecy::is_dir(__DIR__)->willReturn(false);

        $this->assertFalse(is_dir(__DIR__));
    }

    /**
     * It should not allow replacing an existing core function multiple times
     *
     * @test
     */
    public function should_not_allow_replacing_an_existing_core_function_multiple_times()
    {
        if (PHP_VERSION_ID >= 70000 && !extension_loaded('uopz')) {
            $this->markTestSkipped('uopz extension is required to run this test.');
        }

        FunctionProphecy::is_dir(Arg::type('string'))->willReturn(23);
        FunctionProphecy::is_dir(Arg::type('string'))->willReturn(89);

        $this->assertEquals(89, is_dir(__DIR__));
        $this->assertEquals(89, is_dir(__FILE__));
    }

    protected function _after()
    {
        FunctionProphecy::reset();
    }
}
