<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.3.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
