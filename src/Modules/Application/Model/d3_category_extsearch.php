<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.5.0 SourceGuardian (22.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
