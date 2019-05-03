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
$articleId = get('articleId');
$article = $apiNewsResults->articles[$articleId];
?>

<div class="container">
    <div class="mainContent">
        <div class="jumbotron jumbotron-fluid">
	    	<div class="container">
	    		<h1 class="display-4"><?php echo $article->title; ?></h1>
	    		<a class="lead" target="_blank" href="<?php echo $article->url; ?>">Visit article on their site.</a>
	    	</div>
	    </div>
        <p><?php echo $article->description; ?></p>
    </div>
</div>
