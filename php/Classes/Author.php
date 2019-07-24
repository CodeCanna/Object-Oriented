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
		 * Author ID variable.
		 * @var Uuid $authorId
		 */
		private $authorId;

		/*
		 * Author Avatar URL variable.
		 * @var URL $authorAvatarUrl
		 */
		private $authorAvatarUrl;

		/*
		 * Author Activation Token variable
		 * @var Token $authorActivationToken
		 */
		private $authorActivationToken;

		/*
		 * Holds E-Mail of user/author
		 * @var string $authorEmail
		 */
		private $authorEmail;

		/*
		 * Author password hash
		 * @var hash $authorHash
		 *
		 */
		private $authorHash;

		/*
		 * Holds usernames of all users and authors
		 * @var string $authorUsername
		 */
		private $authorUsername;

		/*
		 * Constructor method.  Used to construct the Author object, and set all variables.
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
		 * @Documentation https://php.net/manual/en/language.oop5.decon.php
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
		 * @return Uuid value for Author ID
		 */
		public function getAuthorId() : Uuid {
			return ($this->authorId);
		}

		/*
		 * Setter for Author Id.
		 * @param Uuid|string $authId
		 * @throws \RangeException
		 * @throws \TypeError if $authorId isn't a Uuid or String
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

		/*
		 * Getter for Avatar URL.
		 *
		 * @return $authorAvatarUrl
		 */
		public function getAvatarUrl() {
			return ($this->authorAvatarUrl);
		}

		/*
		 * Setter for Avatar URL.
		 * @param $authorAvatarUrl
		 * @throws \InvalidArgumentException \RangeException \TypeError
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

		/*
		 * Get Activation Token.
		 * @return string
		 */
		public function getActToken() : string {
			return ($this->authorActivationToken);
		}

		/*
		 * Setter for Activation Token.
		 * @param $setActivationToken
		 * @throws \RangeException \Exception \TypeError
		 * @return void
		 */
		public function setActToken($authToken) : void {
			try {
				$this->authorActivationToken = $authToken;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw (new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

		/*
		 * Getter for Author Email.
		 * @return string
		 */
		public function getAuthorEmail() : string {
			return ($this->authorEmail);
		}

		/*
		 * Setter for Author Email.
		 */
		public function setAuthorEmail($authEmail) : void {
			try {
				$this->authorEmail = $authEmail;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}

		}

		/*
		 * Getter for Author Hash.
		 * @return string
		 */
		public function getAuthorHash() : string {
			return ($this->authorHash);
		}

		/*
		 * Setter for Author Hash.
		 * 
		 */
		public function setAuthorHash($authHash) : void {
			try {
				$this->authorHash = $authHash;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

		/*
		 * Getter for Username.
		 * @return string
		 */
		public function getAuthorUsername() : string {
			return ($this->authorUsername);
		}

		/*
		 * Setter for Author Username.
		 * @param $authorUname
		 */
		public function setAuthorUsername($authUname) : void {
			try {
				$this->authorUsername = $authUname;
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}
	}
?>