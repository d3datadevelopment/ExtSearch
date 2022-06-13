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

namespace D3\Extsearch\Application\Controller\Admin\Popups;

use OxidEsales\Eshop\Application\Model\Manufacturer;

class d3_attribute2manufacturer_extsearch_ajax extends d3_attribute_extsearch_ajax_abstract
{
    /**
     * Columns array
     *
     * @var array
     */
    protected $_aColumns = array(
        'container1' => array( // field , table,         visible, multilanguage, ident
            array('oxtitle', 'oxmanufacturers', 1, 1, 0),
            array('oxshortdesc', 'oxmanufacturers', 1, 1, 0),
            array('oxid', 'oxmanufacturers', 0, 0, 0),
            array('oxid', 'oxmanufacturers', 0, 0, 1)
        ),
        'container2' => array(
            array('oxtitle', 'oxmanufacturers', 1, 1, 0),
            array('oxshortdesc', 'oxmanufacturers', 1, 1, 0),
            array('oxid', 'oxmanufacturers', 0, 0, 0),
            array('oxid', 'd3extsearch_attribute2object', 0, 0, 1),
            array('oxid', 'oxmanufacturers', 0, 0, 1)
        ),
    );

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