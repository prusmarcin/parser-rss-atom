<?php

use MarcinPrus\Request\CurlClass;

class CurlClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that true does in fact equal true
     */
    public function testCurlGoodUrl()
    {
        $curl = new CurlClass();
        
        $res = $curl->submit('http://feeds.nationalgeographic.com/ng/News/News_Main');
        $this->assertTrue($res, 'test url ktory zwraca kod 200');
    }
    
    public function testCurlBadUrl()
    {
        $curl = new CurlClass();
        
        $res = $curl->submit('http://feeds.nationalgeographic.com/ng/News/Neblablabla');
        $this->assertFalse($res, 'test url ktory zwraca kod 404');
    }
    
    public function testCurlEmptyUrl()
    {
        $curl = new CurlClass();
        
        $res = $curl->submit('');
        $this->assertFalse($res, 'test url ktory jest pusty');
    }
    
    public function testCurlGetSuccessStatus()
    {
        $curl = new CurlClass();
        
        $res = $curl->isSuccess();
        $this->assertFalse($res, 'ma zwrocic false');
    }
    
    public function testCurlGetErrorStatus()
    {
        $curl = new CurlClass();
        
        $res = $curl->getErrorCodes();
        $this->assertCount(0, $res, 'ma zwrocic pusta tablice');
    }
    
    public function testCurlGetResponse()
    {
        $curl = new CurlClass();
        
        $res = $curl->getResponse();
        $this->assertNull($res, 'ma zwrocic null');
    }
}