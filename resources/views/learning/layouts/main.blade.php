<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" id="font-awesome-css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" media="screen">
    <style>
      h2 {
        margin-top: 2em;
      }
      .back-to-top {
        margin: 0;
        position: fixed;
        bottom: 0;
        right: 0;
        width: 70px;
        height: 70px;
        z-index: 100;
        display: none;
        text-decoration: none;
        color: #808080;
        font-size: 12.9px;
        text-align: center;
        border-top: 10px solid #808080;
        border-bottom: 10px solid #808080;
      }
      .back-to-top:hover {
        color: #808080;
        text-decoration: none;
      }
      .back-to-top:visited {
        color:  #808080;
      }
      .back-to-top i {
        font-size: 53px;
      }
    </style>
  </head>
  <body>
    @include('learning.nav')

    <div class="container-fluid">

      @yield('content')

      <a href="#" class="back-to-top" style="display: inline;">
        <i class="fa fa-arrow-circle-up"></i>
      </a>
    </div>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
      $('.back-to-top').css({'display': 'none'});
      $(document).ready(function() {
        var offset = 250;
        var duration = 300;

        $(window).scroll(function() {
          if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
          } else {
            $('.back-to-top').fadeOut(duration);
          }
        });

        $('.back-to-top').click(function(event) {
          event.preventDefault();

          $('html, body').animate({scrollTop: 0}, duration);
          return false;
        })
      });
    </script>
  </body>
</html>
