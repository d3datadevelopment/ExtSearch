<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.5.0 SourceGuardian (22.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
