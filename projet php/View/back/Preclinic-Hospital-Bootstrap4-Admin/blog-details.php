<?php 
include "bars.php";
// Importations nécessaires
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/blogC.php'; // Assuming you have a BlogC class
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model//blog.php'; // Assuming you have a Blog class

$error = "";

// create blog
$blog = null;

// create an instance of the controller
$blogC = new BlogC();

if (
    isset($_POST["title"]) &&
    isset($_POST["content"])
) {
    if (
        !empty($_POST['title']) &&
        !empty($_POST["content"])
    ) {
        $blog = new Blog(
            null,
            $_POST['title'],
            $_POST['content']
        );

        $blogC->addBlog($blog);
        header('Location: listeCom.php');
    } else {
        $error = "Missing information";
    }
} ?>
<!DOCTYPE html>
<html lang="en">


<!-- blog-details23:51-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Flytasy voyage </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Blog View</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-view">
                            <article class="blog blog-single-post">
                                <h3 class="blog-title">Quelle destination exotique fait battre votre cœur plus fort ? </h3>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><a href="#."><i class="fa fa-calendar"></i> <span>27 Novembre 2023</span></a></li>
                                            <li><a href="#."><i class="fa fa-user-o"></i> <span>By Malek essghir</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="post-right"><a href="#."><i class="fa fa-comment-o"></i>1 Comment</a></div>
                                </div>
                                <div class="blog-image">
                                    <a href="#."><img alt="" src="assets/img/33M.jpg" class="img-fluid"></a>
                                </div>
                                <div class="blog-content">
                                    <p>Le voyage est bien plus qu'une simple traversée d'espaces géographiques ; c'est une exploration de soi-même et du monde qui nous entoure. En embrassant l'inconnu, le voyage nous offre l'opportunité de découvrir de nouvelles cultures, de rencontrer des personnes inspirantes, et de créer des souvenirs inoubliables. Que ce soit à travers les paysages majestueux, les saveurs exotiques, ou les traditions locales, chaque étape d'un voyage est une aventure qui enrichit notre perspective. Le voyage transcende les frontières physiques pour devenir une quête intérieure, une exploration de nos propres limites et la découverte de notre capacité à nous adapter à l'inattendu. En fin de compte, le voyage est un catalyseur de croissance personnelle, nous incitant à élargir nos horizons et à apprécier la diversité qui façonne notre monde.





                            </article>
                            <div class="widget blog-share clearfix">
                                <h3>Share the post</h3>
                                <ul class="social-share">
                                    <li><a href="#." title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#." title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#." title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#." title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#." title="Youtube"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                            <div class="widget author-widget clearfix">
                                <h3>About author</h3>
                                <div class="about-author">
                                    <div class="about-author-img">
                                        <div class="author-img-wrap">
                                            <img class="img-fluid rounded-circle" alt="" src="assets/img/user.jpg">
                                        </div>
                                    </div>
                                    <div class="author-details">
                                        <span class="blog-author-name">Linda Barrett</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="widget blog-comments clearfix">
                                <h3>Comments (3)</h3>
                                <ul class="comments-list">
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <img class="avatar" alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <span class="comment-by">
													<span class="blog-author-name">Diana Bailey</span>
                                                <span class="float-right">
														<span class="blog-reply"><a href="#."><i class="fa fa-reply"></i> Reply</a></span>
                                                </span>
                                                </span>
                                               
                                            </div>
                                        </div>
                                        <ul class="comments-list reply">
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by">
															<span class="blog-author-name">Henry Daniels</span>
                                                        <span class="float-right">
																<span class="blog-reply"><a href="#."><i class="fa fa-reply"></i> Reply</a></span>
                                                        </span>
                                                        </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                        <span class="blog-date">December 6, 2017</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by">
															<span class="blog-author-name">Diana Bailey</span>
															<span class="float-right">
																<span class="blog-reply"> <a href="#."><i class="fa fa-reply"></i> Reply</a></span>
															</span>
                                                        </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                        <span class="blog-date">December 7, 2017</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <img class="avatar" alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <span class="comment-by">
													<span class="blog-author-name">Marie Wells</span>
													<span class="float-right">
														<span class="blog-reply"><a href="#."><i class="fa fa-reply"></i> Reply</a></span>
													</span>
                                                </span>
                                                <p>tres bon travail.</p>
                                                <span class="blog-date">December 11, 2017</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <img class="avatar" alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <span class="comment-by">
													<span class="blog-author-name">Pamela Curtis</span>
													<span class="float-right">
														<span class="blog-reply"><a href="#."><i class="fa fa-reply"></i> Reply</a></span>
													</span>
                                                </span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <span class="blog-date">December 13, 2017</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget new-comment clearfix">
                                <h3>Leave Comment</h3>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Name <span class="text-red">*</span></label>
                                                <input type="text" name="Name" id="Name" class="form-control" required>
                                                <span id="nameError" class="error"></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Your email address <span class="text-red">*</span></label>
                                                <input type="email" name="Email" id="Email" class="form-control" required>
                                                <span id="emailError" class="error"></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Comments <span class="text-red">*</span></label>
                                                <textarea name="Comments" id="Comments" rows="4" class="form-control" required></textarea>
                                                <span id="commentsError" class="error"></span>
                                            </div>
                                            
                                            <div class="comment-submit">
                                                <input type="submit" value="Submit" class="btn">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <aside class="col-md-4">
                        <div class="widget search-widget">
                            <h5>Blog Search</h5>
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="widget post-widget">
                            <h5>Latest Posts</h5>
                            <ul class="latest-posts">
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/blog/777T.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
											<a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>
										</h4>
                                        <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/blog/blog-thumb-02.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
											<a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>
										</h4>
                                        <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/blog/blog-thumb-03.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
											<a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>
										</h4>
                                        <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/blog/blog-thumb-04.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
											<a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>
										</h4>
                                        <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                      
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/controle.js"></script>
</body>


<!-- blog-details23:56-->
</html>