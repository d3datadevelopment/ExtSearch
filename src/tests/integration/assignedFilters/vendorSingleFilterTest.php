<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.5.0 SourceGuardian (22.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
