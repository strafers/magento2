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
 * @copyright  Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Test\Tools\Di\Code\Scanner;

class XmlScannerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Tools\Di\Code\Scanner\XmlScanner
     */
    protected $_model;

    /**
     * @var string
     */
    protected $_testDir;

    /**
     * @var array
     */
    protected $_testFiles = array();

    protected function setUp()
    {
        $this->_model = new \Magento\Tools\Di\Code\Scanner\XmlScanner();
        $this->_testDir = str_replace('\\', '/', realpath(__DIR__ . '/../../') . '/_files');
        $this->_testFiles =  array(
            $this->_testDir . '/app/code/Magento/SomeModule/etc/adminhtml/system.xml',
            $this->_testDir . '/app/code/Magento/SomeModule/etc/di.xml',
            $this->_testDir . '/app/code/Magento/SomeModule/view/frontend/default.xml',
            $this->_testDir . '/app/etc/di/config.xml'

        );
    }

    public function testCollectEntities()
    {
        $actual = $this->_model->collectEntities($this->_testFiles);
        $expected = array(
            'Magento\Backend\Block\System\Config\Form\Fieldset\Modules\DisableOutput\Proxy',
            'Magento\Core\Model\App\Proxy',
            'Magento\Core\Model\Cache\Proxy',
            'Magento\Backend\Block\Menu\Proxy',
            'Magento\Core\Model\StoreManager\Proxy',
            'Magento\Core\Model\Layout\Factory',
        );
        $this->assertEquals($expected, $actual);
    }
}
