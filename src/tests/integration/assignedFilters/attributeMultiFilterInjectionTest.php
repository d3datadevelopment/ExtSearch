<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
