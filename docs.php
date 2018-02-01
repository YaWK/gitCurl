<?php
/*
 * Copyright 2018 Daniel Retzl, danielretzl@gmail.com - MIT license
 * Which means:
 * 
 * Permission is hereby granted, free of charge, to any person obtaining 
 * a copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the 
 * Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in 
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN 
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
?>

<html>
<head>
<!-- jquery JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
<!-- font awesome icons CSS -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- animate CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

<script type="text/javascript">
$( document ).ready(function() {
$("#goUp").click(function() {
    $('html, body').animate({
        scrollTop: $("#top").offset().top
    }, 1200);
});
});
</script>
<style>
.bg-grey
{
	background-color: #ddd;
}
.bg-white
{
	background-color: #fff;
}
</style>
</head>

<body class="bg-grey">
<nav id="top" class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand" href="http://github.com/YaWK/gitCurl" target="_blank" title="visit gitCurl on GitHub"><i class="fa fa-github"></i> GitCurl Project</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gitCurl.php?state=open">Open</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gitCurl.php?state=closed">Closed</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="docs/class-gitCurl.html" target="iframe">Documentation</a>
      </li>
    </ul>
    <ul class="navbar-nav pull-right">    
    <li class="nav-item text-center">
        <a class="nav-link" title="visit GitCurl Website" href="https://gitcurl.yawk.io"><i class="fa fa-globe"></i><small><br>gitcurl.yawk.io</small></a>
      </li>
  </ul>
  </div>
</nav>
      <iframe name="iframe" src="docs/class-gitCurl.html" width="100%" height="100%">

      </iframe>
</body>
</html>