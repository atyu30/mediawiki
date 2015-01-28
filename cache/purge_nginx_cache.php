<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
/*
 * @encoding: utf-8
 * @FileName: purge_nginx_cache.php
 * @Author: Atyu30 <ipostfix (at) gmail.com>
 * @Version: 2015-01-23 16:21
 * @Copyrigth:  http://www.atyu30.com/
 * @Description:
 *
*/
session_start();
$cache_path = '/var/cache/nginx/wiki/';
$url = parse_url($_POST['url']);
if(!$url)
{
    echo 'Invalid URL entered';
    die();
}
$scheme = $url['scheme'];
$host = $url['host'];
$requesturi = $url['path'];
#fastcgi_cache_key "$scheme://$host$request_uri";
$hash = md5($scheme.'://'.$host.$requesturi);

$cache_file = $cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash;

if(file_exists($cache_file)){

    if(unlink($cache_file)){
        echo $_POST['url'].$cache_file."<h1> delete ok !</h1>";
    }
    else{
        echo $_POST['url'].$cache_file."<hr> delete error !<hr/>";
    }
}
else{
    echo $_POST['url']."<font color=red> not exist !</font>";
}
?>

<script type="text/javascript">

function CheckPost(){
    if (purge_nginx.url.value==""){
        alert ("Input URL");
        purge_nginx.url.focus();
    return false;
  }
}

</script>

<center>
<form action=""  method="post" name="purge_nginx" onsubmit="return CheckPost();">
Input URL：("http://www.atyu30.com/OpenBSD")
    <input name="url" type="text" size="60">
    <input type="submit" value="clean"><br>
    </form>
</center>
