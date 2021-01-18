<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=No">
    <!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<![endif]-->
    <title>Laravel | PageTrial</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="js/jquery.js"></script>
</head>

<body>
    <div id="page-wrapper">
        <!--header part-->
        <?php include('includes/header.php');?>
        <!--header part end-->

        <!--Banner part-->
        <section id="banners-in" class="column banners-in pages text-center">
            <h2>Laravel </h2>
        </section>
        <!--Banner part-->

        <!--container part-->
        <section id="container-area" class="column about">
            <div class="main-content home column">
                <div class="wrapper">
                    <div class="heading text-center services">                        
                        <h2>Let Laravel Help You Build a Great Web App for Your PHP Project </h2>
                        <p>There are tons of frameworks for PHP today and many of them use modern web development principles. Laravel is one of the most sophisticated frameworks and also one that is growing the fastest among developers. Let’s take a look at what makes it a worthy choice for your next PHP application.</p>
                       </div>         
                    
                </div>
                <div class="wrapper">
                <div class="column">
                    <div class="wrapper">
                        <div class="story-part services">
                            <h4>Composer and modularity </h4>
                            <p>Most <span class="fontbold">Laravel</span> features are bundled as packages. Even the core libraries are Composer packages. Composer is the best package management tool available for PHP and this framework makes the best use of it. You don’t need a separate module in order to make changes to your application.</p>
                            <br/>
                            <p>If you want a feature removed from your website all you have to do is remove the package and you are done. You can add or remove packages from your application without worrying too much about instability, which makes Laravel instantly attractive for testing new features. </p>

                        </div>
                        <div class="story-img">
                            <img src="images/about-story.jpg" class="img-responsive" alt="" title="" />
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="wrapper">
                    <div class="heading text-center services">                        

                        <h4>Terrific update mechanism  </h4>
                        <p>The biggest benefits of this package structure for core Laravel libraries are:</p>
                        <ul>
                            <li>You can upgrade certain core libraries, as they gain features you like</li>
                            <li>No need to update the entire framework just for a few features</li>
                            <li>Manage different versions of packages more easily with package dependency management tools</li>

                        </ul>
                        
                        <p>Laravel is the best thing that has happened to application stability in the PHP world. You mostly don’t have to choose between security, stability and the latest developments technology.</p>
                        
                        <h4>Easy profiling  </h4>
                        <p>As your application grows large, you often find it difficult to figure out where the bottlenecks lie and why your site is slowing down in random situations. Laravel provides you with multiple profilers created by some very talented developers. One such profiler is called Laravel Debugbar. It tells you:</p>
                        <ul>
                            <li>Which part of your application consumes the most resources</li>
                            <li>When your application slows down and what conditions trigger the condition</li>

                        </ul>
                        <p>Its message and error logging system also helps you parse information more easily, so you have clear insight into how you can improve your application. </p>

                        <h4>Excellent community  </h4>
                        <p>The great thing about Laravel is that even if you are stuck at some point and don’t understand how to use a certain library and feature, you can ask the community. The framework has a very active and helpful contributor scene and other developers are more than willing to help you out with issues. If you want to save time and create a secure web application in PHP from scratch, Laravel is simply hard to beat. <br/><br/><br/><br/></p>

                        
                       </div>         
                    
                </div>
                
                
                <div class="facts column" id="counter">
                    <div class="wrapper">
                        <div class="text-center heading">
                            <h5>We Are Awesome</h5>
                            <h4>Some Fun Fucts</h4>
                        </div>
                        <div class="facts-count column">
                            <ul class="d-flex">
                                <li>
                                    <div class="fact-img text-center">
                                        <img src="images/happy.png" alt="" title="" />
                                    </div>
                                    <div class="fact-in text-center">
                                        <h5>
                                            <span class="counter-value" data-count="480">0</span>
                                        </h5>
                                        <h6>Happy Clients</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="fact-img text-center">
                                        <img src="images/done.png" alt="" title="" />
                                    </div>
                                    <div class="fact-in text-center">
                                        <h5>
                                            <span class="counter-value" data-count="850">0</span>
                                        </h5>
                                        <h6>Project Done</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="fact-img text-center">
                                        <img src="images/awards.png" alt="" title="" />
                                    </div>
                                    <div class="fact-in text-center">
                                        <h5>
                                            <span class="counter-value" data-count="14">0</span>
                                        </h5>
                                        <h6>Got Awards</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="fact-img text-center">
                                        <img src="images/satisfaction.png" alt="" title="" />
                                    </div>
                                    <div class="fact-in text-center">
                                        <h5>
                                            <span class="counter-value" data-count="99">0</span> %
                                        </h5>
                                        <h6>Satisfaction</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--container part-->

        <!--footer part-->
        <section id="footer" class="column">
            <div class="wrapper">
                <div class="footer-in column">
                    <div class="about-pro">
                        <img class="img-responsive" src="images/hello.png" alt="" title="" />
                        <div class="say-h">
                            <h3>SAY <span class="blockele">HELLO.</span></h3>
                            <p>Tell us about your project</p>
                            <h6>
                                <a href="#">CONTACT US <span></span></a>
                            </h6>
                        </div>
                    </div>
                    <div class="contact">
                        <ul>
                            <li>
                                <input type="text" placeholder="Name" />
                            </li>
                            <li>
                                <input type="email" placeholder="Email" />
                            </li>
                            <li>
                                <input type="tel" placeholder="Phone" />
                            </li>
                            <li>
                                <textarea placeholder="Message"></textarea>
                            </li>
                            <li>
                                <input type="submit" class="btn-yellow" value="Submit" />
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="f-menus column">
                <div class="wrapper">
                    <div class="f-left">
                        <div class="fm-in">
                            <ul>
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <a href="#">about us</a>
                                </li>
                                <li>
                                    <a href="#">SErvices</a>
                                </li>
                            </ul>
                        </div>
                        <div class="fm-in">
                            <ul>
                                <li>
                                    <a href="#">CliEnts</a>
                                </li>
                                <li>
                                    <a href="#">Portfolio</a>
                                </li>
                                <li>
                                    <a href="#">contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="fm-in address">
                            <p>45 pennsylvania avenue, Suite 136 fort Washington, PA 19034</p>
                            <a href="tel:123 456789">(123) 456789</a>
                        </div>
                    </div>
                    <div class="f-right">
                        <aside class="f-logo">
                            <a href="index.html">
                                <img src="images/logo.png" alt="" title="" />
                            </a>
                        </aside>
                        <aside class="social">
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="copy text-center">
                <p>&copy; 2019 PAGETRIAL</p>
            </div>
        </section>
        <!--footer part end-->
    </div>

    <script>
        var a = 0;
        $(window).scroll(function () {

            var oTop = $('#counter').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.counter-value').each(function () {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                        countNum: countTo
                    },

                        {

                            duration: 6000,
                            easing: 'swing',
                            step: function () {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function () {
                                $this.text(this.countNum);
                                //alert('finished');
                            }

                        });
                });
                a = 1;
            }

        });
    </script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        type="text/css" />
</body>

</html>