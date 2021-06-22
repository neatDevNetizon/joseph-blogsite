<?php
	$url = $_POST['link'];
	fetch_record($url);
	function fetch_record($path)
	{
		$html = file_get_contents_curl($path);
		$doc = new DOMDocument();
		@$doc->loadHTML($html);
		$metas = $doc->getElementsByTagName('meta');
		$favicon = "none";
		for ($i = 0; $i < $metas->length; $i++)
		{
		    $meta = $metas->item($i);
		    // if($meta->getAttribute('property') == 'og:site_name'){
		    // 	$site_name = $meta->getAttribute('content');
		    // } else {

		    // }
		    if($meta->getAttribute('property') == 'og:image')
		        $image = $meta->getAttribute('content');
		    if($meta->getAttribute('property') == 'og:title')
		        $title = $meta->getAttribute('content');
		    if($meta->getAttribute('property') == 'og:description')
		        $description = $meta->getAttribute('content');
		}
		$links = $doc->getElementsByTagName('link');
		for ($j = 0; $j < $links->length; $j++)
		{
		    $link = $links->item($j);
		    if($link->getAttribute('rel') == 'shortcut icon'){
		        $prelink = $link->getAttribute('href');
		    	if (filter_var($prelink, FILTER_VALIDATE_URL) !== false) $favicon=$prelink;
		    	else $favicon ="";
		        break;
		    }
		    elseif($link->getAttribute('rel') == 'apple-touch-icon'){
		        $prelink = $link->getAttribute('href');
		    	if (filter_var($prelink, FILTER_VALIDATE_URL) !== false) $favicon=$prelink;
		    	else $favicon ="";
		        break;
		    }

		}
		$data = array(
			// "siteName" => $site_name,
			"image" => $image,
			"title" => $title,
			"description" => $description,
			"favicon" => $favicon
		);
		print_r(json_encode($data));

	}
	function file_get_contents_curl($path)
	{
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $path);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
	}

?>