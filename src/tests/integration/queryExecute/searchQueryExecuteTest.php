<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.5.0 SourceGuardian (22.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
