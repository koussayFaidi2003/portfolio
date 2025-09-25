<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/blogC.php';
include "bars.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/blog.php';


$blogC = new BlogC();

if (isset($_POST["title"], $_POST["content"], $_POST["id"])) {
    if (!empty($_POST['title']) && !empty($_POST["content"]) && !empty($_POST["id"])) {
        $blog = new Blog($_POST['id'], $_POST['title'], $_POST['content']);
        $blogC->updateBlog($blog, $_POST['id']);
        header('Location: listblog.php');
        exit();
    } else {
        $error = "Missing information";
    }
}

if (isset($_POST['id'])) {
    $blog = $blogC->showBlog($_POST['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Update</title>
</head>

<body>
    <form action="" method="POST">
    <div class="page-wrapper">
    <div class="content">
    <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Blog</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
										<label for="id">Id  :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="id" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>" readonly/>
                    					<span class="error-message" id="erreurID" style="color: red"></span>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
										<label  for="title">email :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="title" name="title" value="<?php echo isset($blog['title']) ? $blog['title'] : ''; ?>"/>
                    					<span class="error-message" id="erreurtitle" style="color: red"></span>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
										<label  for="content">Comment :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="content" name="content" value="<?php echo isset($blog['content']) ? $blog['content'] : ''; ?>"/>
                    					<span class="error-message" id="erreurcontent" style="color: red"></span>
                                    </div>
                            </div>
								<div class="m-t-20 text-center">
                                <button input type="submit" class="btn btn-primary submit-btn">Add blog</button>
                            </div>
					</div>
                </div>
            </div>
    </form>
    </div>
</body>

</html>
