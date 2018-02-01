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

// include class
require_once('gitCurl.class.php');

// create new gitCurl object
$gitCurl = new gitCurl();
if (isset($_GET['state']) && (!empty($_GET['state'])))
{
	$gitCurl->state = $_GET['state'];
	if ($gitCurl->state === "open")
	{
		$menuOpenState = " active";
		$menuClosedState = "";
		$issuesHeading = "currently ".$gitCurl->state."";
	}
	else 
	{
		$menuOpenState = "";
		$menuClosedState = " active";
		$issuesHeading = "latest ".$gitCurl->state."";
	}
}
else 
{
		$menuOpenState = "";
		$menuClosedState = " active";
		$issuesHeading = "latest ".$gitCurl->state."";
}

// custom repository is set
if (isset($_POST['projectUrl']) && (!empty($_POST['projectUrl'])) && (is_string($_POST['projectUrl'])))
{	// no authentication (because its just for public repos)
	$gitCurl->authentication = false;
	// set repo (project url)
	$gitCurl->projectUrl = $_POST['projectUrl'];
	// explode string - requires correct url eg. https://github.com/user/repo
	$urlParts = explode("/", $gitCurl->projectUrl);
	$gitCurl->username = $urlParts[3];
	$gitCurl->projectName = $urlParts[4];
	// get Data
	$latestCommits = $gitCurl->getData("https://api.github.com/repos/".$gitCurl->username."/".$gitCurl->projectName."/commits?per_page=10");
	$issues = $gitCurl->getData("https://api.github.com/repos/".$gitCurl->username."/".$gitCurl->projectName."/issues?state=".$gitCurl->state."");
}
else 
{	// load default repository
	$latestCommits = $gitCurl->getData("https://api.github.com/repos/".$gitCurl->username."/".$gitCurl->projectName."/commits?per_page=10");
	$issues = $gitCurl->getData("https://api.github.com/repos/".$gitCurl->username."/".$gitCurl->projectName."/issues?state=".$gitCurl->state."");
}

// get data from GitHub
// get latest commits, limited to 10 per page
// get Milestones
// $milestones = $gitCurl->getData("https://api.github.com/repos/YaWK/yawk.io/milestones?state=".$gitCurl->state."&per_page=10");
// get Issues

// fill $this->data array with the following line; (or give it direct to printData())
// $gitCurl->getData('https://api.github.com/repos/YaWK/yawk.io/milestones?state=closed');

// print data function (called with getData to fill $this->data array) 
// $gitCurl->printData($gitCurl->getData('https://api.github.com/repos/YaWK/yawk.io/milestones?state=closed'));
?>

<html>
<head>
<!-- jquery JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<!-- bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
<!-- font awesome icons CSS -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- animate CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand" href="http://github.com/YaWK/gitCurl" target="_blank" title="visit gitCurl on GitHub"><i class="fa fa-github"></i> GitCurl Project</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item<?php echo $menuOpenState; ?>">
        <a class="nav-link" href="gitCurl.php?state=open">Open</a>
      </li>
      <li class="nav-item<?php echo $menuClosedState; ?>">
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
<div class="container-fluid">
	<!-- header w link to github project -->
	<header>
		<div class="row">
			<div class="col-md-6">
				<hr>
				<h2>GitHub Project <a href="<?php echo $gitCurl->projectUrl; ?>" target="_blank" title="visit this project on GitHub [open in new tab]"><i><?php echo $gitCurl->projectName; ?></i></a>
				<br><small>Development Status Overview</small>
				</h2>
			</div>
			<div class="col-md-6">
				<hr>
				<form method="post" action="gitCurl.php">
					<label for="projectUrl">Or any other public repository</label>
					<input type="text" name="projectUrl" id="projectUrl" class="form-control" placeholder="<?php echo $gitCurl->projectUrl; ?>">
					<button type="submit" id="submitButton" style="margin-top:2px;" class="btn btn-success pull-right">Update Data<i class="fa fa-reverse"></i></button>
				</form>
			</div>
		</div>
	</header>
	<hr>

	<!-- main section -->
	<main>
		<div class="row">
			<!-- first col -->
			<div class="col-md-2">
				<!-- add content here -->
				<h3><small><i class="fa fa-tags"></i></small> Commits <small>newest</small></h3>
				<?php
					// print data
					$gitCurl->drawCommits($latestCommits);
				?>
			</div>

			<!-- second col -->
			<div class="col-md-5">
				<h3><small><i class="fa fa-trophy"></i></small> Issues <small><?php echo $issuesHeading; ?> issues</small></h3>
				<?php
					$gitCurl->drawIssues($issues);
					// $gitCurl->drawCommits($latestCommits);
				?>
			</div>
			
			<!-- third col -->
			<div class="col-md-5">
				<h3><small><i class="fa fa-tags"></i></small> Issues <small>latest 5 closed problems</small></h3>
				<?php
					// print data
					// $gitCurl->printData($issues);
					// $gitCurl->printData($gitCurl->getData('https://api.github.com/repos/YaWK/yawk.io/issues?state=closed&per_page=3'));
				?>
			</div>
		</div>
	</main>
	<!-- footer -->
	<footer class="footer">
		<div class="row">
			<div class="col-md-6">
				<?php (date("Y") == 2018) ? ($date = 2018) : ($date = "2018 - ".date("Y")); ?>
				<small class="pull-left"><i class="fa fa-code"></i> <b>GitCurl</b> by Daniel Retzl &copy; <?php echo $date; ?>
				released under the <a href="https://opensource.org/licenses/MIT" target="_blank" title="open MIT license [in new tab]">MIT License</a>
				<br>
				</small>
			</div>
			<div class="col-md-6">
				<small class="pull-right"><i class="fa fa-code"></i> <b>GitCurl</b> is included in <b><a href="http://yawk.io/" target="_blank">Yet another Web Kit</a></b></small>
				<br>
			</div>
		</div>
	</footer>
</div>
</body>
</html>