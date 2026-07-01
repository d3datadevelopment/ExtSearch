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

use OxidEsales\Eshop\Application\Model\Manufacturer;

class d3_attribute2manufacturer_extsearch_ajax extends d3_attribute_extsearch_ajax_abstract
{
    /**
     * Columns array
     *
     * @var array
     */
    protected $_aColumns = [
        'container1' => [ // field , table,         visible, multilanguage, ident
            ['oxtitle', 'oxmanufacturers', 1, 1, 0],
            ['oxshortdesc', 'oxmanufacturers', 1, 1, 0],
            ['oxid', 'oxmanufacturers', 0, 0, 0],
            ['oxid', 'oxmanufacturers', 0, 0, 1],
        ],
        'container2' => [
            ['oxtitle', 'oxmanufacturers', 1, 1, 0],
            ['oxshortdesc', 'oxmanufacturers', 1, 1, 0],
            ['oxid', 'oxmanufacturers', 0, 0, 0],
            ['oxid', 'd3extsearch_attribute2object', 0, 0, 1],
            ['oxid', 'oxmanufacturers', 0, 0, 1],
        ],
    ];

    /**
     * @return string
     */
    public function getObjectModel()
    {
        return Manufacturer::class;
    }

    public function getLeftColumnTitle()
    {
        return 'D3_EXTSEARCH_AJAX_ALLMANUFACTURERS';
    }

    public function getRightColumnTitle()
    {
        return 'D3_EXTSEARCH_AJAX_SETMANUFACTURERS';
    }

    public function getObjectIdField()
    {
        return 'oxmanufacturers.oxid';
    }

    public function getContainerKey()
    {
        return 'd3_attribute2manufacturer_extsearch';
    }
}
