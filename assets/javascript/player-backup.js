  var warningTitleCSS = 'color:red; font-size:60px; font-weight: bold; -webkit-text-stroke: 1px black;';
  var warningDescCSS = 'font-size: 18px;';
  var video_config_media = JSON.parse(burl(atob(video_config)));
  var video_stream_url = "";
  var video_subtitles_url = "";
  var rows_number = 0;
  var video_m3u8_array = [];
  var video_m3u8 = "";
  var is_ep_premium_only = null;
  var video_dash_playlist_url_only_trailer = "";
  var video_dash_playlist_url_old = "";
  var video_dash_playlist_url = "";
  var episode_title = video_config_media['metadata']['title'];
  for(var i = 0; i < video_config_media['streams'].length; i++) {
    if(video_config_media['streams'][i].format == 'trailer_hls' && video_config_media['streams'][i].hardsub_lang == lang) {
      if(rows_number <= 4) {
        video_m3u8_array.push(video_config_media['streams'][i].url.replace("clipTo/120000/", "clipTo/" + video_config_media['metadata']['duration'] + "/").replace(video_config_media['streams'][i].url.split("/")[2], "dl.v.vrv.co"));
        rows_number++;
      }
    }
    if(video_config_media['streams'][i].format == 'adaptive_hls' && video_config_media['streams'][i].hardsub_lang == lang) {
      video_stream_url = video_config_media['streams'][i].url.replace("pl.crunchyroll.com", "dl.v.vrv.co");
      break;
    }
  }
  video_m3u8 = '#EXTM3U' +
    '\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=4112345,RESOLUTION=1280x720,FRAME-RATE=23.974,CODECS="avc1.640028,mp4a.40.2"' +
    '\n' + video_m3u8_array[0] +
    '\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=8098235,RESOLUTION=1920x1080,FRAME-RATE=23.974,CODECS="avc1.640028,mp4a.40.2"' +
    '\n' + video_m3u8_array[1] +
    '\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=2087088,RESOLUTION=848x480,FRAME-RATE=23.974,CODECS="avc1.4d401f,mp4a.40.2"' +
    '\n' + video_m3u8_array[2] +
    '\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1090461,RESOLUTION=640x360,FRAME-RATE=23.974,CODECS="avc1.4d401e,mp4a.40.2"' +
    '\n' + video_m3u8_array[3] +
    '\n#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=559942,RESOLUTION=428x240,FRAME-RATE=23.974,CODECS="avc1.42c015,mp4a.40.2"' +
    '\n' + video_m3u8_array[4];
  if(video_stream_url == "") {
    var blob = new Blob([video_m3u8], {
      type: "text/plain; charset=utf-8"
    });
    video_stream_url = URL.createObjectURL(blob) + "#.m3u8";
  }
  $.ajax({
    async: true,
    type: "GET",
    url: video_stream_url,
    contentType: "text/xml; charset=utf-8",
    complete: function (response) {
    var playerInstance = jwplayer("player")
       playerInstance.setup({
        "title": episode_title,
        "file": video_stream_url,
        "image": thumb,
        "width": "100%",
        "height": "100%",
        "autostart": false,
        "displayPlaybackLabel": true,
        "primary": "html5",
        "logo": {
          "file": "https://files.catbox.moe/xcncgj.png",
          "position": "bottom-right"
        }
      });
      var button_iconPath = "/assets/image/download_icon.svg";
      var button_tooltipText = "Download Video";
      var buttonId = "download-video-button";
      function catchString(str, first_character, last_character) {
        if(str.match(first_character + "(.*)" + last_character) == null) {
          return null;
        } else {
          new_str = str.match(first_character + "(.*)" + last_character)[1].trim()
          return(new_str)
        }
      }
      function htmlDecode(input) {
        var e = document.createElement('textarea');
        e.innerHTML = input;
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
      }
      function setFileSize(url, element_id, needs_proxy) {
        var proxy = "https://cors-anywhere.herokuapp.com/";
        var fileSize = "";
        var http = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"));
        if(needs_proxy == true) {
          final_url = proxy + url;
        } else {
          final_url = url;
        }
        http.onreadystatechange = function () {
          if(http.readyState == 4 && http.status == 200) {
            fileSize = http.getResponseHeader('content-length');
            if(fileSize == null) {
              setFileSize(url, element_id, true);
            } else {
              var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
              if(fileSize == 0) return 'n/a';
              var i = parseInt(Math.floor(Math.log(fileSize) / Math.log(1024)));
              if(i == 0) return fileSize + ' ' + sizes[i];
              var return_fileSize = (fileSize / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
              document.getElementById(element_id).innerText = return_fileSize;
            }
          }
        }
        http.open("HEAD", final_url, true);
        http.send(null);
      }
      document.querySelectorAll("button.close-modal")[0].onclick = function () {
        document.querySelectorAll(".modal")[0].style.visibility = "hidden";
      };
      function download_ButtonClickAction() {
        if(jwplayer().getEnvironment().OS.mobile == true) {
          document.querySelectorAll(".modal")[0].style.height = "170px";
          document.querySelectorAll(".modal")[0].style.overflow = "auto";
        }
        document.querySelectorAll(".modal")[0].style.visibility = "visible";
        player_current_playlist = jwplayer().getPlaylist()[0].file;
        if(jwplayer().getPlaylist()[0].file.indexOf('blob:') !== -1) {
          is_ep_premium_only = true;
        } else {
          is_ep_premium_only = false;
        }
        if(is_ep_premium_only == false) {
          video_dash_playlist_url_old = player_current_playlist.replace("master.m3u8", "manifest.mpd").replace(player_current_playlist.split("/")[2], "dl.v.vrv.co").replace("evs1", "evs");
          video_dash_playlist_url = player_current_playlist.replace(player_current_playlist.split("/")[2], "v.vrv.co").replace("evs1", "evs");
          $.ajax({
            async: true,
            type: "GET",
            url: video_dash_playlist_url_old,
            success: function (result, status, xhr) {
              var params_download_link = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_1080p_code = video_dash_playlist_url.split(",")[2];
              var video_720p_code = video_dash_playlist_url.split(",")[1];
              var video_480p_code = video_dash_playlist_url.split(",")[3];
              var video_360p_code = video_dash_playlist_url.split(",")[4];
              var video_240p_code = video_dash_playlist_url.split(",")[5];
              var video_1080p_mp4_url = video_dash_playlist_url.split("_,")[0] + "_" + video_1080p_code + params_download_link;
              var video_720p_mp4_url = video_dash_playlist_url.split("_,")[0] + "_" + video_720p_code + params_download_link;
              var video_480p_mp4_url = video_dash_playlist_url.split("_,")[0] + "_" + video_480p_code + params_download_link;
              var video_360p_mp4_url = video_dash_playlist_url.split("_,")[0] + "_" + video_360p_code + params_download_link;
              var video_240p_mp4_url = video_dash_playlist_url.split("_,")[0] + "_" + video_240p_code + params_download_link;
              document.getElementById("1080p_down_url").href = video_1080p_mp4_url;
              setFileSize(video_1080p_mp4_url, "1080p_down_size");
              document.getElementById("720p_down_url").href = video_720p_mp4_url;
              setFileSize(video_720p_mp4_url, "720p_down_size");
              document.getElementById("480p_down_url").href = video_480p_mp4_url;
              setFileSize(video_480p_mp4_url, "480p_down_size");
              document.getElementById("360p_down_url").href = video_360p_mp4_url;
              setFileSize(video_360p_mp4_url, "360p_down_size");
              document.getElementById("240p_down_url").href = video_240p_mp4_url;
              setFileSize(video_240p_mp4_url, "240p_down_size");
            }
          });
        }
        if(is_ep_premium_only == true) {
          var video_1080p_dash_playlist_url_no_clipe = video_m3u8_array[1].replace("/clipFrom/0000/clipTo/" + video_config_media['metadata']['duration'] + "/index.m3u8", ",.urlset/manifest.mpd");
          var video_1080p_dash_playlist_url = video_1080p_dash_playlist_url_no_clipe.replace(video_1080p_dash_playlist_url_no_clipe.split("_")[0] + "_", video_1080p_dash_playlist_url_no_clipe.split("_")[0] + "_,");
          $.ajax({
            async: true,
            type: "GET",
            url: video_1080p_dash_playlist_url,
            success: function (result, status, xhr) {
              var params_download_link_1080p = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_1080p_mp4_url_old = video_1080p_dash_playlist_url.split("_,")[0] + "_" + video_1080p_dash_playlist_url.split(",")[1] + params_download_link_1080p;
              var video_1080p_mp4_url = video_1080p_mp4_url_old.replace("dl.v.vrv.co", "v.vrv.co");
              document.getElementById("1080p_down_url").href = video_1080p_mp4_url;
              setFileSize(video_1080p_mp4_url, "1080p_down_size");
            }
          });
          var video_720p_dash_playlist_url_no_clipe = video_m3u8_array[0].replace("/clipFrom/0000/clipTo/" + video_config_media['metadata']['duration'] + "/index.m3u8", ",.urlset/manifest.mpd");
          var video_720p_dash_playlist_url = video_720p_dash_playlist_url_no_clipe.replace(video_720p_dash_playlist_url_no_clipe.split("_")[0] + "_", video_720p_dash_playlist_url_no_clipe.split("_")[0] + "_,");
          $.ajax({
            async: true,
            type: "GET",
            url: video_720p_dash_playlist_url,
            success: function (result, status, xhr) {
              var params_download_link_720p = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_720p_mp4_url_old = video_720p_dash_playlist_url.split("_,")[0] + "_" + video_720p_dash_playlist_url.split(",")[1] + params_download_link_720p;
              var video_720p_mp4_url = video_720p_mp4_url_old.replace("dl.v.vrv.co", "v.vrv.co");
              document.getElementById("720p_down_url").href = video_720p_mp4_url;
              setFileSize(video_720p_mp4_url, "720p_down_size");
            }
          });
          var video_480p_dash_playlist_url_no_clipe = video_m3u8_array[2].replace("/clipFrom/0000/clipTo/" + video_config_media['metadata']['duration'] + "/index.m3u8", ",.urlset/manifest.mpd");
          var video_480p_dash_playlist_url = video_480p_dash_playlist_url_no_clipe.replace(video_480p_dash_playlist_url_no_clipe.split("_")[0] + "_", video_480p_dash_playlist_url_no_clipe.split("_")[0] + "_,");
          $.ajax({
            async: true,
            type: "GET",
            url: video_480p_dash_playlist_url,
            success: function (result, status, xhr) {
              var params_download_link_480p = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_480p_mp4_url_old = video_480p_dash_playlist_url.split("_,")[0] + "_" + video_480p_dash_playlist_url.split(",")[1] + params_download_link_480p;
              var video_480p_mp4_url = video_480p_mp4_url_old.replace("dl.v.vrv.co", "v.vrv.co");
              document.getElementById("480p_down_url").href = video_480p_mp4_url;
              setFileSize(video_480p_mp4_url, "480p_down_size");
            }
          });
          var video_360p_dash_playlist_url_no_clipe = video_m3u8_array[3].replace("/clipFrom/0000/clipTo/" + video_config_media['metadata']['duration'] + "/index.m3u8", ",.urlset/manifest.mpd");
          var video_360p_dash_playlist_url = video_360p_dash_playlist_url_no_clipe.replace(video_360p_dash_playlist_url_no_clipe.split("_")[0] + "_", video_360p_dash_playlist_url_no_clipe.split("_")[0] + "_,");
          $.ajax({
            async: true,
            type: "GET",
            url: video_360p_dash_playlist_url,
            success: function (result, status, xhr) {
              var params_download_link_360p = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_360p_mp4_url_old = video_360p_dash_playlist_url.split("_,")[0] + "_" + video_360p_dash_playlist_url.split(",")[1] + params_download_link_360p;
              var video_360p_mp4_url = video_360p_mp4_url_old.replace("dl.v.vrv.co", "v.vrv.co");
              document.getElementById("360p_down_url").href = video_360p_mp4_url;
              setFileSize(video_360p_mp4_url, "360p_down_size");
            }
          });
          var video_240p_dash_playlist_url_no_clipe = video_m3u8_array[4].replace("/clipFrom/0000/clipTo/" + video_config_media['metadata']['duration'] + "/index.m3u8", ",.urlset/manifest.mpd");
          var video_240p_dash_playlist_url = video_240p_dash_playlist_url_no_clipe.replace(video_240p_dash_playlist_url_no_clipe.split("_")[0] + "_", video_240p_dash_playlist_url_no_clipe.split("_")[0] + "_,");
          $.ajax({
            async: true,
            type: "GET",
            url: video_240p_dash_playlist_url,
            success: function (result, status, xhr) {
              var params_download_link_240p = htmlDecode(catchString(xhr.responseText, '.m4s?', '"'));
              var video_240p_mp4_url_old = video_240p_dash_playlist_url.split("_,")[0] + "_" + video_240p_dash_playlist_url.split(",")[1] + params_download_link_240p;
              var video_240p_mp4_url = video_240p_mp4_url_old.replace("dl.v.vrv.co", "v.vrv.co");
              document.getElementById("240p_down_url").href = video_240p_mp4_url;
              setFileSize(video_240p_mp4_url, "240p_down_size");
            }
          });
        }
      }
      playerInstance.addButton(button_iconPath, button_tooltipText, download_ButtonClickAction, buttonId);
      jwplayer().on('ready', function (e) {
        if(localStorage.getItem(video_id) != null) {
          document.getElementsByTagName("video")[0].currentTime = localStorage.getItem(video_id);
        }
        document.body.querySelector(".loading_container").style.display = "none";
      });
      jwplayer().on('firstFrame', function (e) {
				creator_message = document.createElement("div");
				creator_message.setAttribute("class", "creator-message");
				creator_message.innerHTML = '<span>Made with ❤️ by Moedev Team </span><br><span>If you find any bugs, report on issues to <a href="mailto:yukifag@pm.me">yukifag@pm.me</a>.</span>';
				document.querySelectorAll(".jw-overlays.jw-reset")[0].appendChild(creator_message);
				$(creator_message).slideDown().delay(4000).slideUp();
			});
      const save_player_time_interval = setInterval(function () {
        if(jwplayer().getState() == "playing") {
          localStorage.setItem(video_id, jwplayer().getPosition());
        }
      }, 5000);
    }
  });
  console.log('%cStop!', warningTitleCSS);
  console.log("%cwhat are you doing ?.", warningDescCSS);
  console.log('%cif you want use or see source visit https://cr.moedev.co for more information.', warningDescCSS);
