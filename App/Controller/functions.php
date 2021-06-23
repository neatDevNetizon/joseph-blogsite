<?php
	session_start();
	define('DATABASE_HOST','localhost');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASS', '');
    define('DATABASE_NAME', 'myaggregator');

    $dbConnection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    if(!$dbConnection){
        print('Failed to connect to database !');
        die();
    }
    $router = $_GET['id'];
    switch ($router) {
		case 'login':
			loginAction();
			break;
		case 'newblog':
			addBlogAction();
			break;
		case 'page':
			getPageAction();
			break;
		case 'allrow':
			getAllRow();
			break;
		case 'category':
			getCategoryRows();
			break;
		case 'bycategory':
			getPageByCate();
			break;
	}
	function loginAction() {
		global $dbConnection;
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$hashPwd = md5($pwd);
		$query = "SELECT * FROM `jos_admin` where admin_email = '{$email}' and admin_password='{$hashPwd}' ";
		$result = mysqli_query($dbConnection, $query);
		$numrows = mysqli_num_rows($result);
		if($numrows) {
			$row = mysqli_fetch_row($result);
	      	$_SESSION['josid'] = $row[0];
	      	$_SESSION['josname'] = $row[1];
			echo 'valid';
			return;
		} else {
			echo 'invalid';
			return;
		}
		return ;
	}
	function addBlogAction() {
		global $dbConnection;
		$link = $_POST['link'];
		$photo = $_POST['photo'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$pubdate = $_POST['pubdate'];
		$sitename = $_POST['sitename'];
		$favicon = $_POST['favicon'];
		$category = $_POST['category'];

		if (filter_var($link, FILTER_VALIDATE_URL) === false){
			echo "invalid link";
			return false;
		} else {
			$query = "SELECT * FROM jos_blogs WHERE blog_url = '{$link}'";
			$result = mysqli_query($dbConnection, $query);
			$numrows = mysqli_num_rows($result);
			if($numrows) {
				echo "existed";
				return false;
			} else {
				$query = " INSERT INTO `jos_blogs` (`blog_url`,	`blog_photo`, `blog_title`, `blog_description`, `blog_pub_date`, `blog_sitename`, `blog_href`, `blog_category`) VALUES (\"{$link}\", \"{$photo}\", \"{$title}\", \"{$description}\", \"{$pubdate}\", \"{$sitename}\", \"{$favicon}\", \"{$category}\")";
				$result = mysqli_query($dbConnection, $query);
				if(mysqli_affected_rows($dbConnection)) {
					echo "success";
					return true;
				} else {
					echo "error";
					return false;
				}
			}
		}
	}
	function getPageAction() {
		global $dbConnection;
		$current = $_POST['current'];
		$perpage = $_POST['perpage'];
		$offest = 0;
		if($current==1) $offest = 0;
		else {
			$offest = $perpage*($current-1);
		}
		$query = "SELECT * FROM jos_blogs LIMIT {$perpage} OFFSET {$offest}";
		$result = mysqli_query($dbConnection, $query);
		$numrows =mysqli_num_rows($result);
		if(!$result) {echo "NO"; return;}
		for($count = 0; $count < $numrows; $count++){
			$ac = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$data[] = $ac;
		}
		print_r(json_encode($data)) ;
		return ;

	}
	function getAllRow() {
		global $dbConnection;
		$query = "SELECT COUNT(blog_id) FROM jos_blogs";
		$result = mysqli_query($dbConnection, $query);
		$row = mysqli_fetch_row($result);
		$num = $row[0];
		echo $num;
		return ;
	}
	function getCategoryRows(){
		global $dbConnection;
		$category = $_POST['category'];
		$query = "SELECT COUNT(blog_id) FROM jos_blogs WHERE blog_category = '{$category}'";
		$result = mysqli_query($dbConnection, $query);
		$row = mysqli_fetch_row($result);
		$num = $row[0];
		echo $num;
		return ;
	}
	function getPageByCate(){
		global $dbConnection;
		$category = $_POST['category'];
		$current = $_POST['current'];
		$perpage = $_POST['perpage'];
		$offest = 0;
		if($current==1) $offest = 0;
		else {
			$offest = $perpage*($current-1);
		}
		$query = "SELECT * FROM jos_blogs WHERE blog_category = '{$category}' LIMIT {$perpage} OFFSET {$offest}";
		$result = mysqli_query($dbConnection, $query);
		$numrows =mysqli_num_rows($result);
		if(!$result) {echo "NO"; return;}
		for($count = 0; $count < $numrows; $count++){
			$ac = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$data[] = $ac;
		}
		print_r(json_encode($data)) ;
		return ;
	}
?>
