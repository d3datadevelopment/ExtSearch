<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.0.0 SourceGuardian (05.07.2022) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2022, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
