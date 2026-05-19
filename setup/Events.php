<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
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
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface) {}
    }
}
