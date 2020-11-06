<?PHP

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
use Doctrine\DBAL\DBALException;
use \OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Object2Category;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Str;
use OxidEsales\Eshop\Core\StrMb;

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

        if ($this->_d3GetSet()->getValue('blExtSearch_adminShowVariants')) {
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
    protected function _d3GetSet()
    {
        return d3_cfg_mod::get($this->_d3getModId());
    }

    /**
     * @return string
     */
    private function _d3getModId()
    {
        return $this->_sModId;
    }

    /**
     * @param Article $oListObject
     *
     * @return mixed|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     */
    protected function _buildSelectString($oListObject = null)
    {
        $sSql = parent::_buildSelectString($oListObject);

        // wenn für Admin Variantensuche
        if ($this->_d3GetSet()->isActive()
            && $this->_d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->_d3IsSearch()
        ) {
            $sViewName = $oListObject->getViewName();

            $aReplSearch = array(
                'from ' . $sViewName,
                ", " . DatabaseProvider::getDb()->quoteIdentifier("{$sViewName}.oxtitle"),
                ", " . DatabaseProvider::getDb()->quoteIdentifier("{$sViewName}.oxvarselect")
            );

            $aReplReplacement = array(
                'from ' . $sViewName . ' LEFT JOIN ' . $oListObject->getViewName() . ' oxp ON ' . $sViewName . '.oxparentid = oxp.oxid',
                ", if($sViewName.oxparentid, CONCAT(oxp.oxtitle,' ', $sViewName.oxvarselect), $sViewName.oxtitle) as oxtitle",
                ", if($sViewName.oxparentid, CONCAT(oxp.oxtitle,' ', $sViewName.oxvarselect), $sViewName.oxvarselect) as oxvarselect"
            );

            $sSql = str_replace($aReplSearch, $aReplReplacement, $sSql);
        }

        return $sSql;
    }

    /**
     * Adding empty parent check
     *
     * @param array $aWhere SQL condition array
     * @param string $sQ SQL query string
     *
     * @return mixed|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function _prepareWhereQuery($aWhere, $sQ)
    {
        $sQ = parent::_prepareWhereQuery($aWhere, $sQ);

        // wenn für Admin Variantensuche
        if ($this->_d3GetSet()->isActive()
            && $this->_d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->_d3IsSearch()
        ) {
            $oArticle         = oxNew(Article::class);
            $aReplSearch      = array(" and " . $oArticle->getViewName() . ".oxparentid = '' ");
            $aReplReplacement = array('');

            $sSearchKey    = strtolower($oArticle->getViewName()) . '.oxtitle';
            $aLowerWhere   = array_change_key_case($aWhere);
            $aKeys         = array_keys($aLowerWhere);
            $aOrgKeys      = array_keys($aWhere);
            $sIdent        = array_search($sSearchKey, $aKeys);
            $sOrgSearchKey = $aOrgKeys[$sIdent];
            $sQuotedOrgSearchKey = DatabaseProvider::getDb()->quoteIdentifier($sOrgSearchKey);

            if (in_array($sSearchKey, $aKeys)) {
                $aReplSearch[]      = '( ' . $sQuotedOrgSearchKey . "  like '" . $aWhere[$sOrgSearchKey] . "'  )";
                $aReplReplacement[] = '( ' . $sQuotedOrgSearchKey . " like '" . $aWhere[$sOrgSearchKey] . "' OR ".
                    DatabaseProvider::getDb()->quoteIdentifier("oxp.oxtitle") . " LIKE '" . $aWhere[$sOrgSearchKey] . "' )";
            }

            $sQ = str_replace($aReplSearch, $aReplReplacement, $sQ);
        }

        return $sQ;
    }

    /**
     * Sets articles sorting by category.
     *
     * @param string $sSql sql string
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function _changeselect($sSql)
    {
        $sSql = parent::_changeselect($sSql);

        $sType  = false;
        $sValue = false;

        // wenn für Admin Variantensuche
        if ($this->_d3GetSet()->isActive()
            && $this->_d3GetSet()->getValue('blExtSearch_adminShowVariants')
            && $this->_d3IsSearch()
        ) {
            $sArtCat = Registry::get(Request::class)->getRequestEscapedParameter("art_category");
            if ($sArtCat && strstr($sArtCat, "@@") !== false) {
                list($sType, $sValue) = explode("@@", $sArtCat);
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
                    /** @var $oStr StrMb */
                    $oStr     = Str::getStr();
                    $oO2C = oxNew(Object2Category::class);
                    $sO2CView = $oO2C->getViewName();
                    // d3 sumatch added again (\\1)
                    $sLJAdd = strstr(
                        $sSql,
                        $sO2CView
                    ) ? '' : " LEFT JOIN $sO2CView ON $sTable.oxid = $sO2CView.oxobjectid ";
                    // 2012-07-04 changed to lowercase, because OXID regexp doesn't match uppercase :(
                    $sInsert = "from $sTable \\1 $sLJAdd where ".DatabaseProvider::getDb()->quoteIdentifier("{$sO2CView}.oxcatnid")." = " .
                        DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote(
                            $sValue
                        ) . " AND ";
                    // D3 pattern changed
                    $sSql = $oStr->preg_replace("/$sPattern/i", $sInsert, $sSql);
                    break;
                // add category
                case 'mnf':
                    $sSql .= " and $sTable.oxmanufacturerid = " . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($sValue);
                    break;
                // add vendor
                case 'vnd':
                    $sSql .= " and $sTable.oxvendorid = " . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($sValue);
                    break;
            }
        }

        return $sSql;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _d3IsSearch()
    {
        if ($this->_d3GetSet()->getFieldData('oxactive')
            && $aWhere = Registry::get(Request::class)->getRequestEscapedParameter('where')
        ) {
            if (is_array($aWhere)) {
                $aWhere = $aWhere['oxarticles'];

                foreach ($aWhere as $sValue) {
                    if ($sValue && is_string($sValue) && strlen($sValue)) {
                        return true;
                    }
                }
            }

            return false;
        } else {
            return false;
        }
    }
}
