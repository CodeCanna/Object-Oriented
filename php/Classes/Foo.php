<?php
	namespace mwaid1\ObjectOriented;

	require_once("autoload.php");
	require_once(dirname(__DIR__) . "/Classes/autoload.php");

	use function PHPSTORM_META\type;
	use Ramsey\Uuid\Uuid;
	/*
	* Defines an author
	*/
	class Author {
		private $authorId;
		private $authorAvatarUrl;
		private $authorActivationToken;
		private $authorEmail;
		private $authorHash;
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
				//Send data to SQL?
				$authUuid = self::validateUuid($authId);

			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				echo "Error: ", $exception->getMessage(), "\n";
			}

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
		public function setAvatarUrl() {

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
		public function setActToken() {

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
		public function setAuthorEmail() {

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
		public function setAuthorHash() {

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
		public function setAuthorUsername() {

		}
	}
?>