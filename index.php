<?php
if ($_GET['id'] && $_GET['lang'] != ""){
$id                     = $_GET['id'];
$lang                   = $_GET['lang'];
$url                    = "https://apicr.vercel.app?id=$id";
$json                   = file_get_contents($url);
$array                  = json_decode($json, true);
require 'jspacker.php';
$script = 'for(var warningTitleCSS="color:red; font-size:60px; font-weight: bold; -webkit-text-stroke: 1px black;",warningDescCSS="font-size: 18px;",video_config_media=JSON.parse(burl(atob(video_config))),video_stream_url="",video_subtitles_url="",rows_number=0,video_m3u8_array=[],video_m3u8="",is_ep_premium_only=null,video_dash_playlist_url_only_trailer="",video_dash_playlist_url_old="",video_dash_playlist_url="",episode_title=video_config_media.metadata.title,i=0;i<video_config_media.streams.length;i++)if("trailer_hls"==video_config_media.streams[i].format&&video_config_media.streams[i].hardsub_lang==lang&&4>=rows_number&&(video_m3u8_array.push(video_config_media.streams[i].url.replace("clipTo/120000/","clipTo/"+video_config_media.metadata.duration+"/").replace(video_config_media.streams[i].url.split("/")[2],"dl.v.vrv.co")),rows_number++),"adaptive_hls"==video_config_media.streams[i].format&&video_config_media.streams[i].hardsub_lang==lang){video_stream_url=video_config_media.streams[i].url.replace("pl.crunchyroll.com","dl.v.vrv.co");break}if(video_m3u8="#EXTM3U\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=4112345,RESOLUTION=1280x720,FRAME-RATE=23.974,CODECS=\"avc1.640028,mp4a.40.2\"\n"+video_m3u8_array[0]+"\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=8098235,RESOLUTION=1920x1080,FRAME-RATE=23.974,CODECS=\"avc1.640028,mp4a.40.2\"\n"+video_m3u8_array[1]+"\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=2087088,RESOLUTION=848x480,FRAME-RATE=23.974,CODECS=\"avc1.4d401f,mp4a.40.2\"\n"+video_m3u8_array[2]+"\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1090461,RESOLUTION=640x360,FRAME-RATE=23.974,CODECS=\"avc1.4d401e,mp4a.40.2\"\n"+video_m3u8_array[3]+"\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=559942,RESOLUTION=428x240,FRAME-RATE=23.974,CODECS=\"avc1.42c015,mp4a.40.2\"\n"+video_m3u8_array[4],""==video_stream_url){var blob=new Blob([video_m3u8],{type:"text/plain; charset=utf-8"});video_stream_url=URL.createObjectURL(blob)+"#.m3u8"}$.ajax({async:!0,type:"GET",url:video_stream_url,contentType:"text/xml; charset=utf-8",complete:function(){function a(a,b,c){return null==a.match(b+"(.*)"+c)?null:(new_str=a.match(b+"(.*)"+c)[1].trim(),new_str)}function b(a){var b=document.createElement("textarea");return b.innerHTML=a,0===b.childNodes.length?"":b.childNodes[0].nodeValue}function c(a,b,d){var e="",f=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP");final_url=!0==d?"https://cors-anywhere.herokuapp.com/"+a:a,f.onreadystatechange=function(){if(4==f.readyState&&200==f.status)if(e=f.getResponseHeader("content-length"),null==e)c(a,b,!0);else{var d=["Bytes","KB","MB","GB","TB"];if(0==e)return"n/a";var g=parseInt(Math.floor(Math.log(e)/Math.log(1024)));if(0==g)return e+" "+d[g];var h=(e/Math.pow(1024,g)).toFixed(1)+" "+d[g];document.getElementById(b).innerText=h}},f.open("HEAD",final_url,!0),f.send(null)}function d(){if(!0==jwplayer().getEnvironment().OS.mobile&&(document.querySelectorAll(".modal")[0].style.height="170px",document.querySelectorAll(".modal")[0].style.overflow="auto"),document.querySelectorAll(".modal")[0].style.visibility="visible",player_current_playlist=jwplayer().getPlaylist()[0].file,is_ep_premium_only=-1!==jwplayer().getPlaylist()[0].file.indexOf("blob:"),!1==is_ep_premium_only&&(video_dash_playlist_url_old=player_current_playlist.replace("master.m3u8","manifest.mpd").replace(player_current_playlist.split("/")[2],"dl.v.vrv.co").replace("evs1","evs"),video_dash_playlist_url=player_current_playlist.replace(player_current_playlist.split("/")[2],"v.vrv.co").replace("evs1","evs"),$.ajax({async:!0,type:"GET",url:video_dash_playlist_url_old,success:function(d,e,f){var g=b(a(f.responseText,".m4s?","\"")),h=video_dash_playlist_url.split(",")[2],i=video_dash_playlist_url.split(",")[1],j=video_dash_playlist_url.split(",")[3],k=video_dash_playlist_url.split(",")[4],l=video_dash_playlist_url.split(",")[5],m=video_dash_playlist_url.split("_,")[0]+"_"+h+g,n=video_dash_playlist_url.split("_,")[0]+"_"+i+g,o=video_dash_playlist_url.split("_,")[0]+"_"+j+g,p=video_dash_playlist_url.split("_,")[0]+"_"+k+g,q=video_dash_playlist_url.split("_,")[0]+"_"+l+g;document.getElementById("1080p_down_url").href=m,c(m,"1080p_down_size"),document.getElementById("720p_down_url").href=n,c(n,"720p_down_size"),document.getElementById("480p_down_url").href=o,c(o,"480p_down_size"),document.getElementById("360p_down_url").href=p,c(p,"360p_down_size"),document.getElementById("240p_down_url").href=q,c(q,"240p_down_size")}})),!0==is_ep_premium_only){var d=video_m3u8_array[1].replace("/clipFrom/0000/clipTo/"+video_config_media.metadata.duration+"/index.m3u8",",.urlset/manifest.mpd"),e=d.replace(d.split("_")[0]+"_",d.split("_")[0]+"_,");$.ajax({async:!0,type:"GET",url:e,success:function(d,f,g){var h=b(a(g.responseText,".m4s?","\"")),i=e.split("_,")[0]+"_"+e.split(",")[1]+h,j=i.replace("dl.v.vrv.co","v.vrv.co");document.getElementById("1080p_down_url").href=j,c(j,"1080p_down_size")}});var f=video_m3u8_array[0].replace("/clipFrom/0000/clipTo/"+video_config_media.metadata.duration+"/index.m3u8",",.urlset/manifest.mpd"),g=f.replace(f.split("_")[0]+"_",f.split("_")[0]+"_,");$.ajax({async:!0,type:"GET",url:g,success:function(d,e,f){var h=b(a(f.responseText,".m4s?","\"")),i=g.split("_,")[0]+"_"+g.split(",")[1]+h,j=i.replace("dl.v.vrv.co","v.vrv.co");document.getElementById("720p_down_url").href=j,c(j,"720p_down_size")}});var h=video_m3u8_array[2].replace("/clipFrom/0000/clipTo/"+video_config_media.metadata.duration+"/index.m3u8",",.urlset/manifest.mpd"),i=h.replace(h.split("_")[0]+"_",h.split("_")[0]+"_,");$.ajax({async:!0,type:"GET",url:i,success:function(d,e,f){var g=b(a(f.responseText,".m4s?","\"")),h=i.split("_,")[0]+"_"+i.split(",")[1]+g,j=h.replace("dl.v.vrv.co","v.vrv.co");document.getElementById("480p_down_url").href=j,c(j,"480p_down_size")}});var j=video_m3u8_array[3].replace("/clipFrom/0000/clipTo/"+video_config_media.metadata.duration+"/index.m3u8",",.urlset/manifest.mpd"),k=j.replace(j.split("_")[0]+"_",j.split("_")[0]+"_,");$.ajax({async:!0,type:"GET",url:k,success:function(d,e,f){var g=b(a(f.responseText,".m4s?","\"")),h=k.split("_,")[0]+"_"+k.split(",")[1]+g,i=h.replace("dl.v.vrv.co","v.vrv.co");document.getElementById("360p_down_url").href=i,c(i,"360p_down_size")}});var l=video_m3u8_array[4].replace("/clipFrom/0000/clipTo/"+video_config_media.metadata.duration+"/index.m3u8",",.urlset/manifest.mpd"),m=l.replace(l.split("_")[0]+"_",l.split("_")[0]+"_,");$.ajax({async:!0,type:"GET",url:m,success:function(d,e,f){var g=b(a(f.responseText,".m4s?","\"")),h=m.split("_,")[0]+"_"+m.split(",")[1]+g,i=h.replace("dl.v.vrv.co","v.vrv.co");document.getElementById("240p_down_url").href=i,c(i,"240p_down_size")}})}}var e=jwplayer("player");e.setup({title:episode_title,file:video_stream_url,image:thumb,width:"100%",height:"100%",autostart:!1,displayPlaybackLabel:!0,primary:"html5",logo:{file:"https://files.catbox.moe/xcncgj.png",position:"bottom-right"}});document.querySelectorAll("button.close-modal")[0].onclick=function(){document.querySelectorAll(".modal")[0].style.visibility="hidden"},e.addButton("/assets/image/download_icon.svg","Download Video",d,"download-video-button"),jwplayer().on("ready",function(){null!=localStorage.getItem(video_id)&&(document.getElementsByTagName("video")[0].currentTime=localStorage.getItem(video_id)),document.body.querySelector(".loading_container").style.display="none"}),jwplayer().on("firstFrame",function(){creator_message=document.createElement("div"),creator_message.setAttribute("class","creator-message"),creator_message.innerHTML="<span>Made with \u2764\uFE0F by Moedev Team </span><br><span>If you find any bugs, report on issues to <a href=\"mailto:yukifag@pm.me\">yukifag@pm.me</a>.</span>",document.querySelectorAll(".jw-overlays.jw-reset")[0].appendChild(creator_message),$(creator_message).slideDown().delay(4e3).slideUp()});setInterval(function(){"playing"==jwplayer().getState()&&localStorage.setItem(video_id,jwplayer().getPosition())},5e3)}}),console.log("%cStop!",warningTitleCSS),console.log("%cwhat are you doing ?.",warningDescCSS),console.log("%cif you want use or see source visit https://cr.moedev.co for more information.",warningDescCSS);';
$rand   = rand(20, 100);
$packer = new JSPacker($script);
$script = $packer->pack();
$encode = implode('"+"', str_split(base64_encode($script), $rand));
header_remove('x-powered-by');
?>
<!DOCTYPE html>
<html>
<head>
<title>CR - <?= $array['metadata']['title'];?></title>
<meta http-equiv="content-language" content="<?= $lang?>">
<meta charset="utf-8" />
<meta property="og:site_name" content="CR - Nonton Anime (IL/L)egal"/>
<meta property="og:type" content="tv_show"/>
<meta property="og:image" content="<?= $array['thumbnail']['url'];?>"/>
<meta name="title" property="og:title" content="<?= $array['metadata']['title'];?>">
<meta name="description" property="og:description" content="<?= $array['metadata']['description'];?>">
<meta prefix="moe: https://moedev.co/#" property="moe:id" content="1909082381">
<meta property="moe:developer" content="iqbalrifai"/>
<meta property="moe:name" content="cr-player"/>
<meta property="moe:discord_developer" content="bal#3530"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/css/player.css">
<link rel="stylesheet" type="text/css" href="/assets/css/download_dialog.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="loading_container">
<div class="loading_icon">
<svg width="30px"  height="30px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;">
<circle cx="50" cy="50" fill="none" ng-attr-stroke="{{config.color}}" ng-attr-stroke-width="{{config.width}}" ng-attr-r="{{config.radius}}" ng-attr-stroke-dasharray="{{config.dasharray}}" stroke="#ffffff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(159.051 50 50)">
<animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
</circle>
</svg>
</div>
<div class="loading_text_container">
<div class="loading_text">Your video will start in a moment (^-^)<span class="cut_line"></span>Waiting for stream data ...</div>
</div>
</div>
<div class="modal" style="transform: translate3d(0px, 0px, 0px);visibility: hidden;">
		   <button class="close-modal">×</button>
		   <div class="download-item">
		   	<span class="partdditem hdlabel not-copyable"><sup>Full HD</sup></span>
		   	<span class="partdditem quality not-copyable">1080p</span>
		   	<span id="1080p_down_size" class="partdditem size not-copyable">0 MB</span>
		   	<a id="1080p_down_url" class="partdditem down-icon" href="javascript:void(0);" target="_top" download></a>
		   </div>
		   <div class="download-item">
		   	<span class="partdditem hdlabel not-copyable"><sup>HD</sup></span>
		   	<span class="partdditem quality not-copyable">720p</span>
		   	<span id="720p_down_size" class="partdditem size not-copyable">0 MB</span>
		   	<a id="720p_down_url" class="partdditem down-icon" href="javascript:void(0);" target="_top" download></a>
		   </div>
		   <div class="download-item">
		   	<span class="partdditem hdlabel not-copyable"><sup></sup></span>
		   	<span class="partdditem quality not-copyable">480p</span>
		   	<span  id="480p_down_size" class="partdditem size not-copyable">0 MB</span>
		   	<a id="480p_down_url" class="partdditem down-icon" href="javascript:void(0);" target="_top" download></a>
		   </div>
		   <div class="download-item">
		   	<span class="partdditem hdlabel not-copyable"><sup></sup></span>
		   	<span class="partdditem quality not-copyable">360p</span>
		   	<span id="360p_down_size" class="partdditem size not-copyable">0 MB</span>
		   	<a id="360p_down_url" class="partdditem down-icon" href="javascript:void(0);" target="_top" download></a>
		   </div>
		   <div class="download-item">
		   	<span class="partdditem hdlabel not-copyable"><sup></sup></span>
		   	<span class="partdditem quality not-copyable">240p</span>
		   	<span id="240p_down_size" class="partdditem size not-copyable">0 MB</span>
		   	<a id="240p_down_url" class="partdditem down-icon" href="javascript:void(0);" target="_top" download></a>
		   </div>
	</div>
<div id="player"></div>
<script src="/assets/javascript/jwplayer.min.js"></script>
<script src="/assets/javascript/function-bruh.js"></script>
<script type="text/javascript">var _0x1979=['toLowerCase','fromCharCode','charCodeAt','replace'];(function(_0x4c4dd8,_0x1979df){var _0x3747c0=function(_0x569f24){while(--_0x569f24){_0x4c4dd8['push'](_0x4c4dd8['shift']());}};_0x3747c0(++_0x1979df);}(_0x1979,0x1c0));var _0x3747=function(_0x4c4dd8,_0x1979df){_0x4c4dd8=_0x4c4dd8-0x0;var _0x3747c0=_0x1979[_0x4c4dd8];return _0x3747c0;};function burl(_0x569f24){var _0x4a9e7a=_0x3747;return(_0x569f24+'')[_0x4a9e7a('0x3')](/[a-z]/gi,function(_0x1f385a){var _0x3e512f=_0x4a9e7a;return String[_0x3e512f('0x1')](_0x1f385a[_0x3e512f('0x2')](0x0)+('n'>_0x1f385a[_0x3e512f('0x0')]()?0xd:-0xd));});};video_config = '<?= base64_encode(str_rot13(json_encode($array)));?>';var video_id = <?= $id ?>;var thumb = '<?= $array['thumbnail']['url']?>';var lang = '<?= $lang ?>';</script>
<script type="text/javascript">
<?= 'Bruh.Run("' . $encode . '");'; ?>
</script>
</body>
</html>
<?php
}else{
header('Content-Type: application/json');
	header_remove('x-powered-by');
        http_response_code(200);
        $error = array(
        	'error' => false,
        	'version'  => 1,
                'code' => 200,
                'endpoint' => '/?id=:media_id&lang=:lang',
                'message' => 'Welcome to Player Chrunchyroll'
            );
        echo json_encode($error);
}?>
