<?php
SESSION_START();
error_reporting(0);
date_default_timezone_set('Asia/Hong_Kong');
include_once '../class/elearning.class.php'; 

$user = $_SESSION['user'];
$type = $_SESSION['type'];

$el = new kailearning();
$date = date("Y-m-d h:i A");
$activeSY = $el->getSchoolYear();


if($_POST['action'] == "login"){
	$userid = htmlspecialchars($_POST["userid"]);
	$password = htmlspecialchars($_POST["password"]);

	$el->getUserCredentials($userid, $password);
	$el->setUserLog($userid, $date);
}

if($_POST['action'] == "register-student"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$course = htmlspecialchars($_POST["course"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	

	if($el->isStudentId($userid)){
		echo 'Student has already registered';
	}elseif($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->setStudent($userid, $fname, $lname, $course, $password, $date);
	}
}

if($_POST['action'] == "register-faculty"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	
	if($el->isFacultyId($userid)){
		echo 'Teacher has already registered';
	}elseif($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->setTeacherInfo($userid, $fname, $lname, $password, $date);
	}
}

if($_POST['action'] == "createClass"){
	$sy = htmlspecialchars($_POST["selectSY"]);
	$subj = htmlspecialchars($_POST["selectSubject"]);
	$fac = htmlspecialchars($_POST["selectFaculty"]);
	$class = htmlspecialchars($_POST["className"]);
	$action = 'created class ' . $class;
	
	if($el->isClassCode($class)){
		echo 'Class has already created';
	}else{
		$el->setClass($class, $subj, $fac, $sy, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_GET['action'] == "addToClass"){
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$action = 'added student to class ' . $id;
	
	if($el->isClassStudent($id, $sid)){
		header('Location: classes_students.php?id='.$id);
	}else{
		$el->setStudentClass($id, $sid);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_GET['action'] == "deleteClass"){
	$id = $_GET['id'];
	$action = 'deleted class ' . $id;
	$el->deleteClass($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteStudent"){
	$id = $_GET['id'];
	$action = 'deleted student ' . $id;
	$el->deleteStudent($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteFaculty"){
	$id = $_GET['id'];
	$action = 'deleted faculty ' . $id;
	$el->deleteFaculty($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteSubject"){
	$id = $_GET['id'];
	$action = 'deleted subject ' . $id;
	$el->deleteSubject($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteUser"){
	$id = $_GET['id'];
	$action = 'deleted user ' . $id;
	$el->deleteUser($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteClassStudent"){
	$action = 'deleted student in class '. $_GET['id'] . ' ';
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$el->deleteClassStudent($id, $sid);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteSY"){
	$action = 'deleted school year '. $_GET['id'] . ' ';
	$id = $_GET['id'];
	$el->deleteSY($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteAnnounce"){
	$action = 'deleted announcement '. $_GET['id'] . ' ';
	$id = $_GET['id'];
	$el->deleteAnnounce($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteQuiz"){
	$action = 'deleted quiz '. $_GET['id'] . ' ';
	$id = $_GET['id'];
	$el->deleteQuiz($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "deleteQuestion"){
	$action = 'deleted question '. $_GET['id'] . ' ';
	$id = $_GET['qid'];
	$el->deleteQuestion($id);
	$el->setActivityLog($user, $action, $date);
}

if($_GET['action'] == "activateSY"){
	$action = 'activate school year '. $_GET['id'] . ' ';
	$id = $_GET['id'];
	
	
		$el->activateSY($id, $activeSY);
		$el->setActivityLog($user, $action, $date);

}

if($_POST['action'] == "create-student"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$course = htmlspecialchars($_POST["course"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	$action = "added new student " . $fname . ' ' . $lname;

	if($el->isStudentId($userid)){
		echo 'Student has already created';
	}elseif($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->setStudent($userid, $fname, $lname, $course, $password, $date);
		//$el->setNewStudent('asdfghj', '123', '123', '123', '123', 'date');
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "create-faculty"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	$action = "added new faculty " . $fname . " " . $lname;

	if($el->isFacultyId($userid)){
		echo 'Teacher has already created';
	}elseif($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->setTeacherInfo($userid, $fname, $lname, $password, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "create-subject"){
	$subcode = htmlspecialchars($_POST["subcode"]);
	$title = htmlspecialchars($_POST["title"]);
	$action = "created new subject " . $title;

	if($el->isSubjectId($subcode)){
		echo 'Subject has already created';
	}else{
		$el->setSubject($subcode, $title, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "create-user"){
	$uid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$pass = htmlspecialchars($_POST["pass"]);
	$cpass = htmlspecialchars($_POST["cpass"]);
	$action = "created new admin " . $fname . ' ' . $lname;

	if($el->isAdminId($uid)){
		echo 'Admin user has already created';
	}elseif($cpass !== $pass){
		echo 'Password not match!';
	}else{
		$el->setUser($uid, $fname, $lname, $pass, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "create-sy"){
	$sy = htmlspecialchars($_POST["sy"]);
	$action = "created a new school year " . $sy;

	if($el->isSYId($sy)){
		echo 'School Year has already created';
	}else{
		$el->setSY($sy, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "create-announce"){
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$class = htmlspecialchars($_POST["classes"]);
	$action = "posted a new announcement " . $sy;
	$el->setAnnounce($title, $content, $user, $class, $date);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "create-quiz"){
	$title = htmlspecialchars($_POST["title"]);
	$class = htmlspecialchars($_POST["classes"]);
	$action = "created a new quiz " . $sy;
	$el->setQuiz($title, $class, $user, $date);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "create-question"){
	$question = htmlspecialchars($_POST["question"]);
	$ca = htmlspecialchars($_POST["ca"]);
	$cb = htmlspecialchars($_POST["cb"]);
	$cc = htmlspecialchars($_POST["cc"]);
	$cd = htmlspecialchars($_POST["cd"]);
	$answer = htmlspecialchars($_POST["answer"]);
	$quizid = htmlspecialchars($_POST["quizid"]);
	$action = "created a new question " . $sy;
	$el->setQuestion($question, $ca, $cb, $cc, $cd, $answer, $quizid, $date);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "edit-student"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$course = htmlspecialchars($_POST["course"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	$action = "edited student " . $fname . ' ' . $lname;

	if($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->editStudent($userid, $fname, $lname, $course, $password, $date);
		//$el->setNewStudent('asdfghj', '123', '123', '123', '123', 'date');
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "edit-faculty"){
	$userid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$password = htmlspecialchars($_POST["password"]);
	$confirm_pass = htmlspecialchars($_POST["confirm-password"]);
	$action = "edited faculty " . $fname . " " . $lname;

	if($confirm_pass !== $password){
		echo 'Password not match!';
	}else{
		$el->editTeacherInfo($userid, $fname, $lname, $password, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "edit-subject"){
	$subcode = htmlspecialchars($_POST["subcode"]);
	$title = htmlspecialchars($_POST["title"]);
	$action = "edited subject " . $title;

	
	$el->editSubject($subcode, $title, $date);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "edit-user"){
	$uid = htmlspecialchars($_POST["userid"]);
	$fname = htmlspecialchars($_POST["fname"]);
	$lname = htmlspecialchars($_POST["lname"]);
	$pass = htmlspecialchars($_POST["pass"]);
	$cpass = htmlspecialchars($_POST["cpass"]);
	$action = "edited admin " . $fname . ' ' . $lname;

	if($cpass !== $pass){
		echo 'Password not match!';
	}else{
		$el->editUser($uid, $fname, $lname, $pass, $date);
		$el->setActivityLog($user, $action, $date);
	}
}

if($_POST['action'] == "edit-announce"){
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$class = htmlspecialchars($_POST["class"]);
	$action = "edited a announcement " . $title;

	$el->editAnnounce($title, $content, $user, $class, $date);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "edit-quiz"){
	$title = htmlspecialchars($_POST["title"]);
	$jid = htmlspecialchars($_POST["jid"]);
	$action = "edited a quiz " . $title;
	$el->editQuiz($jid, $title);
	$el->setActivityLog($user, $action, $date);
}

if($_POST['action'] == "edit-question"){
	$id = htmlspecialchars($_POST["quizid"]);
	$question = htmlspecialchars($_POST["question"]);
	$ca = htmlspecialchars($_POST["ca"]);
	$cb = htmlspecialchars($_POST["cb"]);
	$cc = htmlspecialchars($_POST["cc"]);
	$cd = htmlspecialchars($_POST["cd"]);
	$answer = htmlspecialchars($_POST["answer"]);
	$action = "edited a question " . $question;
	$el->editQuestion($id, $question, $ca, $cb, $cc, $cd, $answer);
	$el->setActivityLog($user, $action, $date);
}


if($_GET['action'] == "select-faculty"){
	$id = $_GET['id'];
	list($id, $fname, $lname, $password) = $el->getFacultyID($id);
}

if($_GET['action'] == "select-student"){
	$id = $_GET['id'];
	list($id, $fname, $lname, $course, $password) = $el->getStudentID($id);
}

if($_GET['action'] == "select-subject"){
	$id = $_GET['id'];
	list($scode, $title) = $el->getSubjectID($id);
}

if($_GET['action'] == "select-user"){
	$id = $_GET['id'];
	list($id, $fname, $lname, $password) = $el->getUserID($id);
}

if($_GET['action'] == "select-announce"){
	$id = $_GET['id'];
	list($title, $content) = $el->getAnnounceID($id);
}

if($_GET['action'] == "select-quiz"){
	$id = $_GET['id'];
	list($title) = $el->getQuizID($id);
}

if($_GET['action'] == "select-question"){
	$id = $_GET['id'];
	list($question, $ca, $cb, $cc, $cd, $answer) = $el->getQuestionID($id);
}

if($_GET['action'] == "downloadAss"){
	$id = $_GET['id'];
	$el->downloadAss($id);
}

?>