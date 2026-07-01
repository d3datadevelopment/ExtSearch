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

namespace D3\Extsearch\Application\Controller;

use D3\Extsearch\Application\Model\d3_search_generator;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;

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

        $generator = oxNew(d3_search_generator::class);
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

        $generator = oxNew(d3_search_generator::class);
        $useNoTicker = true;
        $iTermPos = 0;

        $iProcessedTerms = $generator->updateSemantics($iTermPos, $useNoTicker);

        stopProfile(__METHOD__);

        return $iProcessedTerms;
    }
}
