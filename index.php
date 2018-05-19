<!DOCTYPE html>
<html>
<head>
	<title>Paginate</title>
	<?php require_once 'model/Pagination.php'; 
		use model\Pagination;

		$pagination = new Pagination(100,isset($_GET['page'])?$_GET['page']:1,15);
		$pagination->setPath("index.php?TOKEN=asdad");

	?>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="jquery/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php  echo  $pagination->paginate() ?>
</body>
</html>