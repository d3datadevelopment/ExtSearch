<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.3.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
