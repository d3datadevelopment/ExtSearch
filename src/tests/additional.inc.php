<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.5.0 SourceGuardian (22.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
