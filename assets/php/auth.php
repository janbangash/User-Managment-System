<?php  

require_once 'config.php';

/**
 * 
 */
class Auth extends Database
{
	// Register New User
	public function register($name, $email, $password)
	{
		$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
		return true;
	}

	// Check if User already registered

	public function user_exist($email)
	{
		$sql = "SELECT email FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	// Login Existing User

	public function login($email)
	{
		$sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	// Current user In Session

	public function currentUser($email){
		$sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	// Forgot Password
	public function forgot_password($token,$email)
	{
		$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 20 MINUTE) WHERE email = :email";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['token'=>$token,'email'=>$email]);

		return true;
	}

	//Reset Password User Auth
	public function reset_pass_auth($email, $token)
	{
		$sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email, 'token'=>$token]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;	
	}

	//Update New Password
	public function update_new_pass($pass, $email)
	{
		$sql = "UPDATE users SET token = '', password= :pass WHERE email=:email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass'=>$pass, 'email'=>$email]);

		return true;
	}

	// Add New Note
	public function add_new_note($uid, $title, $note)
	{
		$sql = "INSERT INTO notes (uid, title, note) VALUES(:uid, :title, :note)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'title'=>$title, 'note'=>$note]);
		return true;
	}

	// Fetch all notes of user 
	public function get_notes($uid)
	{
		$sql = "SELECT * FROM notes WHERE uid = :uid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid]);

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Edit Note of an User
	public function edit_note($id)
	{
		$sql = "SELECT * FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	// Update Note of User 
	public function update_note($id, $title, $note)
	{
		$sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title'=>$title, 'note'=>$note, 'id'=>$id]);

		return true;
	}

	// Delete Note of User 
	public function delete_note($id)
	{
		$sql = "DELETE FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		return true;
	}

	// Update Profile Of User
	public function update_profile($name, $gender, $dob, $phone, $photo, $id)
	{
		$sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name'=>$name, 'gender'=>$gender, 'dob'=>$dob, 'phone'=>$phone, 'photo'=>$photo, 'id'=>$id]);

		return true;
	}

	// Change Password of User
	public function change_password($pass,$id)
	{
		$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 0 ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass'=>$pass, 'id'=>$id]);
		return true;
	}

	// Verify E-Mail of User
	public function verify_email($email)
	{
		$sql = "UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		return true;
	}

	// Send Feedback to Admin
	public function send_feedback($sub,$feed,$uid)
	{
		$sql = "INSERT INTO feedback  (uid, subject, feedback) VALUES (:uid,:sub,:feed)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'sub'=>$sub, 'feed'=>$feed]);
		return true;
	}

	// Insert Notification
	public function notification($uid, $type, $message)
	{
		$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'type'=>$type, 'message'=>$message]);
		return true;
	}

	// Fetch Notification
	public function fetchNotification($uid)
	{
		$sql = "SELECT * FROM notification WHERE uid = :uid AND type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid]);

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Remove Notification 
	public function removeNotification($id)
	{
		$sql = "DELETE FROM notification WHERE id = :id And type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		return true;
	}
}



?>