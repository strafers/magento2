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
 * @package     Magento_Checkout
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Test class for \Magento\Checkout\Block\Onepage\Payment\Methods
 */
namespace Magento\Checkout\Block\Onepage\Payment;

class MethodsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Checkout\Block\Onepage\Payment\Methods
     */
    protected $_block;

    protected function setUp()
    {
        parent::setUp();
        $this->_block = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get('Magento\Core\Model\Layout')
            ->createBlock('Magento\Checkout\Block\Onepage\Payment\Methods');
    }

    /**
     * @magentoAppArea frontend
     */
    public function testGetMethodTitleAndMethodLabelAfterHtml()
    {
        $expectedTitle = 'Free Method';
        $expectedLabel = 'Label After Html';
        $method = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
            ->create('Magento\Payment\Model\Method\Free');

        $block = $this->_block->getLayout()->createBlock('Magento\Core\Block\Text')
            ->setMethodTitle($expectedTitle)
            ->setMethodLabelAfterHtml($expectedLabel);

        $this->assertEquals('No Payment Information Required', $this->_block->getMethodTitle($method));
        $this->_block->setChild('payment.method.free', $block);
        $actualTitle = $this->_block->getMethodTitle($method);
        $actualLabel = $this->_block->getMethodLabelAfterHtml($method);

        $this->assertEquals($expectedTitle, $actualTitle);
        $this->assertEquals($expectedLabel, $actualLabel);
    }
}
