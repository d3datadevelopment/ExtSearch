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
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\Extsearch\Application\Controller;

use D3\Extsearch\Application\Controller\Admin\d3_cfg_extsearch_main;
use D3\Extsearch\Application\Model\d3_search_generator;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Registry;

class d3_extsearch_cron_response extends BaseController
{
    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function generateIndex()
    {
        startProfile(__METHOD__);

        $generator = oxNew( d3_search_generator::class );
        $iProcessedArticles = $generator->updateArticles(true);

        stopProfile(__METHOD__);

        return $iProcessedArticles;
    }

    /**
     * Generiert aus jedem Semantic-Lexikoneintrag den phonetischen Code
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function generatePhoneticSemantic()
    {
        startProfile(__METHOD__);

        $generator = oxNew( d3_search_generator::class );
        $useNoTicker = true;
        $iTermPos = 0;

        $iProcessedTerms = $generator->updateSemantics( $iTermPos, $useNoTicker );

        stopProfile(__METHOD__);

        return $iProcessedTerms;
    }
}
