<?php
	namespace mwaid1\ObjectOriented;  // My namespace

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
		 * @param string | Uuid $authorId this variable holds the Uuid for the Author/User's ID.
		 * @param string $authorAvatarUrl this string contains the Author/User avatar URL.
		 * @param string $authorActivationToken string contains an activation token for Author.
		 * @param string $authorEmail string holds the Author email address.
		 * @param string $authorHash string contains the hash value of the Author's password.
		 * @param string $authorUsername string contains Author's Username.
		 * @throws \InvalidArgumentException if wrong data type is supplied.
		 * @throws \TypeError if the data is of the wrong type.
		 * @throws \RangeException if a variable goes of specified range.
		 * @throws \Exception if any other exception takes place.
		 * @Documentation https://php.net/manual/en/language.oop5.decon.php
		 */
		public function __construct($authorId, $authorAvatarUrl, $authorActivationToken, $authorEmail, $authorHash, $authorUsername) {
			try {
				$this->setAuthorId($authorId);
				$this->setAvatarUrl($authorAvatarUrl);
				$this->setActToken($authorActivationToken);
				$this->setAuthorEmail($authorEmail);
				$this->setAuthorHash($authorHash);
				$this->setAuthorUsername($authorUsername);
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
			$this->authororId = $authorId;
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

			if (empty($authorAvatarUrl) === true) {
				throw(new \InvalidArgumentException("Invalid URL, please enter a valid URL to continue."));
			}

			if (strlen($authorAvatarUrl) > 255 or $authorAvatarUrl < 0) {
				throw(new \RangeException("Too many or too little characters."));
			}
			$this->authorAvatarUrl = $authorAvatarUrl;
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
		 * @param $authorActivationToken argument to take in the activation token for Author.
		 * @throws \RangeException if data is out of range specified.
		 * @throws \InvalidArgumentException if arguments provided are invalid.
		 * @throws \TypeError if data provided is of wrong data type.
		 * @throws \Exception if any other exception throws.
		 * @return void
		 */
		public function setActToken($authorActivationToken) : void {
			if($authorActivationToken === null) {
				$this->authorActivationToken = null;
				return;
			}

			$authorActivationToken = strtolower(trim($authorActivationToken));
			if (ctype_xdigit($authorActivationToken) === false) {
				throw(new \RangeException("User activation not valid."));
			}

			if (strlen($authorActivationToken) !== 32) {
				throw(new \RangeException("Activation token must be 32 characters."));
			}
			$this->authorActivationToken = $authorActivationToken;
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
			$validEmail = trim($authorEmail, FILTER_VALIDATE_EMAIL);
			if($validEmail === false) {
				throw(new \InvalidArgumentException("Email address invalid, please enter a valid email to continue."));
			}

			if(strlen($authorEmail) > 255) {
				throw(new \RangeException("Email address too long."));
			}
			$this->authorEmail = $authorEmail;
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
			$authorHash = trim($authorHash);
			if(empty($authorHash)) {
				throw(new \InvalidArgumentException("Hash is empty or not secure."));
			}

			$profileHashInfo = password_get_info($authorHash);
			if($profileHashInfo["algoName"] !== "argon2i") {
				throw(new \InvalidArgumentException("Not a valid hash."));
			}

			if(strlen($authorHash) !== 97) {
				throw(new \RangeException("Hash must be 97 characters."));
			}
			$this->authorHash = $authorHash;
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
			if(empty($authorUsername)) {
				throw(new \InvalidArgumentException("Username is empty."));
			}

			if(strlen($authorUsername) >= 50 && strlen($authorUsername) <= 1) {
				throw(new \RangeException("Password not long enough must be no more than 20 and no less than eight."));
			}

			if(empty($authorUsername)) {
				throw(new \InvalidArgumentException("Username is empty please enter a username!"));
			}
			$this->authorUsername = $authorUsername;
		}

		// Insert(), Update(), and Delete()

		/**
		 * Inserts data into the table.
		 *
		 * @param \PDO $pdo holds the PDO object for accessing the database.
		 * @return void this function returns nothing.
		 */
		public function insert(\PDO $pdo): void {
			// Create mySQL query
			$query = "INSERT INTO author(authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername) VALUES(:authorId, :authorAvatarUrl, :authorActivationToken, :authorEmail, :authorHash, :authorUsername)";

			// Prepare mySQL query
			$statement = $pdo->prepare($query);

			// Set values
			$values = ["authorId" => $this->authorId, "authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken, "authorEmail" => $this->authorEmail, "authorUsername" => $this->authorUsername];

			// Execute statement
			$statement->execute($values);
		}

		/**
		 * Updates the species table.
		 *
		 * @param \PDO $pdo holds the PDO object used for accessing the database.
		 * @returns void
		 */
		public function update(\PDO $pdo): void {
			// Create mySQL query
			$query = "UPDATE author SET authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername";

			// Prepare mySQL query
			$statement = $pdo->prepare($query);

			// Set values
			$values = ["authorId" => $this->authorId, "authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken, "authorEmail" => $this->authorEmail, "authorUsername" => $this->authorUsername];

			// Excecute statement
			$statement->execute($values);
		}

		/**
		 * Deletes data from the table.
		 *
		 * @param \PDO $pdo this holds the PDO object used to accessing the database.
		 * @return void this method returns nothing.
		 */
		public function delete(\PDO $pdo) {
			// Create mySQL query
			$query = "DELETE FROM author WHERE authorId = :authorId";

			// Prepare statement
			$statement = $pdo->prepare($query);

			// Set values
			$values = ["authorId" => $this->authorId];

			// Execute statement
			$statement->execute($values);
		}

		// getFooByBar methods

		/**
		 * Gets an author by it's id.
		 *
		 * @param $authorId is the author's uniqe ID.
		 * @throws \Exception if validateUuid fails.
		 * @throws \PDOException if anything goes wrong with the PDO.
		 * @return Author this method returns an instance of $this.
		 */
		public function getAuthorById(\PDO $pdo, $authorId): ?Author {
			// Sanitize authorId
			try {
				$authorId = self::validateUuid($authorId);
			} catch(\PDOException | \Exception $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}

			// Create mySQL query
			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";

			// Prepare mySQL query
			$statement = $pdo->prepare($query);

			// Set values
			$values = ["authorId" => $this->authorId->getBytes()];

			// Execute statement
			$statement->execute($values);

			try {
				$author = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
				}
			} catch(\Exception $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			return $author;
		}

		/**
		 * Gets all authors
		 *
		 * @param \PDO $pdo this holds the PDO object used for accessing the database.
		 * @throws \PDOException if anything goes wrong with the PDO object.
		 * @throws \Exception if any other exception occurs.
		 * @return \SplFixedArray this array will hold all of the data objects grabbed by getAllAuthors()
		 */
		public function getAllAuthors(\PDO $pdo): \SplFixedArray {
			// Create mySQL query
			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author";

			// Prepare mySQL query
			$statement = $pdo->prepare($query);

			// Execute statement
			$statement->execute();

			// Create array to store authors
			$authors = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
					$authors[$authors->key()] = $author;
					$authors->next();
				} catch(\PDOException | \Exception $exception) {
					$exceptionType = get_class($exception);
					throw(new $exceptionType($exception->getMessage(), 0, $exception));
				}
			}
			return $authors;
		}
		/**
		 * Returns a JSON array of the object variables.
		 *
		 * @return array of json objects representing this classes variable set.
		 */
		public function jsonSerialize(): array {
			$fields = get_object_vars($this);
			$fields["authorId"] = $this->authorId->toString();

			return $fields;
		}
	}
?>