#!/usr/bin/php
<?php
if ($argc == 2)
{
	if (file_exists($argv[1]))
	{
		// Get the content of the file
		$file = file_get_contents($argv[1]);
		// Modifies title=""
		// First find all title="...."
		// Then replace what's inside the ""
		$new = preg_replace_callback(
			'/title="(.*)"/',
			function ($matches) {
				foreach ($matches as $elem)
				{
					$elem = preg_replace_callback(
						'/"(.*)"/',
						function ($matches)
						{
							foreach ($matches as $elem)
								return strtoupper($elem);
						},
						$elem);
					return $elem;
				}
			},
			$file);
		// Modifies <a>...</a>
		// same way as title
		$new = preg_replace_callback(
			'/<a.*>(.*)<\/a>/',
			function ($matches) {
				foreach ($matches as $elem)
				{
					$elem = preg_replace_callback(
						'/>(.*?)</',
						function ($matches)
						{
							foreach ($matches as $elem)
								return strtoupper($elem);
						},
						$elem);
					return $elem;
				}
			},
			$new);
		echo $new;
	}
	else
		echo "File doesn't exists !\n";
}
return 0;
?>
