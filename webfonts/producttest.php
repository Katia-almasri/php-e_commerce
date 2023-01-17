<?php
require "../DBHolder/DBManager.php";
require "functions.php";

try {
    $pdo = pdo_connect_mysql();
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

try {
    $pro_id = $_GET['id'];
    $sql    = "SELECT * FROM procomp WHERE pro_id = $pro_id";
    $stmt   = $pdo->prepare($sql);
    $stmt->execute();
    $product = $stmt->fetch();
} catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}



?>

<?= template_header('Name of the product') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Product_Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/product-page.css" rel="stylesheet">
</head>

<body>


    <!-- Navbar -->

    <!--Main layout-->
    <main class="mt-5 pt-4">
        <div class="container dark-grey-text mt-5">

            <!--Grid row-->
            <div class="row wow fadeIn">
                <div class="col-md-6 mb-4">
                    <img src="imgs/products/<?= $product['image'] ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-6 mb-4">
                    <p class="lead font-weight-bold"><?= $product['pro_name'] ?> </p>
                    <!--Content-->
                    <div class="p-4">
                        <p class="lead">
                        <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
                            <?php if ($product['discount_percent'] > 0) : ?>
                                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
                            <?php endif; ?>
                        </h1>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $product['pro_name'] ?></p>
                            </div>
                        </div>
                        <? if ($product['col'] != null) : ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Color</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?= $product['col'] ?></p>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($product['size'] != null) : ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Size</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?= $product['size'] ?></p>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($product['rate'] != null) : ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Rate</label>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $rate = (int)($product['rate']);           // The rate without the decimal part
                                    for ($i = 0; $i < $rate; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                    <?php if (is_float($product['rate'])) {     // If the rate has a decimal part them we should add a half star 
                                    ?>
                                     <i class="fas fa-star-half"></i>
                                    <?php } ?>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($product['description'] != null) : ?>
                            <br>
                            <p class="lead font-weight-bold">Description :</p>
                            <p><?= $product['description'] ?></p>
                        <? endif; ?>
                        <form action="CartAndCheckout.php" method="post">
                            <input type="numasber" name="quantity" value="1" min="1" max="<?= $product['amount'] ?>" placeholder="Quantity" required>
                            <input type="hidden" name="product_id" value="<?= $product['pro_id'] ?>">
                            <input type="submit" value="Add To Cart">
                        </form>
                    </div>
                </div>
            </div>
            <hr>

            <div class="container">


                <h2>Rate the product please</h2>


                <br />
                <label for="input-1" class="control-label">Give a rating for Product:</label>
                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2">

            </div>


            <script>
                $("#input-id").rating();
            </script>


            <hr>
            <div class="row wow fadeIn">
                <div class="col-lg-4 col-md-12 mb-4">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </main>

    <hr>



    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="headings d-flex justify-content-between align-items-center mb-3">
                    <h5>product comments(6)</h5>
                    <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> <span class="text-primary">Comments "ON"</span>
                            <div class="form-check form-switch"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                        </span> </div>
                </div>
                <div class="card card1 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">james_olesenn</small> <small class="font-weight-bold">Hmm, This poster looks cool</small></span> </div> <small>2 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> </div>
                    </div>
                </div>
                <div class="card card1 p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <div class="card card1 p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/0LKZQYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">rashida_jones</small> <small class="font-weight-bold">Really cool Which filter are you using? </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-star-o text-muted"></i> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <div class="card card1 p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/ZSkeqnd.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">simona_rnasi</small> <small class="font-weight-bold text-primary">@macky_lones</small> <small class="font-weight-bold text-primary">@rashida_jones</small> <small class="font-weight-bold">Thanks </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row" style="margin-top:40px;">
            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="text-right">
                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                    </div>

                    <div class="row" id="post-review-box" style="display:none; ">
                        <div class="col-md-12">
                            <form accept-charset="UTF-8" action="" method="post">
                                <input id="ratings-hidden" name="rating" type="hidden">
                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                                <div class="text-right">
                                    <div class="stars starrr" data-rating="0"></div>
                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                        <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                    <button class="btn btn-primary btn-lg" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        (function(e) {
            var t, o = {
                    className: "autosizejs",
                    append: "",
                    callback: !1,
                    resizeDelay: 10
                },
                i = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',
                n = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"],
                s = e(i).data("autosize", !0)[0];
            s.style.lineHeight = "99px", "99px" === e(s).css("lineHeight") && n.push("lineHeight"), s.style.lineHeight = "", e.fn.autosize = function(i) {
                return this.length ? (i = e.extend({}, o, i || {}), s.parentNode !== document.body && e(document.body).append(s), this.each(function() {
                    function o() {
                        var t, o;
                        "getComputedStyle" in window ? (t = window.getComputedStyle(u, null), o = u.getBoundingClientRect().width, e.each(["paddingLeft", "paddingRight", "borderLeftWidth", "borderRightWidth"], function(e, i) {
                            o -= parseInt(t[i], 10)
                        }), s.style.width = o + "px") : s.style.width = Math.max(p.width(), 0) + "px"
                    }

                    function a() {
                        var a = {};
                        if (t = u, s.className = i.className, d = parseInt(p.css("maxHeight"), 10), e.each(n, function(e, t) {
                                a[t] = p.css(t)
                            }), e(s).css(a), o(), window.chrome) {
                            var r = u.style.width;
                            u.style.width = "0px", u.offsetWidth, u.style.width = r
                        }
                    }

                    function r() {
                        var e, n;
                        t !== u ? a() : o(), s.value = u.value + i.append, s.style.overflowY = u.style.overflowY, n = parseInt(u.style.height, 10), s.scrollTop = 0, s.scrollTop = 9e4, e = s.scrollTop, d && e > d ? (u.style.overflowY = "scroll", e = d) : (u.style.overflowY = "hidden", c > e && (e = c)), e += w, n !== e && (u.style.height = e + "px", f && i.callback.call(u, u))
                    }

                    function l() {
                        clearTimeout(h), h = setTimeout(function() {
                            var e = p.width();
                            e !== g && (g = e, r())
                        }, parseInt(i.resizeDelay, 10))
                    }
                    var d, c, h, u = this,
                        p = e(u),
                        w = 0,
                        f = e.isFunction(i.callback),
                        z = {
                            height: u.style.height,
                            overflow: u.style.overflow,
                            overflowY: u.style.overflowY,
                            wordWrap: u.style.wordWrap,
                            resize: u.style.resize
                        },
                        g = p.width();
                    p.data("autosize") || (p.data("autosize", !0), ("border-box" === p.css("box-sizing") || "border-box" === p.css("-moz-box-sizing") || "border-box" === p.css("-webkit-box-sizing")) && (w = p.outerHeight() - p.height()), c = Math.max(parseInt(p.css("minHeight"), 10) - w || 0, p.height()), p.css({
                        overflow: "hidden",
                        overflowY: "hidden",
                        wordWrap: "break-word",
                        resize: "none" === p.css("resize") || "vertical" === p.css("resize") ? "none" : "horizontal"
                    }), "onpropertychange" in u ? "oninput" in u ? p.on("input.autosize keyup.autosize", r) : p.on("propertychange.autosize", function() {
                        "value" === event.propertyName && r()
                    }) : p.on("input.autosize", r), i.resizeDelay !== !1 && e(window).on("resize.autosize", l), p.on("autosize.resize", r), p.on("autosize.resizeIncludeStyle", function() {
                        t = null, r()
                    }), p.on("autosize.destroy", function() {
                        t = null, clearTimeout(h), e(window).off("resize", l), p.off("autosize").off(".autosize").css(z).removeData("autosize")
                    }), r())
                })) : this
            }
        })(window.jQuery || window.$);

        var __slice = [].slice;
        (function(e, t) {
            var n;
            n = function() {
                function t(t, n) {
                    var r, i, s, o = this;
                    this.options = e.extend({}, this.defaults, n);
                    this.$el = t;
                    s = this.defaults;
                    for (r in s) {
                        i = s[r];
                        if (this.$el.data(r) != null) {
                            this.options[r] = this.$el.data(r)
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on("mouseover.starrr", "span", function(e) {
                        return o.syncRating(o.$el.find("span").index(e.currentTarget) + 1)
                    });
                    this.$el.on("mouseout.starrr", function() {
                        return o.syncRating()
                    });
                    this.$el.on("click.starrr", "span", function(e) {
                        return o.setRating(o.$el.find("span").index(e.currentTarget) + 1)
                    });
                    this.$el.on("starrr:change", this.options.change)
                }
                t.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function(e, t) {}
                };
                t.prototype.createStars = function() {
                    var e, t, n;
                    n = [];
                    for (e = 1, t = this.options.numStars; 1 <= t ? e <= t : e >= t; 1 <= t ? e++ : e--) {
                        n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))
                    }
                    return n
                };
                t.prototype.setRating = function(e) {
                    if (this.options.rating === e) {
                        e = void 0
                    }
                    this.options.rating = e;
                    this.syncRating();
                    return this.$el.trigger("starrr:change", e)
                };
                t.prototype.syncRating = function(e) {
                    var t, n, r, i;
                    e || (e = this.options.rating);
                    if (e) {
                        for (t = n = 0, i = e - 1; 0 <= i ? n <= i : n >= i; t = 0 <= i ? ++n : --n) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")
                        }
                    }
                    if (e && e < 5) {
                        for (t = r = e; e <= 4 ? r <= 4 : r >= 4; t = e <= 4 ? ++r : --r) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                        }
                    }
                    if (!e) {
                        return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                    }
                };
                return t
            }();
            return e.fn.extend({
                starrr: function() {
                    var t, r;
                    r = arguments[0], t = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function() {
                        var i;
                        i = e(this).data("star-rating");
                        if (!i) {
                            e(this).data("star-rating", i = new n(e(this), r))
                        }
                        if (typeof r === "string") {
                            return i[r].apply(i, t)
                        }
                    })
                }
            })
        })(window.jQuery, window);
        $(function() {
            return $(".starrr").starrr()
        })

        $(function() {

            $('#new-review').autosize({
                append: "\n"
            });

            var reviewBox = $('#post-review-box');
            var newReview = $('#new-review');
            var openReviewBtn = $('#open-review-box');
            var closeReviewBtn = $('#close-review-box');
            var ratingsField = $('#ratings-hidden');

            openReviewBtn.click(function(e) {
                reviewBox.slideDown(400, function() {
                    $('#new-review').trigger('autosize.resize');
                    newReview.focus();
                });
                openReviewBtn.fadeOut(100);
                closeReviewBtn.show();
            });

            closeReviewBtn.click(function(e) {
                e.preventDefault();
                reviewBox.slideUp(300, function() {
                    newReview.focus();
                    openReviewBtn.fadeIn(200);
                });
                closeReviewBtn.hide();

            });

            $('.starrr').on('starrr:change', function(e, value) {
                ratingsField.val(value);
            });
        });
    </script>

    <hr>

    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
    <script>
        var cartButtons = document.querySelectorAll('.cart-button');
        var card_value = document.querySelector(".added");
        var pqtplus = document.querySelector(".pqt-plus");
        var pqtminus = document.querySelector(".pqt-minus");
        var cartvalue = 0;

        cartButtons.forEach(button => {
            button.addEventListener('click', cartClick);
        });

        function cartClick() {
            let button = this;
            button.classList.add('clicked');
            card_value.textContent = cartvalue += 1;
        }

        pqtplus.addEventListener('click', function() {
            if (card_value.nodeValue <= 0) {
                card_value.textContent = cartvalue += 1;
            }
        });

        pqtminus.addEventListener('click', function() {
            if (Number(card_value.innerText) - 1 >= 0) {
                card_value.textContent = cartvalue -= 1;
            }
        });
    </script>



    <script src="../../../../code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?= template_footer() ?>