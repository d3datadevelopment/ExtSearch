<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.0.0 SourceGuardian (05.07.2022) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2022, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
