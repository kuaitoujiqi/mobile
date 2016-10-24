jQuery.easing.jswing = jQuery.easing.swing,
jQuery.extend(jQuery.easing, {
    def: "easeOutQuad",
    swing: function(a, b, c, d, e) {
        return - d * (b /= e) * (b - 2) + c
    },
    easeInQuad: function(a, b, c, d, e) {
        return d * (b /= e) * b + c
    },
    easeOutQuad: function(a, b, c, d, e) {
        return - d * (b /= e) * (b - 2) + c
    },
    easeInOutQuad: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b + c: -d / 2 * (--b * (b - 2) - 1) + c
    },
    easeInCubic: function(a, b, c, d, e) {
        return d * (b /= e) * b * b + c
    },
    easeOutCubic: function(a, b, c, d, e) {
        return d * ((b = b / e - 1) * b * b + 1) + c
    },
    easeInOutCubic: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b + c: d / 2 * ((b -= 2) * b * b + 2) + c
    },
    easeInQuart: function(a, b, c, d, e) {
        return d * (b /= e) * b * b * b + c
    },
    easeOutQuart: function(a, b, c, d, e) {
        return - d * ((b = b / e - 1) * b * b * b - 1) + c
    },
    easeInOutQuart: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b * b + c: -d / 2 * ((b -= 2) * b * b * b - 2) + c
    },
    easeInQuint: function(a, b, c, d, e) {
        return d * (b /= e) * b * b * b * b + c
    },
    easeOutQuint: function(a, b, c, d, e) {
        return d * ((b = b / e - 1) * b * b * b * b + 1) + c
    },
    easeInOutQuint: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b * b * b + c: d / 2 * ((b -= 2) * b * b * b * b + 2) + c
    },
    easeInSine: function(a, b, c, d, e) {
        return - d * Math.cos(b / e * (Math.PI / 2)) + d + c
    },
    easeOutSine: function(a, b, c, d, e) {
        return d * Math.sin(b / e * (Math.PI / 2)) + c
    },
    easeInOutSine: function(a, b, c, d, e) {
        return - d / 2 * (Math.cos(Math.PI * b / e) - 1) + c
    },
    easeInExpo: function(a, b, c, d, e) {
        return 0 == b ? c: d * Math.pow(2, 10 * (b / e - 1)) + c
    },
    easeOutExpo: function(a, b, c, d, e) {
        return b == e ? c + d: d * ( - Math.pow(2, -10 * b / e) + 1) + c
    },
    easeInOutExpo: function(a, b, c, d, e) {
        return 0 == b ? c: b == e ? c + d: (b /= e / 2) < 1 ? d / 2 * Math.pow(2, 10 * (b - 1)) + c: d / 2 * ( - Math.pow(2, -10 * --b) + 2) + c
    },
    easeInCirc: function(a, b, c, d, e) {
        return - d * (Math.sqrt(1 - (b /= e) * b) - 1) + c
    },
    easeOutCirc: function(a, b, c, d, e) {
        return d * Math.sqrt(1 - (b = b / e - 1) * b) + c
    },
    easeInOutCirc: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? -d / 2 * (Math.sqrt(1 - b * b) - 1) + c: d / 2 * (Math.sqrt(1 - (b -= 2) * b) + 1) + c
    },
    easeInElastic: function(a, b, c, d, e) {
        var f = 1.70158,
        g = 0,
        h = d;
        if (0 == b) return c;
        if (1 == (b /= e)) return c + d;
        if (g || (g = .3 * e), h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return - (h * Math.pow(2, 10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g)) + c
    },
    easeOutElastic: function(a, b, c, d, e) {
        var f = 1.70158,
        g = 0,
        h = d;
        if (0 == b) return c;
        if (1 == (b /= e)) return c + d;
        if (g || (g = .3 * e), h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return h * Math.pow(2, -10 * b) * Math.sin(2 * (b * e - f) * Math.PI / g) + d + c
    },
    easeInOutElastic: function(a, b, c, d, e) {
        var f = 1.70158,
        g = 0,
        h = d;
        if (0 == b) return c;
        if (2 == (b /= e / 2)) return c + d;
        if (g || (g = .3 * e * 1.5), h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return 1 > b ? -.5 * h * Math.pow(2, 10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g) + c: h * Math.pow(2, -10 * (b -= 1)) * Math.sin(2 * (b * e - f) * Math.PI / g) * .5 + d + c
    },
    easeInBack: function(a, b, c, d, e, f) {
        return void 0 == f && (f = 1.70158),
        d * (b /= e) * b * ((f + 1) * b - f) + c
    },
    easeOutBack: function(a, b, c, d, e, f) {
        return void 0 == f && (f = 1.70158),
        d * ((b = b / e - 1) * b * ((f + 1) * b + f) + 1) + c
    },
    easeInOutBack: function(a, b, c, d, e, f) {
        return void 0 == f && (f = 1.70158),
        (b /= e / 2) < 1 ? d / 2 * b * b * (((f *= 1.525) + 1) * b - f) + c: d / 2 * ((b -= 2) * b * (((f *= 1.525) + 1) * b + f) + 2) + c
    },
    easeInBounce: function(a, b, c, d, e) {
        return d - jQuery.easing.easeOutBounce(a, e - b, 0, d, e) + c
    },
    easeOutBounce: function(a, b, c, d, e) {
        return (b /= e) < 1 / 2.75 ? 7.5625 * d * b * b + c: 2 / 2.75 > b ? d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c: 2.5 / 2.75 > b ? d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c: d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c
    },
    easeInOutBounce: function(a, b, c, d, e) {
        return e / 2 > b ? .5 * jQuery.easing.easeInBounce(a, 2 * b, 0, d, e) + c: .5 * jQuery.easing.easeOutBounce(a, 2 * b - e, 0, d, e) + .5 * d + c
    }
}); !
function(a) {
    a(document).ready(function() {
        a(".ali-main-market .ali-main-market-box").mouseenter(function() {
            a(this).addClass("action").siblings().removeClass("action")
        })
    })
} (jQuery),
function(a) {
    function b(a) {
        a = a.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var b = new RegExp("[\\?&]" + a + "=([^&#]*)"),
        c = b.exec(location.search);
        return null === c ? "": decodeURIComponent(c[1].replace(/\+/g, " "))
    }
    a(document).ready(function() {
        "en" != b("lang") && a.ajax({
            url: "//www.kuaitoujiqi.com/",
            dataType: "jsonp",
            data: {
                pageSize: 15,
                noticeType: "noticelist"
            },
            jsonpCallback: "noticeListJsonpCallback"
        }).done(function(b) {
            b = b.result;
            var c = ['<div class="y-row">', '<div class="y-span1" style="text-align: right;">', '<span class="icon icon-bullhorn"></span>', "</div>"];
            "200" == b.code ? (a.each((b.data || []).slice(0, 3),
            function(a, b) {
                var d = new Date(b.publicTime),
                e = "[" + (d.getMonth() + 1) + "-" + d.getDate() + "]",
                f = "//www.kuaitoujiqi.com/news/article/" + b.knowledgeId + ".html";
                c.push('<div class="y-span3"><span>·&nbsp;</span>'),
                c.push(' <a title="' + b.title + '" href="' + f + '" target="_blank" class="y-clear"><span>' + e + '</span><span class="title">' + b.title + "</span></a>"),
                c.push("</div>")
            }), c.push('<div class="y-span2 y-last"><a href="http://www.kuaitoujiqi.com" target="_blank">更多&gt;&gt;</a>', "</div></div>"), b.data.length > 3 ? a("#J_notice").html(c.join("")) : a("#J_notice").hide()) : a("#J_notice").hide()
        })
    })
} (jQuery),
function(a) {
    function b(b) {
        this.allItems = a("#" + b).find("li"),
        this.init()
    }
    b.prototype = {
        init: function() {
            function b(b) {
                var c = a(this);
				var numId = a(this).attr("id").substr(3,1);
				
                d = setTimeout(function() {
                    c.addClass("active").siblings().removeClass("active");
					a(".imgChangeChild").eq(numId).parent().addClass("active").siblings().removeClass("active");
                },
                100)
            }
            function c(a) {
                d && (clearTimeout(d), d = null)
            }
            this.allItems.mouseenter(b).mouseleave(c);
            var d = null
        }
    },
    a(document).ready(function() {
        new b("J-ali-main-product-list")
    })
} (jQuery),
function(a) {
    a(document).ready(function() {
        a(".ali-main-plan-left li").mouseenter(function() {
            a(this).addClass("action").siblings().removeClass("action"),
            a(".ali-main-plan .ali-main-plan-right").hide(),
            a(a(".ali-main-plan .ali-main-plan-right")[parseInt(a(this).attr("num"))]).show()
        })
    })
} (jQuery),
function(a) {
    a(document).ready(function() {
        var b, c = 0,
        d = a("#J_slider>a").length,
        e = !1,
        f = a("#J-home-slider-wrap"),
        g = a("#J-home-slider-bg li"),
        h = null;
        a("#J-home-topbar-menu").mouseenter(function() {
            h && (clearTimeout(h), h = null),
            a(this).addClass("home-topbar-menu-hover")
        }).mouseleave(function() {
            var b = a(this);
            h = setTimeout(function() {
                b.removeClass("home-topbar-menu-hover")
            },
            300)
        }),
        a("#J_slider .background").each(function(b, c) {
            b && a(c).css({
                opacity: 0
            })
        });
        var i = function(b, c) {
            var d = a('#J_slider .item[num="' + b + '"]'),
            h = a('#J_slider .item[num="' + c + '"]');
            if (!e) {
                e = !0;
                var i = a.Deferred(),
                j = a.Deferred();
                setTimeout(function() {
                    j.resolve()
                },
                400),
                h.find(".sublayer").animate({
                    top: "-50px",
                    opacity: 0
                },
                400, "easeInQuart",
                function() {
                    i.resolve()
                }),
                a.when(i, j).then(function(h) {
                    function i() {
                        d.find(".sublayer").animate({
                            top: 0,
                            opacity: 1
                        },
                        400, "easeOutCubic",
                        function() {
                            e = !1
                        })
                    }
                    f[0].className = "J-home-slider-" + g.eq(b).attr("slider-bg-class");
                    var j = g.eq(c);
                    j.animate({
                        opacity: 0
                    },
                    500, "linear",
                    function() {
                        a("#J_slider .item").hide(),
                        d.find(".sublayer").css({
                            top: "-50px",
                            opacity: 0
                        }),
                        d.show(),
                        a('.nav>i[num="' + b + '"]').addClass("action").siblings().removeClass("action")
                    }),
                    g.eq(b).animate({
                        opacity: 1
                    },
                    500, "linear", i)
                })
            }
        };
        a(".nav i").click(function() {
            d = c;
            var b = parseInt(a(this).attr("num"));
            e || d == b || (c = b, i(b, d))
        }),
        a("#J_slider").mouseenter(function() {
            window.clearInterval(b)
        }).mouseleave(function() {
            window.clearInterval(b),
            j()
        });
        var j = function() {
            b = setInterval(function() {
                d = c,
                c++,
                a("#J_slider>a").length == c && (c = 0),
                i(c, d)
            },
            5e3)
        };
        j();
        var k = a(".ali-main-product-other-box>div"),
        l = a(".ali-main-product-other-box>span"),
        m = {};
        a(".ali-main-product-other-box").css({
            position: "absolute"
        });
        var n = a("#J_slider"),
        o = function() {
            n.width() >= 1400 && n.width() < 1500 ? n.addClass("sm1").removeClass("sm1").removeClass("sm2") : n.width() < 1300 ? n.addClass("sm").removeClass("sm1").removeClass("sm2") : n.width() >= 1300 && n.width() < 1400 ? n.addClass("sm2").removeClass("sm1").removeClass("sm") : n.removeClass("sm").removeClass("sm1"),
            m && clearTimeout(m),
            m = setTimeout(function() {
                var b = a("#J_swiper").width();
                b = Math.floor((b - 50) / 3),
                316 > b ? b = 316 : "",
                k.width(b),
                a(".ali-main-product-other-box").width(k.width() * k.length + l.width() * l.length + 10),
                a("#J_swiper_page li:first").click();
                var c = a(".y-row").width();
                1e3 == c ? (a(".ali-main-bigpic-content").addClass("ali-main-bigpic-content-1000"), a(".ali-main-product-other-box").addClass(".ali-main-product-other-box-1000")) : (a(".ali-main-bigpic-content").removeClass("ali-main-bigpic-content-1000"), a(".ali-main-product-other-box").removeClass(".ali-main-product-other-box-1000"))
            },
            300)
        };
        o(),
        a(window).bind("resize.body", o),
        a(".ali-main-product-other-box > *").show(),
        a("#J_plan_av").delegate("li", "mouseenter",
        function() {
            a('.ali-main-plan-cell[num="' + a(this).attr("num") + '"]').show().siblings("div").hide(),
            a(this).addClass("action").siblings().removeClass("action")
        }),
        a(".ali-main-plan-img>a").each(function() {
            a(this).attr("href").length || a(this).removeAttr("href")
        })
    })
} (jQuery),
function(a) {
    a(document).ready(function() {
        a(".ali-main-special li").mouseenter(function() {
            a(this).addClass("hover").siblings().removeClass("hover")
        })
    })
} (jQuery);