<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.3.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B31F7C1B6FAAQAAAAXAAAABHAAAACABAAAAAAAAAD/32BSfUWfZt9NRij1yiKy2XpJK80XEstHPc7n+wku1U8lYh0aji/kVkjzo1K9l2MiHhi5JcfFZTO0NCu/jtTElWYaOkeUejKsM6ZsNk2kFcInKEds1r283SHp62bgouegz2XA2jUcG/hX3HYr1+jmUAgAAACgBwAAo02G2ZYcgIRQAFR/5ykRNa+FnVUBnvreUU2jthJNx6Y2fWQcmIIPRKe+/fxCTuinJotkI9IfgrihFhROzescoHbv5rtoafsuJ0lijp7UrzpkEj0cB1Mh7mKPORAbKXAAdm44P+w4M75YJLlDh110nRyITDx4K0qbGN0ZZFNqgTEGztHwpqtt9229UYTqtkTTVyVysCmL4Q3IfvCdMVoAISeWE/+gQmhQunpLynU13uvfJntFQ45QBII8uBU/ECyU18aOys/h/a/RH4gKNDUwcbGXY1jDZR1O6GW6B380xX1i++mr5Gyvu0mzTv17nr1PUm3/rZ+6Gq+UNNCR16RDrUyQTTeD2NrU7JotK3AUYNRmvd95M7/6MlOoYdvRyEEBY7kIDtsK2g7dyEa4RzfTDgsqbHdNiNm4MmAOYwsBehT0kzvlz773cO9K0DEKSzND85f7P+/Pv9jdB+nXCduqpe7/TasSfeaSPEtRTlmjoOvUMbQvHTlRfjfWnY493F3g1nYGo6fIHAlotzV3U6oRh7zLc0KAz/tczkaamVzmJp3mIYRVO8wVm3CWTBFHo21+TznSuApxlFRN/DjDEQvNUr2mQFuEaUJMPxMZs7YUx38vCBiqgKJAL+sslIq8DGDT9X15VN+tM++RKfysxNodPljAnU55jtOZk8nkPv7XXcQpztKi+in/D772+ArC3NE3mEtVbOPZv36F1aqI54VM3boygSVJELS1CNlP4tJUQ0UerAmy44HqEo3QWhcyAFwVsnqmBT5qzPOK+JSkfnc/DPNucot6+4yECvnj3FvYEaVPHP4c/XBc/IbTcRSHvMv5wI9ZiZKWsL5Zk3muOvQDUI0TuXdtrx6GlVvYGWHwxv4wBMUyRZXOspyCmO1T7PGvA0byu1P0fJO7yGOaU/3hFte7GODLx/4RPQfQYIGgzNtjUsQz3gZX4M0K9Iopib0oigig5EOQAJsRtezVQAPW/9X8Zd3qdH61rfT3Gvua7FpKTACOIu1ANjShCZ9Qbq73/zz0bj261jO5R2WCQXnDicokqoWrx0iVsxCV0qs0GE+DkU0LEGSXdSLqviA/HmyMsq0mFjtryWWVIGk7n7Gms3eN8E3j2+T4n7VRaZ/0j+ul/SfTloVq/ghC7q9ercGWs2vCOOyIuaFnXubdBRG9pCnyE3a7UaTSshATwuZN1FwQpkUXeyFh8TEePnZipZ1E8MtMBJ2bD8z9F1WAQhkGKG6+NJvmgsV1ZuZ6I62IqhXo/HMjN79KDwLnny4nM9tvdD54DWL2c5bdfvOLYfalp2YhAkvu47UVWpENqw+/12AkM5iLxSo76JkQOmdQ/KdgK4HZK+zIaQkte3Qm4q7UcMOYMFSqsW/ve0vlcrT7ZcuAfufuTIIDG6VfBfXh4gyUek45tJo0NDMIL6do7Qte1beFzEIKJQ8A9MSMxwen0cwUkzU1mEYMQs/fk/IixG1TEPAuBJ7d9Ec2YUJoJ4NBUYWxvJVESQMSTI2kXshwvejnEkskpYdNCVE/B+9KEqBiCRHSG3VBdqjb5fEEefKiqf6KPU1AhRhl/DzQaJ43a2C35Ht8fvuJeIdQHFwojC9RDVwYiZAeTdWE10NHrTlox8MwD63DN9UebEYo9VTIs2VysMn06xVeAibnFKu9XYj7gqpoXF6S0hCb1O6Od7gDXL/7lEDgwpTizgy2gggTCZ7OtxDwqAy4MBU2GnZElkbzYjHHQoML6oDBpM4hcILzMY41ujFBDGr/SNCxO5IQX8PMPeCuko3GvMV5j1ZbB4QoeplmFv9y9CJnsxfxbC5rhNyGVQj55zhMfcscLZtIP/WZMAZ331m4Sg022BjFV8nqEX9+jKZ1Zx/O2bfH1RHYklamVGsh3ZUPPhV2hoDzLo28YdeTJLccPPN+0Rc8IVfbLf6stSpkeFYr5rl9onsSSZ/sry7elE+lPL4i9gZ1wT9YnGE/FmpgTqu+P/ooB8S/VnuUtKuAYhGRGoEG26jdqhQrrO53NU9jU0hfi65y862GWqP0JPjyIyPSOrmAY7eejLRw6XjPMjWGrTaP2SS3l0/aYO1LG0orGLBsbTryZv+9L/QX0iJ9cq0Rp7cChgg9qYYWunXlNc77zRKZhrRkST6ClNBVXV+1B9RbShsRjVjAB2pFcHY2eX1I+SEFNxBAcGjpbo9m8+hBdMxll1YvbKY9Vlw+/73BtKi9hNkKZQDDE6IMIT5RS2wUVyxSKN7yCIcpLtSXIAWwCVQk7OgLnVAvk5bd/tkLk2GrNnYSQG/MnNbPJqaAhOMrfPfYy8zch/H0uPR1WYlBKJwbcT9UhkyjIDshKs9lpScyT+tLMWtK+A63DK5YKCQjVVUaWXlk1q7wu9v6dAGY+yq7stePVqNbOoKQIWzpAekywBhprieP0jopQoIuIiYsBiAkMdJ9QR6zxBIYQBrBqa1xi4jImvlEHnIFNZiP+1U239Wi8Fo83ZQ6tOCao6hsvvExhnlOMQJ1k+venk/MxIE5YGgbb/osyibcHhc2GulGvGKsJ05wdskI3M12FWrFPPx8/QUEyatBoBbpCSMWdL8iIHd1OizI9IZPd+Aixn/xJZaR2ThRAAAAmAcAAHUB1L+b16wwJdO7k6DTWk997zZzPfubPFiu8CtvcD677PtFVImU/KdF+9cOc8sQM/qoU4n0bq1CXZ76ZAzgttZbKwACgxL9rXWdye349fZJK0+EDlTKB3lIcEbICLyM1FZzip4DWlZwX1yMW9CJz+JmJIFGHe+nHKl/+X/tcAZy6pdhG8XQBgjJH4TrR3KR6Fnr4EFX98mj5141XtBt5TT+LrS4MreHzxDY78o7u0ZRhlacbIJI3ASdjHqMW8Pm6I2dHhizplZ7PhFhVAo3YU1h43ozH0pypBt8SZegdTc84AOSjZJoKuSwnWoJGgEZEI+asha+gt+Hgn+lyd2L0yAWNlJg955NOxC1qxsOuW3jk5hxzOVWmUFRJ7c68fo7HfrBB6g2rijgdxNBUbsT+6FcYBGd15npmfWTPRXobdPSzBbD7PYqWDk9bk5gM/ZU0YM0D0jrNZYxMzMbvTHpLIoL1bX8Nxf8Xp5wbZVFHAWHOGrRAY5KqT3bSpSiCELP63KyJ8tDmiT3ZowneJKEZqhp90Zn2QqRp5XLqjSWHUQUVfpVT7ZafCGlTdVEPNK/P0o6FghWaWKSI8KjogiRzN4KF4GjwMcI7ov6kHsZ5uZgQKPfTEFjRGZ/W/D9wcVHR7W8zVwlq2PV53yNajW2TxkvFa+/s3rTpgcIeLS+4RQTorYpfnYQrSg7Eo/HCN30C/sC53fRgGmvmnPOKUrh9274x22DTc1pNSGL51k84AXGXSRHWvsbZeFx7oBf9gSYd8f20f6UsyPZbS/CWZFUaZi+cZGDgJboeNFSCz3oa4uO14dCoBaFEbg/vn2EXDF/vmgizb8UwFLYs9kLk1fb/74riq0oxOewGk/r7k2HlCBKYzOmSKbT9dS8sJTuPUAdgpwfpIFlB1B0tDtcAqYod+KkNB6Y0EJFRNbOQrKSMSn5r9tNmIaIvih8SAyrIceT5vHV9uzlwJtmFp3pWcMlDWRKWRyqgH6S5MlOcHKaCgo7JQKtZZT2cyeZSn8jKmcrjtqMO3NoQttpH4DkKXysdsLDvGOuholJbkHlk8CPcXMJiws+/dnIxtsex2OEoipKY/uNimPV1ZkHYLnjIxhkBuuk3WFFv7yeISi6ynXxIUPLf7wNhn2/jOWZOBk7ZLpvJhT8d7B3HQhkEW4g6UYbSSDCBC3FQntMMRwZbuQMDYEQ8w+RvIz50M/1e3Br0zU++Fsbtsckx542tpmPdAEPm4kLsMV8WUAEeOREW0zIe93iN+jwlOi0R+nEzBK418yCQ1/tj3iTiRYYEnlLnoLJVyUtariqt7jBcYxXEpJChGQP7C6kO277v7R9v3isSSCQyzd6QpItihulpg8bp9xNlrm79IthtB5j20Q4eQewvR6SMYu0v2G17YWjh2ffiFGpOs8Tg17Vf9EzCUcgLHY2QBtk6q48+1H1QFE8yBHbaEQIc8Veu4va4Tp1H3bjagTXphlEYJ6zha2Tw01Dw6rn//ynl+/qJ7uygCiw8hZq0QhaKQmKMJRtlNQxz8JOWtatuHF9TFBuPpcJMPBaQrDeASyDElw3/+VddenJbSYyf4GwghOQpzGuMixAGZP6IW8jPwv33A7ZOH9soD4mTOZF15UniexG1ffAUAFas9dGrImbnEBD76RguxJnkiPpZ7Bmvv4l9cYUMA4aUDlzvE1fpnkYDwW1iIQ0mQSPcN4rSneAPky/RPRXjMw6WnsE6Lwz2cavOcs2beljP3D/a4L0XqSBYS6xCbrJwKdrFS5pXP/9BRLGSwcN2m2YHu3LPSElgW6VUZ7MK0NLHumw9HkWG4nQS73yHk8x35kBircBTy+cMIz8OawtUxXgWD8V/r/BcLuyug+uh51Dr5hGVTAe6GYwf+B4olOYvlGuBGI9xilUHkFJlplA66Cb1xYz9pHrdR0sYHpgl18TiQcfcRmPXqSOcn/TL/XQQN4OVidzz2/FACYYnJT3DrAC7C8Tcw6r3VdUXAf4S6//LAKaXDmNKRsYy9nesZzA+pylFLXkP69enGYk5t0JSjDaz+nGfSOaphqs05m6g3OdqRI37n5u9OLY1RrX92TYdCewgZ05k0kmZQh5mlj3uMtPwHGCGynLRsBoghWzkofX1oWfFaMQDaWv5huESZibUjXePPyfb7/yrFIluc+0lb7gaGmCkgEE8/AEl3Tub0NOjtKlzeiwiR/YduFgxmn/CUbFHPGsJHbzfzR7v4w7HOM0R/DcCmwkGuuTbc1hJNbaL1vaCUzO18Hg0XRX+9++a6fph2LrXuA2cX766PetowFXnYumfHpRz2UIWBYtDQjUWus/7AEeilO7kANmKbBPjc2MvL6X07gwMDZfbhwepOQp60uf4qBTB9tLGG91D8beDtuHDJWzXJUHD8BC7CCXQFRz4nnwaHShujVPJFIWoY3n4Ug6WxbIFskHeyWP2aTRV4/YImU1c/Y0AS0RsCuqCvirNGjHvAF6hFW204R49Im0wEEFyIZVm8z8RV9TTuhob3qcDyvrnK45AwJDUGO32LPA1sV5ysftHWQNNVuQGAZt0UinIbhDIujbrprovcz/puk/SBKfbGM6YIqx8A30VAAAAAA=');
