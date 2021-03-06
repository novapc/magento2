<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     performance_tests
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magento_ImportExport_Fixture_GeneratorTest extends PHPUnit_Framework_TestCase
{
    public function testIteratorInterface()
    {
        $pattern = array(
            'id' => '%s',
            'name' => 'Static',
            // @codingStandardsIgnoreStart
            /**
             * PHP_CodeSniffer bug - http://pear.php.net/bugs/bug.php?id=19290 (fixed in 1.4.0)
             */
            'calculated' => function ($index) {
                return $index * 10;
            },
            // @codingStandardsIgnoreEnd
        );
        $model = new Magento_ImportExport_Fixture_Generator($pattern, 2);
        $rows = array();
        foreach ($model as $row) {
            $rows[] = $row;
        }
        $this->assertEquals(array(
            array('id' => '1', 'name' => 'Static', 'calculated' => 10),
            array('id' => '2', 'name' => 'Static', 'calculated' => 20),
        ), $rows);
    }
}
