<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.3 SourceGuardian (13.12.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B33D7C1C47AAQAAAAhAAAABKgAAACABAAAAAAAAAD/y6H8uWEVIuDJOP/TReUFZzd0W1M5iHr3DbjR/CZgCIbZRQuxKtI6yUTZmxYrkSdLTFdeR3FszizP6HiwXdYuKq7bX8SrwxJrY7sfVdj19Rpsu4gMUp1Y4/nWbmyv7L6a+HgpI+T3/QbHePUlKDTR+ukuDxmphkAWtQ7j1fQ707z0h+Uzv7nu6DdVIRHOnNmZs/SC3qrGZBtvUCw0z5xmRbffWsGen9MxCAAAAGAFAAAHkbU5Ft9SfBp4IciBxCZH8Tkn26Q0Oe0CHCn3Uzrm3DQ0yseghIZSzrkoXeuLglPsrBRDFC63YUNf9Q58U8R8cFTVfCyVrWVYF6LcPv1RQ73DwhOcwewFCnli/mz30O1E4bXVh+YTO650ovko0b64Evovg5sCQHz6ZdYRiDhRA+qvSNhJBxM2IYU4v7HuasiuLRUcqLjEnCv8x5xwoh+mGF/K08XZahLB3qH16Lj0TOoQn3fuRXw58eFlWyV9K697RanKl98TqGIgjCQwOtL1Ea+PmWGp/CaRj6X6FAwY3BF4giOxMJERFaLaRPc6gs17yGamOgwrdVE61lGJdwbmhwxujgFruoKy4yxuEP1hPtsAKmUDqmqOCWy6yBdTmrUsVNZh2S8aVMRn7YJWWBdEDZ4cNZxhO0JGx4KJrH0QDXWuo2Yf9tx5yj4e26CE1RjcgoMdmEne0NRqMrVxah8ItOzQdb4LppWJ/wO/oWgcG5eaxqjfYkoUxj74jj/T/XEwJHZwkj4yLWIyB22+ao15834qYjSQbcU4ZHpITwrGuGqCX+bHtXsqgW19DrCkiYn080p6AO8fFnYAz/LheAHKH6Ss8O5AfToClD+/sIj6sdj6MU7S4vQx0OqrmRrZBchUWKIvVu7/AMxzmgaQMSzUbjR7eJ9Yc0wu4Nf6CuLEv03qWD0kQKRZQvQihXm1VUfXtxCc6MwOCP7wj2O4uibe/dD/TxEquSpSpQXIgC4Spgrly8PVK+Txsys8aF5N5BGEO/AypS13OeELTR9FKqUd2FdEDlhpUt46bxBMvh9dFMEDqiL14uFbCpE8NdFZo4sX2D4H5lU1lAV4X3xWJHNOMEo5veOx2j4tAqlPhPaaryHVniIgcLPmXNbyG1N0Qd/6dK8cUFWvvtJCowe3kIylp785F3NER3AUc3qbhkS+enUMQlS3IaYqVqzoeTgwGw3Sk36AzJ6auoETiEukBfI3X3YDp8lI3rDfLcxfGkxXipw10hlyk1EbMfEUOPyL11qGTU6ytsiEI4PJiTxG5i/BbTUrk7iBy48M4HOeM71iF6OlTWzxaQKs49bbJytz9yQFkvmc5YF5feb04gUcKOE9qlMUofiveDFIBnRcCboikPC8uHaW52rsbrKhpW6gHDcZHeP8bZ7TIXIpOvz8ydEzzrgzl/JGZ8YpMN+UmJkQ4CUnB4PkHM5Sw354MK50hgm6VzzPKpY9Cnq+xmxal69iS8ytQGH8kwDLNLu23k/dj76p00PRPyWpB5OXWDb5lVztejnOtGzOhy/m89JA7LIoIepoLK5JpzCI8ZiAuOhoNWc/sUX4oKCXr7RcqFt+wbQvOK55K7NI7Mf8eWdFOaAWBYBVlgeYIhtOn2MNQaXwX3xi9KOdf1xLCGuLEJ7trksimUBCzEARpdXwrN9tGa2zMHMuEkgxuMdZJRRsidnN8u+IBF6mdET7Zn8V5pDXKGN1XE4EUeypQnbaXqD9cQtzLsNDYWSDTbRjrbPo8uubXXqZPINJS5nVQ4k7VdIJI1lLrXCitU525bEh2bO/M2teqq09zKZ7vft6b5wqVLkblD7IrVBrvJ2DZas1vO2lNbgfIv0udS3uEIHcu29vQ05KbLzcJGolOZEHCjhOi2kfANZdQVkSuoKHLrzQzLTi+r9HhElUxY4oGPrf5u0/K5icniS+c8gRg0pepUfKPmMGUHm2ZIU3sb9IWfl00pzq/yLP63BeNmEg80AcmX+L1iXBDug3V48/h4OSXi+1m+aSPMZsLIlnAuiQmFFTnTWZT1Bgk5MMRkLVEN979E4B5VLV6rorWMvUDZPj3CcGmSwRnlEAAABYBQAAnbDb8St7ksPjvQpsVuwSnxnG+ApOoE+FvgsE1wffTm46lAEjLocs1MosOKiwIxCzbhDct2A/PK68INwq+IK1mcTs9Lfm2+c7yNC+L3MGNUL/81HJyd+uEEXKxCl96MMv5/7Wxb9BAR/Gg5Iu05K/iMIr9Os2EOlWH9kEHG9kCu0sZiXkBEQRVh0JkcVFqeiuX38ujCs7tNQ2B9bWpJ7zWDYo27y/jU5dalSago0HaAr1fjEgQzqplU9/DNnGozbMNOfmZfCTZOW8JbE93nTDPoDLsMNYqp/ni4OVcMer98SVqQQRqMtKCFQ4byzjBSqxuBJfMLQTb+z/nmIIUyqvXCxvt+lkqT37V1ktYlUiBONkKXibpRyw0Ye2tkgG13otcax67+NTDxYLK/RCSBjnKpoh+7+CxYgJk7m8vM3k/NDV+8homUgAC2onAKy3Jw6Lle1GJGROoEBZVD3fYlkXNQjoJe4QVgi2ZeqT6ICoBzAMoiBJHUeQSu/pI5OXZO4PMCFm//4OTfvf0Q56DOaTKgc/rOZJPtqX7bYUPu8E2W/mvUtBCKUpm7zYMHywrH8A0xKOLuwmaKelbyuOe9uJ3U+MgI2ay8zxxMrU87IBBA3Czw6uaMHjYUWtN9+UiGKV9ZuwvQzOHS9Q9WjcE9GMNLSKtWqKQQk+IjMKFV9KU5VHQe1dHkN5wqL7iTtozUYK1epDyPkXVz89+cCeKrrm+oZHxMEmj9neo7U2R21/IR2FACqtZXw+nlmbP8D8ZpSJBarWVJ9IotYLMrJGgUM9K3J9nm3usNk3GCsn2Z4oBbOwedc0IfmArAu2/GHpx8wiREWK7bol5/qUkdWPhWCetvwiZVCp9TVSKlI7Ld2gjWDm1Nuw4dBldj4+aIii7CVHNzNyu30W+b2LGWvDuRK/swAsgPOJr8fQij+o/fYOZoRRuFnoFrKboBeHc3Q8cw1r5QOYY5Xjd02LQolScq5A6ZG8JFJTfjVGlXaMHZuqWETyeFOVl93LuB35zp5W3TLUfoYJWgtgfGrmxpxpOnDE9aKTq1CkeigB/H5MGc60tx8NKzZO6Rdm5+ijUDREZ77FFGqmZeeIljbbhyUALJCZz+B/vIQvTFfIeyT0ActUCVm72BAOXNATu6tDavvVaNERclWuYLdNNS+bH5FzWV+rjtjftLLXX57sPvSp6OaRRHB2MfSi2+7hoqkH/kfFzU4xnMoz/+YcwAsDWHBpc8Zb7oTwgO5Qg3Kwo5ZsweHazcaABcMUnyBZrg3qPU/AsZMuEpz5VL+5lPNRFiAlCuDpOEDhlSqRg0zDxQRGRpgMWhKuo64hxoOshEB70TGGw8bO7YyBs3DrHx715oqt17UnP4VzYet90GDCcTS61EBPTuMx6rdVEWrKNtea/ufI+jtm1gy57gE0UQ/r4DS35qBHQ5A2tva6UoMRIXRJ4f+2YYwWj5kuSaVSt3uPP4C19hL4KbrdEpbRbvAYqlgYFaYg3RICRfdXvUICrHGaOoBBHukivdv6xbq5nIVyAhqJbQF/4f2X3aO9fCwat/T1aEi3Ogz6bUjkzEijF5dubuK7KVOY9nhT90XyYNc6Q7Xvn+CK/RQSTjFuO1yH1p9pMLzo+kiJILGprEYdlPYYpsVJU4lxK+M6mu2kd41p+23ibEcXkn57/2Sr5RBrW7JqcUVwRlKHxYUJy0pvQaH7g18jaLTWPxM9XRvqoTBJPy2h8k4+d+JaHpHCcepe7N42JuSifSwD2JxhtuPFk2UW13C4SaCf5wK2Mm4ncyNqvClIhGGrQ/9ITC6uld3IRq0XNKWCeOeZSBgMmGQaUgAAAFgFAAAlRxyBGHh5UEov1Vvs7WBrQABZQvswhVyDYD3C9jI1X0O/ipsOOjDC2Z21wFxEpYnLcCNHvrVzTNjrmIl2YzWVQErfR9UTxUKV7lPeWzZw4qu1sK+VkYpEHTiQrez4m6tdDYhypc0VKffc+RtOw0MJnynqGFSSiHlsOL8kpCf3LpqxFEYyWgVl+SsaO0jZ/M+q04pbk2VDN+W1KTR3JLYGOJREsTBl/Ml1sTSKaWRZcQh6Bx6x2X/viiFYqkJaenFOk/gcab/oMU/+q7g/VHCq0VCDAUNO9XJEMx4K++dVXSy4dyG+R9zVG1PehLEVWdfFbdWvIhbgFrNPutaL1L9eiMyA0LyK8PpqcWd+Sl5Nwcuz6s+ABRePaetoogvrskNOgWDxAzUqlCcFTT++54WAurtVCkuO440Du2Y8dVBu7vukB9Numal6canT1MUsPrAfnK6EbiE7ktC3PRVLYFwvxONWzEm8Z71l5Rofwqxe7KPQEhnmRrg+06S+laJKvFq2ll8Kt+BDZSWMjSYGYE2oGt28OagoUXF+6gMoCc+xiSpQPZfLZuTRY/Go6Dafm2V0qVIj/ioYHio3vebYd3uatbh1wlnynpXT01cBZ3B/dE557ulQcRMr2N2oghAYIrG2Wc0jDLkJ2eFy6xtv5XNl07LbQWRaYpzd0WTmUscP0afO50MTaG+2ouzcbeWwxz9xOYaZpO6vifsrkVOVrQfSmOyvSp0xJvmrrp20ohnQnVHRETVjNqS0rN7syIe2KMNJ0f1V5miz4tTdmzNdT5knMAtHtR0QgA8S0XetulO2D3sKOoqF2uZ9VxvnsM3u1UrfWIz0G3v+FHbggGhnZTdqcJWsdDuH7fb633ZdKDz8hNtFbaxWkX4WfqzAyYe3mO0vD0XbbI6Z7djo7O4mbJ369nxBobK+/Shm9nUyXE8uoClVrjnvpiis6gl+VWnHaQSWz2CYk/OdO9gZWzLCsdUp3uz3nYYGzz5XSjvfhsjEthapJbRKUBjdxq1QkP4scXj9PJh49s/dF7bNSscYOlBu6qqE6tF4Q2Jmmnn4/mfFCSF7Kb5S5S7yBcMcvsYONcFYVRgsJRafKTdKGNb7mgMwbJejLaKbmm9wp+BzoUgrzXV6dFSd3w9vqBZwZI/+FvovrhFsw4k8GH/dDxaJ1QYa6YtlCJIh05RuZ3aKk5tv6VRpTF0soslFnZ2vG9+7SOoe4zeieqWZSKRNd5X4vL/GXsUHN45FALKLxud8B2NZqaURVpEuEr8hjorz2S5xarIUrvm8Jk6u3dPLJszDi0VM+hPYyUsUtQqMdMvOyh1U39VdK5MjWYK3pBxOQPE8iqv3IMX47TsHfUxCeiXrsJuda7tv0+CdmVRFnIy/zQTkmAuVfwn8+kpb38IaWYakrYMh/edPeEHRjU6OOvYU7yhmNh3xDTotN/d+ughv1DGFIY1BMbAH8c6+GCxb2qHhynDrlmOX8F7h0C1jo7buefnlFqbBrTIb6XIPiLkZAvYbHY82HBIigH0QRf/unteehCj7X3BL3FC0h2T9YsI96kXhTvMprZ2Sa0ZqbjSy8h/ZdiKiCFvYtsvXBFQvqgkOQ7AyMry0xcaygO2xjpVxcCj8Rl9Hrat/bkrHu+QfRoLiPfpr1GhB8ZQMnPD2sLrix0rz23Y9Wt9MrBwHe5m+WbxLMNaK3G/7zEkKxnmMOJzIxKxVsXXDRtBVXw6s3i7G4/maA2pgim5iuAsJHBvt7rFtrNQWsi5Zd+NhPekfo0N+p9KksIrCb3U0EkEM3gLRCtR5NPeFPEqY+CrFQFbDDOIriQNzmajzFfoAAAAA');
