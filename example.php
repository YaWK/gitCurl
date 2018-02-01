<?PHP

// include class
require_once ('gitCurl.class.php');

// create new gitCurl object
$gitCurl = new gitCurl();

// grab data from GitHub with any API URL
$commits = $gitCurl->getData('https://api.github.com/repos/USER/REPO/commits');
$issues = $gitCurl->getData('https://api.github.com/repos/USER/REPO/issues?state=closed');
$milestones = $gitCurl->getData('https://api.github.com/repos/USER/REPO/milestones?state=open');

// finished for now - data array is filled.
// now it's time to take care about the layout.
?>

<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
</head>
 <body>
  <div class="container-fluid">
   <div class="row">
     <div class="col-md-2">
       <?PHP $gitCurl->drawCommits($commits); ?>
     </div>
     <div class="col-md-4">
       <?PHP $gitCurl->drawIssues($issues); ?>
     </div>
     <div class="col-md-4">
       <?PHP $gitCurl->drawMilestones($milestones); ?>
     </div>
   </div>
  </div>
 </body>
</html>