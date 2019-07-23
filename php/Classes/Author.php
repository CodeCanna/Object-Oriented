<?php
	namespace mwaid1\ObjectOriented;

	require_once("autoload.php");
	require_once(dirname(__DIR__) . "/vendor/autoload.php");

	use mysql_xdevapi\Exception;
	use function PHPSTORM_META\type;

	use Ramsey\Uuid\Uuid;
	/*
	* Defines an author
	*/
	class Author {
		use ValidateDate;
		use ValidateUuid;

		/*
		 *Author ID variable.
		 */
		private $authorId;

		/*
		 *
		 */
		private $authorAvatarUrl;

		/*
		 *
		 */
		private $authorActivationToken;

		/*
		 *
		 */
		private $authorEmail;

		/*
		 *
		 */
		private $authorHash;

		/*
		 *
		 */
		private $authorUsername;

		/*
		 * Constructor method.
		 */
		/**
		 * Author constructor.
		 * @param $authId
		 * @param $authAvUrl
		 * @param $authActToken
		 * @param $authEmail
		 * @param $authHash
		 * @param $authUname
		 * @throws \Exception
		 */
		public function __construct($authId, $authAvUrl, $authActToken, $authEmail, $authHash, $authUname) {
			$this->setAuthorId($authId);
			$this->setAvatarUrl($authAvUrl);
			$this->setActToken($authActToken);
			$this->setAuthorEmail($authEmail);
			$this->setAuthorHash($authHash);
			$this->setAuthorUsername($authUname);
		}

		/*
		 * Getter for Author ID.
		 */
		public function getAuthorId() : Uuid {
			return ($this->authorId);
		}

		/*
		 * Setter for Author Id.
		 */
		public function setAuthorId($authId): void {
			try {
				$this->authorId = self::validateUuid($authId);
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			//$this->authorId = $authId;
		}

		/*
		 * Getter for Avatar URL.
		 */
		public function getAvatarUrl() {
			return ($this->authorAvatarUrl);
		}

		/*
		 * Setter for Avatar URL.
		 */
		public function setAvatarUrl($authUrl) {
			$authUrl = trim($authUrl);
			$authUrl = filter_var($authUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);		//Check for valid URL.
			if(strlen($authUrl) > 255) {
				throw(new \Exception("ERROR: Input too large!"));
			}
			$this->authorAvatarUrl = $authUrl;
		}

		/*
		 * Get Activation Token.
		 */
		public function getActToken() {
			return ($this->authorActivationToken);
		}

		/*
		 * Setter for Activation Token.
		 */
		public function setActToken($authToken) : void {
			$this->authorActivationToken = $authToken;
		}

		/*
		 * Getter for Author Email.
		 */
		public function getAuthorEmail() {
			return ($this->authorEmail);
		}

		/*
		 * Setter for Author Email.
		 */
		public function setAuthorEmail($authEmail) : void {
			if (!filter_var($authEmail, FILTER_VALIDATE_EMAIL)) {
				throw(new Exception("Invalid Email"));
			}
			$this->authorEmail = $authEmail;
		}

		/*
		 * Getter for Author Hash.
		 */
		public function getAuthorHash() {
			return ($this->authorHash);
		}

		/*
		 * Setter for Author Hash.
		 */
		public function setAuthorHash($authHash) : void {
			if (is_null($authHash)) {
				throw(new Exception("Password Invalid!"));
			}
			$this->authorHash = $authHash;
		}

		/*
		 * Getter for Username.
		 */
		public function getAuthorUsername() {
			return ($this->authorUsername);
		}

		/*
		 * Setter for Author Username.
		 */
		public function setAuthorUsername($authUname) : void {
			if (!is_string($authUname)) {
				throw(new Exception("Error: Invalid Username!"));
			}
			$this->authorUsername = $authUname;
		}
	}
?>