<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
