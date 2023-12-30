
<!DOCTYPE html>
<html>
  <head>
    <title>zyosetu_system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- <link rel='stylesheet' href='css/easy-button.css'/> -->
    <!-- <script src='js/easy-button.js'></script> -->

    <style class="mapview" type="text/css">
      #mapid { height: 700px; width: 1420px ;top: 0px;left:100px; right:350px;z-index: 0;}
      
    </style>

    <!-- AIチャットボットCSS -->
    <link rel="stylesheet" href="css/AIbot.css" type="text/css">

    <!-- AIチャットボットJS -->
    <script type="module" src="js/main.js" defer></script>

    <style media="screen">
 
     nav ul li{
        /* display: inline-block; */
        margin: 0 0px;
      }
    a{
      text-decoration: none;
    }
    </style>

<link rel="stylesheet" href="css/HamburgerMenu.css">
  </head>



  <body bgcolor="#FFFFFF"><!-- #A9CEEC -->
    <img src="image/freefont_logo_kouzansousho.png">

    <!-- ハンバーガーメニュー -->
    <link href= "https://fonts.googleapis.com/icon?family=Material+Icons" rel= "stylesheet">
    <header>
      <div class="sp-menu">
        <span class="material-icons" id="open">menu</span>
      </div>
    </header>
  
    <div class="overlay">
      <span class="material-icons" id="close">close</span>
      <nav>
        <ul>
          <li><a href="index.html"><img src="image/freefont_logo_kouzansousho2.png"></a></li>
          <!-- <img src="freefont_logo_kouzansousho2.png"> -->
          <li><a href="./login.php"><img src="image/freefont_logo_kouzansousho3.png"></a></li>
          <li><a href="access.html"><img src="image/freefont_logo_kouzansousho4.png"></a></li>
        </ul>
      </nav>
    </div>
    <!-- <script>
      open.addEventListener('click', () => {
      overlay.classList.add('show');
      open.classList.add('hide');

    });

    close.addEventListener('click', () => {
      overlay.classList.remove('show');
      open.classList.remove('hide');
    });
  
    </script> -->
    <script src="js/HamburgerMenu.js"></script>
    <!-- ハンバーガーメニュー終わり -->

    <!-- AIチャットボット -->

    <!--Import Google Icon Font-->


<div id= "chatbot">
  
  <div id= "chatbot-header">
    <div id= "chatbot-logo">AI Chatbot</div>
    <i id= "chatbot-zoom-icon" class="material-icons waves-effect waves-light" onclick= "chatbotZoom()">fullscreen</i>
  </div>
  
  <div id= "chatbot-body">
    <ul id= "chatbot-ul"></ul>
  </div>
  
  <!--入力場所，送信ボタン-->
  <form onsubmit= "return false">
    <div id= "chatbot-footer">
      <input type= "text" id= "chatbot-text" class= "browser-default" placeholder= "テキストを入力">
      <input type= "submit" value= "送信" id= "chatbot-submit">
    </div>
  </form>
  
</div>

<!-- AIチャットボット終わり -->

    <div id="mapid"></div>
    <!-- <button type="button"style="position: absolute; left: 0px; top: 0px">ボタン</button> -->
    
    <!-- <nav class="global-nav" style="position: absolute; left: 0px; top: 150px" ;>
      <p>メニュー</p>
      <ul>
        <li><a href="#">menu</a></li>
        <li><a href="http://192.168.10.120/map_project/login.php">login</a></li>
        <li><a href="access.html">access</a></li>
      </ul>
    </nav> -->
    <script>
      var mymap = L.map('mapid').setView([43.79, 142.41],13);

      //var mymap = L.map('mapid').setView([35.6896,139.6918],9);

      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, '
      }).addTo(mymap);
	    // var triangle = L.polygon([
      //     [43.81472, 142.35843],
      //     [43.81588, 142.35680],
      //     [43.81239, 142.35195],
		  //     [43.81118, 142.35355],
      // ]).addTo(mymap);
       


      function onLocationFound(e) {
          L.marker(e.latlng).addTo(mymap).bindPopup("現在地").openPopup();
      }

      function onLocationError(e) {
          alert("現在地を取得できませんでした。" + e.message);
      }

       mymap.on('locationfound', onLocationFound);
      // mymap.on('locationerror', onLocationError);

     // mymap.locate({setView: true, maxZoom: 16, timeout: 20000});
//2
      // var popup = L.popup().setContent('ポップアップメッセージ');
      // L.easyButton('fas fa-comment-alt', function(btn, easyMap){
      //   popup.setLatLng(easyMap.getCenter()).openOn(easyMap);
      // }).addTo(map);



      var markers=[];

      // markers[0]=
      L.marker([35.6896, 139.6918]).addTo(mymap).bindPopup('<img src="image/freefont_logo_kouzansousho2.png"  /><p>ここに文章を追加</p>');//.openPopup();
      //markers[1]=
      L.marker([35.6050, 140.1234]).addTo(mymap).bindPopup("千葉県");
      //markers[2]=
      L.marker([35.8572, 139.6490]).addTo(mymap).bindPopup("埼玉県");
      //L.marker([43.8089, 142.35355]).addTo(mymap).bindPopup("埼玉県");
      L.marker([43.80963, 142.35355]).addTo(mymap).bindPopup('<img src="image/pre_image.png"  /><p>2023年1月13日10:26</p><p>除雪車ナンバー:あ 12-34</p><p>緯度,経度: 43.80963, , 142.35355</p><p>作業者ID: 43fb979c-4687-448d-ac0f-1a58e2c76017</p><p>報告内容:除雪を実施しました</p>');
      L.marker([43.8213211, 142.3541]).addTo(mymap).bindPopup('<img src="image/magarimiti.jpg"  /><p>2023年1月13日10:56</p><p>除雪車ナンバー:あ 12-34</p><p>緯度,経度: 43.8213211, , 142.3541</p><p>作業者ID: 43fb979c-4687-448d-ac0f-1a58e2c76017</p><p>報告内容:除雪を実施しました</p>');

      L.marker([43.8173211, 142.35329]).addTo(mymap).bindPopup('<img src="image/pre4_image.jpg"  /><p>2023年1月13日10:56</p><p>除雪車ナンバー:あ 12-34</p><p>緯度,経度: 43.8213211, , 142.3541</p><p>作業者ID: 43fb979c-4687-448d-ac0f-1a58e2c76017</p><p>報告内容:除雪を実施しました</p>');
    </script>
    
  </body>
</html>