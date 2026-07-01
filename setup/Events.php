<?php

/**
 * Copyright (c) D3 Data Development (Inh. Thomas Dartsch)
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

namespace D3\Extsearch\setup;

use D3\Extsearch\Application\Model\Constants;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Install\d3install;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Cache\ModuleCacheServiceInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Events
{
    /**
     * @throws d3ShopCompatibilityAdapterException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws SystemComponentException
     */
    public static function onActivate()
    {
        d3install::checkUpdateStart();
        self::clearCache();
    }

    public static function onDeactivate()
    {
        self::clearCache();
    }

    protected static function clearCache(): void
    {
        try {
            /** @var ContainerInterface $container */
            $container = ContainerFactory::getInstance()->getContainer();

            /** @var ModuleCacheServiceInterface $moduleCache */
            $moduleCache = $container->get(ModuleCacheServiceInterface::class);
            $moduleCache->invalidate(Constants::OXID_MODULE_ID, Registry::getConfig()->getShopId());
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface) {
        }
    }
}
