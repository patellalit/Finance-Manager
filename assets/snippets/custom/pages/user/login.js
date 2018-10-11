var SnippetLogin = function() {
    var s = $("#m_login"),
        n = function(e, i, a) {
            var l = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(), l.prependTo(e), mUtil.animateClass(l[0], "fadeIn animated"), l.find("span").html(a)
        },
        o = function() {
            s.removeClass("m-login--forget-password"), s.removeClass("m-login--signup"), s.addClass("m-login--signin"), mUtil.animateClass(s.find(".m-login__signin")[0], "flipInX animated")
        },
        e = function() {
            $("#m_login_forget_password").click(function(e) {
                e.preventDefault(), s.removeClass("m-login--signin"), s.removeClass("m-login--signup"), s.addClass("m-login--forget-password"), mUtil.animateClass(s.find(".m-login__forget-password")[0], "flipInX animated")
            }), $("#m_login_forget_password_cancel").click(function(e) {
                e.preventDefault(), o()
            }), $("#m_login_signup").click(function(e) {
                e.preventDefault(), s.removeClass("m-login--forget-password"), s.removeClass("m-login--signin"), s.addClass("m-login--signup"), mUtil.animateClass(s.find(".m-login__signup")[0], "flipInX animated")
            }), $("#m_login_signup_cancel").click(function(e) {
                e.preventDefault(), o()
            })
        };
    return {
        init: function() {
            e(), $("#m_login_signin_submit").click(function(e) {
                e.preventDefault();
                var t = $(this),
                    r = $(this).closest("form");
                var login_action = $(this).closest("form").attr('action');

                r.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        }
                    }
                }), r.valid() && (t.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), r.ajaxSubmit({
                    url: login_action,
                    success: function(e, i, a, l) {

                    	var login_errordata =jQuery.parseJSON(a.responseText);
                		//console.log(login_errordata);
          				if($.isEmptyObject(login_errordata.error))
          				{
	                        window.location.href = $("#dashboard_url").val();
                    	}else{
                    		 setTimeout(function() {
                            t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n(r, "danger",login_errordata.error)
                        	}, 2e3)
                    	}
                        // setTimeout(function() {
                        //     t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n(r, "danger", "Incorrect username or password. Please try again.")
                        // }, 2e3)
                    }
                }))
            }), $("#m_login_signup_submit").click(function(e) {
                e.preventDefault();
                var t = $(this),
                    r = $(this).closest("form");
                    var action = $(this).closest("form").attr('action');
                    //console.log(action);
                    
                r.validate({
                    rules: {
                        fullname: {
                            required: !0
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        rpassword: {
                            required: !0
                        },
                        agree: {
                            required: !0
                        }
                    }
                }), r.valid() && (t.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), r.ajaxSubmit({
                    url: action,
                    success: function(e, i, a, l) {
                    	var error_data =jQuery.parseJSON(a.responseText);

          				if($.isEmptyObject(error_data.error))
          				{
	                        setTimeout(function() {
	                            t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), o();
	                            var e = s.find(".m-login__signin form");
	                            e.clearForm(), e.validate().resetForm(), n(e, "success", "Thank you. To complete your registration.")
	                        }, 2e3)
                    	}else{
                    		setTimeout(function() {
                            t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n(r, "danger", error_data.error)
                        	}, 2e3)
                    		//console.warn(error_data.error);
                    	}
                    }
                }))
            }), $("#m_login_forget_password_submit").click(function(e) {
                e.preventDefault();
                var t = $(this),
                    r = $(this).closest("form");
                r.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        }
                    }
                }), r.valid() && (t.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), r.ajaxSubmit({
                    url: "",
                    success: function(e, i, a, l) {
                        setTimeout(function() {
                            t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), o();
                            var e = s.find(".m-login__signin form");
                            e.clearForm(), e.validate().resetForm(), n(e, "success", "Cool! Password recovery instruction has been sent to your email.")
                        }, 2e3)
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function() {
    SnippetLogin.init()
});