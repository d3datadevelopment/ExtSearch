<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.1 SourceGuardian (20.10.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
