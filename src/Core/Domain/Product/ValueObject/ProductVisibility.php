<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\Product\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Product\Exception\ProductConstraintException;

/**
 * Holds value for product visibility setting
 */
class ProductVisibility
{
    const VISIBLE_IN_CATALOG = 'catalog';
    const VISIBLE_IN_SEARCH = 'search';
    const VISIBLE_EVERYWHERE = 'both';
    const INVISIBLE = 'none';

    const AVAILABLE_VISIBILITY_VALUES = [
        self::VISIBLE_IN_CATALOG => self::VISIBLE_IN_CATALOG,
        self::VISIBLE_IN_SEARCH => self::VISIBLE_IN_SEARCH,
        self::VISIBLE_EVERYWHERE => self::VISIBLE_EVERYWHERE,
        self::INVISIBLE => self::INVISIBLE,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->assertIsValidVisibilityValue($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @throws ProductConstraintException
     */
    private function assertIsValidVisibilityValue(string $value): void
    {
        if (!in_array($value, self::AVAILABLE_VISIBILITY_VALUES, true)) {
            throw new ProductConstraintException(
                sprintf(
                    'Invalid product visibility "%s". Allowed values are: "%s"',
                    $value,
                    implode(',', self::AVAILABLE_VISIBILITY_VALUES)
                ),
                ProductConstraintException::INVALID_VISIBILITY
            );
        }
    }
}
