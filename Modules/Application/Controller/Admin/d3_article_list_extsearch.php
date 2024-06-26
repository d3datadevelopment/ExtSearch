<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\Extsearch\Modules\Application\Controller\Admin;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Object2Category;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Str;
use OxidEsales\Eshop\Core\StrMb;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\ConnectionProviderInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class d3_article_list_extsearch extends d3_article_list_extsearch_parent
{
    private $_sModId = 'd3_extsearch';

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function render()
    {
        $sRet = parent::render();

        if ($this->d3GetSet()->getValue('blExtSearch_adminShowVariants')) {
            if (false == is_array($this->getViewDataElement("pwrsearchfields")) ||
                !in_array('oxvarselect', $this->getViewDataElement("pwrsearchfields"))
            ) {
                $aSearchFields   = $this->getViewDataElement("pwrsearchfields");
                $aSearchFields[] = 'oxvarselect';
                $this->addTplParam("pwrsearchfields", $aSearchFields);
            }
        }

        return $sRet;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3GetSet()
    {
        return d3_cfg_mod::get($this->d3getModId());
    }

    /**
     * @return string
     */
    private function d3getModId()
    {
        return $this->_sModId;
    }

    /**
     * @param null $oListObject
     *
     * @return mixed|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function buildSelectString($oListObject = null)
    {
        $sSql = parent::buildSelectString($oListObject);

        // wenn für Admin Variantensuche
        if ($this->d3GetSet()->isActive()
            && $this->d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->d3IsSearch()
        ) {
            $sViewName = $oListObject->getViewName();
            $connection = ContainerFactory::getInstance()->getContainer()->get(ConnectionProviderInterface::class)->get();

            $aReplSearch = [
                'from ' . $sViewName,
                ", " . $connection->quoteIdentifier("{$sViewName}.oxtitle"),
                ", " . $connection->quoteIdentifier("{$sViewName}.oxvarselect"),
            ];

            $aReplReplacement = [
                'from ' . $sViewName . ' LEFT JOIN ' . $oListObject->getViewName() . ' oxp ON ' . $sViewName . '.oxparentid = oxp.oxid',
                ", if($sViewName.oxparentid, CONCAT(oxp.oxtitle,' ', $sViewName.oxvarselect), $sViewName.oxtitle) as oxtitle",
                ", if($sViewName.oxparentid, CONCAT(oxp.oxtitle,' ', $sViewName.oxvarselect), $sViewName.oxvarselect) as oxvarselect",
            ];

            $sSql = str_replace($aReplSearch, $aReplReplacement, $sSql);
        }

        return $sSql;
    }

    /**
     * Adding empty parent check
     *
     * @param array  $whereQuery SQL condition array
     * @param string $fullQuery  SQL query string
     *
     * @return mixed|string
     * @throws ContainerExceptionInterface
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws NotFoundExceptionInterface
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function prepareWhereQuery($whereQuery, $fullQuery)
    {
        $fullQuery = parent::prepareWhereQuery( $whereQuery, $fullQuery);

        // wenn für Admin Variantensuche
        if ($this->d3GetSet()->isActive()
            && $this->d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->d3IsSearch()
        ) {
            $oArticle         = oxNew(Article::class);
            $aReplSearch      = [" and " . $oArticle->getViewName() . ".oxparentid = '' "];
            $aReplReplacement = [''];

            $connection = ContainerFactory::getInstance()->getContainer()->get(ConnectionProviderInterface::class)->get();
            $sSearchKey    = strtolower($oArticle->getViewName()) . '.oxtitle';
            $aLowerWhere   = array_change_key_case( $whereQuery);
            $aKeys         = array_keys($aLowerWhere);
            $aOrgKeys      = array_keys( $whereQuery);
            $sIdent        = array_search($sSearchKey, $aKeys);
            $sOrgSearchKey = $aOrgKeys[$sIdent];
            $sQuotedOrgSearchKey = $connection->quoteIdentifier($sOrgSearchKey);

            if (in_array($sSearchKey, $aKeys)) {
                $aReplSearch[]      = '( ' . $sQuotedOrgSearchKey . "  like '" . $whereQuery[ $sOrgSearchKey] . "'  )";
                $aReplReplacement[] = '( ' . $sQuotedOrgSearchKey . " like '" . $whereQuery[ $sOrgSearchKey] . "' OR " .
                                      $connection->quoteIdentifier("oxp.oxtitle") . " LIKE '" . $whereQuery[ $sOrgSearchKey] . "' )";
            }

            $fullQuery = str_replace( $aReplSearch, $aReplReplacement, $fullQuery);
        }

        return $fullQuery;
    }

    /**
     * Sets articles sorting by category.
     *
     * @param string $query sql string
     *
     * @return string
     * @throws ContainerExceptionInterface
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws NotFoundExceptionInterface
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function changeselect($query)
    {
        $query = parent::changeselect( $query);

        $sType  = false;
        $sValue = false;

        // wenn für Admin Variantensuche
        if ($this->d3GetSet()->isActive()
            && $this->d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->d3IsSearch()
        ) {
            $connection = ContainerFactory::getInstance()->getContainer()->get(ConnectionProviderInterface::class)->get();
            $sArtCat = Registry::get(Request::class)->getRequestEscapedParameter("art_category");
            if ($sArtCat && strstr($sArtCat, "@@") !== false) {
                [$sType, $sValue] = explode("@@", $sArtCat);
            } elseif ($sArtCat) {
                $sValue = $sArtCat;
                $sType  = 'cat';
            }

            $oArticle = oxNew(Article::class);
            $sTable = $oArticle->getViewName();

            // D3 pattern changed
            $sPattern = "from\s+$sTable\s+(.*?)\s{0,1}where";

            switch ($sType) {
                // add category
                case 'cat':
                    /** @var StrMb $oStr */
                    $oStr     = Str::getStr();
                    $oO2C = oxNew(Object2Category::class);
                    $sO2CView = $oO2C->getViewName();
                    // d3 sumatch added again (\\1)
                    $sLJAdd = strstr(
                        $query,
                        $sO2CView
                    ) ? '' : " LEFT JOIN $sO2CView ON $sTable.oxid = $sO2CView.oxobjectid ";
                    // 2012-07-04 changed to lowercase, because OXID regexp doesn't match uppercase :(
                    $sInsert = "from $sTable \\1 $sLJAdd where ".$connection->quoteIdentifier("{$sO2CView}.oxcatnid")." = " .
                        $connection->quote(
                            $sValue
                        ) . " AND ";
                    // D3 pattern changed
                    $query = $oStr->preg_replace( "/$sPattern/i", $sInsert, $query);
                    break;
                    // add category
                case 'mnf':
                    $query .= " and $sTable.oxmanufacturerid = " . $connection->quote( $sValue);
                    break;
                    // add vendor
                case 'vnd':
                    $query .= " and $sTable.oxvendorid = " . $connection->quote( $sValue);
                    break;
            }
        }

        return $query;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3IsSearch(): bool
    {
        if ($this->d3GetSet()->getFieldData('oxactive')
            && $aWhere = Registry::get(Request::class)->getRequestEscapedParameter('where')
        ) {
            if (is_array($aWhere)) {
                $aWhere = $aWhere['oxarticles'];

                foreach ($aWhere as $sValue) {
                    if (is_string($sValue) &&
                        strlen($sValue)
                    ) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
