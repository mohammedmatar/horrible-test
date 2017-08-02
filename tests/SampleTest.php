<?php
/**
 * Created by PhpStorm.
 * User: abdosaeed
 * Date: 02/08/17
 * Time: 10:16 ص
 */

namespace SampleApp\tests;
//require_once 'PHPUnit/Autoload.php';
use PHPUnit\Framework\TestCase;
use SampleApp\Sample;

class SampleTest extends TestCase
{
    public function testDoingSomething() {
        $sample = new Sample();
        $this->assertEquals($sample->doSomething(), 'mola');
    }
}
