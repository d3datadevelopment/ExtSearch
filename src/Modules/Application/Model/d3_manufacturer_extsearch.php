<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3377C1C97AAQAAAAXAAAABHAAAACABAAAAAAAAAD/FiN4Eo/syabdxwVP9rT8iOD5W+tEW/5TbTqsCzKiE/W4gMT9wWmqmHAKLH1+usRsY/x5S7wsiKk0vIEgDQ7cER2tEl5bMteMl/bC9dCS49kHCrFmMKYixQFC1ME4cTTLEqfN4WNEZw+cQh8vSi2KWggAAAB4AwAAnr2HzXqtYrB1fuZ/a+Vdj0DbV9gcBwbsUj7uL2qqDc2M5kL5TfMf2GCJXVIFrx697jrLMnQXKY3Ng3DMgYQRLbdycUYPmZopjVs7kYRN1GVVRS0UY9g4nkSNHyF9ikL6G5unGtKu6G3kotzx3TYCc35kuQeGFrs8wBqZXsxcM2tCWa9NHYh6hw9i5/j14Xde2LVQVMnQa82j/R2z8cdo9zvR0bWOiguYSxGQx595aintUuxeiwIz271siSXxHkYE6/mzDWf+iCfiAtLBTrfAmW2AazoQgRniCw48HeprMeV/7UWPhWQcNZCRGx8moKIkob8J8vmqoUEzLOxZgiGuhSSr3TFF1Nhv9N91HFQuswhbecT2q3SVwkZa3KnuLH995pMdMT2O70KMHepwtmm2QlVTP6ZJ1pDi1OKXpj2Ax6tpo6+en7xri657QzQowJkKCfIaWxDutpu3cYmCkDljjhqFynbmpcz0cj3pPt66eoWiVkVLAsWv4srQR4UNl03C5aNubP5Q3Bd9Fku/c3AEP7QZZEtPkfkt9a3b3nd/aTyp3JirJTSNHoKmN4KnfBwZUp/hIjo7Hu9icCsbmRMH2BeV0Lh6P8cTAiJoPGA2lvmpbROKRk2vSer2YlZDpnpTYzlq4Bx3VO7I9tfBPMOYs6tk6//rLyiuniPKkfcYxla1szZgV3vtA6x63OuSHuOyZnAiDlYSIFSn6z8SsuaQO3SXydhJ8PRsa3v3uWVRZU78VxkCgJt0LmJl2dk/uHyvy4oHEGk7Q92bPxwo2cecAKU0+qSltGiki94QSbBzfWEdtLA0ATka3sTx0M4JYT6R25Z9JxItpUbla9quWYYu5Irf/MGIXV8gZhIqElWo+j9Y2vSyDx6FiPO+hExGu2rP3m0Tw5/lTj0lFKqaWM2pBv0ZqF6X5nni/1lQF8Ut5A+e0sNWOKkb2xg9Q0L094e3FBo6kekV6I4CTMerA6EMozKR4Tc6A8PAOtCKQ/rDUDrtTfyZPJ3inHkMfU0TLjYxT6aI5MtDgYgMbzk8D4Mw4h1ADDtG/ju0GIDPAe6bX3YKATSAteJocl6+7kJihSkBushr4xPHwUJaSPK43q7aQB4YoTVQ53qye5rR0Tirn4wCAEZuHHmt03x06AR+1FU298VPb6XZTZek9Pv3YfFwdVyptyAXlixoUQAAAHADAACfwP0nOPbz9Dx5UI2388WW6fQNh5lqVlYzkLBjNvxYHSYKn/3K3mpleTdPRXb/JnTM6YGWNObtE8NNufbKN571tHPqITkCuSUE7mNDLDyCimvGwIMIJwlRRISLaNbee4Ae3b/9102y2PBmul2LXP5Jxkg3ywQDL9hS1a7NH6clyxWznDxtaG4q1rPL0F2BHQUlkxKOxwNstwR44el9t879tigDWzu1aWw95oi33jX0gfgRCW3uS5F+ZPqWqWIdDZ35tRc7FuFlxwFTJDmgqYQI0dtup3Ejk7ybPbciaOwZaLmUN8iMe645NHRxVZ+flE2i+nVA93Xxfvx3xrMqViOIGSPOpthbVqY3riO6KQ30C9cPtzKGHlzYfTT/hCZ5qlltsKLfQ2JMh7QDTIigoTt9KPFGIV0Oofmrc0ex9RDKPu4PbT3sRsY9CCQZYT1yMrBsLD8GemxYbmijBajoO5+HuEe8JFWgKvowAwBYle2QPw8au1Ou7HdIPJXze+PEWTXTebMGuHknj66CpFav6VnPm7hPF+9nc5L7mZfRzkoL7ThOcgiDsHrcd8kqg+/TBCmAXHrFd/pLq7MAO2FXYwJjXkvh0Ldz57yaNZdGtkwpXGeKVzd2ePBUd048gdhXV1DRR4qWYiZEz0JbSzenfGd6lqE6AYnii+2A4V6hamZoT1z6Tc6hP4GcSdqbFyfrSl/UvbkEId5GERnbZTsAGaJ3Nn8j1f5Zxw+4xaH1WwOcSbFLKUVIXNNIGxcq9NKM+l6oDR3Dve/38TEweNJ+n5OfRZuvpAufhXKammuaf2Qd6dLGHlNHvUxNd2irDvBXbYPMz3lrKt7Oj4QjHlGrLoiOQjNDdUiGj0WiTz/8R0TLN6FmlTEATCDLTjvfNNgWGyAx+RLJBaksytfBUbd5sT606c/l2ZXa7UUtjt9EW8JgcT9MYaDfS1gGfkKgO3E3Fzo3CDMMOqVlR/r/CFaRWt4Z3oHnqiH41u5yjbnWyKUwGP8pQ7mHvD0hvlgCKdL5sIgydBzEr+BTz698ZZZlEWP5PquB2tR7LjHgUG1aKwdg4Wsl999PK2Y4FEZVS2yc/o79p6KC3jEiTgsUy6M28dmlc2iZP2MqhMbR5/KBcDEvNZXj+0VyGPewrnnqlsj4WX1EEt+DaCppUzXkuQ7ISxCPAAAAAA==');