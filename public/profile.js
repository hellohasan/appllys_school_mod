(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["profile"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      userDetails: {},
      form: new Form({
        name: null,
        email: null,
        bio: null,
        photo: null
      }),
      pForm: new Form({
        current_password: null,
        password: null,
        password_confirmation: null
      })
    };
  },
  methods: {
    updateProfile: function updateProfile() {
      var _this = this;

      this.form.post('/api/update-profile').then(function () {
        $('#inputPhoto').val('');
        _this.form.photo = null;

        _this.$store.dispatch('refreshCurrentUser');

        _this.getUserDetails();

        Toast.fire({
          icon: 'success',
          title: 'Profile successfully Updated.'
        });
      });
    },
    changePhoto: function changePhoto(e) {
      var _this2 = this;

      var file = e.target.files[0];
      var reader = new FileReader();

      reader.onloadend = function (file) {
        //console.log('result',reader.result)
        _this2.form.photo = reader.result;
      };

      reader.readAsDataURL(file);
    },
    updatePassword: function updatePassword() {
      var _this3 = this;

      this.pForm.post('/api/update-password').then(function () {
        _this3.pForm.reset();

        Toast.fire({
          icon: 'success',
          title: 'Password successfully Updated.'
        });
      })["catch"](function (error) {
        if (error.response.status === 400) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.response.data.message
          });
        }
      });
    },
    getUserDetails: function getUserDetails() {
      var _this4 = this;

      axios.get('/api/profile').then(function (_ref) {
        var data = _ref.data;

        _this4.form.fill(data);

        _this4.form.photo = null;
        _this4.userDetails = data;
      });
    }
  },
  created: function created() {
    this.getUserDetails();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Email.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/Email.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Email",
  data: function data() {
    return {
      form: new Form({
        sender_name: '',
        sender_email: '',
        mail_driver: '',
        smtp_host: '',
        smtp_port: '',
        smtp_username: '',
        smtp_password: '',
        smtp_enc: ''
      })
    };
  },
  methods: {
    submitEmailSetting: function submitEmailSetting() {
      var _this = this;

      this.form.post('/api/email-setting-update').then(function (response) {
        Toast.fire({
          icon: 'success',
          title: _this.$t('success_message')
        });
      })["catch"](function () {
        Swal.fire({
          icon: 'error',
          title: _this.$t('error_alert_title'),
          text: _this.$t('error_alert_text'),
          confirmButtonText: _this.$t('ok')
        });
      });
    },
    loadEmailSetting: function loadEmailSetting() {
      var _this2 = this;

      axios.get('api/email-setting').then(function (_ref) {
        var data = _ref.data;
        return _this2.form.fill(data);
      });
    }
  },
  created: function created() {
    this.loadEmailSetting();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_Summernote__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../globals/Summernote */ "./resources/js/components/globals/Summernote.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "EmailTemplate",
  components: {
    Summernote: _globals_Summernote__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      form: new Form({
        content: ''
      })
    };
  },
  methods: {
    submitEmailTemplate: function submitEmailTemplate() {
      var _this = this;

      this.form.post('api/update-email-template').then(function () {
        Toast.fire({
          icon: 'success',
          title: _this.$t('success_message')
        });
      });
    },
    loadEmailTemplate: function loadEmailTemplate() {
      var _this2 = this;

      axios.get('/api/get-email-template').then(function (res) {
        return _this2.form.content = res.data;
      });
    }
  },
  mounted: function mounted() {
    this.loadEmailTemplate();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ImageSetting",
  data: function data() {
    return {
      form: new Form({
        logo: '',
        favicon: ''
      }),
      oldLogo: '',
      oldFavicon: ''
    };
  },
  methods: {
    submitImage: function submitImage() {
      var _this = this;

      this.form.post('/api/update-logo').then(function () {
        Toast.fire({
          icon: 'success',
          title: _this.$t('success_message')
        });
      })["catch"](function () {
        return _this.form.reset();
      });
    }
  },
  created: function created() {
    this.oldLogo = "http://localhost:8000/" + 'img/logo.png';
    this.oldFavicon = "http://localhost:8000/" + 'img/favicon.png';
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Sms",
  data: function data() {
    return {
      message: '{{message}}',
      number: '{{number}}',
      form: new Form({
        'sms_api': ''
      })
    };
  },
  methods: {
    submitSmsApi: function submitSmsApi() {
      var _this = this;

      this.form.post('api/sms-api-update').then(function (res) {
        Toast.fire({
          icon: 'success',
          title: _this.$t('success_message')
        });
      })["catch"]();
    },
    loadSmsApi: function loadSmsApi() {
      var _this2 = this;

      axios.get('api/sms-api').then(function (_ref) {
        var data = _ref.data;
        return _this2.form.fill(data);
      });
    }
  },
  created: function created() {
    this.loadSmsApi();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Summernote",
  props: {
    value: {
      "default": ''
    },
    autofocus: {},
    placeholder: {
      type: String,
      "default": null
    },
    height: {
      type: Number,
      "default": 100
    }
  },
  data: function data() {
    return {
      minHeight: false
    };
  },
  watch: {
    value: function value(val) {
      if (this.summernote.summernote('code') !== val) {
        //this.summernote.summernote("editor.rewind")
        this.summernote.summernote('code', val);
      }
    }
  },
  computed: {
    id: function id() {
      return "sn_" + Date.now();
    }
  },
  beforeDestroy: function beforeDestroy() {
    $("#" + this.id).summernote("destroy");
  },
  mounted: function mounted() {
    this.summernote = $("#" + this.id).summernote({
      height: this.height,
      minHeight: "100px",
      focus: typeof this.autofocus !== 'undefined',
      placeholder: this.placeholder,
      lineHeight: 20,
      toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']], ['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['table', ['table']], ['insert', ['picture', 'video']], ['view', ['fullscreen', 'codeview', 'help']]]
    });
    this.summernote.on('summernote.change', this.onChange);
    $("#" + this.id).next().find(".note-toolbar").find("[data-toggle=dropdown]").attr('onclick', '$(this).next().toggle()').next().attr('onclick', '$(this).toggle()');
  },
  methods: {
    onChange: function onChange(we) {
      this.$emit('input', we.target.value);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.widget-user .widget-user-header[data-v-3bd692e4]{\n    background-position: center center;\n    background-size: cover;\n    height:200px\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-md-12" }, [
      _c("div", { staticClass: "card card-widget widget-user" }, [
        _c(
          "div",
          {
            staticClass: "widget-user-header text-white",
            staticStyle: {
              background: "url('./img/user-cover.png') center center"
            }
          },
          [
            _c("h3", { staticClass: "widget-user-username text-left" }, [
              _vm._v(_vm._s(_vm.userDetails.name))
            ]),
            _vm._v(" "),
            _c(
              "h5",
              { staticClass: "widget-user-desc text-left" },
              [
                _vm._l(_vm.userDetails.roles, function(role) {
                  return [_vm._v(_vm._s(_vm._f("capitalize")(role.name)))]
                })
              ],
              2
            )
          ]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "widget-user-image" }, [
          !_vm.userDetails.photo
            ? _c("div", { staticClass: "ph-avatar img-circle" })
            : _c("img", {
                staticClass: "img-circle",
                attrs: { src: _vm.userDetails.photo, alt: "User Avatar" }
              })
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-12" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-header p-2" }, [
          _c("ul", { staticClass: "nav nav-pills" }, [
            _c("li", { staticClass: "nav-item" }, [
              _c(
                "a",
                {
                  staticClass: "nav-link active",
                  attrs: { href: "#profile", "data-toggle": "tab" }
                },
                [_vm._v(_vm._s(_vm.$t("your_info")))]
              )
            ]),
            _vm._v(" "),
            _c("li", { staticClass: "nav-item" }, [
              _c(
                "a",
                {
                  staticClass: "nav-link",
                  attrs: { href: "#password", "data-toggle": "tab" }
                },
                [_vm._v(_vm._s(_vm.$t("password")))]
              )
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _c("div", { staticClass: "tab-content" }, [
            _c(
              "div",
              { staticClass: "tab-pane active", attrs: { id: "profile" } },
              [
                _c(
                  "form",
                  {
                    staticClass: "form-horizontal",
                    attrs: { enctype: "multipart" },
                    on: {
                      submit: function($event) {
                        $event.preventDefault()
                        return _vm.updateProfile($event)
                      },
                      keydown: function($event) {
                        return _vm.form.onKeydown($event)
                      }
                    }
                  },
                  [
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-sm-2 col-form-label",
                          attrs: { for: "inputName1" }
                        },
                        [_vm._v(_vm._s(_vm.$t("Name")))]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col-sm-10" },
                        [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.name,
                                expression: "form.name"
                              }
                            ],
                            staticClass: "form-control",
                            class: {
                              "is-invalid": _vm.form.errors.has("name")
                            },
                            attrs: {
                              type: "text",
                              id: "inputName1",
                              placeholder: "Name"
                            },
                            domProps: { value: _vm.form.name },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(_vm.form, "name", $event.target.value)
                              }
                            }
                          }),
                          _vm._v(" "),
                          _c("has-error", {
                            attrs: { form: _vm.form, field: "name" }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-sm-2 col-form-label",
                          attrs: { for: "inputEmail" }
                        },
                        [_vm._v("Email")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col-sm-10" },
                        [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.email,
                                expression: "form.email"
                              }
                            ],
                            staticClass: "form-control",
                            class: {
                              "is-invalid": _vm.form.errors.has("email")
                            },
                            attrs: {
                              type: "email",
                              id: "inputEmail",
                              placeholder: "Email"
                            },
                            domProps: { value: _vm.form.email },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(_vm.form, "email", $event.target.value)
                              }
                            }
                          }),
                          _vm._v(" "),
                          _c("has-error", {
                            attrs: { form: _vm.form, field: "email" }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-sm-2 col-form-label",
                          attrs: { for: "inputExperience" }
                        },
                        [_vm._v("Experience")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col-sm-10" },
                        [
                          _c("textarea", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.bio,
                                expression: "form.bio"
                              }
                            ],
                            staticClass: "form-control",
                            class: { "is-invalid": _vm.form.errors.has("bio") },
                            attrs: {
                              id: "inputExperience",
                              placeholder: "Experience"
                            },
                            domProps: { value: _vm.form.bio },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(_vm.form, "bio", $event.target.value)
                              }
                            }
                          }),
                          _vm._v(" "),
                          _c("has-error", {
                            attrs: { form: _vm.form, field: "bio" }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-sm-2 col-form-label",
                          attrs: { for: "inputPhoto" }
                        },
                        [_vm._v("Profile Photo")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col-sm-10" },
                        [
                          _c("input", {
                            staticClass: "form-control-file",
                            class: {
                              "is-invalid": _vm.form.errors.has("photo")
                            },
                            attrs: {
                              type: "file",
                              accept: "image/*",
                              id: "inputPhoto"
                            },
                            on: { change: _vm.changePhoto }
                          }),
                          _vm._v(" "),
                          _c("has-error", {
                            attrs: { form: _vm.form, field: "photo" }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c("div", { staticClass: "offset-sm-2 col-sm-10" }, [
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-success",
                            attrs: { type: "submit", disabled: _vm.form.busy }
                          },
                          [_vm._v(_vm._s(_vm.$t("update")))]
                        )
                      ])
                    ])
                  ]
                )
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "tab-pane", attrs: { id: "password" } }, [
              _c(
                "form",
                {
                  staticClass: "form-horizontal",
                  on: {
                    submit: function($event) {
                      $event.preventDefault()
                      return _vm.updatePassword($event)
                    },
                    keydown: function($event) {
                      return _vm.form.onKeydown($event)
                    }
                  }
                },
                [
                  _c("div", { staticClass: "form-group row" }, [
                    _c(
                      "label",
                      {
                        staticClass: "col-sm-2 col-form-label",
                        attrs: { for: "inputName" }
                      },
                      [_vm._v("Current Password")]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-sm-10" },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.pForm.current_password,
                              expression: "pForm.current_password"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.pForm.errors.has(
                              "current_password"
                            )
                          },
                          attrs: {
                            type: "password",
                            id: "inputName",
                            placeholder: "Current Password"
                          },
                          domProps: { value: _vm.pForm.current_password },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.pForm,
                                "current_password",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.pForm, field: "current_password" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c(
                      "label",
                      {
                        staticClass: "col-sm-2 col-form-label",
                        attrs: { for: "inputPassword" }
                      },
                      [_vm._v("New Password")]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-sm-10" },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.pForm.password,
                              expression: "pForm.password"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.pForm.errors.has("password")
                          },
                          attrs: {
                            type: "password",
                            id: "inputPassword",
                            placeholder: "New Password"
                          },
                          domProps: { value: _vm.pForm.password },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.pForm,
                                "password",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.pForm, field: "password" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c(
                      "label",
                      {
                        staticClass: "col-sm-2 col-form-label",
                        attrs: { for: "inputName4" }
                      },
                      [_vm._v("Confirm Password")]
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-10" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.pForm.password_confirmation,
                            expression: "pForm.password_confirmation"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "password",
                          id: "inputName4",
                          placeholder: "Confirm Password"
                        },
                        domProps: { value: _vm.pForm.password_confirmation },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.pForm,
                              "password_confirmation",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("div", { staticClass: "offset-sm-2 col-sm-10" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-success",
                          attrs: { type: "submit", disabled: _vm.form.busy }
                        },
                        [_vm._v("Submit")]
                      )
                    ])
                  ])
                ]
              )
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("card", { attrs: { title: _vm.$t("Email_setting") } }, [
    _c(
      "form",
      {
        attrs: { role: "form", method: "post" },
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.submitEmailSetting($event)
          }
        }
      },
      [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("div", { staticClass: "col-md-6" }, [
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c("label", { attrs: { for: "sender_name" } }, [
                    _vm._v("Sender Name")
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.form.sender_name,
                        expression: "form.sender_name"
                      }
                    ],
                    staticClass: "form-control",
                    class: { "is-invalid": _vm.form.errors.has("sender_name") },
                    attrs: {
                      type: "text",
                      id: "sender_name",
                      placeholder: "Sender Name"
                    },
                    domProps: { value: _vm.form.sender_name },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.form, "sender_name", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("has-error", {
                    attrs: { form: _vm.form, field: "sender_name" }
                  })
                ],
                1
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c("label", { attrs: { for: "sender_email" } }, [
                    _vm._v("Sender Email")
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.form.sender_email,
                        expression: "form.sender_email"
                      }
                    ],
                    staticClass: "form-control",
                    class: {
                      "is-invalid": _vm.form.errors.has("sender_email")
                    },
                    attrs: {
                      type: "text",
                      id: "sender_email",
                      placeholder: "Sender Email"
                    },
                    domProps: { value: _vm.form.sender_email },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.form, "sender_email", $event.target.value)
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("has-error", {
                    attrs: { form: _vm.form, field: "sender_email" }
                  })
                ],
                1
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-12" }, [
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c("label", { attrs: { for: "mail_driver" } }, [
                    _vm._v("Email Driver")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.form.mail_driver,
                          expression: "form.mail_driver"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { name: "mail_driver", id: "mail_driver" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            _vm.form,
                            "mail_driver",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "mail" } }, [
                        _vm._v("PHP Mailer")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "smtp" } }, [
                        _vm._v("SMTP Driver")
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("has-error", {
                    attrs: { form: _vm.form, field: "mail_driver" }
                  })
                ],
                1
              )
            ]),
            _vm._v(" "),
            _vm.form.mail_driver === "smtp"
              ? [
                  _c("div", { staticClass: "col-md-6" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "smtp_host" } }, [
                          _vm._v("SMTP Host")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.smtp_host,
                              expression: "form.smtp_host"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.form.errors.has("smtp_host")
                          },
                          attrs: {
                            type: "text",
                            id: "smtp_host",
                            placeholder: "SMTP Host"
                          },
                          domProps: { value: _vm.form.smtp_host },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "smtp_host",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.form, field: "smtp_host" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-6" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "smtp_port" } }, [
                          _vm._v("SMTP Port")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.smtp_port,
                              expression: "form.smtp_port"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.form.errors.has("smtp_port")
                          },
                          attrs: {
                            type: "number",
                            id: "smtp_port",
                            placeholder: "SMTP Port"
                          },
                          domProps: { value: _vm.form.smtp_port },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "smtp_port",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.form, field: "smtp_port" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "smtp_username" } }, [
                          _vm._v("SMTP Username")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.smtp_username,
                              expression: "form.smtp_username"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.form.errors.has("smtp_username")
                          },
                          attrs: {
                            type: "text",
                            id: "smtp_username",
                            placeholder: "SMTP Username"
                          },
                          domProps: { value: _vm.form.smtp_username },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "smtp_username",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.form, field: "smtp_username" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "smtp_password" } }, [
                          _vm._v("SMTP Password")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.smtp_password,
                              expression: "form.smtp_password"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.form.errors.has("smtp_password")
                          },
                          attrs: {
                            type: "text",
                            id: "smtp_password",
                            placeholder: "SMTP Password"
                          },
                          domProps: { value: _vm.form.smtp_password },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "smtp_password",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.form, field: "smtp_password" }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "smtp_enc" } }, [
                          _vm._v("SMTP Encryption")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.smtp_enc,
                              expression: "form.smtp_enc"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.form.errors.has("smtp_enc")
                          },
                          attrs: {
                            type: "text",
                            id: "smtp_enc",
                            placeholder: "SMTP Encryption"
                          },
                          domProps: { value: _vm.form.smtp_enc },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "smtp_enc",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: { form: _vm.form, field: "smtp_enc" }
                        })
                      ],
                      1
                    )
                  ])
                ]
              : _vm._e(),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-12" }, [
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c("v-button", { attrs: { loading: _vm.form.busy } }, [
                    _c("i", { staticClass: "fas fa-cogs" }),
                    _vm._v(
                      " " + _vm._s(_vm.$t("Update")) + "\n                    "
                    )
                  ])
                ],
                1
              )
            ])
          ],
          2
        )
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("card", { attrs: { title: _vm.$t("Email_template") } }, [
    _c(
      "form",
      {
        attrs: { role: "form", method: "post" },
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.submitEmailTemplate($event)
          }
        }
      },
      [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-sm-12" }, [
            _c(
              "div",
              { staticClass: "form-group" },
              [
                _c("summernote", {
                  class: { "is-invalid": _vm.form.errors.has("content") },
                  attrs: { height: 320 },
                  model: {
                    value: _vm.form.content,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "content", $$v)
                    },
                    expression: "form.content"
                  }
                }),
                _vm._v(" "),
                _c("has-error", { attrs: { form: _vm.form, field: "content" } })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "form-group" },
              [
                _c("v-button", { attrs: { loading: _vm.form.busy } }, [
                  _c("i", { staticClass: "fas fa-cogs" }),
                  _vm._v(
                    " " + _vm._s(_vm.$t("update")) + "\n                    "
                  )
                ])
              ],
              1
            )
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("card", { attrs: { title: _vm.$t("image_setting") } }, [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-5 col-sm-3" }, [
        _c(
          "div",
          {
            staticClass: "nav flex-column nav-tabs h-100",
            attrs: {
              id: "vert-tabs-tab",
              role: "tablist",
              "aria-orientation": "vertical"
            }
          },
          [
            _c(
              "a",
              {
                staticClass: "nav-link active",
                attrs: {
                  id: "vert-tabs-logo-tab",
                  "data-toggle": "pill",
                  href: "#vert-tabs-logo",
                  role: "tab",
                  "aria-controls": "vert-tabs-logo",
                  "aria-selected": "true"
                }
              },
              [_vm._v("Logo & Favicon")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "nav-link",
                attrs: {
                  id: "vert-tabs-pad-tab",
                  "data-toggle": "pill",
                  href: "#vert-tabs-pad",
                  role: "tab",
                  "aria-controls": "vert-tabs-pad",
                  "aria-selected": "true"
                }
              },
              [_vm._v("Manage Pad")]
            )
          ]
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-7 col-sm-9" }, [
        _c(
          "div",
          { staticClass: "tab-content", attrs: { id: "vert-tabs-tabContent" } },
          [
            _c(
              "div",
              {
                staticClass: "tab-pane text-left fade show active",
                attrs: {
                  id: "vert-tabs-logo",
                  role: "tabpanel",
                  "aria-labelledby": "vert-tabs-logo-tab"
                }
              },
              [
                _c("div", { staticClass: "card card-secondary card-outline" }, [
                  _c("div", { staticClass: "card-header" }, [
                    _c("h3", { staticClass: "card-title" }, [
                      _vm._v(
                        "\n                                Update Logo & Favicon\n                            "
                      )
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "card-body" }, [
                    _c(
                      "form",
                      {
                        attrs: {
                          role: "form",
                          method: "post",
                          enctype: "multipart/form-data"
                        },
                        on: {
                          submit: function($event) {
                            $event.preventDefault()
                            return _vm.submitImage($event)
                          }
                        }
                      },
                      [
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-4" }, [
                            _c(
                              "div",
                              { staticClass: "form-group" },
                              [
                                _c("label", { attrs: { for: "logo" } }, [
                                  _vm._v("Site Logo: ")
                                ]),
                                _vm._v(" "),
                                _c("v-image", {
                                  class: {
                                    "is-invalid": _vm.form.errors.has("logo")
                                  },
                                  attrs: {
                                    custom: "Choice Logo",
                                    "default-image": "" + _vm.oldLogo,
                                    "input-name": "logo"
                                  },
                                  model: {
                                    value: _vm.form.logo,
                                    callback: function($$v) {
                                      _vm.$set(_vm.form, "logo", $$v)
                                    },
                                    expression: "form.logo"
                                  }
                                }),
                                _vm._v(" "),
                                _c("has-error", {
                                  attrs: { form: _vm.form, field: "logo" }
                                })
                              ],
                              1
                            )
                          ]),
                          _vm._v(" "),
                          _c("div", { staticClass: "col-md-4" }, [
                            _c(
                              "div",
                              { staticClass: "form-group" },
                              [
                                _c("label", { attrs: { for: "favicon" } }, [
                                  _vm._v("Favicon Image: ")
                                ]),
                                _vm._v(" "),
                                _c("v-image", {
                                  class: {
                                    "is-invalid": _vm.form.errors.has("favicon")
                                  },
                                  attrs: {
                                    custom: "Choice Favicon",
                                    "default-image": "" + _vm.oldFavicon,
                                    "input-name": "favicon"
                                  },
                                  model: {
                                    value: _vm.form.favicon,
                                    callback: function($$v) {
                                      _vm.$set(_vm.form, "favicon", $$v)
                                    },
                                    expression: "form.favicon"
                                  }
                                }),
                                _vm._v(" "),
                                _c("has-error", {
                                  attrs: { form: _vm.form, field: "favicon" }
                                })
                              ],
                              1
                            )
                          ]),
                          _vm._v(" "),
                          _c("div", { staticClass: "col-md-4" })
                        ]),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "form-group" },
                          [
                            _c(
                              "v-button",
                              { attrs: { loading: _vm.form.busy } },
                              [
                                _c("i", { staticClass: "fas fa-cogs" }),
                                _vm._v(
                                  " " +
                                    _vm._s(_vm.$t("Update")) +
                                    "\n                                    "
                                )
                              ]
                            )
                          ],
                          1
                        )
                      ]
                    )
                  ])
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "tab-pane text-left fade",
                attrs: {
                  id: "vert-tabs-pad",
                  role: "tabpanel",
                  "aria-labelledby": "vert-tabs-pad-tab"
                }
              },
              [
                _c("h3", [_vm._v("Update Banner Image")]),
                _vm._v(" "),
                _c(
                  "form",
                  {
                    attrs: {
                      action: "",
                      role: "form",
                      method: "post",
                      enctype: "multipart/form-data"
                    }
                  },
                  [
                    _c("div", { staticClass: "form-group" }, [
                      _c("code", [
                        _vm._v(
                          "Size : 1920X1080. Image extension only .jpg supported. After update press CTRL+F5\n                                button or clear browser cache."
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group" }, [
                      _c(
                        "button",
                        {
                          staticClass:
                            "btn btn-primary btn-block btn-lg bold uppercase",
                          attrs: { type: "submit" }
                        },
                        [
                          _c("i", { staticClass: "fas fa-paper-plane" }),
                          _vm._v(" Update Banner\n                            ")
                        ]
                      )
                    ])
                  ]
                )
              ]
            )
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("card", { attrs: { title: _vm.$t("Sms_setting") } }, [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-12" }, [
        _c("div", { staticClass: "table-scrollable" }, [
          _c(
            "table",
            { staticClass: "table table-striped bg-info table-bordered" },
            [
              _c("thead", [
                _c("tr", [
                  _c("th", [_vm._v(" #")]),
                  _vm._v(" "),
                  _c("th", [_vm._v(" CODE")]),
                  _vm._v(" "),
                  _c("th", [_vm._v(" DESCRIPTION")])
                ])
              ]),
              _vm._v(" "),
              _c("tbody", [
                _c("tr", [
                  _c("td", [_vm._v(" 1")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" username=*******")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" Replace ******** With your username.")])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", [_vm._v(" 2")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" password=*******")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" Replace ******** With your password.")])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", [_vm._v(" 3")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" " + _vm._s(_vm.message))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" Message Text. Which Text User Receive.")])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", [_vm._v(" 4")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" " + _vm._s(_vm.number))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" User Receive Number")])
                ])
              ])
            ]
          )
        ]),
        _vm._v(" "),
        _c("hr"),
        _vm._v(" "),
        _c(
          "form",
          {
            staticClass: "form-horizontal",
            attrs: { method: "post", role: "form" },
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.submitSmsApi($event)
              }
            }
          },
          [
            _c("div", { staticClass: "form-body" }, [
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c("label", { attrs: { for: "sms_api" } }, [
                    _vm._v("SMS API")
                  ]),
                  _vm._v(" "),
                  _c(
                    "textarea",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.form.sms_api,
                          expression: "form.sms_api"
                        }
                      ],
                      staticClass: "form-control",
                      class: { "is-invalid": _vm.form.errors.has("sms_api") },
                      attrs: { rows: "3", id: "sms_api", placeholder: "API" },
                      domProps: { value: _vm.form.sms_api },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(_vm.form, "sms_api", $event.target.value)
                        }
                      }
                    },
                    [_vm._v("{!! $basic->smsapi !!}")]
                  ),
                  _vm._v(" "),
                  _c("has-error", {
                    attrs: { form: _vm.form, field: "sms_api" }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "form-group" },
                [
                  _c(
                    "v-button",
                    {
                      attrs: {
                        loading: _vm.form.busy,
                        block: true,
                        large: true
                      }
                    },
                    [
                      _c("i", { staticClass: "fas fa-cogs" }),
                      _vm._v(
                        " " +
                          _vm._s(_vm.$t("Update")) +
                          "\n                        "
                      )
                    ]
                  )
                ],
                1
              )
            ])
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("textarea", {
    attrs: { id: _vm.id },
    domProps: { value: _vm.value },
    on: { change: _vm.onChange }
  })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Profile.vue":
/*!*********************************************!*\
  !*** ./resources/js/components/Profile.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Profile.vue?vue&type=template&id=3bd692e4&scoped=true& */ "./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true&");
/* harmony import */ var _Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Profile.vue?vue&type=script&lang=js& */ "./resources/js/components/Profile.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& */ "./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3bd692e4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Profile.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Profile.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Profile.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Profile.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& ***!
  \******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=style&index=0&id=3bd692e4&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_style_index_0_id_3bd692e4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Profile.vue?vue&type=template&id=3bd692e4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile.vue?vue&type=template&id=3bd692e4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_3bd692e4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Settings/Email.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/Settings/Email.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Email.vue?vue&type=template&id=1f7d99bb&scoped=true& */ "./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true&");
/* harmony import */ var _Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Email.vue?vue&type=script&lang=js& */ "./resources/js/components/Settings/Email.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1f7d99bb",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Settings/Email.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Settings/Email.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/Settings/Email.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Email.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Email.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Email.vue?vue&type=template&id=1f7d99bb&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Email.vue?vue&type=template&id=1f7d99bb&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_1f7d99bb_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& */ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&");
/* harmony import */ var _EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EmailTemplate.vue?vue&type=script&lang=js& */ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "2e791a55",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Settings/EmailTemplate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmailTemplate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Settings/ImageSetting.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Settings/ImageSetting.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ImageSetting.vue?vue&type=template&id=14960126&scoped=true& */ "./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true&");
/* harmony import */ var _ImageSetting_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ImageSetting.vue?vue&type=script&lang=js& */ "./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ImageSetting_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "14960126",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Settings/ImageSetting.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageSetting_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageSetting.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/ImageSetting.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageSetting_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageSetting.vue?vue&type=template&id=14960126&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/ImageSetting.vue?vue&type=template&id=14960126&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageSetting_vue_vue_type_template_id_14960126_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Settings/Sms.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/Settings/Sms.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Sms.vue?vue&type=template&id=c2b2ca90&scoped=true& */ "./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true&");
/* harmony import */ var _Sms_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Sms.vue?vue&type=script&lang=js& */ "./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Sms_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "c2b2ca90",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Settings/Sms.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Sms_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Sms.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Sms.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Sms_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Sms.vue?vue&type=template&id=c2b2ca90&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/Sms.vue?vue&type=template&id=c2b2ca90&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sms_vue_vue_type_template_id_c2b2ca90_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& */ "./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&");
/* harmony import */ var _Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Summernote.vue?vue&type=script&lang=js& */ "./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0065c7ea",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/globals/Summernote.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Summernote.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);