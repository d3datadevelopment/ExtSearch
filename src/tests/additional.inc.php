<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.0.0 SourceGuardian (05.07.2022) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2022, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
