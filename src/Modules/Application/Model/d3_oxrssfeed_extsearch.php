<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.0.0 SourceGuardian (05.07.2022) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2022, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
