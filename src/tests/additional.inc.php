<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.3 SourceGuardian (13.12.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
