function setCredentials(e){
	e.preventDefault();
	var action = "login";
	var userid = document.getElementById('userid').value;
	var pass = document.getElementById('password').value;
	var param = "userid="+userid+"&password="+pass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			var result = xhr.responseText;
			if(result == 'admin'){
				window.location="../admin_mod/index.php"; 
			}else if(result == 'teacher'){
				window.location="../teacher_mod/index.php";
			}else if(result == 'student'){
				window.location="../student_mod/index.php";
			}else{
				document.getElementById("error").innerHTML = result;
			}
		}
	}
	
	xhr.send(param);
}

function setRegisterStudent(e){
	e.preventDefault();
	var action = "register-student";
	var userid = document.getElementById('userid').value;
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var course = document.getElementById('course').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirm-password').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&course="+course+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				document.getElementById("error").innerHTML = "Succesfully Registered!";
				document.getElementById("error").style.color = "green";
				document.getElementById('userid').value = "";
				document.getElementById('fname').value = "";
				document.getElementById('lname').value = "";
				document.getElementById('course').value = "";
				document.getElementById('password').value = "";
				document.getElementById('confirm-password').value = "";
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function setRegisterTeacher(e){
	e.preventDefault();
	var action = "register-faculty";
	var userid = document.getElementById('userid').value;
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirm-password').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&course="+pass+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				document.getElementById("error").innerHTML = "Succesfully Registered!";
				document.getElementById("error").style.color = "green";
				document.getElementById('userid').value = "";
				document.getElementById('fname').value = "";
				document.getElementById('lname').value = "";
				document.getElementById('password').value = "";
				document.getElementById('confirm-password').value = "";
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function setClass(e){
	e.preventDefault();
	var action = "createClass";
	var sy = document.getElementById('selectSY').value;
	var subj = document.getElementById('selectSubject').value;
	var fac = document.getElementById('selectFaculty').value;
	var classcode = document.getElementById('className').value
	var param = "className="+classcode+"&selectSubject="+subj+"&selectFaculty="+fac+"&selectSY="+sy+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "classes.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function getClassValue(){
		
		var sy = document.getElementById('selectSY').options[document.getElementById('selectSY').selectedIndex].text;
		var subj = document.getElementById('selectSubject').options[document.getElementById('selectSubject').selectedIndex].text;
		var fac = document.getElementById('selectFaculty').value;
		var classcode = "";
		if(fac == ""){
			classcode = subj + '-';
		}else{
			classcode = subj + '-' + fac + '-' + sy;
		}
		document.getElementById('className').value = classcode;
}

function setStudent(e){
	e.preventDefault();
	var action = "create-student";
	var userid = document.getElementById('studentID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var course = document.getElementById('course').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&course="+course+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "student.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}


function setTeacher(e){
	e.preventDefault();
	var action = "create-faculty";
	var userid = document.getElementById('facultyID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "faculty.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function setSubject(e){
	e.preventDefault();
	var action = "create-subject";
	var subcode = document.getElementById('subCode').value;
	var title = document.getElementById('title').value;
	var param = "subcode="+subcode+"&title="+title+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "subject.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function setUser(e){
	e.preventDefault();
	var action = "create-user";
	var userid = document.getElementById('userID').value;
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var pass = document.getElementById('pass').value;
	var cpass = document.getElementById('cpass').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&pass="+pass+"&cpass="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "users.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function setSY(e){
	e.preventDefault();
	var action = "create-sy";
	var sy = document.getElementById('sy').value;
	var param = "sy="+sy+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "school_year.php";
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function setAnnounce(e){
	e.preventDefault();
	var action = "create-announce";
	var title = document.getElementById('title').value;
	var content = document.getElementById('content').value;
	var classes = document.getElementById('classes').value;
	var param = "title="+title+"&content="+content+"&classes="+classes+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				alert("Successfully Created!");
				window.history.back();
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function setQuiz(e){
	e.preventDefault();
	var action = "create-quiz";
	var title = document.getElementById('title').value;
	var classes = document.getElementById('classes').value;
	var param = "title="+title+"&classes="+classes+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.history.back();
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function setQuestion(e){
	e.preventDefault();
	var action = "create-question";
	var question = document.getElementById('question').value;
	var ca = document.getElementById('ca').value;
	var cb = document.getElementById('cb').value;
	var cc = document.getElementById('cc').value;
	var cd = document.getElementById('cd').value;
	var answer = document.getElementById('answer').value;
	var quizid = document.getElementById('quizid').value;
	var param = "question="+question+"&ca="+ca+"&cb="+cb+"&cc="+cc+"&cd="+cd+"&answer="+answer+"&quizid="+quizid+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.history.back();
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function editAnnounce(e){
	e.preventDefault();
	var action = "edit-announce";
	var title = document.getElementById('title').value;
	var content = document.getElementById('content').value;
	var classes = document.getElementById('classes').value;
	var param = "title="+title+"&content="+content+"&class="+classes+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "announcement.php";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function editStudent(e){
	e.preventDefault();
	var action = "edit-student";
	var userid = document.getElementById('studentID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var course = document.getElementById('course').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&course="+course+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "student.php";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}


function editTeacher(e){
	e.preventDefault();
	var action = "edit-faculty";
	var userid = document.getElementById('facultyID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "faculty.php";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function editSubject(e){
	e.preventDefault();
	var action = "edit-subject";
	var subcode = document.getElementById('subCode').value;
	var title = document.getElementById('title').value;
	var param = "subcode="+subcode+"&title="+title+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "subject.php";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function editUser(e){
	e.preventDefault();
	var action = "edit-user";
	var userid = document.getElementById('userID').value;
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var pass = document.getElementById('pass').value;
	var cpass = document.getElementById('cpass').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&pass="+pass+"&cpass="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "users.php";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function editAnnounce(e){
	e.preventDefault();
	var action = "edit-announce";
	var title = document.getElementById('title').value;
	var content = document.getElementById('content').value;
	var classes = document.getElementById('classes').value;
	var param = "title="+title+"&content="+content+"&class="+classes+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				alert("Successfully Created!");
				window.history.back();
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function editQuiz(e){
	e.preventDefault();
	var action = "edit-quiz";
	var title = document.getElementById('title').value;
	var jid = document.getElementById('jid').value;
	var param = "title="+title+"&jid="+jid+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.history.back();
				alert("Successfully Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}

function editQuestion(e){
	e.preventDefault();
	var action = "edit-question";
	var question = document.getElementById('question').value;
	var ca = document.getElementById('ca').value;
	var cb = document.getElementById('cb').value;
	var cc = document.getElementById('cc').value;
	var cd = document.getElementById('cd').value;
	var answer = document.getElementById('answer').value;
	var quizid = document.getElementById('quizid').value;
	var param = "question="+question+"&ca="+ca+"&cb="+cb+"&cc="+cc+"&cd="+cd+"&answer="+answer+"&quizid="+quizid+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.history.back();
				alert("Successfully Created!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	xhr.send(param);
}


function cpUser(e){
	e.preventDefault();
	var action = "edit-user";
	var userid = document.getElementById('userID').value;
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var pass = document.getElementById('pass').value;
	var cpass = document.getElementById('cpass').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&pass="+pass+"&cpass="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "profile.php?id="+userid+"&action=select-user";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function cpTeacher(e){ //Change Password Teacher
	e.preventDefault();
	var action = "edit-faculty";
	var userid = document.getElementById('facultyID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "profile.php?id="+userid+"&action=select-faculty";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function cpStudent(e){
	e.preventDefault();
	var action = "edit-student";
	var userid = document.getElementById('studentID').value;
	var fname = document.getElementById('firstName').value;
	var lname = document.getElementById('lastName').value;
	var course = document.getElementById('course').value;
	var pass = document.getElementById('password').value;
	var cpass = document.getElementById('confirmPassword').value;
	var param = "userid="+userid+"&fname="+fname+"&lname="+lname+"&course="+course+"&password="+pass+"&confirm-password="+cpass+"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "profile.php?id="+userid+"&action=select-student";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}

function ansQuestion(e){
	e.preventDefault();
	var action = "ans-question";
	var item = document.getElementById('item').value;
	var answer = document.getElementById('ans').value;
	var qid = document.getElementById('qid').value;
	var cans = document.getElementById('cans').value;
	var param = "item="+item+
				"&an="+answer+
				"&qid="+qid+
				"&cans="+cans+
				"&action="+action;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../class/elearning.condition.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			console.log(xhr.responseText);
			var result = xhr.responseText;
			if(result == "Success"){
				window.location = "quiz_answer.php?cid="+cid+"&id="+userid+"&qid"+qid+"&action=select-student";
				alert("Saved!");
			}else{
				document.getElementById("error").innerHTML = result;
				document.getElementById("error").style.color = "red";
			}
		}
	}
	
	xhr.send(param);
}
