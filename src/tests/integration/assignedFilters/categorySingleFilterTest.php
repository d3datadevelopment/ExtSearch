<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package erweiterte_Suche @version 7.1.6.1 SourceGuardian (20.10.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3397C1BF7AAQAAAAXAAAABHAAAACABAAAAAAAAAD/kYek0yIPfHrkxN96m3aIKSPohoBgpZx37ScuK+Wc1QkhbsM9tTSCzg/fzvf0zfaTEGOzLiGTSEwt1rOjvyhz5pWfI67f99aQ3c1WvG0uiRaj5nF9kjPGAH0MvFK+ffY/Y90Qafj7X7/Pz3/3pFgXsQgAAABYHgAA9UJqjHxePAYQ1fsIZj+ObkfQnXcUq1QNbCheGprIf61CGgp0/3BehKtqdnZIB5zVbW2b5EvTdVsw8nhA0mDpVSTCty6Nmm/ti9bIURb9ByWX4B5PD1YNBY3ogB64Vph7o1EbfQFWQfQskn3aootf2hlL07HmAYlQ6FVdHF5HZ9yBNEEc5s1q1M2kI5mMrhGYrRx5qjASCGBZ7WjwoLabnUXOgSOGW/CNZyLsi56v06OyXWl8jAVWYYTueupDCRxMkpo2HwK5EKlFmE2956dZRz3uFtyd0xrt4wA5Qwjh43mNwItJl3H/OcLjiVl0ti3CG0SoKT6izNYZ21PrFJED4cDZDeX6ggFwhuLYn07ZVmb3za7nuB531XdjYTQSXNB6RsPhPKA1PCXc4hEqSJ9jKuKn1eA3sJth2E9T0t9rMmffOwKL6YJTQSHIiD7MRO3ngoB41bFKEH5V/hDbmFy64k0G1OvRKuWbumjjkEGVY+kBC/p9m7H1k43nrKXT589CLxxu8RPayelNg1JB35omdvCuAQ/WVYqz8t2PQDWanrKKiq8uI5h1WYIT9FrDQMzvP6fgcieN06iwYMItflHzOa+tzA0pML12mcKPyeZKmlmEg5773AFKrFTVsdGEosN1HM5A4JNf1pk2jpwixy38PwKbNPDUwtOQynUNvhx8yvu3nG9sNNJstqfJAoGbB8oLPmB66ZI2xI6sGYGvO5nhr0rpt6Qb90szrNXtBfgt90qmImUiaOcGuqf+scbjU+psLZsXmLy57IKNWBB5YxVVjyYLXlgJcZXss2olPoh379B8UpI3g40qJc7rpxfva8AEIu/hn8nhdV86pr2aPYcfZ9GYpom3g70MYXbo7asoSDfMe4pdDex2QLH7UywCsgDsGtIWCSLPREcGxL+uLrhe+rSQkOsdBY0nQKnevRGQyW4mVYVr2uVinRSQVnRub/5TOJ009HQCIdbCC8svqjMd9dB8VZ3rQ+IQMG1luNmWCNsqkEjEAS9BMJWDxtoOwW9BDZ9gvB3/2HHvqIOVSXVTQHL1xNWyibJCfOt7wY69EjbZC0lk8AetU6srspOEQDilsjQbJtDj47c4SYo2Zj0NI35Cdjxj2hRcp+2HmEmMVHta2RV9NUgaVJeS+itpXrXZjDMUvlv1ZC8VNR7JxqzNxRUFW3jmGU7Gq/Yd8E73u9wWBEwVeEWrg6TdzzLQE4Gzmvi/RUGaVTRlT52AOp7CVn+Z0Wn9Kkd0TR91UaWy21FNZeywGroQEvoiJVfRqDuh6pFr+qPt3OAaXHzcKxOgp4HLbhB5N4pL5vCSkowNJpAlm9/rtqpNRk8ZkXqpMrMtvANsyGHBRNusqsiS8oFdyPBEznQUV0tOUpXtqNpB8J2YSoBuSqdkGfDldzJJrFdy+cz4+sFvM5KwmRYtVSxlZbwtvRXUDHxJNtVsRtHvNGcc9O828Lxc/fWH8zxWxOveaNI+nPH5GSB5a7AGarNHumE5pm3drux9O66nCCUTMd+1z9Lr2SmHACc9fQqsJ3XA1wMItI1aAUdkgZUOfk8Hw8b7d6nNgzZLRpR4wO/Ch35Zyo7u1DPBylY64yX/HeRggfX2btNuxL9CGZeaJZESbC0ffxjHylsKFvSx98/AZgjbY5rfcHorYFNzg90UDPwYgrhUxadxq8LWBHZ96+/h3PrXZhXhxtDQ6bQr5wF6sWDSQe0EWxnik2XdsQ7chJlwMoeoJhjH36VCzOMUvpsmWa8b7DaY7fG+2p2TURkLOuIEpjwmeOAcWZGNcJ6OdxUhF05zt3OY330tH15nFcAXq89IxTJl2ISxlk2ieCEDybSK0uQVc0FhqOG5QxHzSEong22f4Ja+npGpKypvBfAIHKSQsfv8yknXD3oFc77CFFZfpr6jvlWYYMKx+t1leZ/sXJXxXV/KsRhZaFh8PBQJogS5zhV9XmEhTYumXfHibB1qErvQn0SfIptf3LbOcAAzkRYQ8QixvOLHbR9b5VGM8f1ipnB1aMEdWEY1CETzanGI5rhiJfYIAbdiYqQDKESdBcdx66fqzwL8eEmS1YbLUonQhqrj3wezsMM5QL3oC81qRk/FbJTjpT4XRzZ1Wth1Lq660YEWkLXVzK0xvwFNoNctjgwJtEdAg1l5BWwDruQvVPZ9Du10IX4j05dhfdw3juG6qKh2ToSAnYk6alBBl5PEHCf1o0S6j3D83gzpBp3o4rjm4CDzQ/Fk0FVaaiqSHTL11T5Hlgva2KEB1R6MTao1JkaklSUXCSPQF5dOK/X+zJ+z8EsVvurwEMOkbrUPPBya0dJw92BcSyxkh398+GaeLFm8xMBPC31DvoTIc25d19bZ0HGCLDHWEbVjOX/weY5wTLkPEiv/vl6yPXfUJXBxHdOqjW/6qf2Pf/Vz6bnAQ1ZjXQ+CexVxSps9/C0DxFGEu1s1cc+KJWRPwPuQG9TKJI4D/d6lkQkLXcR2BvA19moHoigDY0GzI2lXdRnLid0RjSUM9NuJMnUX0FNzbrxo0vIpeupM2hEH48MYh5J51bCIbid3s1PHTlnJ6RQu3Z11Adc+n/vMcIltc+g2k39z99lBVlkOc+CeVJDIU3nbjPFhyXJOSMS2xnz279NWbG4YNWzU2lDoYU385CM36Oz0wmHP/M8prcjRsWn99NrecZ1WvHKj8F4YoDBNujby6xrRCm1SiqVMgTrjyQ0bqyUwIDdYbxfXHZJ/dXvRDUbipb+9jHvlUK9L+tpaMoe7jW9g/VdOdr9rcmcOXJx+pOivWzAJEWsjJp6n6GEUyCT/3xyvIrwWWl+r2mCGvyU9XepsWi9IdE2xGu8I4yW4tVBmXljcE6F8DFeW898lBMhIlwrfjUMFhAgKbLIXVHdt4PnBX2/I5OXIZEfjnPoBm1GZBt0PYqj5AAk0eMExrAfKF9qOS2TTZOjPFmq6USvhRitppMZ1j3glfNovJpFnddFcY+hr1lZDTarAuJ++VHg0znIKNJZtuzQe2JpNfPvepLT72AigoKoL1R+CdNLJRWNb8bnUURFmD80Iq+6fj+xmc4VAPOPc0rq1+xXs1E6Px0q0UuIp6FI95ubonX5V+yNAGfCegI//rb0HLQdALeKlWUaT30EarIb4nYFT/mv6ck8N+ufoSqLcHUC0bRhqof8xEUey1u9JarN4IpzH/qkgxu+finr4e975S6XWP8CtYo1e9WNAtSu6+ZEtgr4sOoaJw73nj7KFdcMQiH/mdh2JK7GAMRsv2tXQ4C8DTNetV+cDra76jImJQnaEySQaz92F13E22kKbt1N8gDdBkoatDjPqLheb15Ip75m92LzpFujdQQBBAtXRP56u/rUcC++rLYoHV5vHNUOKk4s6y8KDaGTdb3zsBKoCdZj2vyfchmlmjeMnA60kk/Dec3IoLFJjIXxy53pKNbCcdKKIo7nfqHqIYe1u5I4Hkk5qa/ugb+eQQg2GjKVSH+mlZdNTgXRyz8kTNGILiYMic8c1twfSjQBL175bikquDYnZaLq9O9S2XyoOYZUaZpQxvSLkX2/f3wlFJ8ouV9tegXN6I/R77NVPrzjqXPlSPrqn81iRKMx9MuozUM3A3gZy8L7wSBNj1Wuc2HFi7CcrG8rvz3IPVCQtx3sIdrNhr03f/FdZS7vkhccidNbg4xYhIQeogy6BuB24+lOYRq1UPf8BTHvmLZZrNGDTx17t+Vo6O7fFMu+TLQtxq75xK1zNkCadBCzL3xg9sIBDhCWZUgU63bOKuHPUda1e44tZ6nnfJHSCE3GDmdd2MB2aaxZeR+tN7gasM0SFY2YmQVqcxq+hZKNnKwSzJwy79rGIkjfQ3C8gMTyqUyFZ1iKjjPNPWRbhIAF829odKbFtkn9DnmFgIVwss/Uqoagce/QyMw6Kin8uj64n+0S7W0m+w9d1L9uaFrDbvxcq0q9ZDK2Aas1AGPLXDXJImx6f3N55aKGYw3GU+i0Qqy9jspyrb62GU0tr9lp0081eIqqMlO34J55AGJVJM4ZAd4wjE0t+tUSRJlDmYkXjpOf3zqovhKQZCqV+3pX6Ty5/sctLn5cRXFTOA8PPjSBoTuYeh29sWtInUVIQKjfr5HEtSi/gZI++8PjdxHMDO6D86XMxiapxRWJFcck1w5l86gcr2hfX03/c6Cidj5g4RHfB+cbfrg5VI3Xbh1NH/xMw0u9BFVL3QGKJFzWKFHuL+j1gYQwR+eGcsQBDGS8t7LbpQHeCJ+iDKcWfByfN86PArD352C/GA+m6u/HcZhfh4a0HAjjH5+3ZNrcw7QDU502g5Ql+QfTQxGU76AKmp7tA5D3fQMEsZ+shlRDz45K/3YEFSN6WrmxZIkebS3r2tMRv7lN+CEE1xdnoBr4uwdURrPGZmpBbdZbhquEXEtLtwGePjdZznJIrODbMCQkiV/iK9OCVvxgu6y/zoJ0YxB/vmXQRjKt30FdR4+lf7JcUtq+gDp+k38RTsSZpvlS9YDNsVEmcqsYxAsA+q+avPrgHZVGwuju0U9bwRWGI/8QEpZ4+jyluUCWLZ+jzBxBkNd8qHZApyd5ZYCb6n5pB4ftfuHs6e+XE/eq5JZFOsZkrc1UkAvXZ91YJh0Wxm22aqR5+d7tdKyHigDcdea8whX87W/Lh+XJacfOh6LrHFi60xB8JvhtYO7rr1ATsVu5bj5+uT1IQfyjmPWkDmESFyGFAXDgnQrppKuLbVH45+odELugOsGGHjBITW/g80OOLntzISM6zYLgH6YwoHxPmN7rpJ0b5DnusWyOsZm9Qu/mmpa8nolJDgrYCvWUEGurZ4hNWDjodsG2qp3xg4f9fD0tyZrPdSw0wEseaNxErclxRM8kMxbfla2ARSESbfWv5HLx6pPWaGcOMBnTaykRCxEVsOjLcB0c/YWkVHMdYAflpZfca8khCYozcMYJlH35KzllBjsDcTdwL/uwzH7a2gkVJcn0HuV6YO3AIJ/tHh6E2vf4PDDmqCbY7EsGzxXpJNwWykqCOdalqiJKM1K1AK2vk14uqoCxOd4EhDrdbM4F1CEAXqO1YQMJZLb2+frOEozrtqxVRvyRt8pigHKu5YveDEEpLBywRkvAhlLorp7WQnT3bQBY3B+EOWy5G/UApTnW6+EKgFJH/nXS4IvAUh0zl9mRGbsdadkylMUyM/A19DIe4p3fsyNQPhsNh4YuswEmbiIdlAMV/L1zazGzkw/dPzPf96Rs1hSoy3yE5wc+p3v9+aNS8xorlBxdB4xdqhIB4PwudXvQJquct5ELxNVBL84Wb/SxAC9d0msmhsmYvM3MJ2ki2XqR9Ngj0ArAKVZXgHhb6ts15NFwT7o36PsB3J5Kz42uCNPwexrZj7DHNxla+HEA4W7rfskpGjw+cMR+dCPZ8uQtBQviqVXsuRITs5yTTY2XsH4fOChGh+Dhvr6cvnVwmL2xgZwbAN5SnaQmmsIOE/B/CyJ1rOyrMy5VZf96bw+/7i25zmXtQHbOuDSrLuRnvrkSGCpGPWegJw4YnwqFNevqICehHTiY/UcvcUtTpSEEuu46/zZuOiM0aIby81YJZkyR7+6C/+TqjL2TiBd9XsgtzQAQLcNMI1wUALBzv+SBvYp5QPz9jgGweUXMp1e0Pqjzw7bo3qOjFdDXcfrh7t18bjVR+1Uu6wT6feoBsbPIt9sVMlhyNsq4r1GNhFI/GxZ+HjjgfhyOPsc6ssSRRwVK+89fXynkSyBYCjRKZy01EpzCsP4zh2x6Tdzvf0cY4+OvJgl2uPEZna+xjnxV0fxUh1Xs3bChGar7FthFIBoNHYaMU4OV0Z/NjVfMN0ZTzS+BmqFQRKSv34lYiKzcpyLo6Xr5jSLoeqiUTjMIskCsTgObovg1oXxayxFQuIKTBpWl/E8qIDNWJrfs3X3aJv1ED1k+SsAJD3WV1WLXT+bn+jlObj+LmjBhSI6pLo4VtuHyeEoOb8unvTAbonv3GiIYcYKwhnLddLBw4AL/OqeDFC9AjWumpu6pDJIZRi+6BR+xTQ1kDXCsqAwVdTiqiAVVESVSC5J6ROsVeyt+DOvGJGpvIxxY57DQh2nnJYOAnm0/beR3lvZkfrEI53W5ROoEo585G+v5Bt/hrhu9sxnYBNFeaocj8cz92nVWn8AU4wy+PgVhZeLYjqZ4fey7NJwhRSbKiGCqUR2NCmBnS1GIoybxS6d2qciJ6W4QnLpn9Y6cPmwfWvC0zK7xchkb7BAZkFy893ckBocIRLcn/XtMF603nAflWaQqDS5g3BNrHgurilwDy7LeLQyIRrWPL+G0cozXabIocmKiaNF6y5Nc1R5S3gZOHxww1lVZ+PAoLW0LCToUbVF4iXvOWhQ6WXoyQ8CRDXLfHFU7vJ9But/7neS2Kawi3fyuGIINeLA3MNPjPZUSQr1x5LVsob3PIM10lCVMt1pzGhkpatlzEfao87gp9gtjkW+V509lfs2YYHeH8w/zckMpXZb2t/TFvStSb6nFFATunEQKO45ebfl0DcEp3dRN6YFMODmLOeSEDzWaMgdCEMqD4q/gZ2l8fxjjIb8Gn7tfuizJkVqlsOCBix8XtW1NV3q+6WTAKaweTdsATD17A0M/jOzRKev+tLT81JGy9LTS3Bn7viEk6KL2GYJlXAvXB8d1xBUDglqvMR2HBRZNQbZr02UPWTuCW7Vt7Kn81GvHhr7ELdnFcGbEoD4/vDCgont4SBFoZaLgiPqCocCisXmzI8HWeURQMsMwNQdQLLeT3STR35ghvxI+TtZKiJdzFQJYLqvZC9kEoSEh0ZVzNDW9Z8n4V1ktlRH39e+Qs86E78DMmjvx88Qn9yTOp7BqRyWsBn72rhTicAFUpxRyM6ddKbYBCVEr40noA+UOy84u9m73sAYwjWLQ6r9ZSQ09df1zuRr/a3XsHmMQBKYHIxs7fTdVYO9GGeW+yADg7Mi+gFET1p7RKI6JNrhaOy/o1+H2ZH7fpZ7JmoHI49l9c89ltphQRWFukvvu+K/JHgs7fNsKFOrjPb2ubnSu3e38oR3yqxBKWnLNlDq0oblP7WbWDVQlZhRbIy4OT3Pr+ncBvS8xG8JNzxpRCJioL1iDfMCerMWSl2dzpbkbgPAj+u8qImfbYO09CHHrBPUGcQ0nKd1MDBJ6/yCuH7tkW/w+WBgz1XzWVMkyY/e9/UJ6N78IRIUeJvGnIRcIit+6+pJTVB0FercrWz2plLHy4adDlXged/q4JZ/wIFdfuKjjisMzcrKd1qauHfnGo/+azO8oHlNYx0b89BJcrQYnIobcUoLBiPCEWHTRUR1qN0/7SMyDTk8ItIZziLvXGFI4jJx8kCqD59g4UQ5+XhbIKP42ttJmcgihfDx/hy94/d5T5jBViHSw2lK8ryP0YxQUJczZCV2KJyVf1JjiLsYR+uiWhQlA8xTk+ulNxy9gXDTQrm/gKrCUJPB+BU9NqtVlcBVfv/cNKqJSCQpNao4ae5a0eAqp//5uJ0+FCqsRQSkhXhoZsK+NFvxLd+94kJR7RY5CdTWMss+pAIKCwllpzsX5HA+spj1UoxDv+sChOGnum2kpDUaUcp2CrnecOHlRJ3tUc21dPVea6vs+Mh1iosbCCpvAx70P069W3gIztNGY3XZGM6S8wVCF1ju7WGZJAD3T1ZpdcZI5YAt3odJAd0xjT9B0xmymUQAX99aMwK/dQBiXr+zfVTmxD3cgQIbKEka/tUNXGK5xQQkMBlvIdpKgwtxG2t4nNepGKdiS3v0UHq9nrDu/KE7LuKXtNh7J6mSVCwycyEeB/GDfvHvwqpOI1mbZxO4mQZqaCxcJxCjmFlwRow6EgIrHZuih+NwQgU9WzT88NMH3HZoFsFZqBbUkJw9CDis7eI4sksFtwcwgfD2nNqaRDPJ26KfkJFM397zY3V8R1ItMQl5qGbU+NacN6PujeZPpgluF+VnMNh0obA/gPPaBsTiYD6xzUOPShit2NNiRMQ0ACwyvHdncni326cvJnUnMTHJ9gKf6TguXyYUTefIIIT0gGoQairmiKysfCorUydz3Rr4gHW7HHa8byz1GZZVeqGvHcRIEpImImLWNko448hWY3c1lxozRTQ8Vnqju4erbLODW92L7Wi0/VnHcCqRVh1n+L1QlPf6OO49u6SmTvvSBq+Vk+kEmo5F/8vlj4ArmGatW6zLpRRyItABhLxTve6szNBuLpJ2HPuWuzJuEeK6kOBEZhf8cxMp3qRUg/vD+UH5F9bHKCTR9oZPqqdWzoq8bl01LWkhtI0vCRuU4GaM5dJF5S/NBYdq6PMJVIzmCBzSWIII99MC+1kjMtr8NLA2MZakVi5JYeNlaEvBGtoO2cB/t0YHOMC4D7bPj8h1z9vm2yKhcqtqs3YZd2GtKrUkWxpKqKAicoOA5tH0LH/qZuPsrHkgtujR1DAjaRwfDmsr1Jjx2JBnhevReB0+PJ1+8po5u2wgstzkJhCpoHzW6a87rgo89pMAjZujGFl7IK6e/bY1NWeYV7Cpn5HGGAFaYcAEGQJkKyRxCBv/BzgZUcfge7cs4K2PB6ENOU/q/LcD1Me5jT25+64OSMWbMxFmoeDH3oFXA60BfhwQTA3beBgw3DQHFDRsco80t1SaPzeDj2gQQIPqnCXupTi8KM0rrvZ5s8EOh7RSjTg39KobDUIWAccZZAPAKXPhKo5+spdUI69dWWorBDXxb5oqjukdTSMGHQaEcQu5BCDv+M3wVKQAIQf6RyMlbJEJPLvkIz3RQJpsbcgf+DCVT+xV90JJP2yLpUl3z2op2ztKXKD6n63V2zRBJ5Hm/Y4BfIuXJncXtznXdZqj54PJH1ngbI2A9p3sRrta0SPJwiQpoUOIQfsIRVTO4V1i/3IhIwwFyvhSxh1rkmw1RiTUgqbDEsLRCtaNZS4izw0TdF/cg3E5lqFekr2lcPzZ7g7VujZBj3+lGHa//84kcc3jTBFkCA820ihH2OD0x6y6hBmeAJULwlYDtkQlRjLmUptFvNmwUFN7C//zYUCUsYNVVHOCPC5FTqcIW7s51M+SXzLxoGT9vjVTS99YNf3M/wT2dR9VJprk/daYwgK4lbedd7bE7KSm/wovNaFI2BC+EgBXcMybNc4w1oWXTcPX1ogYPKlk2bldmYadgEuE/QLOlK+cOwfEtKnb3ZwUm9iHlZ4v+xOtbHL4majnVMf5WeE4IHmwO+mmRaAEPErNZ3Z2zwE5YACQKqwA4kUzo0j51mJSRUwNEFbnrBZAjztjV6V8dzSyw0mGFaQrRMw1KwLGsiH/Yp1d2oASCNvYPcVcS9CNFaRRp7yWZyb5+lUx2NThXDQI3V5QqU4IXOWARaI5rFPWQIfei8t4fM+Phe/fXRlX/P5anFEVC+IZAKFRc2Sh9h9XFYlAKhtU4Jp5stCBgw192jr2UBOHOxGDUGpZWcG9GBIx4himOeDXyZd02NefMaaW8pjAH8QknFUsW6sdo/H5MYHVqrM05nCUeWSDlPMNo1VsDXHAB/5i/3nsy+KbHeGTn3K91eVDNavUnmjGwjtvY/xPGbuBwNte9o/juV7rW5xzSMT+5eNQb6E3pcujQXL2pl2b96u1SYl0fhThDn9yelQ+btRf7rfT5uuuXVViLBKdf37Gt0c1ZZHxmKhiqjw3NTf7uEga3NFqXtRLOBoD1Cssdmh1tHGDbJ5yko7tvhWec+0pycHD8w1at/3q+dzsE9eHDEm1MkGfcUFSyZ2kTfs8ffXipfSn01vC9B223Dk6DKPquQTi2HhI3AWvSqwwx/fBz0mTSWvuawNICfsIOyX9lX93kPI0wqjzj0fCaJJ9LxSDuqWjpVipoZDqSsU9Hk9vRN6R22HJL0XnpwgCgo+VwAzlZCAzMC7HWNH0O5O9IRnQ/8/YmTgLoaqkWp41eZfls5J1MTv9KvUr0+jPDwGMQJR+9NKpycQxbU5FkQsBes9IjwDq2M9rTjh2cmJZUyNCPQcRNIDnrXxuXxTDKHgMzwPGWIymwOVtrjNnBKZZc/BbNq3HWa0E/D5MPMrrDVc7djNNlqJGRihZG2YucLJiVd2xxD8GLC8nCXxE9NH4ttLkHewzUl2dTgEsIRrKCwmmropzj+SGXx6ymMbx+hDfD4m+n8cF/s/mv81Xa+xvSns0wwcrbRHh8uJmlfHUBvA7W8V6735Ra1Dys8kCl11MxPVFHpToOhblhqoiSAk+UMX1xTyZPvvIisOFVLVeicndi6QzVRkR9b+jLbFvHwosmcbfsKH9Af8YKJh0VTqDf6TJUiy6Vi/YYlK2U4gFMlNJRoCOx5pnjTRuflYftBEA67XIgXz3nU6uaFUOO/lBdQWEEf1biroLvLshQVVRLPOzeDRhuZM/uE4nZbKPPo/VEAAAA4HgAAfJTx+FwzX6+8etp2857m+/dC1IU6xOE2fHlER5yv/3IJ2v4pfvuvog62+Ug7uCo7uE63CbikGxdaukEgDaLh4wQR8oiFgNiL133PLacIYQ2SYrmbJDfQvguboe1DkGGIdsZ8Dl2xAjLuupzgjUi9zNQY0EO3X3xQSbUXOnXSKyzYOlnkPOyI6/2UsL7uASEoNKx0bBeIS/Kx//LyQy14gme+VePkS6/m7riTf1RWeEXVU4yvWAYUVXpg4PrwPgVPVE5pCUahslWEldpTA9uOKuhCrE92iUgsM5CNJWqZntgvdiyoE+XrCr9Lzf+dstrHtnJIBLc45YYD0o7Q9Ckcc0nNxVf6cN7Jl0H5ziSH+THS9Gedw4Tb1IBcVd9qBRSExbcwlN06okt+HEqjU8UGbhoEzKOdOf6skbaIgciqLbhVDh7ixiiic4YWSt8Gehu/NU+ygUkh94VMaxhXQqkYom1kg3BQ94jZfDjxRQ+LDpnubwz64tUZzhpx9VM9KKP2RH+BfwIox9LgYcd8KC/Hikgi4yJOu/Qxi+hCTbffUkYpN54eanU26yPDGkcLoJBVltOqxyu6too4/3yaWO6wv1pQB+UNbvb27ODVxUKt0TzPT+yadY/bsrGlw0Dk2Kommj0TP/R8ilt75TJvDgAFFEcOwEf5AZFrn6JXoLlrGQPCv+QBPa7r84/cFxQ7whPDvKvnk+C5z/YvAYHMKHJ8mGiXdBUp19os8RmYiVEA836Vn98UxqQkW24cJnmtLrn9pN+ez3B0yEkBmtqHYsKkuARmz1xT4LZtQ3j3bRPeuT3wZkGEv8Yh1CXZERd4Uz5CmLE83D6kUWikos5XHfY8x68wwIHv58Fa7mE/LSlMapO12gyC+MdyP1jXIPO8Xqqi8OnCp7gyg2hfJDVo4N9uyEvApxZ8zKfUBdN0y2n4iPKj+uTqN76sxo42LEgqu15AVGalWFGLD7HcfUiSAPGprOhWHdkV/0otcxtK+AG01dRe2Hb71r6VaFuxreJGcHhJeEl7Fnq1OgQ4GdPTfV78N9oF1554PWtLJv9fOr4y87I93ln8KcZqHDBUjAO28N9YeYz92s6Flc+6000QCZn/qT67KPfDSJRP8yWzH3azfvZegz893Dxt4zA6SmEuge+q/OB0yhMpVCx45XwKUr8DtYf6JrbAjNOIzmj7cM9XAGYZ2grLpptu8FSfpCD2pz/g0TZgRTerVHJ0sbCfOE8xUyzY44djwsEhH6oHVpoveRIBq76oxAo2hMqHdK/soxcZnlS6BXhfD1K22A6VgR+cQ+fGUJJ/Wdt3w3gpUMkRPsZzM4WT7a15yuEa+uM0/lbGlLJGXr5AbKDU0by69FkKc96jU4tfypFWvPTTC5bfts4GQcBPjJ8I8YJOyj0D7Acy/+wS7J2SxU9GXdxUAcsoay8Xm9Dm7AB3oc9mSKJUpp4jwKVWQnLMhAJc9/Ghl8XpPoyfcJkeTRfEfZqCURmedfsLtvWozMea0EvAujRQsgBgmy+tC2frEG+wn30i/R7AKlIUp1spmbGInS3/iyxqEdK/XsDdX/AIv3337eVvfN+lQ1UKLt/KJzfRV7qtvsPuE5P06gSSP6j2EMZw7T6JX3nZSElTtKRYolp3ntikwItYT5Nwjn4sRfdLYUcBIv/JaAo/3jwYj8d8uCbIXsYLPFfk9G8OBBdx9hwfxbqzzimvFb2uCtCWaLuwKZPhpyccuf0QKqZ2DXT2PhuFWI57LMF1n5cxhSZwWWijE0dSsl3UpN33FEuixAnNWF45uWC7j15zHVMVSnYuF4YiKBs6g1aMpzAjYSTkiYcEEaAF4t3y0hzg9/wxJQm0rjoGPlXjkE9sM4RW+34sGelEsIRTRbS3kzqNPfpL1HQC05NDgBvQw2HoAgwkbVAd0tXi8eks3boQ5F98Ich6HlMSNAxKP4kYXRg7Iq4ETp4exUEEK1WcLAYXgHaZhQZ1CCNqs8kXPGIq5Y2bVov+UpjdwoR0LyG0/pJFuTlmThgfkCrLp3jNYxlw8dHc0X5Fo9Z0iH5esgk2831d8N6dW+cSa7Lrdw8/+PQePKrhYMxv1hJBBJEdVowsiXbGuDNs0w4g8gTRXSUaFRyY6Sb8+w24nhvVsDX/t4pSngNZI945aO65IhAGISi8QHWSp0c6EBGK+4lpgj0Qb0TicxwCY5PNwtAadxjiZitdjxDo5SDxoTX8LBsu5s2ZRqIO0Od/nLZqVZrjSdcBi+IGxNfMsMDsfhBBOQKAp+7ldPkIlE9mqdUbDhYlaxnilvN8HkjIvPuZafhegg+IRKh/FdlmH1i6md4vu0Kywt99j2p63CCtS3kpBsNt4C30rnEFyCmZxIrqx68koi6j/zKEdHBadbGCMPHr57Yluu9co4MNNMaX4aVfbZmZJZy7NwoY4OXmk9H7CYM3Fps0f5IFCGXKI/OzgkfYoxQp1KDyGGpA9gyODhMKg7DhmxdWatVodWlhr9QzQGi/IH978Te82UTfajuVumbSLwn8J9ZdHvZWJGf8NzdSITpAeYpqher5mSL+y0/W8hEfL8Vj0+sJ1g0sbBZ0x8I1YEK01h2fUGVjp+3bGL8UprHd7NBx6bUSRqUruVX7XwYmvo0zj75TkUiuZPcJIIh/3+46OVMtFzqBWjxwxOMT9XxzA5pT9/Kprn5GCCQt33sD2yl9dV57Ce6ESpckAQGvqjRxGGFWzIpaXKLG8FBojafhlkfkcuphkjMbJilkPpTEvjaX586EulsPUoykMfKZHUQ3gtFsWPXxx/7sAL5wVmeAlcxXpfXm9C50xdL+7vf/ONzkmRScOYvdcFJayP/WVD0/QuT46jv1YY/uEML51LayTTuAI/kzZyFpMH7smVRasIz/8fkLMseo7JV1uE358JdxFB/wWFIHRT4BcUKLl7aiXENCpa1SgpyrDUf45/DJ1118YijCHXRITOdPiTlKksCWv3JZ7EfQAGX03swmPdPDeEuZPsypoUhE27acXCC9uPY+CfjBhS0+ooECqmJLOwfsUMPI29mDSSpKDsyg61WsruUU9zCl3OVOJEWmwZyjQjCpDuo+6ElEgsCKxfOMawEYc9flacpTxCtL2Qcoq0EibcSesGl+fttZyVVA7xcLhZ5YomWpiQJgccQlHI+ZWB8fcwDtI6dWAyoNeUX8ZCJ8RuAUs6SEqSMp2lOhd3g7hxNQJrU5VgBCZqHMYvQLtzpFMx3Wk+IkgN3BahGvvSagNq0poG7PBKFNmOvywxtCuqIsxgerDDpZ3Sm6/5AZyHDh6qOY+00YpT0LXilIwzzSgE0lOfZjLM8MZ0ft6xa0rQcgLpK2iAIaSQK1OVjyt3hB7bFZsP1gbte/2kszjpiOvjrrJMbYbPSd6maP4J2YXbRmduVVE9vKx0FZolRe9VxLLqYu3sOTWa6UKlFqyLU6KZI78hJs1OCXvcl++R7cUZWhCHGsysaurAPCCyLuXHNFbZTj1LoF54ZOBmRPsT11KlKPP7qp9yrPntP2uNDjhqlX4fTCZjW1ETla96aCyAdqht7C5PHPCqRl0ceXPG7njBBgOQ8Y8gtDvDnyxNCp/wZM29gSInDgSLnRzeQ3/GEw1MzSOzxPrjsS/dWPCfF1NLpLpTOoQT3IkM8zMRcIr7dwkIa9tcDIEy4AXTj7HdC0cSFWDrSDnSybOdd/GSW3JNC+Y+LWdlARKf1Kp1NJZzhI0XKZ4JbSwSbwLfv1SuX4FxdSjlur/UJyYKqVX1QPQPbArWN81n7oGouzMO7JcxhH/S3/dihI6wzGJHklprGkhCMyh7PhILUodtwekve0JTZc7hGeTfawKTmOEE6c4sH2d4f2Rmw9uPGc2Ym9yQUExUZEfdTvgcOvtIAd/RjY+jkv4M2RHzVqyXuBXwuPO3FmPAipSsVfpsQwA+0xZFG91W+uD6LTrqME5Po33jHvgpkDT+XGo6bO4tLacVt8Xontqq7rXslq75byhPRNWZx+g2EwzdJROONeBCUCZ2jtGGUqU2iPKgWzc5of+S5dLIWTcFRKEb9di4KeRzlowqBEYK3r6oNJ/9LCg0EOep0n0epD4sji2HtSzrBubzb8yqhRZSsU3OH7JL5MrZNOpnjOxsMwAWb/lchm4mIeFFzBn7XgRhQltqhFZyW/cnY9kmzNgisPDTXeI3ag1tm6uor8E9CQC1KQAMfS8dEiMnFO6mdw/NMV7ze66kWW3g0sucI5x/5dajxis6fnWI4WO75kWdyApwj89jY7vwVs3yDOiVXzPKUueImKVLlPIT72SyTt2At2XwKEo6jkFMezs5sYazuQ9y3aQSu92hMiQjfEBvkAKKnvHTSYc2R4eQxZ3TcF7I/GjX1adMv+w29mn3icbda5+d0E98KzjWIouwpkUmWnxLMlphdC+xkJZ3V250oMC4ZtV/roTzYJlSh7oALshBcUXbj8rIFZPy709cwVnC+kzbc4oeNKwvSyZWoCDB8IQOQn1iaSXgT1UHs7sJwzadXWgW7Qe8c3JinhejALFCqHcEckIhjQzgo8hipoLcirfeGAgsIa6APdyRaENhgD3odzk/FOm3HUC2x/BdszC6xQ2yHASRgOlYxlQfliQgmaFhLwufnkbvHsRRVjdkhxKnn5ebdrU48FT4A5aPt+5ApeRw2WZxMdm2sgC4oD4uKYuT5foxvAoB8x4QFIdodIRgHqalS1dissokxYtkrcbkLV4SyQflWrqvO0bNAfu30t9TWz2D/vwheWGyNgleBSqCvrwkn7qgadgxfrd9m58ijub6nGgg53ptq1KTQ5bGShXRsQRGksLx8Lb2ULJI5N0A91w5akPj2sWa21q44YTg2Ejpnwvx6PxvAwp6H733qYuLH5bZTQ2I6uTilClAySuvxWaFXoZEcKjlknnil0C5Okz6fToSFMBVu2vrVDiyW+yYzRXN2xAos37Ckg+93IScGY44XYR167BwmSSR1XTlw5+EHf7V5qjwKg+7vOrdS84IaYYfP4Br7IVFwoqEb4dmKDgrowTIuCY3Kwi12QO4v4zobYtF6MARMiqRl5DsMOv6RGWJPfaznPTA+QBjCJrXoZfRdbjBg+C4BGmeBvT+9z+bcx45mvOF0b15pkDSe5uLca9KVBmMxgeWu/lXmqDFJGWWDsLSE9HIkQFZmqCTYcsvWU+85DS2L3eFiD380mSiKpR3id7oSsvxtTcFKtlsAquL+bavjdtg7YE9gGJvRivT+lGuddPcVaw7JeI9pSZOaz8uLFImfiYDaZKr3WkX3WRVUfq+BKltpDzjjOLCoYzwnl4M/VV+F0UJJxEdWvIqkr0aCm7Z0ItrBsYu7nzeEIFUUK+aVCfjn/PmTwMMNqmO+Mu10GZDCh0iWxFRzkl96XA1hi2IFXeO8JloAL91HCnJ9mOk59ISWIe5M5q9GE/LHsN1oqYI99AHa/8J86veESxLSZS3qF/oIyXRic8+WRU9tVNQWIka5wBsh4Rsa1IFTHxIonZFSs+SKEvvUpG3fvYESdO9nEA+pCchRat+bnEeD3uAlfjLjpjinQ4vfcWPhF5Whw+O+EfqG84En9iiC/XkSMEWWrx5yZZnOq4h1jHn7yC+7AeziOs1b4KDi5GdBhIDAob+jfSnTrFyJjsxLuDsfA/RKKyTKHT7zqVLUrCPPwKv/v+CwaYRlQdOmFomnX35lse9HZKHieHGCoGqEAsqw1C+AJW/6YaYTbwdv4Hgeqdwu1ubxN9EQtzJ6zkdE0Yrq4adX7DVlCA98zn+iMeDLUNTIa+BNECye93h1GYDLoLO2ikVmIm/C8Eyg2AzhsBtPCADulFXadzipnDbJZ21rIJ6FftebwgMKAwgmsRbkyEPtgYB3ot3ORlP2MCPcEkxHRMGda4v0A+8KwD+iCEC0xvTxikSZ1XrQdxiou5OSz2AEJvU/9LoJOn9kaVdwkY8Tvrlo6dYgGnBt7KYlnIN1SdZPd4sS9p4qgtc25pKAzu/ZhXBg3liCkFHjlESFjA7aGyZV73ty0lVY1wp2lmtw7Q/iz4ign9p/tvujTSF3T3ZiIbLd3nmbDXp96V85ecOa0f/0bG8RH6RnF53E4uAS2ybU7b93CeOu0xwDoMm3Idg1YqGbwfeBWNKjyyh9Ni8CsCWFN84tTZV6J1JHxA0TGYOd0XYWk7JgxVH+OFiWhKAebErpNRdajeJN61x6QMwXOrAuRNt7q928pR2ArfeTun7AiG+Rc/Ev6Rm2EUquEDWsrjbF9caOnMXReejPdIdWsSc7V1M4CsMXjQ6OY9Eggd+sj5BkfxZmVAaI+19JtTlez68P2rUWFkzTHDnszCR8J5ie7gAD9mLcwQAEfgb9oPP+93asBLFWn35T6/Xw9ZenRT8t49qv9HCHg6r8xilR0YYrTKf+Ouds8ZNC5m3NJjuS+0BW5qqE/0VEtLklzkdXvkqWcYk4f5Z4lLq4buWxZsu9UP2CY5fRc0IH9/JmbA3b2KGR3LtM5jTl9oTKcZokR+z4/icK/DaNGCkI+91jbOeEFGxxYbfotNync44VGn3rFjAiDGU/jwlu+pDAFg+XpNXpWBN4fk+lzrZLh92mw3ck/CkXVcRaraxd+rfLV6TntzUEepmHQ6ysXg9XdBRcrEkXQ7FETdtwfdhlYjttqSdWoWowfsLkTsIBcGUxjCGH37OMIOytciZZ3khLbklgAtWM8Acb6z1ttpmG68YVvGjrBlK/bztHwTHWbulslMXf+Kk8PZAw620+/WAlLVZuZx5SQ7mMTl5Yc562hPFEtPyUAlpRpTtug+wrqjFZgSneF3QtzkN1jlmX9VMywCCKMvOLCDwuJ6YdKkFN7HoG4qCjLTGOmhOuCfjewYNp/0DpApgb/24JaJIdXQeEFv2I5rMjqiEvLiIzRQTX6yZKY8VgCrHUxPKeuItU1ebiz18u1J3QcoHCtCBMt5gQW2/1CK6B5CW+/MxeFQTkrV4lr2REb0t/FVe+bTUIpQ2xkMfKQrCH9lWTH6yH+xG1xXHe73ZWzAbI2rB6Xb9ty+8a1nL7tdECWnE29KozZF1tknW8AlbjvxjGtdLuWnp9M5tiZW2aK7+JpbwpTi3D9QrFwj5vKbMhcpqZbCngnVcPUFJEUAB8unZlBClkBT9uYk7Wm/Bo01HktlUMlC3l5Hef4bL9S/qnWTWDohUMd4ZfAaGiF0ThnUoIjePlbspuY23TS6G3zHqfmgyEw/4GccPSx1IiWvRqZSsydfG23zhmQ85vu6w3eF7Vo7LRNNp7Z/NHnbllLHT7dVoN5vsDN21Is4mTvLEFEHwFD5LR9SHC7XY1NRPheSJupF2Rb7Uw0bFWyc4d0f1Rg1SZJvMHlIHpeaQNIUVY1J7u3JBNK4xkoLECxOxZZLyLbCIvg4es8dAXwT/5tzRNeGhSEwEAZKQRgIvcyWCoSqbtr54uUjm6yii5zrsKvN/CZRbd8YKJr4HcGaB7guaYIh9aJdFchU0ALR9r1Dsl3e4uuQ7NPaFg8APLOpxwYqs8k8w1VDoTI9juepJppWKZr7Bmi7Q46wbu1rwE988YWwOZDvqsWaXpwTbCh/ibLXYe7IQm384x3XVbpMoSsJkl4In+r44sYvVOVB7E18yRgw2soIenuJv4znLZ7Cr6XbiWnc1OWZGQjHJNMHetTr+HSsWTZR4f8/p8x26Yd6uvMsJa4+YlGZmyHmHHcyrzGQ45eDXgifXEOZ73SJ6KU5xf9kT1UGKarSDCqrBJgfM1r7jGzIcCyCzd4c8OHg6mumD3mRDICcQ/NtGhLa/CqHo4vhDFMz3zg8UshtjIWQC8+68z7IpAwrl2UBnWycG3Cvd1dO6i9m64a20tTbqyvi565l9j3kHdSyuPLF89JMUPVB2znwBZXCJMQ9N2slSKulNpIQBUzUsfE3dRxF548rG69ZYgBwJlr6vGKpbnLr7IFGwFcVbiCW+TSus8t3TwKGCPHdsObmL8TqstFDNmnp/vSHaoNQ5spPKRpdQypvts9JGTGVNNGvuv/+q6mosYEx1nK7iZ6PnmYEv2+2LEzqpoWuE0dQdC0ADo4OMbAAhuuEqV/NdcYqk/Y3nKYR2B1tqYsX9mVpifnDu9la8WTHZY8kKQ+wybnD6RWCNeBTLuiWq9hCgZPk93sNMMwa9EkwvpNHAXGafhXehJZ50PxRZmJZI1DR2PX7LDGvJMFeAulo1RONwpuWtDS7/kG0U8RsKHq+NhOhejpiQoNQbQlJMR2Gd84C3uICG+wV5LeUzqvQZYV6gvJ0oiOex3eaKCe168b9SWfWBgJnXFGsBAMnqbTYeJtMA/mh/oHPeI/Cd93YgLXMcB8dCPae5oT03iTKZtr6+/uVOwoSgr/68AkccEgDzEUPZmHMcpDaa1yIlB3GnPATr8iF+bF8C8Mp7gXVw6VN3wAQVjby0l9Z2Lbydh8hpbMOM3Amn2/5N/0KLi6ENrx5C/FLV7ctbWW+wwByU85Nkz4SPNgkatuNXSAKGMeol7vtrsjqyJ0TXkRRMK8bBOAARW8Gme1Yvv5F4emW7mm3h3cuY5k3L5h0cQLk87XFFGLJgnVq/QLMtpEtK3IsdqfrPm8zMPRphxi+UhBc5dv1pp/V27bPxXTiVPREWUvVu4XLMESPz8XhlIaouFlZXmWBP4T99ZD2lR7FNROWRskD+I5NhQsyp2/2LZ+AxJJQgk4Nt7EFM86b95hxUhZuwFYeLfiPgSrWVcDXtHEZhMSg/D7nwHNe7c97N17PTQSt12OGndUNgH6RWyIOzCpRiacf0oIS1NyS5nKNaSutpM9Cw1AqHjmdzT5Lkf4kZxtrOrNYHFiqz7cF8lqZPtPPTPaFUngVxK59q+kFhMNl2QQhfpkgyb5yfL7jzBGKOw3lgTdqIPRiP25255noMB9e+EB65fhwDpEmt1LfelgD4j6SL3AtDGFN3TvWszRcIBfnB1f/FbZaybHqxbMFDEnbTkf+BZAVMAE/AQmawCIU+k04F9mIwmE7f5I5CVU1BDLO+y+RvLsozkbENIVJpAxawqNMDP4otHKB4PKwW4nOIYizlkA6XQuZbjVELs4bz4Hh5Aa3rf+hvO1KKce60B/3PM7zMSQJIphixZVfPrc1hUSfJlEFmFedpkSpz0dGMoMZ1aIbjTxwUdOWDzOvjRWYTFTjuefTc0QUYMX9YZdN3ahN1Ky505zF1or3KRbEVPumci5pJt4icPQx4dLpPXERN207zqGmnW8IpdlR9bZk+MclidQNdn2n1tN259MBdPXu/DPjfmaLjH2SIMpNkitSbwaCq+9ru4N8T/VFbC4TNiekxpHRUL8Q6KBc7Qh1ZBV/Cm2CWwNwW9F897/vJCOAlLJNkx++ZxUSoaDiauLmT7TF0MW+OdT2EFAiCdurd0YC9cuZVUkacvp02OfzoH6kZ+rhiXEONGI1Hy0kG/rTz74VY1+aFoWKTv9ZtT7glBEmpXJNW1fwx5/a6EOX18G3F2tk3yhdLqaCdnNvFHbd8rPKEEiz7zKePnBGmalB7xPbg3TmSoFrP2DkhIA0lhDWUceLBm1ouoyw+9+UQb3G/1CqlRI2dj60kyDzitmE5PWoXdaxyVz/DKMpY0MfJ+6zK2BIcuCcc0EPsP8OS4tPUDvgIWyB5aILKThrFJbxhYGTMmcl1Ej0wtsobLLgp7E/hOR+EymjuDVzoXVVNz7cEFlcjvGW8knkqcIodw1mWUW83TDjpRKZnWSYtaS7e/T59uRurAxe8pUQaVD4HbFYz+XyNG+OM+/XnVpgRBgF1sL70LGPZHUncF/FItGBHtyEpIa7Twf6EFOIy4seoAi1EXaPnXB2967HGbUXGcWrepPMXBRJcV44sr9vu9jNPFrYZFPWNCh2Ty/AKca/myj1WpauSy/SmyoIKd++A3CEgYFCGp0xjsS1ZquVoWULVRATROU4X2Xi44cHxU0TxnOM6R/OZnJdRZunfMLoP1geC6cjN/CyyRCpy2qPPsXW4K+wKfju7D3qpE1N2rc1gS1QcjtnGrCr8xUvkhbDaqg+hYqto/sOfIJRttoWOUxJsNlWCzNdPMo9RxNTxE28Cd45MkCANLZCJprccbGIyaz2mk9MiUXcCpdIRA0poypl/JQKZzKf6+Kn/BcozXa/ZuuLKnX0PxucemYuAc8X6iC1uwq6X4aV3KYDRCUCgghGMB1AUlbwzt3kc7eCNDrkQl/jYTJZ6V8VVhwso5KOR/OP3iYc6DLUyXiPT5CN9FYIBXRN//4kkBCQTqAhYOjb8b49SjyTI81lkrLbr7SmXbpgnPrl3MzH8+5TAQIkFpwzBs8AaWfMGWZ0UcAAAAA');
