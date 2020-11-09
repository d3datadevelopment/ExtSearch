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

use D3\Extsearch\Application\Model\d3_extsearch_synset;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOException;
use OxidEsales\Eshop\Core\Exception\ConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Application\Model\Shop;
use ReflectionException;

/**
 * Class d3_extsearch_update
 */
class d3_extsearch_update extends d3install_updatebase
{
    public $sModKey = 'd3_extsearch';
    public $sModName = 'erweiterte Suche';
    public $sModVersion = '6.6.0.1';
    public $sModRevision = '6601';
    public $sBaseConf = 'k7Nv2==T1N6R0lKaktyWS91ZURXUCtubDdYYUQ4OG4yVHhnNklHalhtOGpLWDJaZ1V0amV2aU4zYW9zS
EZnNGZpa0pseHpTSEtCaURlMWxTQTRyUTVQMTFNelZLZWttVFdmZGJXcEJoMXk5cHRFcVA1OWpZYndMO
Vh2bFFDYVJhNExDOTJabVdXVHI0aERLZUUvUGNwdjYwRXFVbGxxQldHN2xqbHB6VDhHMDRXTXI5NG9Gb
2xCbjBNVElwczlPM2NHR1Blakg2TGF3UXl6cU1iN0ZIT2hFMU53VjIvNVgwVE5aQ2FPNlcwRUw2eUljZ
mdjV01zUGxJeDBjUC94cVhVaU9XYlhOVi9HZVZlMkdjUjdSSTRLVlgzUzc4ZEFDM0daa1BjN3E3bVd0Y
kNxbFlhUHFpKzhmOWVNaVlJZ1hXWXo1RTRyME0xcFhmTWVHM1JlazlJVExJWHFnPT0=';
    public $sRequirements = '';
    public $sBaseValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTY5JTNBJTdCcyUzQTI4JTNBJTIyZDNfY2ZnX21vZF9fYUxpY2Vuc2VJbmZvTWFpbCUyMiUzQmElM0EyJTNBJTdCcyUzQTQyJTNBJTIyTk9MSUNLRVlfXzQ3OTM2Mzg3MDJiNjc3MTVmMWRmYmZjODMyNDY2OTE0JTIyJTNCcyUzQTE5JTNBJTIyMjAxMy0wMS0xNiUyMDEyJTNBMTAlM0E0MCUyMiUzQnMlM0E0NCUzQSUyMk5PU0VSSUFMSURfXzQ3OTM2Mzg3MDJiNjc3MTVmMWRmYmZjODMyNDY2OTE0JTIyJTNCcyUzQTE5JTNBJTIyMjAxMy0wMS0xNiUyMDEyJTNBMTElM0E0MiUyMiUzQiU3RHMlM0E0MiUzQSUyMmQzX2NmZ19tb2RfX2FFeHRTZWFyY2hfc2ltaWxhclNlYXJjaEZpZWxkcyUyMiUzQmElM0E0JTNBJTdCaSUzQTAlM0JzJTNBMTQlM0ElMjI1MCUyMCUzRCUzRSUyMG94YXJ0bnVtJTIyJTNCaSUzQTElM0JzJTNBMTMlM0ElMjI1MCUyMCUzRCUzRSUyMG94dGl0bGUlMjIlM0JpJTNBMiUzQnMlM0ExOCUzQSUyMjQwJTIwJTNEJTNFJTIwb3hzZWFyY2hrZXlzJTIyJTNCaSUzQTMlM0JzJTNBMTclM0ElMjIyMCUyMCUzRCUzRSUyMG94c2hvcnRkZXNjJTIyJTNCJTdEcyUzQTQzJTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9NdWx0aVNlYXJjaHdvcmRVc2FnZSUyMiUzQnMlM0ExMCUzQSUyMnNpbmdsZVdvcmQlMjIlM0JzJTNBMzklM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF91c2VBcnROdW1TZWFyY2glMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMzklM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9vcmRlckJ5UHJpb3JpdHklMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMzUlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9vcmRlckJ5UHVzaCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E0NCUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2ZpbmRQdXRJbkFuZExlYXZlT3V0JTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTM3JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfb3duRm9ybUZpZWxkcyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzNyUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX1ZhcmlhbnRTZWFyY2glMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzUlM0ElMjJkM19jZmdfbW9kX19zRXh0U2VhcmNoX1ZhcmlhbnRVc2FnZSUyMiUzQnMlM0ExMCUzQSUyMnNob3dQYXJlbnQlMjIlM0JzJTNBMzclM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaW1pbGFyU2VhcmNoJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTMxJTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9sYW5nRmlsZSUyMiUzQnMlM0EyMiUzQSUyMmQzX3Bob25ldGljX2RlX3ZvYy5waHAlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaW1pbGFyRXh0TGlzdCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzNyUzQSUyMmQzX2NmZ19tb2RfX2lFeHRTZWFyY2hfc2ltaWxhckV4dExpc3QlMjIlM0JzJTNBMiUzQSUyMjEwJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9faUV4dFNlYXJjaF9taW5QaG9uTGVuZ3RoJTIyJTNCcyUzQTElM0ElMjIzJTIyJTNCcyUzQTM4JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2VtYW50aWNTZWFyY2glMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBNDMlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zZW1hbnRpY1VzZVBob25ldGljJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQzJTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2VtYW50aWNBbGxvd1Z1bGdhciUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMyUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2NhdFNlYXJjaCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX3NFeHRTZWFyY2hfc2hvd0NhdEFydGljbGVzJTIyJTNCcyUzQTglM0ElMjJhcnRpbmNhdCUyMiUzQnMlM0EzMCUzQSUyMmQzX2NmZ19tb2RfX2lFeHRTZWFyY2hfY2F0UHJpbyUyMiUzQnMlM0EyJTNBJTIyNTAlMjIlM0JzJTNBNDIlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9tYW51ZmFjdHVyZXJTZWFyY2glMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMzklM0ElMjJkM19jZmdfbW9kX19pRXh0U2VhcmNoX21hbnVmYWN0dXJlclByaW8lMjIlM0JzJTNBMiUzQSUyMjUwJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2hvd0NvbnRlbnRMaXN0JTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTQ1JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfY29udGVudFNlYXJjaExvbmd0ZXh0JTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTM0JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfbG9nSGl0bGVzcyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E0NSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2dlbmVyYWxseUxvZ0ZvclNlYXJjaCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0MSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2FkbWluU2hvd1ZhcmlhbnRzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTM4JTNBJTIyZDNfY2ZnX21vZF9faUV4dFNlYXJjaF9hcnRpY2xlc1BlclRpY2slMjIlM0JzJTNBMiUzQSUyMjEwJTIyJTNCcyUzQTM1JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfZW1wdHlTZWFyY2glMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBNDMlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaG93SGlnaGxpZ2h0ZWRUZXh0JTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTM3JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfZ29Ub1VuaXF1ZUhpdCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EzNSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3Nob3dDYXRMaXN0JTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTM1JTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9vcmRlckNhdExpc3QlMjIlM0JzJTNBNyUzQSUyMmNvdW50ZXIlMjIlM0JzJTNBNDIlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaG93T25lSXRlbUNhdExpc3QlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaG93VmVuZG9yTGlzdCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX3NFeHRTZWFyY2hfb3JkZXJWZW5kb3JMaXN0JTIyJTNCcyUzQTclM0ElMjJjb3VudGVyJTIyJTNCcyUzQTQ1JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2hvd09uZUl0ZW1WZW5kb3JMaXN0JTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQ0JTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2hvd01hbnVmYWN0dXJlckxpc3QlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBNDQlM0ElMjJkM19jZmdfbW9kX19zRXh0U2VhcmNoX29yZGVyTWFudWZhY3R1cmVyTGlzdCUyMiUzQnMlM0E3JTNBJTIyY291bnRlciUyMiUzQnMlM0E1MSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3Nob3dPbmVJdGVtTWFudWZhY3R1cmVyTGlzdCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0MSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3Nob3dBdHRyaWJ1dGVMaXN0JTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQxJTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9vcmRlckF0dHJpYnV0ZUxpc3QlMjIlM0JzJTNBNyUzQSUyMmNvdW50ZXIlMjIlM0JzJTNBNTUlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaG93Tm9Bc3NpZ25lZEF0dHJpYnV0ZUFydGljbGVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQxJTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfc2hvd1ByaWNlU2VsZWN0b3IlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBNDElM0ElMjJkM19jZmdfbW9kX19pRXh0U2VhcmNoX3ByaWNlU2VsZWN0b3JJdGVtcyUyMiUzQnMlM0ExJTNBJTIyNSUyMiUzQnMlM0E0NSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX1ByaWNlU2VsZWN0b3JzUm91bmRlZCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E0NSUzQSUyMmQzX2NmZ19tb2RfX3NFeHRTZWFyY2hfUHJpY2VTZWxlY3RvcnNEaXNwVHlwZSUyMiUzQnMlM0E4JTNBJTIyanFzbGlkZXIlMjIlM0JzJTNBMzklM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9zaG93RmlsdGVyUGFyYW0lMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMzklM0ElMjJkM19jZmdfbW9kX19zRXh0U2VhcmNoX2ZpbHRlclBhcmFtRmllbGQlMjIlM0JzJTNBNyUzQSUyMm94dGl0bGUlMjIlM0JzJTNBNDAlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9lbmFibGVBamF4U2VhcmNoJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTQ1JTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9RdWlja1NlYXJjaE1heEFydGljbGVzJTIyJTNCcyUzQTMlM0ElMjIyMDAlMjIlM0JzJTNBNDklM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9RdWlja1NlYXJjaExvYWRDYXRlZ29yaWVzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTUyJTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfUXVpY2tTZWFyY2hMb2FkTWFudWZhY3R1cmVycyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E0NiUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX1F1aWNrU2VhcmNoTG9hZFZlbmRvcnMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBNDYlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9RdWlja1NlYXJjaExvYWRDb250ZW50JTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTMxJTNBJTIyZDNfY2ZnX21vZF9fYmxFeHRTZWFyY2hfU2hvd0lBUyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMyUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX1Nob3dQb3B1cCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0OCUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX1ZhcmlhbnRDaGVja1BhcmVudEFjdGl2ZSUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0MSUzQSUyMmQzX2NmZ19tb2RfX3NFeHRTZWFyY2hfb3JkZXJCeUFsdGVybmF0aXZlJTIyJTNCcyUzQTclM0ElMjJveHRpdGxlJTIyJTNCcyUzQTQyJTNBJTIyZDNfY2ZnX21vZF9fc0V4dFNlYXJjaF9vcmRlckRpckFsdGVybmF0aXZlJTIyJTNCcyUzQTMlM0ElMjJhc2MlMjIlM0JzJTNBNTAlM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF9lbmFibGVQbHVnaW5Ccm93c2VySW5zdGFsbCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0MCUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2VuYWJsZVBsdWdpbkxpbmslMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19ibEV4dFNlYXJjaF91c2VBTGlzdEZpbHRlciUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E0NSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3VzZUF0dHJpYnV0ZUNvbWJpbmVPciUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX3NFeHRTZWFyY2hfb3JkZXJBdHRyaWJ1dGVzJTIyJTNCcyUzQTUlM0ElMjJveHBvcyUyMiUzQnMlM0E1MSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3VzZUF0dHJpYnV0ZVZhbHVlQ29tYmluZUFuZCUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E1MSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX3Nob3dOb3RTZWxlY3RhYmxlQXR0cmlidXRlcyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E0OSUzQSUyMmQzX2NmZ19tb2RfX2JsRXh0U2VhcmNoX2FqYXhTZWFyY2hMb2FkRnVsbE9iamVjdHMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0IlN0Q=';

    public $sMinModCfgVersion = '5.3.0.0';

    protected $_aUpdateMethods = array(
        array('check' => 'checkModCfgItemExist',
              'do'    => 'updateModCfgItemExist'),
        array('check' => 'checkRenameFields',
              'do'    => 'fixRenameFields'),
        array('check' => 'checkIndexRefreshMsg',
              'do'    => 'fixIndexRefreshMsg'),
        array('check' => 'checkAttribute2ObjectTableExist',
              'do'    => 'addAttribute2ObjectTable'),
        array('check' => 'checkStatisticTablesExist',
              'do'    => 'addStatisticTables'),
        array('check' => 'checkSynsetTablesExist',
              'do'    => 'addSynsetTables'),
        array('check' => 'checkFields',
              'do'    => 'fixFields'),
        array('check' => 'checkIndizes',
              'do'    => 'fixIndizes'),
        array('check' => 'checkUnsetSynsetTypes',
              'do'    => 'setInitialSynsetTypes'),
        array('check' => 'checkContentNoArtItemExist',
              'do'    => 'updateContentNoArtItemExist'),
        array('check' => 'hasUnregisteredFiles',
              'do'    => 'showUnregisteredFiles'),
        array('check' => 'checkModCfgSameRevision',
              'do'    => 'updateModCfgSameRevision'),
    );

    public $aFields = array(
        'D3_PHONETIC'        => array(
            'sTableName'  => 'oxartextends',
            'sFieldName'  => 'D3_PHONETIC',
            'sType'       => 'LONGTEXT',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => 'modExtSearch',
            'sExtra'      => '',
            'blMultilang' => true,
        ),
        'D3_SEARCHINDEXDATE' => array(
            'sTableName'  => 'oxarticles',
            'sFieldName'  => 'D3_SEARCHINDEXDATE',
            'sType'       => 'DATETIME',
            'blNull'      => true,
            'sDefault'    => null,
            'sComment'    => 'modExtSearch',
            'sExtra'      => '',
            'blMultilang' => true,
        ),
        'D3PUSH'             => array(
            'sTableName'  => 'oxarticles',
            'sFieldName'  => 'D3PUSH',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '1',
            'sComment'    => 'search sort criteria',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'D3CONTENTHASH'      => array(
            'sTableName'  => 'oxarticles',
            'sFieldName'  => 'D3CONTENTHASH',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'extSearch: hashed search field content',
            'sExtra'      => '',
            'blMultilang' => true,
        ),
        'D3ISSEARCHABLE'     => array(
            'sTableName'  => 'oxcontents',
            'sFieldName'  => 'D3ISSEARCHABLE',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'modExtSearch',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'D3NOTUSE4FILTER'    => array(
            'sTableName'  => 'oxattribute',
            'sFieldName'  => 'D3NOTUSE4FILTER',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'attrib use in extsearch',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'D3USECORRESPONDINGVALUES'    => array(
            'sTableName'  => 'oxattribute',
            'sFieldName'  => 'D3USECORRESPONDINGVALUES',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'use synonyms in extsearch',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'D3NOTUSE4FILTERCAT'    => array(
            'sTableName'  => 'oxcategories',
            'sFieldName'  => 'D3NOTUSE4FILTER',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'category use in extsearch',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
    );

    public $aIndizes = array();

    public $aRenameFields = array(
        'D3_PHONETIC'        => array(
           'sTableName'  => 'oxarticles',
           'mOldFieldNames' => array('d3_phonetic'), // is case sensitive
           'sFieldName'  => 'D3_PHONETIC',
           'blMultilang' => true,
        ),
        'D3_SEARCHINDEXDATE'        => array(
           'sTableName'  => 'oxarticles',
           'mOldFieldNames' => array('d3_searchIndexDate'), // is case sensitive
           'sFieldName'  => 'D3_SEARCHINDEXDATE',
           'blMultilang' => true,
        ),
        'D3PUSH'        => array(
           'sTableName'  => 'oxarticles',
           'mOldFieldNames' => array('d3push'), // is case sensitive
           'sFieldName'  => 'D3PUSH',
           'blMultilang' => false,
        ),
        'D3NOTUSE4FILTER'        => array(
           'sTableName'  => 'oxattribute',
           'mOldFieldNames' => array('d3notuse4filter'), // is case sensitive
           'sFieldName'  => 'D3NOTUSE4FILTER',
           'blMultilang' => false,
        ),
    );

    public $aSemanticTables = array();
    public $aStatisticTables = array();

    public $aOldModuleFiles = array(
        'd3/d3_extsearch/models/d3_extsearch_update.php',
    );

    protected $_aRefreshMetaModuleIds = array('d3_extsearch');

    /**
     * constructor
     */
    public function __construct()
    {
        require('d3_extsearch_semanticstructure.php');
        require('d3_extsearch_statisticlog.php');
        require('d3_extsearch_attribute2object.php');

        parent::__construct();
    }

    /**
     * @return bool
     */
    public function checkIndexRefreshMsg()
    {
        if (Registry::getSession()->getVariable('checkIndexRefreshMsg')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function fixIndexRefreshMsg()
    {
        $blRet = true;

        if (Registry::getSession()->getVariable('checkIndexRefreshMsg')) {
            Registry::getSession()->setVariable('checkIndexRefreshMsg', false);
            $this->_confirmMessage('D3_EXTSEARCH_UPDATE_GENPHONETIC');
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     */
    public function checkContentNoArtItemExist()
    {
        $blRet = false;
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop Shop */
            $aWhere = array(
                'oxloadid' => 'd3extsearch_noarticlefound',
                'oxshopid' => $oShop->getId(),
            );

            $blRet = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet) {
                return $blRet;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws ConnectionException
     * @throws DatabaseErrorException
     */
    public function updateContentNoArtItemExist()
    {
        $blRet = false;

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop Shop */
            $aWhere = array(
                'oxloadid' => 'd3extsearch_noarticlefound',
                'oxshopid' => $oShop->getId(),
            );

            if ($this->_checkTableItemNotExist('oxcontents', $aWhere)) {
                $aWhere = array();
                $aInsertFields = array(
                    array (
                        'fieldname'     => 'OXID',
                        'content'       => "md5('d3extsearch_noarticlefound " . $oShop->getId() . "')",
                        'force_update'  => true,
                        'use_quote'     => false,
                    ),
                    array (
                        'fieldname'     => 'OXLOADID',
                        'content'       => "d3extsearch_noarticlefound",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXSHOPID',
                        'content'       => $oShop->getId(),
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXSNIPPET',
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXTYPE',
                        'content'       => "0",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXACTIVE',
                        'content'       => "1",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    array (
                        'fieldname'     => 'OXPOSITION',
                        'content'       => "",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                        'content'       => "Leider wurden keine Artikel gefunden",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    array (
                        'fieldname'     => 'OXCONTENT',
                        'content'       => "<p>Versuchen Sie es mit einem anderen Suchbegriff, einer anderen ".
                            "Schreibweise oder anderen Filtern bitte noch einmal. </p><p>Erhalten Sie dennoch keine ".
                            "Ergebnisse, kontaktieren Sie uns bitte ".
                            "<a href=\"[{oxgetseourl ident=\$oViewConf->getSelfLink()|cat:\"cl=contact\"}]\">hier</a>.".
                            "</p><br />",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    array (
                        'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'en'),
                        'content'       => "Sorry, no items were found.",
                        'force_update'  => false,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXCATID',
                        'content'       => "kgo83a794223bfd23cbb091d0a34019d",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                    array (
                        'fieldname'     => 'OXFOLDER',
                        'content'       => "CMSFOLDER_USERINFO",
                        'force_update'  => true,
                        'use_quote'     => true,
                    ),
                );

                $this->setInitialExecMethod(__METHOD__);
                $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);

                if ($this->getStepByStepMode()) {
                    break;
                }
            }
        }

        return $blRet;
    }

    /**
     * @return bool true, if table is missing
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkStatisticTablesExist()
    {
        foreach ($this->aStatisticTables as $aStatisticTable) {
            if (($blRet = $this->_checkTableNotExist($aStatisticTable['sName']))) {
                return $blRet;
            };
        }

        return false;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addStatisticTables()
    {
        $this->setInitialExecMethod(__METHOD__);

        $blDoRet = false;
        foreach ($this->aStatisticTables as $aStatisticTable) {
            if ($this->_checkTableNotExist($aStatisticTable['sName'])) {
                if ($this->hasExecute()) {
                    $iCount = $this->getUpdateStepCount();
                    Registry::getSession()->setVariable('iD3UpdatebaseCount', $iCount + 1);
                }

                $blDoRet = $this->_addTable2(
                    $aStatisticTable['sName'],
                    $this->aFields,
                    $this->aIndizes,
                    $aStatisticTable['sComment'],
                    $aStatisticTable['sType']
                );

                if ($this->getUpdateBreak() || false == $blDoRet) {
                    return $blDoRet;
                }
            }
        }

        return $blDoRet;
    }

    /**
     * @return bool true, if table is missing
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkAttribute2ObjectTableExist()
    {
        return $this->_checkTableNotExist('d3extsearch_attribute2object');
    }

    /**
     * @return bool
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addAttribute2ObjectTable()
    {
        $this->setInitialExecMethod(__METHOD__);

        $blDoRet = false;
        if ($this->checkAttribute2ObjectTableExist()) {
            if ($this->hasExecute()) {
                $iCount = $this->getUpdateStepCount();
                Registry::getSession()->setVariable('iD3UpdatebaseCount', $iCount + 1);
            }

            $blDoRet = $this->_addTable2(
                'd3extsearch_attribute2object',
                $this->aFields,
                $this->aIndizes,
                'Shows many-to-many relationship between attributes and objects (table determined by oxtype)',
                'InnoDb'
            );
        }

        return $blDoRet;
    }

    /**
     * @return bool true, if table is missing
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkSynsetTablesExist()
    {
        foreach ($this->aSemanticTables as $aSemanticTable) {
            if (($blRet = $this->_checkTableNotExist($aSemanticTable['sName']))) {
                return $blRet;
            };
        }

        return false;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addSynsetTables()
    {
        $this->setInitialExecMethod(__METHOD__);

        $blDoRet = false;
        foreach ($this->aSemanticTables as $aSemanticTable) {
            if ($this->_checkTableNotExist($aSemanticTable['sName'])) {

                if ($this->hasExecute()) {
                    $iCount = $this->getUpdateStepCount();
                    Registry::getSession()->setVariable('iD3UpdatebaseCount', $iCount + 1);
                }

                $blDoRet = $this->_addTable2(
                    $aSemanticTable['sName'],
                    $this->aFields,
                    $this->aIndizes,
                    $aSemanticTable['sComment'],
                    $aSemanticTable['sType']
                );

                if ($this->getUpdateBreak() || false == $blDoRet) {
                    return $blDoRet;
                }
            }
        }

        return $blDoRet;
    }

    /**
     * @return bool // true, if there are unassigned synsets
     * @throws DatabaseConnectionException
     */
    public function checkUnsetSynsetTypes()
    {
        $iUnassigned = (int) $this->getDb()->getOne(
            "SELECT count(*) FROM `".oxNew(d3_extsearch_synset::class)->getCoreTableName()."` WHERE 1 IN (`USEFORTERMS`, `USEFORATTRIBUTES`)"
        );
        $iTotal = (int) $this->getDb()->getOne(
            "SELECT count(*) FROM `".oxNew(d3_extsearch_synset::class)->getCoreTableName()."` WHERE 1"
        );

        return !$iUnassigned && $iTotal;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function setInitialSynsetTypes()
    {
        if ($this->checkUnsetSynsetTypes()) {
            $sQuery = "UPDATE `" . oxNew(d3_extsearch_synset::class)->getCoreTableName() . "` SET USEFORTERMS = 1 WHERE 1;";

            if ($this->hasExecute()) {
                try {
                    $this->getDb()->execute($sQuery);
                } catch (PDOException $exception) {
                    if ($exception->errorInfo[1]) {
                        $this->setErrorMessage($exception->errorInfo[2]);
                    }
                }
            }

            $this->setUpdateBreak(false);

            if ($sQuery) {
                $this->setActionLog('SQL', $sQuery, __METHOD__);
            }
        }

        return true;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws ReflectionException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function hasUnregisteredFiles()
    {
        return $this->_hasUnregisteredFiles('d3_extsearch', array('blocks', 'd3FileRegister'));
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws ReflectionException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function showUnregisteredFiles()
    {
        return $this->_showUnregisteredFiles('d3_extsearch', array('blocks', 'd3FileRegister'));
    }
}
