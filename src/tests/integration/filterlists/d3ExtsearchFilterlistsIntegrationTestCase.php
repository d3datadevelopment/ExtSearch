<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.0 SourceGuardian (22.06.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3377C1C97AAQAAAAXAAAABHAAAACABAAAAAAAAAD/FiN4Eo/syabdxwVP9rT8iOD5W+tEW/5TbTqsCzKiE/W4gMT9wWmqmHAKLH1+usRsY/x5S7wsiKk0vIEgDQ7cER2tEl5bMteMl/bC9dCS49kHCrFmMKYixQFC1ME4cTTLEqfN4WNEZw+cQh8vSi2KWggAAAC4BAAADswHASdL2aOVByS8Rd2ZiKr0Qkx32PCtxY7g+Q2CfDyEc8EVcMC7QvpNab0M8MdP0pFQ44lCjFdmaGspbodY7gRFvp7al/Ql15XMYQ2gEzKsOl6Fhd+4cgOMq+H0c+PB0dlM1VaXFkXjt7qmVuLWf5rKcB36tDSynRP73zo9fNnxPE1O+eWcy7BwI1Cy69ST8a0p9U3qsvCn8FgqwgqoqnIU4De0Lh1o+g4Y14N7wGL2/ohyN0ecykDCnKEhV83M4OIMH6Mp5zSNmdhyCSwLawVdXPz3bv7vc4bl8ei5+wPQXy044lrrWfOSDCHbTih4aZMWSDLaEFo9hj3I6UpXLmlns4+le8un+MNEKUeMQehtGqBiiipu1AXO3l2JT4iKFay32O9mYPn/BiVyKEaXTcvlvKmqKeJdGSWt4dVK6OI478BjX97VyEseP37SBZYtWSm5rEYl9fp4vagaV0Wl4vhU3/wsSMkQUPiQ+DSS6UZlAyb4DJm1WlAAko30AW+erEhOWnjWRJ1vIlSX5z3/7eFgIGANyCQd8DbCV+0GeuThEKdsNCDwceucuICpaN6MlX/i8HqOKMlnepqbvZ3JJYAcC8MtCFOCmkec6YUzJd4PKCJhJ5KLB62XMnpx4QAgXFQ08T4fSl7HHD6J2/Vz9HF5XAYZ3g6/X7c/Rkrn+bxNsk3e10DTdFIi0/IvatmVA0aHiyJ+nMJROaNQ1M4FGUhSX94HK8GLA/3udG+AohGMdfnvGGJeF6uFouw76S03glW+ahddGwHp1xOMSgG3p3x5WCW5T5buaI8it5Qi4EJXtNm7wf+mYkns2vYcCvRItsRrMyPa4i87ddzK2dh9TAVz9alJ1oZRdlrNshs5uT7gX4ibYKqttf8BmHwolljTQLV4IpNuqDiEuGesrpR4nf+BkCheotP7/S+sKUCYrfVHXkyo2IAg1psR0yENnbOa7sHxDEWKwlYGxiNejqKQcz7vYZoNjcue7qy+QdYNbe9259QZEEh03+d3lN58l8NIEBWd9M8q7Oix7n0qBzrqzwyDgtHb22z2OPtF0IDyNYq0efffN168R+5OOVWGcMWzZVOivqwtZvF7ZpRP3C/9ZTGVigVm0U+WXpfQ2DMAdfYPKxEhremaVJ0UWTu88zWswWckGILP0PDRKcgZuROjG65yJmkgXxAOifdYfnidVWz1httfbCJusouz/RO7FKwvW9IcVY5rYOb3G4PlE54PCa7C9GS4FdZqW+jhc3oNyfkYGMKdCawMC5bAWFD25XyBSB1G6+HYPM5xn0GjClBKnE9kmovTSzN4myCjWOkcDeQoMFumzGghQq15yvS/V8hMOIu1sy9oBXZdZ090wjCNwEdgX5qfv4zGVp0fPo61uC7AWvwIl9vwHd4q8jcs27v/xqvtNoi7X7efmcSLZbTFwgv+oZQtL5iPiG/AxD1L0+9IufzUOqNFyg+1R0QBMIf1qc54AYf2MxjZQFfubKnIkH0NIEiB36uEn2UeDdG99K/MWhuugM+lcr4RPJyyHXVaJK67RxF/SrbQv/JMeJC8c/zFR81th/mmAGHu8x1tbgVGHhFD4s0lnteriWmYUwRtIiTlqskYHkhRAAAAsAQAAHTyFpcxepNlq2F+josHYKbm8wIcthmcn1tUlF9/VdvOdmvBoHnl+u/gMU//z4JvMnHMp+cZO9tlX7GegqAbwEgmnp6pUlbzKGwAuY7oh/8JWiLncMYubqV21BfAhVMbCcpnCcd4Cw9zt5wZO+jBmZPo0pbsbGLSKqzOjfo3tz3y9lodEvlQyDG1m7X64V76QoTH8KAgctvLjcgaEue4H5caQGX+7IfEsSyxmRae1k2O6r0ZJICaeI4TD1cpWm9CX77TU4hq9P8+a4EHzdtu/cJSLKKmwMHNaXaLkwsIbbgIaa06ojIs0ggKt5QEiIR6kEsT9bcZQYaSf5GQ6rjSt5aNSlFjPlDZsPIoEAT7vWyFnuXRVKGQgiVrirkpcKuet1fmfdLPbWyhGd/eybhlL41IhCJ4v+efSL68zbn+uDSGjd8mHoFLoQ5bTuU+JwIDV4a6FlVxfNfPlu5RgJ257MB9VXABBEt872Yg8eqaED5B5aQ87aCaJcOVO54VXRDmszTBDiL2r3QfasOAGD8IbSG7L++6l+p2LPYIytO/o3oEOrTNWOebLvBLQH3JOfWnPilFTvBsQQF76dXcluGMM4b13rSN+RqaUhdvmyw0clsFc72bBle29b3T626GRJQ+zbxAHhpkCr+n0oHKI6gdMz2n/rT0wPObszojuQ1uG0aLNAWH0K1oj/qdTyTjC0KNM/Td6XfR1iSihQmQtI8+0h++ohXc0DdfFyGqM3L7vub835VsGKkEMXskpGD65iYqp2RDy0cEW95Jx6YZ5J70V0bn+Vt1W34zy2lS0A677rxJ7DdqZ/nx5dQ823/o4xbktLBLKFphmwBgzfvqqaoQrY+UEyWIx/zfcLS1AH2473KZoY5U//2NBnuFDc0nkrYZDFMiveui195KUXa6F3SLXdO5VnWM6JOVJXOJ48097ir+3+OoNcq2EWcnrsnS4ctuD/7W30eOg5Ko0jScUhVg2G4k6irU4r91WX9nreNQx1NId/Jkbxa0n1Q2xkxksL13ZNjSpyh+KZj4njivB3L2UX0+FEP+KcutCm9hEZfo9TtnZedOMl5GGNS+sU4UqvnH4TrWz6KdA4JoPCWmlzv0UqBHTqpQt6sPv4MRhD9WP+AzFyRKGRdpsC6FV4Slnf3wbNjVt8i+wc7ZpY/FgKQSdIfzgZyG3MFM5Q8gM5C8ofSdMMmH1ZfGxTwod89v8FZh5CacbjWMP4ZGydQVB3aIOt7+JA15hR9gFf5TNjn1rFhbVVmiitCM4gJ23KJ+vQS3eI2++dmihX7MKUImOAGw3wsVqtQdswp0T+weHOE7KUyGCvmafjO+EIaKmBTETu4igpLbwiHqrPl8+ZBb1vYtZ6l3O+TYF65II2symQcrgn6pbefFzOOobkx6IEazc7sL08ueyBZ00/FBJBlf5ox0uXmOHpSYHHFDea/UYQZCOnihQwjVHib3jH5L7wUr1qpKcgN5lZu27IeuU+niS5QSse18ra0mzj2rXPIXnKAGFRQa1qnHH8qG08OdcCfTx5SKcd8gLgCtOXvevmbYz+AJLg6whJel85yD5jVdZHqcXSGSX0eLxY0ff9coebCzvpjZoAAAAAA=');
