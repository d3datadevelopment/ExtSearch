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

namespace D3\Extsearch\Application\Controller\Admin\Popups;

use OxidEsales\Eshop\Application\Model\Vendor;

class d3_attribute2vendor_extsearch_ajax extends d3_attribute_extsearch_ajax_abstract
{
    /**
     * Columns array
     *
     * @var array
     */
    protected $_aColumns = [
        'container1' => [ // field , table,         visible, multilanguage, ident
            ['oxtitle', 'oxvendor', 1, 1, 0],
            ['oxshortdesc', 'oxvendor', 1, 1, 0],
            ['oxid', 'oxvendor', 0, 0, 0],
            ['oxid', 'oxvendor', 0, 0, 1],
        ],
        'container2' => [
            ['oxtitle', 'oxvendor', 1, 1, 0],
            ['oxshortdesc', 'oxvendor', 1, 1, 0],
            ['oxid', 'oxvendor', 0, 0, 0],
            ['oxid', 'd3extsearch_attribute2object', 0, 0, 1],
            ['oxid', 'oxvendor', 0, 0, 1],
        ],
    ];

    /**
     * @return string
     */
    public function getObjectModel()
    {
        return Vendor::class;
    }

    public function getLeftColumnTitle()
    {
        return 'D3_EXTSEARCH_AJAX_ALLVENDORS';
    }

    public function getRightColumnTitle()
    {
        return 'D3_EXTSEARCH_AJAX_SETVENDORS';
    }

    public function getObjectIdField()
    {
        return 'oxvendor.oxid';
    }

    public function getContainerKey()
    {
        return 'd3_attribute2vendor_extsearch';
    }
}
