<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.3.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
