<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Tests\Unit\Adapter;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Adapter\Validate;

class ValidateTest extends TestCase
{
    /**
     * @dataProvider getIsOrderWay
     */
    public function testIsOrderWay(int $expected, $input): void
    {
        self::assertEquals($expected, Validate::isOrderWay($input));
    }

    public function getIsOrderWay(): iterable
    {
        yield [0, 'test'];
        yield [0, 1];
        yield [0, true];
        yield [1, 'ASC'];
        yield [1, 'DESC'];
        yield [1, 'asc'];
        yield [1, 'desc'];
    }

    /**
     * @param bool $expected
     * @param mixed $value
     *
     * @dataProvider isUnsignedIntProvider
     */
    public function testIsUnsignedInt(bool $expected, $value): void
    {
        self::assertEquals($expected, Validate::isUnsignedInt($value));
    }

    public function isUnsignedIntProvider(): array
    {
        return [
            [true, 1],
            [true, 666],
            [true, 0],
            [true, '234'],
            [true, '0'],
            [false, -1],
            [false, '-1'],
            [false, false],
            [false, true],
            [false, null],
            [false, 'invalid'],
            [false, '666invalid'],
        ];
    }
}
