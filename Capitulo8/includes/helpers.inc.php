function markdown2html($text){
	$text = html($text);

	//strong emphasis
	$text = preg_replace('/__(.+?)__/s','<strong>$1</strong>','$text');
	$text = preg_replace('/\*\*(.+?)\*\*/s','<strong>$1</strong>','$text');

	//emphasis
	$text = preg_replace('/_([^_]+)_/s','<em>$1</em>','$text');
	$text = preg_replace('/\*([^\*]+)\*/s','<em>$1</em>','$text');

	return $text;
}	