<?php 
	
	require_once 'config.php';

	/**
	 * 
	 */
	class Admin extends Database
	{
		// Admin Login
		public function admin_login($username, $password)
		{
			$sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['username'=>$username, 'password'=>$password]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		// Count Total No: of User Rows
		public function totalCount($tablename)
		{
			$sql = "SELECT * FROM $tablename";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		// Count Total Verified/Unverified Users

		public function verified_users($status)
		 {
		 	$sql = "SELECT * FROM users WHERE verified = :status";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['status'=>$status]);
		 	$count = $stmt->rowCount();

		 	return $count;
		 }

		  // Gender Percentage
		 public function genderPer()
		 {
		 	$sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	return $result;
		 }

		 // User's Verifeid/Unverified Percentage
		 public function verifiedPer()
		 {
		 	$sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	return $result;
		 }

		 // Count website hits 
		 public function site_hits()
		 {
		 	$sql = "SELECT hits FROM visitors";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$count = $stmt->fetch(PDO::FETCH_ASSOC);

		 	return $count;
		 }

		 // Fetch All Registered Users
		 public function fetchAllUsers($val)
		 {
		 	$sql = "SELECT * FROM users WHERE deleted != $val";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	return $result;
		 }

		 // Fetch Users Details by ID
		 public function fetchUserDetailsByID($id)
		 {
		 	$sql = "SELECT * FROM users WHERE id = :id AND deleted != 0";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['id'=>$id]);

		 	$result = $stmt->fetch(PDO::FETCH_ASSOC);
		 	return $result;
		 }

		 // Delete an User 
		 public function userAction($id, $val)
		 {
		 	$sql = "UPDATE users SET deleted = $val WHERE id = :id";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['id'=>$id]);

		 	return true;
		 }

		 // Fetch All Notes with User info
		 public function fetchAllNotes()
		 {
		 	$sql = "SELECT notes.id, notes.title, notes.note, notes.created_at, notes.updated_at, users.name, users.email FROM notes INNER JOIN users ON notes.uid = users.id";

			 $stmt = $this->conn->prepare($sql);
			 $stmt->execute();
			 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			 return $result; 
		 }

		 // Delete Note of an User By Admin
		 public function deleteNoteOfUser($id)
		 {
		 	$sql = "DELETE FROM notes WHERE id = :id";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['id'=>$id]);

		 	return true;
		 }

		 // Fetch All Feedback of users
		 public function fetchAllFeedback()
		 {
		 	$sql = "SELECT feedback.id, feedback.subject, feedback.feedback, feedback.created_at, feedback.uid, users.name, users.email FROM feedback INNER JOIN users ON feedback.uid = users.id WHERE replied != 1 ORDER BY feedback.id DESC";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	return $result;
		 }

		 // Reply to user feedback
		 public function replyFeedback($uid, $message)
		 {
		 	$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['uid'=>$uid, 'message'=>$message]);

		 	return true;
		 }

		 // Set Feedback Reply 
		 public function feedbackReplied($fid)
		 {
		 	$sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['fid'=>$fid]);

		 	return true;
		 }

		 // Fetch Notification 
		 public function fetchNotification()
		 {
		 	$sql = "SELECT notification.id, notification.message, notification.created_at, users.name, users.email FROM notification INNER JOIN users ON notification.uid = users.id WHERE type = 'admin' ORDER BY notification.id DESC LIMIT 5";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();
		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	return $result;
		 }

		 // Remove Notification from admin panle
		 public function deleteNotification($id)
		 {
		 	$sql = "DELETE FROM notification WHERE id = :id AND type = 'admin'";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute(['id'=>$id]);

		 	return true;
		 }

		 // Fetch All Users From Database
		 public function exportAllUsers()
		 {
		 	$sql = "SELECT * FROM users";
		 	$stmt = $this->conn->prepare($sql);
		 	$stmt->execute();

		 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		 	return $result;
		 }
		 

		
	}

 ?>