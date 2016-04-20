<?php 

return [

	"requirements" => [
		'getPhpVersion' => '5.6.1',
		'checkPdo'	  => true,
		'checkSafeMode' => true,
		'checkSessionSupport' => true,
		'checkCurl' => true,
		'checkModeRewrite' => true,
		'checkIfDirIsWritable' =>  __DIR__ ,// false if no or file path if true
		
	],

	'author_email' => 'email@email.com',
	'complete_message' => 'For More Security Plase Delete "<strong>install Folder </strong> and <strong>install.php file</strong>"',

	'config_file_path' => __DIR__ . '/config/',
	


	/** Languages Config */
	// you can re-sorte language
	'enabled_lang' => [
		'ar',
		'en'
	],
	// this config same .json name for language
	'local_lang' => [
		'ar'=> 'ar-AR',
		'en'=> 'en-US'
	],
	'language_name' => [
		'ar' => 'العربية',
		'en' => 'English'
	],
	// set full path for language folder
	'language_dir' => __DIR__ . '/local/',

	'lang_dir' => [
		'ar' => 'rtl',
		'en' => 'ltr'
	],

	'can_fix' => [
		'checkSafeMode',
		'checkModeRewrite'
	]
];