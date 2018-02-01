<?php
/**
 * <h1>GitCurl Documentation</h1>
 * <h2>GitHub API Helper for PHP 5.3+</h2>
 * <p><b>A PHP class that makes it easy to help you 
 * embed commits, issues and milestones on your website.</b></p>
 * @author 		Daniel Retzl
 * @copyright 	2018
 * @link 		http://gitcurl.yawk.io/
 * @license 	https://opensource.org/licenses/MIT
 * 
 *
*/
class gitCurl
{
	/** CONFIGURATION */
	/** @var string GitHub username */
	public $username = '';
	/** @var string GitHub password */
	public $password = '';
	/** @var string User Agent String */
	public $userAgent = '';
	/** @var string Project name that will be displayed in heading */
	public $projectName = "gitCurl";
	/** @var string GitHub project URL */
	public $projectUrl = "https://github.com/YaWK/gitCurl/";
	/** @var string Link to the master zip file on GitHub  */
	public $masterZip = "https://github.com/YaWK/gitCurl/archive/master.zip";
	/** @var string GitHub API Link (your request) */
	public $apiURL = 'https://api.github.com/repos/YaWK/gitCurl/milestones?state=open';
	/** @var string Which state should be loaded on default  */
	public $state = 'closed';
	/** @var bool True, if repository needs authentication */
	public $authentication = true;
	/** @var bool True, if user loads a custom repository */
	public $custom = false;
	/** @var string Holds the cURL handle */
	public $curl = ''; 
	/** @var string API result as json string */
	public $result = '';
	/** @var array API result as array */
	public $data = array();
	/** @var string gitCurl version number */
	public $version = '1.0&alpha;';

/**
 * Check if cURL is installed and call init method. If cURL is not installed, abort with error message.
*/
public function isInstalled()
{
	// is cURL currently installed?
	if (!function_exists('curl_init'))
	{	// nope, exit with error msg
		die('Sorry, cURL is not installed... :-/');
	}
	else 
	{	// ok, it is installed - init cURL
		$this->initCurl($this->apiURL);
	}
}

/**
 * Set a user defined repository. Expects a correct API URL.
 * @param string $apiurl the API URL string
 * @return string
*/
public function setRepository($apiURL)
{	// check data integrity
	if (isset($apiURL) && (!empty($apiURL) && (is_string($apiURL))))
	{	// set this repository
		$this->apiURL = $apiURL;
		// ok, return this repository
		return $this->apiURL;
	}
}


/**
 * Init curl get curl handle for this repository. Expects a correct API URL.
 * @param string $apiurl the API URL string
 * @return bool return true if curl_init was successful.
*/
public function initCurl($apiURL)
{
	// set this repository (if empty, default will be used)
	$this->apiURL = $this->setRepository($apiURL);

	// get curl handle
	if ($this->curl = curl_init($this->apiURL))
	{	// ok
		return true;
	}
	else 
	{	// error: curl init failed
		die ('Error: could not get cURL handle - failed to init cURL!');
	}
}

/**
 * Set Curl Options
*/
public function setOpts()
{
	// if no custom userAgent is set
	if (isset($this->userAgent) && (empty($this->userAgent)))
	{	// set current userAgent
		$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
	}

	// check if curl handle is set and not empty
	if (!isset($this->curl) || (empty($this->curl)))
	{	// handle is empty - try to init cURL and get handle
		$this->initCurl($this->apiURL);
	}
	// verify ssl host
	curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false); 
	// verify ssl peer
	curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
	// set user agent
	curl_setopt($this->curl, CURLOPT_USERAGENT, $this->userAgent);
	// set curl url (github api url)
	curl_setopt($this->curl, CURLOPT_URL, $this->apiURL);
	// timeout after 30 sec
	curl_setopt($this->curl, CURLOPT_TIMEOUT, 30);
	// return data as string
	curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
	if (isset($this->authentication) && ($this->authentication) == true)
	{
		// set basic authentication method
		curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		// set username and password
		curl_setopt($this->curl, CURLOPT_USERPWD, "$this->username:$this->password");
	}
}


/**
 * Execute cURL handle
*/
public function exeCurl()
{	// set result after executing cURL handle
	/*
	if($this->result = curl_exec($this->curl) === false)
	{
    	die('Error: "' . curl_error($this->curl) . '" - Code: ' . curl_errno($this->curl));
	}
	else 
	{
		return $this->result;
	} 
	*/

	if (!$this->result = curl_exec($this->curl))
	{
    	die('Error: "' . curl_error($this->curl) . '" - Code: ' . curl_errno($this->curl));
	}
	else 
	{
		return $this->result;
	}
}


/**
 * Close this cURL handle
*/
public function closeCurl()
{	// close handle
	curl_close ($this->curl);
}


/**
 * Convert jSON string into multi-dimensional array
*/
public function json2Array()
{	// store data array from json string
	$this->data = json_decode($this->result, true);
}


/**
 * Basic output of data array
*/
public function output()
{
	// output data
	echo "<div class=\"container-fluid\">";
	echo "<hr>";
	echo "<h1>GitHub Project <a href=\"".$this->projectUrl."\" target=\"_blank\" title=\"visit this project on GitHub [open in new tab]\"><i>".$this->projectName."</i></a><br><small>Development Status Overview</small></h1>";
	echo "<hr>";
	echo "<pre>";
	print_r($this->data);
	echo "</pre>";
	echo "</div>";
}


/**
 * Get Data from GitHub. This method set the repository, execute curl and return data as array.  
 * @param string $apiURL the API URL string
 * @return array return data array
*/
public function getData($apiURL)
{
	// set this repository
	$this->apiURL = $this->setRepository($apiURL);
	// check if cURL is installed
	$this->isInstalled();
	// set cURL options
	$this->setOpts();
	// execute cURL command
	$this->exeCurl();
	// close cURL resource
	$this->closeCurl();
	// convert json result string to array 
	$this->json2Array();
	// check if data array is set
	if (is_array($this->data))
	{	// ok, return data
		return $this->data;
	}
}

// calculate timings (require PHP 5.3.0)
/**
 * Calculate difference between two dates. Expect itemDate as string. Return how many days ago as string.  
 * @param string $itemDate the item date as string
 * @return string return how many days have been gone.
*/
public function daysAgo($itemDate)
{
	// modify itemDate string
	// $itemDate = strstr($itemDate, 'T', true);
	$itemDate = substr($itemDate, 0,10);
	// create new dateTime object from itemDate
	$itemDate = new DateTime(date($itemDate));
	// create new dateTime object for comparison
	$today = new DateTime(date("Y-m-d"));
	// calculate how many days ago this item was posted, compared to now (today)
	$since = $today->diff($itemDate)->format("%a");
	
	// check plural
	if ($since == 1)
	{	// singular if its just one day ago
		return "".$since." day ago";
	}
	else if ($since == 0)
	{	// custom string if its today
		return "today";
	}
	else 
	{ 	// more than one day ago: use plural 
		return "".$since." Days ago";
	}
}


/**
 * If a commit contains a string like 'issue #123', the hashtag will be converted to a link which leads to this issue on GitHub.
 * @param string $commitMessage The commit message as string
 * @return mixed return false, if no commit msg was set or commit message containing link, or just the commit message if no #int was found.
*/
public function replaceIssueWithLink($commitMessage)
{	// check if commit message is set
	if (!isset($commitMessage) || (empty($commitMessage)))
	{	// if not...
		return false;
	}
	// ok, check if it is a string
	else if (is_string($commitMessage)) 
	{	
		// the string to be changed
		$string = $commitMessage;
		// regex pattern: a leading hashtag, followed by minimum 1 digit
		$pattern = '/#{1}\d{1,}/';
		// replacement string
		$replace = '<a href="https://github.com/issues/$0" target="_blank">$0</a>';

		// check, if pattern match on string and save result
		preg_match($pattern, $string, $result);
		
		// check if regex pattern match and result was set  
		if (isset($result[0]))
		{	
			// cut off hashtag from the left
			$issue = ltrim($result[0], "#");
			// replacement string (change text to link)
			$replace = "<a href=\"".$this->projectUrl."issues/".$issue."\" target=\"_blank\" title=\"open this issue on GitHub [in new tab]\">$0</a>";
			// uppercase first letter
			$string = ucfirst($string);
			// return modified string (with link)
			return preg_replace($pattern, $replace, $string);
		}
		else 
		{	
			// regex pattern does not match
			// return plain commit message string (untouched)
			return ucfirst($commitMessage);
		}
	}
}

/**
 * Draw commits with bootstrap card style  
 * @param array $data Array
 * @return array return data array
*/
public function drawCommits($data)
{	// check if data was sent
	if (isset($data) && (!empty($data) && (is_array($data))))
	{
		// draw commits
		foreach ($data as $item => $property) 
		{
			// first array [0]
			if (is_array($property))
			{
				// replace 'issue #...' with a correct link to GitHub
				$commitMessage = $this->replaceIssueWithLink($property['commit']['message']);
				// draw data: on screen
				echo "<div class=\"card animated fadeIn\">
  						<div class=\"card-block\" style=\"padding:10px;\">";
				echo "<p><small><b>".$this->daysAgo($property['commit']['author']['date'])."</b> by <b>".$property['committer']['login']."</b> (<a href=\"mailto:".$property['commit']['author']['email']."\">".$property['commit']['author']['name']."</a>)</small><hr>"
					 .$commitMessage."<br><i><small><a href=\"".$property['html_url']."\" target=\"_blank\">open commit on GitHub</a></i></small></p>";
    			echo "</div>
					</div><br>";
			}
		}
	}
	else 
	{	// maybe data was set before due a call of setData()
		if (isset($this->data) && (!empty($this->data) && (is_array($this->data))))
		{
			// data is not sent, try to load latest 10 commits
			$this->drawCommits($this->getData("https://api.github.com/repos/".$this->username."/".$this->projectName."/commits?per_page=10"));
		}
		else
		{	// no data here - exit with error
			die ("ERROR: No array sent and this->data is also empty.");
		}
	}
}

/**
 * Draw labels that are used in this element. Expects data array  
 * @param array $data Array containing the data
*/
public function getLabels($data)
{
	foreach ($data['labels'] as $label => $property) 
	{
		echo "<span class=\"badge badge-secondary\" style=\"color:#fff; background-color:#".$property['color']."\">".$property['name']."</span>&nbsp;";
	}
}

/**
 * Check open/closed state and draw appropriate icon.   
 * @param string $state Status of this element (open or closed)
 * @return string html code (icon)
*/
public function getIconFor($state)
{	// check if state is set and not empty
	if (isset($state) && (!empty($state)))
	{	// set this state
		$this->state = $state;
		// check if state is open
		if ($this->state === "open")
		{	// ok, set red icon
			return $icon = "<i class=\"fa fa-unlock text-danger\"></i>&nbsp;";
		}
		else 
		{	// state is closed - set green icon
			return $icon = "<i class=\"fa fa-lock text-success\"></i>&nbsp;";
		}
	}
	else 
	{	// no state to set
		return null;
	}
}

/**
 * Draw Issues with bootstrap card style. Expects data array  
 * @param array $data Array containing the data
*/
public function drawIssues($data)
{
	// check if data was sent
	if (isset($data) && (!empty($data) && (is_array($data))))
	{
		// draw commits
		foreach ($data as $item => $property) 
		{
			// first array [0]
			if (is_array($property))
			{	
				// check if milestone title is set and not empty to avoid php warnings if no milestone is set
				if (isset($property['milestone']['title']) && (empty($property['milestone']['title'])))
				{	// in that case: set empty milestone title
					$property['milestone']['title'] = '';
				}

				// check if milestone URL is set and is not empty
				if (isset($property['milestone']['html_url']) && (!empty($property['milestone']['html_url'])))
				{
					// set milestone weblink
					$milestoneLink = "<a href=\"".$property['milestone']['html_url']."\" target=\"_blank\" title=\"open this Milestone on GitHub [new tab]\">open Milestone on GitHub</a>";
				}
				else 
				{	// no milestone, no link
					$milestoneLink = '';
				}

				// check state to ensure proper date calculation
				if ($this->state == "open")
				{	// state is open, take creation date
					$since = $property['created_at'];
				}
				else 
				{	// state is closed, take closed date
					$since = $property['closed_at'];
				}

				// draw data: on screen
				echo "<div class=\"card animated fadeIn\">
						<div class=\"card-header\">

							".$this->getIconFor($this->state)."
							<small> <b>".$this->daysAgo($since)." 
						  	</b>|<b> <a href=\"".$property['milestone']['html_url']."?closed=1\">Issue #".$property['number']."</a> 
						  	</b>|<b> ".$property['milestone']['title']."</b></small>

						</div>
  						<div class=\"card-body\" style=\"padding:20px; margin-top: -10px;\">";
				echo "".$this->getLabels($property)."<hr>
						<h4>".$property['title']."</h4>
						".$property['body']."
						<hr>
						<i><small><a href=\"".$property['html_url']."\" target=\"_blank\">open issue on GitHub</a></i></small>
						<span class=\"pull-right\"><small><i>".$milestoneLink."</i></small></span>";
    			echo "</div>
					</div><br><br>";
			}
		}
	}
	else 
	{	// maybe data was set before due a call of setData()
		if (isset($this->data) && (!empty($this->data) && (is_array($this->data))))
		{
			// data is not sent, try to load latest 10 commits
			$this->getData("https://api.github.com/repos/".$this->username."/".$this->projectName."/issues?state=closed&per_page=10");
		}
	}
}

/**
 * Basic output of data array (for testing purpose)
 * @param array $data Array containing the data
*/
public function printData($data)
{
	if (isset($data) && (!empty($data) && (is_array($data))))
	{
		$this->data = $data;
		echo "<pre>";
		print_r($this->data);
		echo "</pre>";
	}
	else 
	{
		if (isset($this->data) && (!empty($this->data) && (is_array($this->data))))
		{
			echo "<pre>";
			print_r($this->data);
			echo "</pre>";
		}
		else 
		{
			die ('ERROR: No data was set. In order to use the class properly, please make sure to call gitCurl->getData(\'http://api.github.com.........\') before you try to print or draw any data.');
		}
	}
}
}	// end class gitCurl


/*
$milestones_i = count($data);

echo"<div class=\"row\">
<div class=\"col-md-2\">
<h3><small><i class=\"fa fa-fire\"></i></small> Latest <small>Commits</small></h3>
</div>
<div class=\"col-md-4\">
<h3><small><i class=\"fa fa-trophy\"></i></small> Milestones <small>currently achieved ".$milestones_i." goals</small></h3>";
foreach($data as $item)
{
	if ($item['state'] === "closed")
	{
		$headerState = "Closed";
		$stateClass = "text-success";
		$since = $item['closed_at'];
	}
	else 
		{
			$headerState = "Opened";
		 	$stateClass = "text-warning"; 
		 	$since = $item['created_at'];
		}

// calculate timings 
$since = strstr($since, 'T', true); // Ab PHP 5.3.0
$since = new DateTime(date($since));
$today = new DateTime(date("Y-m-d"));

	$closedSince = $today->diff($since)->format("%a");
	if ($closedSince == 1)
	{
		$days = "Day ago";
	}
	else if ($closedSince == 0)
	{
		$closedSince = "";
		$days = "today";
	}
	else 
	{ 
		$days = "Days ago"; 
	}
	
	echo "
<div class=\"card text-center\">
  <div class=\"card-header\">
  <span class=\"pull-left small\"><b>$headerState</b> $closedSince $days</span>
  <b><i class=\"fa fa-trophy\"></i> Milestone</b>
  <b class=\"pull-right ".$stateClass."\">".$item['state']."</b>
  
  </div>
  <div class=\"card-block\">
    <h4 class=\"card-title\"><br>".$item['title']."</h4>
    <p class=\"card-text\">".$item['description']."</p>
    <a href=\"".$item['html_url']."\" target=\"_blank\" class=\"btn btn-primary\">Open on GitHub</a><br><br>
  </div>
  <div class=\"card-footer text-muted\">
  <small class=\"pull-left\"><small><b>&nbsp;&nbsp;Issues</b><br>&nbsp;open: <b>".$item['open_issues']."</b><br>closed <b>".$item['closed_issues']."</b></small></small>
  <small class=\"pull-right\"><small>created: ".$item['created_at']."<br>updated: ".$item['updated_at']."</small></small>
  </div>
</div><br><br>";
/*
    foreach($item as $sub)
    {
        if (is_array($sub))
        {
            foreach($sub as $key => $option)
            {
                echo $key, ' => ', $option."<br>";
            }
        }
    }
}
/*
echo "</div>
<div class=\"col-md-4\">
<h3><small><i class=\"fa fa-line-chart\"></i></small> Statistics <small>Overview</small></h3></div>
<div class=\"col-md-2\">
<h3><small><i class=\"fa fa-lightbulb-o\"></i></small> Ideas <small>&amp; Requests</small></h3>
</div>
</div>
</div>";
/*

foreach ($data as $item) {
	# code...
	foreach ($item as $key => $value) {
		# code...
		if (is_array($key))
		{
			foreach ($key as $property => $value) {
				# code...
				echo "array: $property : $value";
			}
		}
		echo $key." : ".$value." <br>";
	}
}
*/

/*
if($result = curl_exec($curl) === false)
{
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
else 
{
	echo "erfolgreich!<br>$result";
	print_r($result);
}   
echo $status_code;
*/
// $result = curl_exec($curl);
// echo $result;

/** get any webpage with curl ext 
$curl = curl_init('http://yawk.io'); 
curl_setopt($curl, CURLOPT_FAILONERROR, true); 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   
$result = curl_exec($curl); 
echo $result; 
**/

?>