<?php
namespace Edu\Cnm\DdcAaaa;

	class Bridge {

		/**
		 * class Bridge for Ddcaaaa
		 *
		 * @version 1.0.0
		 **/

		/**
		 * @var int $bridgeStaffId
		 **/

		private $bridgeStaffId;
		/**
		 * @var int $bridgeName
		 **/
		private $bridgeName;
		/**
		 * @var int $bridgeUserName
		 **/
		private $bridgeUserName;

		/**
		 * Bridge constructor.
		 * @param int|null $newBridgeStaffId
		 * @param int $newBridgeName
		 * @param int $newBridgeUserName
		 * @throws \InvalidArgumentException
		 * @throws \RangeException
		 * @throws \TypeError
		 * @throws \Exception
		 */

		public function __construct(int $newBridgeStaffId = null, int $newBridgeName, int $newBridgeUserName) {
			try {
				$this->setBridgeStaffId($newBridgeStaffId);
				$this->setBridgeName($newBridgeName);
				$this->setBridgeUserName($newBridgeUserName);

			} catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
			} catch(\RangeException $range) {
				throw(new  \RangeException($range->getMessage(), 0, $range));
			} catch(\TypeError $typeError) {
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
			} catch(\Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
		/**
		 * accessor method for bridge staff id
		 *
		 *@return string value for bridge staff id
		 **/
		public function getBridgeStaffId() {
				return $this->bridgeStaffId;
		}

		/**
		 * mutator method for bridge staff id
		 * @param string $newBridgeStaffId
		 * @throws \InvalidArgumentException if $newBridgeStaffId is not a valid string
		 * @throws \RangeException if $newBridgeStaffId is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeStaffId(string $newBridgeStaffId) {
			// TODO should not assign to $this->bridgeStaffId before input validation is done
			$this->bridgeStaffId = $newBridgeStaffId;
			$this->bridgeStaffId = trim ($newBridgeStaffId);
			// TODO missing filter_var sanatize string function
			// TODO this will set $bridgeName to null - look at = vs ==
			if($newBridgeStaffId = null) {
				$this ->bridgeStaffId = null;
				return;
			}
			//verify the bridge staff id !== 9
			if(strlen($newBridgeStaffId)!== 9){
					throw(new\RangeException("bridge staff id has to be 9"));
			}
			$this ->bridgeStaffId = $newBridgeStaffId;
		}
		/**
		 * accessor method for bridge name
		 * @return string value of bridge name
		 **/
		public function getBridgeName() {
				return ($this->bridgeName);
		}
		/**
		 * mutator method for bridgeName
		 * @param string $newBridgeName
		 * @throws \InvalidArgumentException if $newBridgeName is not a valid string
		 * @throws \RangeException if $newBridgeName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeName(string $newBridgeName) {
			// TODO should not assign to $this->bridgeName before input validation is done
			$this->bridgeName = $newBridgeName;
			$this->bridgeName = trim ($newBridgeName);
			// TODO missing filter_var sanatize string function
			// TODO this will set $bridgeName to null - look at = vs ==
			if($newBridgeName = null) {
				$this ->bridgeName = null;
				return;
			}
			$this ->bridgeName = $newBridgeName;
		}
		/**
		 * accessor method for bridge user name
		@return string value of bridge user name
		 **/
		public function getBridgeUserName() {
			return ($this->bridgeUserName);
		}
		/**
		 * mutator method for bridgeUserName
		 * @param string $newBridgeUserName
		 * @throws \InvalidArgumentException if $newBridgeUserName is not a valid string
		 * @throws \RangeException if $newBridgeUserName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeUserName(string $newBridgeUserName) {
			// TODO should not assign to $this->bridgeName before input validation is done
			$this->bridgeUserName = $newBridgeUserName;
			$this->bridgeUserName = trim ($newBridgeUserName);
			// TODO missing filter_var sanatize string function
			// TODO this will set $bridgeName to null - look at = vs ==
			if($newBridgeUserName = null) {
				$this ->bridgeName = null;
				return;
			}
			$this ->bridgeUserName = $newBridgeUserName;
		}
		/**
		 * @param \PDO $pdo
		 * @throws \PDOException
		 */
		public function insert(\PDO $pdo) {
			// enforce the bridgeStaffId is null (i.e., don't insert a bridge that already exists)
			// TODO does this if statement match your comment above? !== vs ===
			if($this->bridgeStaffId !== null) {
				throw(new \PDOException("not a new bridge"));
			}
			// create query template
			$query = "INSERT INTO bridge(bridgeStaffId, bridgeName, bridgeUserName) VALUES(:bridgeStaffId, :bridgeName, :bridgeUserName)";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holders in the template
			$parameters = ["bridgeStaffId" => $this->bridgeStaffId, "bridgeName" => $this->bridgeName, "bridgeUserName" => $this->bridgeUserName];
			$statement->execute($parameters);
			// update the null bridgeStaffId with what mySQL just gave us
			$this->bridgeStaffId = intval($pdo->lastInsertId());
		}
		/**
		 * @param \PDO $pdo
		 * @throws \PDOException
		 */
		public function delete(\PDO $pdo) {
			// enforce the bridgeStaffId is not null (i.e., don't delete a bridgeStaffId that hasn't been inserted)
			// TODO does this if statement match your comment above? !== vs ===
			if($this->bridgeStaffId === null) {
				throw(new \PDOException("unable to delete a bridgeStaffId that does not exist"));
			}
			// create query template
			$query = "DELETE FROM bridge WHERE bridgeStaffId = :bridgeStaffId";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holder in the template
			$parameters = ["bridgeStaffId" => $this->bridgeStaffId];
			$statement->execute($parameters);
		}
		/**
		 * @param \PDO $pdo
		 * @throws \PDOException
		 */
		public function update(\PDO $pdo) {
			// enforce the bridgeStaffId is not null (i.e., don't update a bridgeStaff that hasn't been inserted)
			// TODO does this if statement match your comment above? !== vs ===
			if($this->bridgeStaffId === null) {
				throw(new \PDOException("unable to update a bridge that does not exist"));
			}
			// create query template
			$query = "UPDATE bridge SET bridgeStaffId = :bridgeStaffId, bridgeName = :bridgeName, bridgeUserName = 
			 :brigeUserNAme WHERE Id = :bridgeStaffId";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holders in the template
			$parameters = ["bridgeStaffId" => $this->bridgeStaffId, "bridgeName" => $this->bridgeName, "bridgeUserName" =>
				$this->bridgeUserName];
			$statement->execute($parameters);
		}
	}


