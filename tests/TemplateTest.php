<?php

namespace JinTemplate\JinTemplate\Test;

use JinTemplate\JinTemplate\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $template = '<ul><!--{variable: item}--><li>${name}</li><!--{/variable}--></ul>';

        $t = Template::fromString($template);
        $source_item = $t->getTemplateByName('item');
        $values = array('Foo', 'bar');
        $items = array();
        foreach ($values as $value) {
            $item = $source_item->createCopy();
            $item->setVariable('name', $value);
            $items[] = $item;
        }
        $t->setVariable('item', $items);
        $output = $t->render();
        $this->assertEquals($output, '<ul><li>Foo</li><li>bar</li></ul>');
    }
}
