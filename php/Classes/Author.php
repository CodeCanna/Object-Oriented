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

		/**
		 * Author ID variable.
		 * @var Uuid $authorId
		 */
		private $authorId;

		/**
		 * Author Avatar URL variable.
		 * @var string $authorAvatarUrl
		 */
		private $authorAvatarUrl;

		/**
		 * Author Activation Token variable
		 * @var string $authorActivationToken
		 */
		private $authorActivationToken;

		/**
		 * Holds E-Mail of user/author
		 * @var string $authorEmail
		 */
		private $authorEmail;

		/**
		 * Author password hash
		 * @var string $authorHash
		 */
		private $authorHash;

		/**
		 * Holds usernames of all users and authors
		 * @var string $authorUsername
		 */
		private $authorUsername;

		/*
		 * Constructor method.  Used to construct the Author object, and set all variables.
		 */
		/**
		 * Author constructor.
		 * @param string | Uuid $authId this variable holds the Uuid for the Author/User's ID.
		 * @param string $authAvUrl this string contains the Author/User avatar URL.
		 * @param string $authActToken string contains an activation token for Author.
		 * @param string $authEmail string holds the Author email address.
		 * @param string $authHash string contains the hash value of the Author's password.
		 * @param string $authUname string contains Author's Username.
		 * @throws \InvalidArgumentException if wrong data type is supplied.
		 * @throws \TypeError if the data is of the wrong type.
		 * @throws \RangeException if a variable goes of specified range.
		 * @throws \Exception if any other exception takes place.
		 * @Documentation https://php.net/manual/en/language.oop5.decon.php
		 */
		public function __construct($authId, $authAvUrl, $authActToken, $authEmail, $authHash, $authUname) {
			try {
				$this->setAuthorId($authId);
				$this->setAvatarUrl($authAvUrl);
				$this->setActToken($authActToken);
				$this->setAuthorEmail($authEmail);
				$this->setAuthorHash($authHash);
				$this->setAuthorUsername($authUname);
			} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

		/**
		 * Getter for Author ID.
		 * @return Uuid value for Author ID
		 */
		public function getAuthorId() : Uuid {
			return ($this->authorId);
		}

		/**
		 * Setter for Author Id.
		 * @param Uuid|string $authorId
		 * @throws \RangeException if $authorId is out of range of specified.
		 * @throws \TypeError if $authorId isn't a Uuid or String.
		 * @throws \InvalidArgumentException if arg is invalid.
		 * @throws \Exception if any other Exception is thrown.
		 */
		public function setAuthorId($authorId): void {
			try {
				$this->authorId = self::validateUuid($authorId);
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			//$this->authorId = $authId;
		}

		/**
		 * Getter for Avatar URL.
		 *
		 * @return $authorAvatarUrl
		 */
		public function getAvatarUrl() {
			return ($this->authorAvatarUrl);
		}

		/**
		 * Setter for Avatar URL.
		 * @param $authorAvatarUrl
		 * @throws \InvalidArgumentException if arg is invalid.
		 * @throws \RangeException if arg is out of specified range.
		 * @throws \TypeError if arg is of the wrong data type.
		 * @throws \Exception if any other Exception is thrown.
		 * @returns void
		 */
		public function setAvatarUrl($authorAvatarUrl) {
			$authorAvatarUrl = trim($authorAvatarUrl);
			$authorAvatarUrl = filter_var($authorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);		//Check for valid URL.
			try {
				$this->authorAvatarUrl = $authorAvatarUrl;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}
		/**
		 * Get Activation Token.
		 * @return string
		 */
		public function getActToken() : string {
			return ($this->authorActivationToken);
		}

		/**
		 * Setter for Activation Token.
		 * @param $activationToken argument to take in the activation token for Author.
		 * @throws \RangeException if data is out of range specified.
		 * @throws \InvalidArgumentException if arguments provided are invalid.
		 * @throws \TypeError if data provided is of wrong data type.
		 * @throws \Exception if any other exception throws.
		 * @return void
		 */
		public function setActToken($activationToken) : void {
			try {
				$this->authorActivationToken = $activationToken;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw (new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

		/**
		 * Getter for Author Email.
		 * @return string
		 */
		public function getAuthorEmail() : string {
			return ($this->authorEmail);
		}

		/**
		 * Setter for Author Email.
		 * @param $authorEmail
		 * @throws \InvalidArgumentException if arg is invalid.
		 * @throws \RangeException if arg is out of specified range.
		 * @throws \TypeError if arg is of wrong data type.
		 * @throws \Exception if any other Exception is thrown.
		 * @return void
		 */
		public function setAuthorEmail($authorEmail) : void {
			try {
				$this->authorEmail = $authorEmail;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}

		}

		/**
		 * Getter for Author Hash.
		 * @return string
		 */
		public function getAuthorHash() : string {
			return ($this->authorHash);
		}

		/**
		 * Setter for Author Hash.
		 * @param $authorHash parameter gets passed holding the Author password hash.
		 * @throws \InvalidArgumentException if args are invalid.
		 * @throws \RangeException if args are our of specified range.
		 * @throws \TypeError if args if of wrong data type.
		 * @throws \Exception if any other exception is thrown.
		 */
		public function setAuthorHash($authorHash) : void {
			try {
				$this->authorHash = $authHash;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

		/**
		 * Getter for Username.
		 * @return string
		 */
		public function getAuthorUsername() : string {
			return ($this->authorUsername);
		}

		/**
		 * Setter for Author Username.
		 * @param $authorUsername
		 * @throws \InvalidArgumentException if arg is invalid.
		 * @throws \RangeException if arg is out of specified range.
		 * @throws \TypeError if arg is of wrong data type.
		 * @throws \Exception if any other Exception is thrown.
		 * @return void
		 */
		public function setAuthorUsername($authorUsername) : void {
			try {
				$this->authorUsername = $authorUsername;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}
	}
?>