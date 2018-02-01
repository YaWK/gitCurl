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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gitCurl.php?state=open">Open</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gitCurl.php?state=closed">Closed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="docs.php">Documentation</a>
      </li>
    </ul>
    <ul class="navbar-nav pull-right">		
		<li class="nav-item text-center">
	    	<a class="nav-link" title="visit GitCurl Website" href="https://gitcurl.yawk.io"><i class="fa fa-globe"></i><small><br>gitcurl.yawk.io</small></a>
	    </li>
	</ul>
  </div>
</nav>

<!-- container start-->
<section class="jumbotron text-center animated fadeIn">
        <div class="container">
          <br>
          <h1 class="jumbotron-heading"><a href="#">GitCurl</a><br><small>Thank you for downloading!</small></h1>
          <p class="lead text-muted" style="text-shadow:1px 1px 0px #fff;">Please keep in mind that GitCurl is currently in alpha state. <br>More features will come with each major and minor version update.</p>
          <p>
            <a href="docs.php" class="btn btn-secondary my-2"><i class="fa fa-book"></i> &nbsp;Documentation</a>
            <a href="https://github.com/YaWK/gitcurl" class="btn btn-secondary my-2"><i class="fa fa-github"></i> &nbsp;Help developing</a>
          </p>
          <br>
        </div>
</section>

	<!-- main -->
	<main class="animated slideInUp">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8 text-center">
				<h3><i class="fa fa-code text-muted"></i> Full-featured code example<br>
				<small>take a look at this basic code example and see how it works </small></h3>
				<div class="row">
					<div class="col-md-4">
						<br><br><br><br><br><br>
						<img src="screenshot-03.png" class="img-thumbnail img-responsive"><br>
						Embed Commits

						<br><br><br><br><br>
						<img src="screenshot-01.png" class="img-thumbnail img-responsive"><br>
						Issues and Milestones
				
					</div>
					<div class="col-md-8">				
						<br><br>
						<div class="jumbotron text-left">
							<code><b>
								&lt;?PHP<br>
								<span class="text-muted">// include class</span><br>
								require_once ('gitCurl.class.php');<br><br>
								<span class="text-muted">// create new gitCurl object</span><br>
								$gitCurl = new gitCurl();<br><br>
								<span class="text-muted">// grab data from GitHub with any API URL</span><br>
								$commits = $gitCurl->getData('https://api.github.com/repos/USER/REPO/commits');<br>
								$issues = $gitCurl->getData('https://api.github.com/repos/USER/REPO/issues?state=closed');<br>
								$milestones = $gitCurl->getData('https://api.github.com/repos/USER/REPO/milestones?state=open');<br><br>
								<span class="text-muted">// finished for now - data array is filled.<br>
								// now it's time to take care about the layout.<br>
								</span>
								?&gt;<br>
								<span class="text-muted"><br>
								&lt;html&gt;<br>
								&lt;head&gt;<br>
								&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"&gt;&lt;/script&gt;<br>
								&lt;script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"&gt;&lt;/script&gt;<br>
								&lt;link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet"&gt;<br>
								&lt;link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"&gt;<br>
								&lt;link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet"&gt;<br>
								&lt;/head&gt;<br>
								&nbsp;&lt;body&gt;<br>
								&nbsp;&nbsp;&lt;div class="container-fluid"&gt;<br>
								&nbsp;&nbsp;&nbsp;&lt;div class="row"&gt;<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="col-md-2"&gt;<br>
								</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?PHP $gitCurl->drawCommits($commits); ?&gt;<br>
								<span class="text-muted">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="col-md-4"&gt;<br>
								</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?PHP $gitCurl->drawIssues($issues); ?&gt;<br>
								<span class="text-muted">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="col-md-4"&gt;<br>
								</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?PHP $gitCurl->drawMilestones($milestones); ?&gt;<br>
								<span class="text-muted">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div><br>
								&nbsp;&nbsp;&nbsp;&lt;/div><br>
								&nbsp;&nbsp;&lt;/div><br>
								&nbsp;&lt;/body><br>
								&lt;/html><br>
								</span><br>
								
							</b></code>
						</div>
					</div>
				</div>
				<br><br><br>

				<h3><i class="fa fa-lightbulb-o"></i> Usage
				<br><small>Initialize gitCurl</small></h3>
				Simply require and init the class like:<br>
				<code><b>
				<i>require_once ( 'curl-git.class.php' ); <span class="text-muted">// include class</span></i><br>
				<i>$gitCurl = new gitCurl(); <span class="text-muted">// create new gitCurl object</span></i></b>
				</code>
				<br><br><br><br>
				<hr>
				<br>
				<h3><i class="fa fa-exchange"></i> Request</h3>
				<h3><small>Make a simple request</small></h3>
				To get commits, use this method: $gitCurl->getData('your api url')<br>
				<code><b><i>$data = $gitCurl->getData('https://api.github.com/repos/USERNAME/REPOSITORY/commits'); 
				<span class="text-muted">// your GitHub API URL</span></i></b></code>
				<br><br><br>
				<hr>
				<br>
				<h3><i class="fa fa-magic"></i> Draw Data <br><small>(Examples)</small></h3><br>
				<h3><small>Basic Data Output</small></h3>
				<code><b><i>$gitCurl->printData($data);
				<span class="text-muted">// print Issues (data only)</span></i></b></code>
				<br><br>
				<h3><small>Draw Issues with Bootstrap 4 Cards</small></h3>
				<code><b><i>$gitCurl->drawIssues($data); <span class="text-muted">// draw Issues (card view)</span></i></b></code>
				<br><br><br>
				<hr>
				<br><br><br>
				<h3><i class="fa fa-book"></i> GitCurl Help<br><small>Class Documentation</small></h3>
				If you want to modify or extend the class, you should start with the GitCurl Docs:
				<br><a href="docs.php" title="gitCurl API Docs">GitCurl Class Documentation</a><br><br> 
				<br><br><br>
				<hr>
				<br><br><br>
				<h3><i class="fa fa-github"></i> GitHub API Help<br><small>get more information</small></h3>
				You can learn everything about the <b>GitHub API</b> here:
				<br><a href="https://developer.github.com/v3/" target="_blank" title="GitHub API [new tab]">https://developer.github.com/v3/</a><br><br> 
				For more information on <b>cURL</b> &amp; <b>PHP</b> visit:
				<br><a href="http://php.net/manual/book.curl.php" target="_blank" title="PHP Manual about cURL">http://php.net/manual/book.curl.php</a><br> 
				<br><br><br>
				<hr>
				<br><br><br>
				<h3><i class="fa fa-money text-success"></i> Donate to this project<br><small>Send $10 with PayPal</small></h3>
				This project is free, licensed under the MIT license.<br>
				If you like it, support it! Download it, use it, spread the word!<br>
				You help me developing more tools if you spend a few bucks.<br><br>

				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				    <!-- Identify your business so that you can collect the payments. -->
				    <input type="hidden" name="business"
				        value="danielretzl@gmail.com">

				    <!-- Specify a Donate button. -->
				    <input type="hidden" name="cmd" value="_donations">

				    <!-- Specify details about the contribution -->
				    <input type="hidden" name="item_name" value="GitCurl">
				    <input type="hidden" name="item_number" value="Friendly Donation">
				    <input type="hidden" name="amount" value="10.00">
				    <input type="hidden" name="currency_code" value="EUR">

				    <!-- Display the payment button. -->
				    <input type="image" name="submit"
				    src="btn_donate_LG.gif"
				    alt="Donate" style="cursor:pointer;">
				</form>
				<h5><i class="fa fa-handshake-o"></i> If you can - thank you!</h5>
				<br><br><br><br>
				<hr>
				<br><br><br>
				<h3><i class="fa fa-envelope-o"></i> Get in contact<br><small>with the developer</small></h3>
				<h5>Daniel Retzl</h5>
				<a href="https://github.com/YaWK" target="_self" title="Daniel Retzl on GitHub">on GitHub</a><br>
				<a href="https://twitter.com/danielretzl" target="_self" title="Daniel Retzl on Twitter">on Twitter</a><br>
				<a href="https://facebook.com/dretzl" target="_self" title="Daniel Retzl on Facebook">on Facebook</a><br><br>
				other projects:<br>
				<a href="http://yawk.io/" target="_self" title="Visit Yet another WebKit">Yet another WebKit</a><br>
				<br><br><br><br>
				<br><br><br><br>
				<h2><span class="text-muted" id="goUp" style="cursor:pointer;"><i class="fa fa-chevron-up"></i></span></h2>
			</div>
			<div class="col-md-2">
			
			</div>
		</div>
	</div>
	<br><br><br>
	<br><br><br>
	<br><br><br>
	</main>
	<hr>
	<!-- footer -->
	<footer>
		<div class="pull-left"> 
			<?php (date("Y") == 2018) ? ($date = 2018) : ($date = "2018 - ".date("Y")); ?>
			<small class="pull-left">&nbsp;&nbsp;<i class="fa fa-code"></i> <b>GitCurl</b> by Daniel Retzl &copy; <?php echo $date; ?>
			released under the <a href="https://opensource.org/licenses/MIT" target="_blank" title="open MIT license [in new tab]">MIT License</a>
			<br><br>
			</small>
		</div>
		<div class="pull-right">
			<small class="pull-right"><i class="fa fa-code"></i> <b>GitCurl</b> is included in <b><a href="http://yawk.io/" target="_blank">Yet another Web Kit</a></b>&nbsp;&nbsp;</small>
			<br><br>
		</div>
	</footer>
</body>
</html>