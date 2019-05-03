<?php 
include('config.php');

$service_url = 'https://newsapi.org/v2/everything?domains=wcpo.com&apiKey=' . $apiKey;
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$apiNewsResults = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
} 

?>

<div class="container">
    <div class="mainContent">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Articles</h1>
				<p class="lead">We've collected the top news stories from around your area.</p>
			</div>
		</div>
        <div class="row">
	    	<?php for($index = 0; $index < 15; $index++) : ?>
	    		<div class="col-4 align-items-center">
	    			<div class="card c-card">
  	    				<div class="card-body">
  	    				  <h5 class="card-title"><?php echo $apiNewsResults->articles[$index]->title; ?></h5>
  	    				  <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
  	    				  <p class="card-text"><?php echo $apiNewsResults->articles[$index]->description; ?></p>
  	    				  <a href="article.php?articleId=<?php echo $index; ?>" class="card-link">View Entire Article</a>
  	    				</div>
	    			</div>
	    		</div>
	    	<?php endfor; ?>
	    </div>
    </div>
</div>