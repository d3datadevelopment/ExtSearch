<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.2 SourceGuardian (30.11.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
