<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 8.0.0.0 SourceGuardian (09.02.2024) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2024, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
