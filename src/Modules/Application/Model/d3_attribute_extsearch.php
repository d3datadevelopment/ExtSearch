<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
