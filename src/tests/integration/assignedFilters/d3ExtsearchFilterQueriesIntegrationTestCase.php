<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3377C1C97AAQAAAAXAAAABHAAAACABAAAAAAAAAD/FiN4Eo/syabdxwVP9rT8iOD5W+tEW/5TbTqsCzKiE/W4gMT9wWmqmHAKLH1+usRsY/x5S7wsiKk0vIEgDQ7cER2tEl5bMteMl/bC9dCS49kHCrFmMKYixQFC1ME4cTTLEqfN4WNEZw+cQh8vSi2KWggAAACoAwAAdJJmyQes0zQETFQpfN01CUqlRa1WncO5w8OBBebM9AudMKCclbjmT/4ihimbTBo5/lXTEdHP+ueIyhViD3OwfAVOrUyow0FTYIHjekX0PsD5ogJoq4wG2ddxIV01py3fg3/KEGHtUtgFBpQp9T8CmUzpHXaihMl6mfJs9VrlzU7VNMv3+cibd2MWghBz44j7akRgmrSEtywFQFDHGVFzN8wUvu8WT69VRN49Aab4L4EfR/nK2XPJpVoPaB4azKWbSeAetQBpM33AxZUxD2zsvdsHzFEXeOZwruuPQqNLgfniyBw4+O3Y1JXep5rbTqs+d7rg1SfmJ2G/DKrXrKllL/+TlezVzrw3rxATmH57TSrEmSPgXTscmTJKaXlUsCfIc9xLDPYBRuAtotUS6Z1cL7OX9sL2kZ3Y0b+NdmgnVEsFUHKpk6jmVzTuWniLJvIW+l+PUsFpqUBJWGjEXDobOuElWYzOe3BJE2pEfdjGH908fnPqImexZ03EvE1M1LZMIuCdJ7snNb1I9cWQXW2lelLgJ6Ad5xnk92EnDQcLNjVuAyB1iFAOa3qjfj3gow9VtdReVNWpzmJqsv/m0o84pVZM2PyHAQLDEDCurlTO1mHC0yjU9ghFuODH80PpNTWHcGa9v2icB7y+jQ0f5AjPMhmW35YAYrSb6hhNI+t2mVUy4VasUD64lhjgEM66LGVRYjXJh0hp6fRFVz5d/vTWqbVw4CpYuMeyO0nBe+rBtdmhs5Ms+gFQpMXBOOePfPvQCrXzwdioNWuimnaiWFYps1Wua/cHJFhoWCtwYjpRYryhzjFP7UXzhANJWQr/tWas6RkTvrtsiu65EEf3nSPKylAjpC1gyir32+phoSKt9TVPv9mpwXZindvtxTT5iY4GKMdiR5P6Ob1Vpfiwl/RefGL6vnidrFAaaLJRi3sDkIJ8fXIAXjk4aP09a/lC+e3TgYTq4f3Kf8HekdRVUyzA8AF9l1Dl8cJHHIJUJ0AkvpOYl+hb6VSI9uEfRf1nv7RAWGhW33GVcL5Z8KVu1hiLN4RXSu5df2gnGjWYJGZ8veDeKddv/qFxoOV91SQiYZUeF5PiysetlQPVZQpOkAM9TfJKcJHRGBWO5QLzYFd/UE7Jg0HoltA3qyJiuH7Gs5rXCgIX/jZzf9etQx4x1Zh3GT+XVrBV2dfUqMnsuojon2PE5pf0ML8u7DqcfKJX8TQ7e6yEPeh/0YhQQIko0ThJ9z2V5mFg8PwWUQAAAJgDAACLfTmcyYKSalt+6in2R1FsVNwhImIZwcYujpwM7dH7tBHxQvA3+vFg6XuRLiCJar0S85jLOMoAIWgAheug82v49bau1aZp79saoi27UpNbxgStyknR1XZ9haY47Qkbv63Jp87HopqOLkP0+9fWE1yrAxD44EHJFP/v+eIehselEKZePIAZ2pluApbtsO4VKQ2XDeATszg24Z7Ir8HPBTIC4RYEFaqSmz2Gs5l7Hx3AQuoLCv6Wjic5cs696E9yuST9lldaXt5cx+aotaP5d5joLHU65SZnFni94csSAdTvNK6Me5mC9l9S+2jgjwF0incpuf2Funr+gNpNMATR/OGVkrPYGL8+OxS5OKTZMzKLXY5m3YvMY0uE6ejP/VERaEbqOCYhBcBUsJrfW8uNMmkJ7+hdnwaK9wd2G3mHmira8g+UPcrQNL2ak3vlkNf8xxoVQMcl55j/w/hoMSNhGAxn489EBDtb+D46kUMJOVGBTUx9I3lPUnij6D6lr49CJ5Mzmu4pGf7VHopdXUP/+H3imLYfeBWhBAwBP+f0+vvjAf1Bf7+C/N0Hn+H5fUrbAREwt/2iTfESQmxDqFPmXOX9OgRqVXgF0efdJLiKvcmw1kmXj3z7YcuVErHmVjep+aNzo1jOo05iCY+fqs7xJ7Yg0ZTs1oRig0ON9JRvRRayhNFmtkhjThged6kcWImcw2yotASSlPYNpVwSQchBFYESyEabNf8aTG9TUBKCGc5Pwlm/cc3vadePWLOzhqV2jdj4b8isW9arBeHT9rrqMkfGOQb+sW5juFgGKSZhgg+UAoYx/nU9XBakyStUCXpeCnALxzBcZB/rdRkJUnpMBTq7kAlcCPYvSpZF6aiVzjdEoWGeBZwAMQMPdDdyI34bggcxkpGH+/yICKKOiJ3dn8UlHZG61yiegR9XXXfKBHv94G9mAG34xSd5AIAew6NIpWW0TlcQwtApX1ZVp/isVyCiHrHUrjNVJpPjcMP7yTicVuX4vcEgDOS773dj0vLXYzJtw9P4z41A48kbVgz7UiFpXkeLffQIcf9/XHgv4IfvJEBoX62a7NOLxNTEdPVO9cN3sZBrQ8xYpaiklmvtBCcFCiIiqv6jwcCN8DmEM+oHs0zGLI5Bh1844+1GbLXKa5ATXQgoooY7TBbItCD17CoMUwrrwBVyCxT4xfIj/Yhk2abf9V+MDEL/DD+Y9APFkvewgSAdPZPB4wAAAAA=');
