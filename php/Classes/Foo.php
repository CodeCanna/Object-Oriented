<?php
	namespace mwaid1\ObjectOriented;

	require_once("autoload.php");
	require_once(dirname(__DIR__) . "/Classes/autoload.php");
	/*
	* Defines an author
	*/
	class Author {
		public $authorId;
		public $authorAvatarUrl;
		public $authorActivationToken;
		public $authorEmail;
		public $authorHash;
		public $authorUsername;
	}
?>