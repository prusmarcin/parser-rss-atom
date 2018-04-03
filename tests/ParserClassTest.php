<?php

use MarcinPrus\Parser\ParserClass;

class ParserClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that true does in fact equal true
     */
    public function testParseCliParametersSimple()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'test parametru simple');
    }
    
    public function testParseCliParametersExtended()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'test parametru extended');
    }
    
    public function testParseCliParametersCountFour()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'test parametru suma = 4');
    }
    
    public function testParseCliParametersCountOne()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(1, $tab);
        $this->assertFalse($res, 'test na sume parametrow = 1');
    }
    
    public function testParseCliParametersCountTwo()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(2, $tab);
        $this->assertFalse($res, 'test na sume parametrow = 2');
    }
    
    public function testParseCliParametersCountThree()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(3, $tab);
        $this->assertFalse($res, 'test na sume parametrow = 3');
    }
    
    public function testParseCliParametersNotCsv()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'txt:extended';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'zly parametr txt');
    }
    
    public function testParseCliParametersNotExntendedAndSimple()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:blablabla';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'musi byc simple lub extended');
    }
    
    public function testParseCliParametersMissingSecondParam()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        //$tab[1] = 'csv:blablabla';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'brakuje drugiego parametru');
    }
    
    public function testParseCliParametersWrongSecondParam2()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'fdfdf:blablabla';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'zle wartosci parametru drugiego');
    }
    
    public function testParseCliParametersWrongSecondParam3()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'fdfdfblablabla';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'parametry musza byc rozdzielone znakiem :');
    }
    
    public function testParseCliParametersWrongUrl()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'http:feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'zly parametr URL');
    }
    
    public function testParseCliParametersWrongUrl2()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'zly parametr URL');
    }
    
    public function testParseCliParametersUrlWww()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'http://www.feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'nie dziala url z .www');
    }
    
    public function testParseCliParametersUrlHttps()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'https://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'nie dziala url z https');
    }
    
    public function testParseCliParametersUrlHttpsAndWww()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'https://www.feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty.csv';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertTrue($res, 'nie dziala url z https i .www');
    }
    
    public function testParseCliParametersMissingExtFile()
    {
        $parser = new ParserClass();

        $tab[0] = 'src/console.php';
        $tab[1] = 'csv:simple';
        $tab[2] = 'http://feeds.nationalgeographic.com/ng/News/News_Main';
        $tab[3] = 'eksport_prosty';
        
        $res = $parser->parseCliParameters(4, $tab);
        $this->assertFalse($res, 'brakuje rozszezenia pliku');
    }
 
}
