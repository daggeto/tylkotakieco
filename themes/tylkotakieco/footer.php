<div id="onas" class="shit width700 font11"><?php echo $content->getValue("tekst", "tekst_2") ?></div>
<div id="stopka">
  <a href="kontakt.php">[ <?php echo $content->getValue("footer", "kontakt") ?> ]</a>
  <a href="regulamin.php">[ <?php echo $content->getValue("footer", "regulamin") ?> ]</a>
  <br/>

  <div class="footer">
    Copyright &copy; 2016<br/>
    Webmaster: <a href="mailto:daggeto@gmail.com">daggeto@gmail.com</a>
  </div>
  <div id="banners">
    <ul>
      <li>
        <!-- Place this tag where you want the su badge to render -->
        <su:badge layout="1"></su:badge>

        <!-- Place this snippet wherever appropriate -->
        <script type="text/javascript">
          (function () {
            var li = document.createElement('script');
            li.type = 'text/javascript';
            li.async = true;
            li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(li, s);
          })();
        </script>
      </li>
    </ul>
  </div>
  <script>
    (function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function () {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-74290950-1', 'auto');
    ga('send', 'pageview');

  </script>
<script>
        $(document).ready(function() {$(".w2bslikebox").hover(function() {$(this).stop().animate({right: "0"}, "medium");}, function() {$(this).stop().animate({right: "-250"}, "medium");}, 500);});
</script>
    <style>
    .w2bslikebox {
      background: url("img/fb.png") no-repeat scroll left center transparent !important;
      display: block;
      float: right;
      height: 270px;
      padding: 0 0 0 30px;
      width: 250px;
      z-index: 99999;
      position: fixed;
      right: -250px;
      top: 20%;
    }

    .w2bslikebox div {
      padding: 3px;
      background-color: #257695;
      border: none;
      position: relative;
      display: block;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      -khtml-border-radius: 5px;
      border-radius: 5px;
    }

    .w2bslikebox span {
      bottom: 12px;
      font: 8px "lucida grande", tahoma, verdana, arial, sans-serif;
      position: absolute;
      right: 6px;
      text-align: right;
      z-index: 99999;
    }

    .w2bslikebox span a {
      color: #808080;
      text-decoration: none;
    }

    .w2bslikebox span a:hover {
      text-decoration: underline;
    }
</style>
<div class="w2bslikebox" style="">
            <div>
                <iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/politykaglupcze&amp;width=245&amp;colorscheme=light&amp;show_faces=true&amp;connections=9&amp;stream=false&amp;header=false&amp;height=330" scrolling="no" frameborder="0" scrolling="no" style="border: medium none; overflow: hidden; height: 330px; width: 245px;background:#fff;"></iframe>
            </div>
        </div>
</div>
<script type="text/javascript">
  init();
</script>
</body>
</html>
