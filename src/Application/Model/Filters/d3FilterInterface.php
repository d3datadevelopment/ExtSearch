<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
