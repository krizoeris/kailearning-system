<?php 
include_once '../config/dbcon.php';

class Kailearning{
	
	private $DB;
	public $SY;
	
	function __construct(){
		$this->DB = new ConnectDB();
		$this->DB = $this->DB->connect();
	}
	
	public function getUserCredentials($userid, $password){
		try{
			if(!empty($userid) && !empty($password)){
				$stmt = $this->DB->prepare("SELECT USER_ID, `PASSWORD`, '0' AS TYPE FROM tbl_user
											WHERE USER_ID = :userid AND `PASSWORD` = :password
											UNION SELECT FACULTY_ID, `PASSWORD`, '1' AS TYPE FROM tbl_faculty
											WHERE FACULTY_ID = :userid AND `PASSWORD` = :password
											UNION SELECT STUDENT_ID, `PASSWORD`, '2' AS TYPE FROM tbl_student
											WHERE STUDENT_ID = :userid AND `PASSWORD` = :password
											ORDER BY TYPE;");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':password', $password);
				$stmt->execute();
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$type = htmlentities($row['TYPE']);
				
				if($type == '0'){
					$_SESSION['user'] = $userid;
					$_SESSION['type'] = $type;
					echo 'admin';
				}elseif($type == '1'){
					$_SESSION['user'] = $userid;
					$_SESSION['type'] = $type;
					echo 'teacher';
				}elseif($type == '2'){
					$_SESSION['user'] = $userid;
					$_SESSION['type'] = $type;
					echo 'student';
				}else{
					echo 'Invalid Username or Password!';
				}
				
			}else{
				echo 'Please Insert Username/Password!';
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function loggedIn($userid, $type){
		if(isset($userid) && isset($type)){
			if($type == '0'){
				$stmt = $this->DB->prepare("SELECT * FROM tbl_user WHERE USER_ID = :userid");
				$stmt->bindValue(':userid', $userid);
				$stmt->execute();
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$userName = htmlentities($row['FIRST_NAME'] . ' ' . $row['LAST_NAME']);
				
				return $userName;
			}elseif($type == '2'){
				$stmt = $this->DB->prepare("SELECT * FROM tbl_student WHERE STUDENT_ID = :userid");
				$stmt->bindValue(':userid', $userid);
				$stmt->execute();
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$userName = htmlentities($row['FIRST_NAME'] . ' ' . $row['LAST_NAME']);
				
				return $userName;
			}elseif($type == '1'){
				$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty WHERE FACULTY_ID = :userid");
				$stmt->bindValue(':userid', $userid);
				$stmt->execute();
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$userName = htmlentities($row['FIRST_NAME'] . ' ' . $row['LAST_NAME']);
				
				return $userName;
			}
		}else{
			header('Location: ../login/index.php');
		}
	}
	/**
	public function setStudentInfo($userid, $first_name, $last_name, $course, $password, $date){
		try{
			if(!empty($userid) && !empty($first_name) && !empty($last_name) && !empty($course) && !empty($password) && !empty($password)){
				$stmt = $this->DB->prepare("INSERT INTO tbl_student(STUDENT_ID, FIRST_NAME, LAST_NAME, COURSE, `PASSWORD`, STATUS, DATE) VALUES(:userid, :firstname, :lastname, :course, :password, 'Registered', :date)");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':firstname', $first_name);
				$stmt->bindValue(':lastname', $last_name);
				$stmt->bindValue(':course', $course);
				$stmt->bindValue(':password', $password);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
				echo 'Success';
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}**/
	
	public function setTeacherInfo($userid, $first_name, $last_name, $password, $date){
		try{
			if(!empty($userid) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($date)){
				$stmt = $this->DB->prepare("INSERT INTO tbl_faculty(FACULTY_ID, FIRST_NAME, LAST_NAME, PASSWORD, STATUS, DATE) VALUES(:userid, :firstname, :lastname, :password, 'Registered', :date)");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':firstname', $first_name);
				$stmt->bindValue(':lastname', $last_name);
				$stmt->bindValue(':password', $password);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
				echo 'Success';
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setClass($classcode, $subjectid, $facultyid, $syid, $date){
		try{
			if(!empty($classcode) && !empty($subjectid) && !empty($facultyid) && !empty($syid) && !empty($date)){
				$stmt = $this->DB->prepare("INSERT INTO tbl_class(CLASS_CODE, SUBJECT_ID, FACULTY_ID, SCHOOL_YEAR_ID, SEMESTER, DATE) VALUES(:classcode, :subjectid, :facultyid, :syid, 0, :date)");
				$stmt->bindValue(':classcode', $classcode);
				$stmt->bindValue(':subjectid', $subjectid);
				$stmt->bindValue(':facultyid', $facultyid);
				$stmt->bindValue(':syid', $syid);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
				echo 'Success';
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setUserLog($userid, $date){
		try{
			if(!empty($userid) && !empty($date)){
				$stmt = $this->DB->prepare("INSERT INTO tbl_user_log(USER_ID, DATE) VALUES(:userid, :date)");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setActivityLog($userid, $action, $date){
		try{
			if(!empty($userid) && !empty($date) && !empty($action)){
				$stmt = $this->DB->prepare("INSERT INTO tbl_activity_log(USER_ID, ACTION, `DATE`) VALUES(:userid, :action, :date)");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':action', $action);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAdminUsers(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_user");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['USER_ID']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				
				return $id;
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	
	public function getClasses(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class AS class INNER JOIN tbl_subject AS subj ON class.SUBJECT_ID = subj.SUBJECT_ID INNER JOIN tbl_faculty AS fac ON class.FACULTY_ID = fac.FACULTY_ID INNER JOIN tbl_school_yr AS sy ON class.SCHOOL_YEAR_ID = sy.ID ORDER BY CLASS_ID DESC");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['CLASS_ID']);
				$code = htmlentities($row['CLASS_CODE']);
				$subj = htmlentities($row['SUBJECT_TITLE']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				$sy = htmlentities($row['SCHOOL_YEAR']);
				
			echo "<tr><td>".$code."</td><td>".$subj."</td><td>".$first_name." ".$last_name."</td><td>".$sy."</td><td><a href='classes_students.php?id=" . $id . "'><img src='../assets/img/eye.png'> View Students</a><a href='classes.php?id=" . $id . "&action=deleteClass' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getClassesTeacher($userid){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class AS class INNER JOIN tbl_subject AS subj ON class.SUBJECT_ID = subj.SUBJECT_ID INNER JOIN tbl_faculty AS fac ON class.FACULTY_ID = fac.FACULTY_ID INNER JOIN tbl_school_yr AS sy ON class.SCHOOL_YEAR_ID = sy.ID WHERE class.FACULTY_ID = :id ORDER BY CLASS_ID DESC");
			$stmt->bindValue(':id', $userid);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['CLASS_ID']);
				$code = htmlentities($row['CLASS_CODE']);
				$subj = htmlentities($row['SUBJECT_TITLE']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				$sy = htmlentities($row['SCHOOL_YEAR']);
				
			echo "<tr><td>".$code."</td><td>".$subj."</td><td>".$first_name." ".$last_name."</td><td>".$sy."</td><td><a href='class.php?cid=" . $id . "'><img src='../assets/img/eye.png'> Open</a><a href='classes.php?id=" . $id . "&action=deleteClass' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getClassesStudent($userid){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class_student WHERE STUDENT_ID = :id");
			$stmt->bindValue(':id', $userid);
			$stmt->execute();
			while($row1 = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cid = $row1['CLASS_ID'];
				
				$stmt2 = $this->DB->prepare("SELECT * FROM tbl_class AS class INNER JOIN tbl_subject AS subj ON class.SUBJECT_ID = subj.SUBJECT_ID INNER JOIN tbl_faculty AS fac ON class.FACULTY_ID = fac.FACULTY_ID INNER JOIN tbl_school_yr AS sy ON class.SCHOOL_YEAR_ID = sy.ID WHERE class.CLASS_ID = :cid ORDER BY CLASS_ID DESC");
				$stmt2->bindValue(':cid', $cid);
				$stmt2->execute();
				
				while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					$id = htmlentities($row['CLASS_ID']);
					$code = htmlentities($row['CLASS_CODE']);
					$subj = htmlentities($row['SUBJECT_TITLE']);
					$first_name = htmlentities($row['FIRST_NAME']);
					$last_name = htmlentities($row['LAST_NAME']);
					$sy = htmlentities($row['SCHOOL_YEAR']);
				echo "<tr><td>".$code."</td><td>".$subj."</td><td>".$first_name." ".$last_name."</td><td>".$sy."</td><td><a href='class.php?cid=" . $id . "'><img src='../assets/img/eye.png'> Open</a>";
				}
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getStudentsAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_student ORDER BY `DATE` ");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$first_name."</td><td>".$last_name."</td><td>".$course."</td><td><a href='student_edit.php?id=" . $sid . "&action=select-student'><img src='../assets/img/pencil.png'> Edit</a><a href='student.php?id=" . $sid . "&action=deleteStudent' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getFacultyAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$fid = htmlentities($row['FACULTY_ID']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				
				echo "<tr><td>".$fid."</td><td>".$first_name."</td><td>".$last_name."</td><td><a href='faculty_edit.php?id=" . $fid . "&action=select-faculty'><img src='../assets/img/pencil.png'> Edit</a><a href='faculty.php?id=" . $fid . "&action=deleteFaculty' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getSubjectAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_subject");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['SUBJECT_ID']);
				$scode = htmlentities($row['SUBJECT_CODE']);
				$title = htmlentities($row['SUBJECT_TITLE']);
				
				echo "<tr><td>".$scode."</td><td>".$title."</td><td><a href='subject_edit.php?id=" . $id . "&action=select-subject'><img src='../assets/img/pencil.png'> Edit</a><a href='subject.php?id=" . $scode . "&action=deleteSubject' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getUsersAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_user");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$uid = htmlentities($row['USER_ID']);
				$first_name = htmlentities($row['FIRST_NAME']);
				$last_name = htmlentities($row['LAST_NAME']);
				
				echo "<tr><td>".$uid."</td><td>".$first_name.' '.$last_name."</td><td><a href='users_edit.php?id=" . $uid . "&action=select-user'><img src='../assets/img/pencil.png'> Edit</a><a href='users.php?id=" . $uid . "&action=deleteUser' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getSYAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_school_yr WHERE STATUS = 'INACTIVE' ORDER BY STATUS");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$sy = htmlentities($row['SCHOOL_YEAR']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$sy."</td><td>".$date."</td><td><a href='school_year.php?id=" . $id . "&action=activateSY' onclick=\"return confirm('Do you want to change the school year?');\"><img src='../assets/img/check.png'> Activate</a><a href='school_year.php?id=" . $id . "&action=deleteSY' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAnnounceAd(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_announcement ORDER BY `DATE`");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$title = htmlentities($row['TITLE']);
				$user = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$title."</td><td> by ".$user."</td><td>".$date."</td><td><a href='announcement_view.php?id=" . $id . "&action=select-announce'><img src='../assets/img/eye.png'> View</a><a href='announcement_edit.php?id=" . $id . "&action=select-announce'><img src='../assets/img/pencil.png'>Edit</a><a href='announcement.php?id=" . $id . "&action=deleteAnnounce' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAnnounceTeacherAd($id, $cid){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_announcement WHERE CLASS = :id OR CLASS = 'All' ORDER BY `DATE`");
			$stmt->bindValue(':id', $cid);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$title = htmlentities($row['TITLE']);
				$user = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$title."</td><td> by ".$user."</td><td>".$date."</td><td><a href='announcement_view.php?cid=".$cid."&id=" . $id . "&action=select-announce'><img src='../assets/img/eye.png'> View</a><a href='announcement_edit.php?id=" . $id . "&action=select-announce'><img src='../assets/img/pencil.png'>Edit</a><a href='class.php?cid=".$cid."&id=" . $id . "&action=deleteAnnounce' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAnnounceStudentAd($id, $cid){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_announcement WHERE CLASS = :id OR CLASS = 'All' ORDER BY `DATE`");
			$stmt->bindValue(':id', $cid);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$title = htmlentities($row['TITLE']);
				$user = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$title."</td><td> by ".$user."</td><td>".$date."</td><td><a href='announcement_view.php?cid=".$cid."&id=" . $id . "&action=select-announce'><img src='../assets/img/eye.png'> View</a>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAssignmentAd($cid){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_assignment WHERE CLASS_ID = :cid ORDER BY `DATE`");
			$stmt->bindValue(':cid', $cid);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$title = htmlentities($row['TITLE']);
				$desc = htmlentities($row['DESCRIPTION']);
				$file = htmlentities($row['FILE_NAME']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$title."</td><td>".$desc."</td><td>".$file."</td><td>".$date."</td><td><a href='assignments.php?id=".$id."&cid=".$cid."&action=downloadAss'><img src='../assets/img/download.png'> Download</a>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function isUserId($userid){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_user WHERE USER_ID = :userid");
		$stmt->bindValue(':userid', $userid);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['USER_ID']);
		
		if($id == $userid){
			return true;
		}
	}
	
	public function isFacultyId($facultyid){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty WHERE FACULTY_ID = :facultyid");
		$stmt->bindValue(':facultyid', $facultyid);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['FACULTY_ID']);
		
		if($id == $facultyid){
			return true;
		}
	}
	
	public function isStudentId($studentid){
		$stmt = $this->DB->prepare("SELECT STUDENT_ID FROM tbl_student WHERE STUDENT_ID = :studentid");
		$stmt->bindValue(':studentid', $studentid);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['STUDENT_ID']);
		
		if($id == $studentid){
			return true;
		}
		/*
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['STUDENT_ID']);
		RETURN true;
		*/
	}
	
	public function isClassCode($classcode){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_class WHERE CLASS_CODE = :classcode");
		$stmt->bindValue(':classcode', $classcode);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['CLASS_CODE']);
		
		if($id == $classcode){
			return true;
		}
	}
	
	public function isClassStudent($id, $sid){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_class_student WHERE CLASS_ID = :id AND STUDENT_ID = :sid");
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':sid', $sid);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$iid = htmlentities($row['CLASS_ID']);
		$ssid = htmlentities($row['STUDENT_ID']);
		
		if($id == $iid && $sid == $ssid){
			return true;
		}
	}
	
	public function isSubjectId($subjectid){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_subject WHERE SUBJECT_CODE = :subcode");
		$stmt->bindValue(':subcode', $subjectid);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['SUBJECT_CODE']);
		
		if($id == $subjectid){
			return true;
		}
	}
	
	public function isAdminId($userid){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_user WHERE USER_ID = :userid");
		$stmt->bindValue(':userid', $userid);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = htmlentities($row['USER_ID']);
		
		if($id == $userid){
			return true;
		}
	}
	
	public function isSYId($syo){
		$stmt = $this->DB->prepare("SELECT * FROM tbl_school_yr WHERE SCHOOL_YEAR = :sy");
		$stmt->bindValue(':sy', $syo);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$syn = htmlentities($row['SCHOOL_YEAR']);
		
		if($syn == $syo){
			return true;
		}
	}
	
	public function getStudentsRegistered(){
		try{
			$stmt = $this->DB->prepare("SELECT COUNT(STUDENT_ID) AS rowCount FROM tbl_student WHERE STATUS='Registered'");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['rowCount'];
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getTeachersRegistered(){
		try{
			$stmt = $this->DB->prepare("SELECT COUNT(FACULTY_ID) AS rowCount FROM tbl_faculty WHERE STATUS='Registered'");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['rowCount'];
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassNum(){
		try{
			$stmt = $this->DB->prepare("SELECT COUNT(CLASS_ID) AS rowCount FROM tbl_class");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['rowCount'];
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getSchoolYear(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_school_yr WHERE STATUS = 'ACTIVE'");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$sy = $row['SCHOOL_YEAR'];
			return $sy;
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getUserLogs(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_user_log ORDER BY `DATE` DESC");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$id."</td><td>".$date."</td>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getActivityLogs(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_activity_log ORDER BY `DATE` DESC");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['USER_ID']);
				$action = htmlentities($row['ACTION']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$id." ".$action."</td><td>".$date."</td>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getLatestUserLogs(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_user_log ORDER BY `DATE` DESC LIMIT 5");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$id."</td><td>".$date."</td>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getLatestActivityLogs(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_activity_log ORDER BY `DATE` DESC LIMIT 5");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['USER_ID']);
				$action = htmlentities($row['ACTION']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$id." ".$action."</td><td>".$date."</td>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getLatestAnnounce(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_announcement ORDER BY `DATE` LIMIT 5");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$title = htmlentities($row['TITLE']);
				$user = htmlentities($row['USER_ID']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$title."</td><td> by ".$user."</td><td>".$date."</td><td><a href='announcement_view.php?id=" . $id . "&action=select-announce'><img src='../assets/img/eye.png'> View</a>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getSubjectSelect(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_subject");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['SUBJECT_ID']);
				$subj = htmlentities($row['SUBJECT_TITLE']);
				
				echo "<option value='".$id."'>".$subj."</option>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getFacultySelect(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['FACULTY_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				
				echo "<option value='".$id."'>".$fname.' '.$lname."</option>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getFacultySelectTeacher($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty WHERE FACULTY_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['FACULTY_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				
				echo "<option value='".$id."'>".$fname.' '.$lname."</option>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getSYSelect(){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_school_yr WHERE STATUS = 'ACTIVE'");
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['ID']);
				$sy = htmlentities($row['SCHOOL_YEAR']);
				
				echo "<option value='".$id."'>".$sy."</option>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassSelect($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class WHERE FACULTY_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$id = htmlentities($row['CLASS_ID']);
				$class = htmlentities($row['CLASS_CODE']);
				
				echo "<option value='".$id."'>".$class."</option>";
			}
			
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function deleteClass($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_class WHERE CLASS_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function deleteStudent($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_student WHERE STUDENT_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	public function deleteFaculty($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_faculty WHERE FACULTY_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	public function deleteSubject($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_subject WHERE SUBJECT_CODE = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	public function deleteUser($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_user WHERE USER_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function deleteSY($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_school_yr WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function deleteAnnounce($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_announcement WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function deleteQuiz($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_quizes WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function deleteQuestion($id){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_questions WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function deleteClassStudent($id, $sid){
		try{
			$stmt = $this->DB->prepare("DELETE FROM tbl_class_student WHERE CLASS_ID = :id AND STUDENT_ID = :sid");
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':sid', $sid);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getQuizes($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quizes WHERE CLASS_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['ID']);
				$quiz = htmlentities($row['QUIZ_TITLE']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td><a href='questions.php?cid=" . $id . "&id=".$sid."'>".$quiz."</a></td><td>".$date."</td><td><a href='quiz_edit.php?id=" . $sid . "&action=select-quiz'><img src='../assets/img/pencil.png'>Edit</a><a href='quiz.php?cid=".$id."&id=" . $sid . "&action=deleteQuiz' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function getStudentQuizes($id, $user){
		try{
			
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quizes WHERE ID NOT IN (SELECT QUIZ_ID FROM tbl_quiz_status WHERE STUDENT_ID = $user) AND CLASS_ID = $id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['ID']);
				$quiz = htmlentities($row['QUIZ_TITLE']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$quiz."</td><td>".$date."</td><td><a href='quiz_answer.php?cid=" . $id . "&id=" . $sid . "&action=answer-quiz'><img src='../assets/img/pencil.png'> Take Quiz</a></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function viewQuizes($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quizes WHERE CLASS_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['ID']);
				$quiz = htmlentities($row['QUIZ_TITLE']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$quiz."</td><td>".$date."</td><td><a href='grade_students.php?id=" . $sid . "&cid=" . $id . "'><img src='../assets/img/eye.png'> View Scores</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function viewQuizesGrade($id, $user){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quiz_status AS status INNER JOIN tbl_quizes AS quiz ON quiz.ID = status.QUIZ_ID WHERE STUDENT_ID = :user AND CLASS_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':user', $user);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['ID']);
				$quiz = htmlentities($row['QUIZ_TITLE']);
				$item = htmlentities($row['ITEMS']);
				$score = htmlentities($row['SCORE']);

				echo "<tr><td>".$quiz."</td><td>".$score."/".$item."</td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function viewQuizesGradeStudents($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quiz_status AS status INNER JOIN tbl_student AS student ON student.STUDENT_ID = status.STUDENT_ID WHERE status.QUIZ_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$item = htmlentities($row['ITEMS']);
				$score = htmlentities($row['SCORE']);

				echo "<tr><td>".$fname." ".$lname."</td><td>".$score."/".$item."</td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function getQuestions($cid, $id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_questions WHERE QUIZ_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$qid = htmlentities($row['ID']);
				$question = htmlentities($row['QUESTION']);
				$ca = htmlentities($row['CHOICES_A']);
				$cb = htmlentities($row['CHOICES_B']);
				$cc = htmlentities($row['CHOICES_C']);
				$cd = htmlentities($row['CHOICES_D']);
				$answer = htmlentities($row['ANSWER']);
				$date = htmlentities($row['DATE']);
				
				echo "<tr><td>".$question."</td><td>".$ca."</td><td>".$cb."</td><td>".$cc."</td><td>".$cd."</td><td>".$answer."</td><td><a href='questions_edit.php?id=" . $qid . "&action=select-question'><img src='../assets/img/pencil.png'>Edit</a><a href='questions.php?cid=".$cid."&id=" . $id ."&qid=" . $qid . "&action=deleteQuestion' onclick=\"return confirm('Are you sure you want to delete?');\"><img src='../assets/img/trashcan.png'>Delete</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function getStudentQuestions($cid, $id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_questions WHERE QUIZ_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			$i = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$i++;
				$qid = htmlentities($row['ID']);
				$question = htmlentities($row['QUESTION']);
				$ca = htmlentities($row['CHOICES_A']);
				$cb = htmlentities($row['CHOICES_B']);
				$cc = htmlentities($row['CHOICES_C']);
				$cd = htmlentities($row['CHOICES_D']);
				$answer = htmlentities($row['ANSWER']);
				$date = htmlentities($row['DATE']);

				echo '<div>'
					.$i.'.) '. $question .'<br>
					<ol class="choices-question" type="A">
						<li><input name="a'.$i.'" id="a1" type="radio" value="A"> '. $ca .'<br></li>
						<li><input name="a'.$i.'" id="a2" type="radio" value="B"> '. $cb .'<br></li>
						<li><input name="a'.$i.'" id="a3" type="radio" value="C"> '. $cc .'<br></li>
						<li><input name="a'.$i.'" id="a4" type="radio" value="D"> '. $cd .'<br></li>
					</ol>
					<input type="hidden" value="'. $qid.'" name="qid'.$i.'" required>
					<input type="hidden" value="'. $answer.'" name="cans'.$i.'" required>
				</div>';
			}
			echo '<input type="hidden" value="'. $i.'" name="item" hidden required>';
			echo '<input type="hidden" value="'. $id.'" name="zid" hidden required>';
			echo '<input type="hidden" value="'. $cid.'" name="xid" hidden required>';
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassName($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class WHERE CLASS_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['CLASS_CODE'];
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function getQuizName($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quizes WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['QUIZ_TITLE'];
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassFaculty($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class WHERE CLASS_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$fid = $row['FACULTY_ID'];
			
			$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty WHERE FACULTY_ID = :fid");
			$stmt->bindValue(':fid', $fid);
			$stmt->execute();
			$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
			$fids = $row2['FIRST_NAME'] . ' ' . $row2['LAST_NAME'];
			echo $fids;
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassStudents($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class_student AS class_stud INNER JOIN tbl_student AS stud ON class_stud.STUDENT_ID = stud.STUDENT_ID WHERE CLASS_ID = :id ORDER BY `DATE` DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$fname." ".$lname."</td><td>".$course."</td><td><a href='students.php?id=" . $id . "&sid=".$sid."&action=deleteClassStudent'><img src='../assets/img/trashcan.png'>Remove</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassStudentsStud($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class_student AS class_stud INNER JOIN tbl_student AS stud ON class_stud.STUDENT_ID = stud.STUDENT_ID WHERE CLASS_ID = :id ORDER BY CLASS_STUDENT_ID DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$fname." ".$lname."</td><td>".$course."</td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getClassStudentsTeacher($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_class_student AS class_stud INNER JOIN tbl_student AS stud ON class_stud.STUDENT_ID = stud.STUDENT_ID WHERE CLASS_ID = :id ORDER BY CLASS_STUDENT_ID DESC");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$fname." ".$lname."</td><td>".$course."</td><td><a href='classes_students.php?id=" . $id . "&sid=".$sid."&action=deleteClassStudent'><img src='../assets/img/trashcan.png'>Remove</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getStudents($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_student
WHERE STUDENT_ID NOT IN (SELECT STUDENT_ID FROM tbl_class_student WHERE CLASS_ID = :id);");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$fname." ".$lname."</td><td>".$course."</td><td><a href='classes_students.php?id=" . $id . "&sid=".$sid."&action=addToClass'><img src='../assets/img/plus.png'>Add Student</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function getStudentsTeacher($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_student
WHERE STUDENT_ID NOT IN (SELECT STUDENT_ID FROM tbl_class_student WHERE CLASS_ID = :id);");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$sid = htmlentities($row['STUDENT_ID']);
				$fname = htmlentities($row['FIRST_NAME']);
				$lname = htmlentities($row['LAST_NAME']);
				$course = htmlentities($row['COURSE']);
				
				echo "<tr><td>".$sid."</td><td>".$fname." ".$lname."</td><td>".$course."</td><td><a href='students.php?id=" . $id . "&sid=".$sid."&action=addToClass'><img src='../assets/img/plus.png'>Add Student</a></td></tr>";
			}
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}
	
	public function setStudentClass($id, $sid){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_class_student(CLASS_ID, STUDENT_ID) VALUES(:id, :sid)");
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':sid', $sid);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong!";
		}
	}

	public function setStudent($userid, $first_name, $last_name, $course, $password, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_student(STUDENT_ID, FIRST_NAME, LAST_NAME, COURSE, `PASSWORD`, STATUS, `DATE`) VALUES(:userid, :firstname, :lastname, :course, :password, 'Registered', :date)");
			$stmt->bindValue(':userid', $userid);
			$stmt->bindValue(':firstname', $first_name);
			$stmt->bindValue(':lastname', $last_name);
			$stmt->bindValue(':course', $course);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setSubject($subcode, $title, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_subject(SUBJECT_CODE, SUBJECT_TITLE,`DATE`) VALUES(:subcode, :title, :date)");
			$stmt->bindValue(':subcode', $subcode);
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setUser($userid, $fname, $lname, $pass, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_user(USER_ID, FIRST_NAME, LAST_NAME, PASSWORD, `DATE`) VALUES(:userid, :fname, :lname, :pass, :date)");
			$stmt->bindValue(':userid', $userid);
			$stmt->bindValue(':fname', $fname);
			$stmt->bindValue(':lname', $lname);
			$stmt->bindValue(':pass', $pass);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setSY($sy, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_school_yr(SCHOOL_YEAR, STATUS, `DATE`) VALUES(:sy, 'INACTIVE', :date)");
			$stmt->bindValue(':sy', $sy);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setUpload($title, $description, $uploaded, $class, $filename, $path, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_assignment(TITLE, DESCRIPTION, UPLOADER, CLASS_ID, FILE_NAME, PATH,`DATE`) VALUES(:title, :description, :uploaded, :class, :filename, :path, :date)");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':uploaded', $uploaded);
			$stmt->bindValue(':class', $class);
			$stmt->bindValue(':filename', $filename);
			$stmt->bindValue(':path', $path);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function setAnnounce($title, $content, $user, $class, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_announcement(TITLE, CONTENT, USER_ID, CLASS, `DATE`) VALUES(:title, :content, :user, :class, :date)");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':content', $content);
			$stmt->bindValue(':user', $user);
			$stmt->bindValue(':class', $class);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function setQuiz($title, $class, $teacher, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_quizes(QUIZ_TITLE, CLASS_ID, TEACHER_ID, `DATE`) VALUES(:title, :class, :teacher, :date)");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':class', $class);
			$stmt->bindValue(':teacher', $teacher);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function setQuestion($question, $ca, $cb, $cc, $cd, $answer, $quizid, $date){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_questions(QUIZ_ID, QUESTION, CHOICES_A,  CHOICES_B, CHOICES_C, CHOICES_D, ANSWER,`DATE`) VALUES(:quizid, :question, :ca, :cb, :cc, :cd, :answer, :date)");
			$stmt->bindValue(':question', $question);
			$stmt->bindValue(':ca', $ca);
			$stmt->bindValue(':cb', $cb);
			$stmt->bindValue(':cc', $cc);
			$stmt->bindValue(':cd', $cd);
			$stmt->bindValue(':answer', $answer);
			$stmt->bindValue(':quizid', $quizid);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function addAnswer($user, $id, $qid, $a, $cans){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_answers(STUDENT_ID, QUESTION_ID, QUIZ_ID,  USER_ANSWER, CORRECT_ANSWER) VALUES(:user, :id, :qid, :a, :cans)");
			$stmt->bindValue(':user', $user);
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':qid', $qid);
			$stmt->bindValue(':a', $a);
			$stmt->bindValue(':cans', $cans);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function addQuizStatus($qid, $user, $item, $score){
		try{
			$stmt = $this->DB->prepare("INSERT INTO tbl_quiz_status(QUIZ_ID, STUDENT_ID, ITEMS, SCORE, `STATUS`) VALUES(:qid, :user, :item, :score, :done)");
			$stmt->bindValue(':qid', $qid);
			$stmt->bindValue(':user', $user);
			$stmt->bindValue(':item', $item);
			$stmt->bindValue(':score', $score);
			$stmt->bindValue(':done', 'Done');
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function editStudent($userid, $first_name, $last_name, $course, $password, $date){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_student SET STUDENT_ID = :userid, FIRST_NAME = :firstname, LAST_NAME = :lastname, COURSE = :course, PASSWORD = :password, `DATE` = :date WHERE STUDENT_ID = :userid");
			$stmt->bindValue(':userid', $userid);
			$stmt->bindValue(':firstname', $first_name);
			$stmt->bindValue(':lastname', $last_name);
			$stmt->bindValue(':course', $course);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function editSubject($subcode, $title, $date){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_subject SET SUBJECT_CODE = :subcode, SUBJECT_TITLE = :title,`DATE` = :date WHERE SUBJECT_CODE = :subcode");
			$stmt->bindValue(':subcode', $subcode);
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function editUser($userid, $fname, $lname, $pass, $date){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_user SET USER_ID = :userid, FIRST_NAME = :fname, LAST_NAME = :lname, PASSWORD = :pass, `DATE` = :date WHERE USER_ID = :userid");
			$stmt->bindValue(':userid', $userid);
			$stmt->bindValue(':fname', $fname);
			$stmt->bindValue(':lname', $lname);
			$stmt->bindValue(':pass', $pass);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function editTeacherInfo($userid, $first_name, $last_name, $password, $date){
		try{
			if(!empty($userid) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($date)){
				$stmt = $this->DB->prepare("UPDATE tbl_faculty SET FACULTY_ID = :userid, FIRST_NAME = :firstname, LAST_NAME = :lastname, PASSWORD = :password, `DATE` = :date WHERE FACULTY_ID = :userid");
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':firstname', $first_name);
				$stmt->bindValue(':lastname', $last_name);
				$stmt->bindValue(':password', $password);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
				echo 'Success';
			}
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function editAnnounce($title, $content, $user, $class, $date){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_announcement SET TITLE = :title, CONTENT = :content, USER_ID = :user, `DATE` = :date WHERE ID = :class");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':content', $content);
			$stmt->bindValue(':user', $user);
			$stmt->bindValue(':class', $class);
			$stmt->bindValue(':date', $date);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function editQuiz($id, $title){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_quizes SET QUIZ_TITLE = :title WHERE ID = :id");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function editQuestion($id, $question, $ca, $cb, $cc, $cd, $answer){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_questions SET QUESTION = :question, CHOICES_A = :ca, CHOICES_B = :cb, CHOICES_C = :cc, CHOICES_D = :cd, ANSWER = :answer WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':question', $question);
			$stmt->bindValue(':ca', $ca);
			$stmt->bindValue(':cb', $cb);
			$stmt->bindValue(':cc', $cc);
			$stmt->bindValue(':cd', $cd);
			$stmt->bindValue(':answer', $answer);
			$stmt->execute();
			//echo $id . ' ' . $question . ' ' . $ca . ' ' . $cb . ' ' . $cc . ' ' . $cd . ' ' . $answer;
			echo 'Success';
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function activateSY($id, $sy){
		try{
			$stmt = $this->DB->prepare("UPDATE tbl_school_yr SET STATUS = 'ACTIVE' WHERE ID=:id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			
			$stmt2 = $this->DB->prepare("UPDATE tbl_school_yr SET STATUS = 'INACTIVE' WHERE SCHOOL_YEAR=:sy");
			$stmt2->bindValue(':sy', $sy);
			$stmt2->execute();
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getFacultyID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_faculty WHERE FACULTY_ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$id = $row['FACULTY_ID'];
			$fname = $row['FIRST_NAME'];
			$lname = $row['LAST_NAME'];
			$password = $row['PASSWORD'];
			
			return array($id, $fname, $lname, $password);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getUserID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_user WHERE USER_ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$id = $row['USER_ID'];
			$fname = $row['FIRST_NAME'];
			$lname = $row['LAST_NAME'];
			$password = $row['PASSWORD'];
			
			return array($id, $fname, $lname, $password);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getStudentID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_student WHERE STUDENT_ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$id = $row['STUDENT_ID'];
			$fname = $row['FIRST_NAME'];
			$lname = $row['LAST_NAME'];
			$course = $row['COURSE'];
			$password = $row['PASSWORD'];
			
			return array($id, $fname, $lname, $course, $password);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getSubjectID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_subject WHERE SUBJECT_ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$scode = $row['SUBJECT_CODE'];
			$title = $row['SUBJECT_TITLE'];
			
			return array($scode, $title);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function getAnnounceID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_announcement WHERE ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$title = $row['TITLE'];
			$content = $row['CONTENT'];
			
			return array($title, $content);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function getQuizID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_quizes WHERE ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$title = $row['QUIZ_TITLE'];
			
			return array($title, $content);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}

	public function getQuestionID($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_questions WHERE ID = :id");
			$stmt->execute(array(":id"=>$id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$question = $row['QUESTION'];
			$ca = $row['CHOICES_A'];
			$cb = $row['CHOICES_B'];
			$cc = $row['CHOICES_C'];
			$cd = $row['CHOICES_D'];
			$answer = $row['ANSWER'];
			return array($question, $ca, $cb, $cc, $cd, $answer);
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
	
	public function downloadAss($id){
		try{
			$stmt = $this->DB->prepare("SELECT * FROM tbl_assignment WHERE ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$path = $row['PATH'];
				$filename = $row['FILE_NAME'];
				header('content-Disposition: attachment; filename = '.$filename.'');
				header('content-type:application/octent-strem');
				header('content-length='.filesize($path));
				readfile($path);
			}
			
		}catch(Exception $e){
			echo "Something went wrong ! \n" . $e->getMessage();
		}
	}
}

//$el = new Kailearning();
//$el->setStudent('aaaa', 'kriz', 'tian', 'bsit', 'pass', 'date');

?>