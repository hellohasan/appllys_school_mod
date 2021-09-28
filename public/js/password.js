(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/password"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Password.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Password",
  data: function data() {
    return {
      userDetails: {},
      pForm: new Form({
        current_password: null,
        password: null,
        password_confirmation: null
      })
    };
  },
  methods: {
    updatePassword: function updatePassword() {
      var _this = this;

      this.pForm.post("/api/update-password").then(function () {
        _this.pForm.reset();

        Toast.fire({
          icon: "success",
          title: "Password successfully Updated."
        });
      })["catch"](function (error) {
        if (error.response.status === 400) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message
          });
        }
      });
    },
    getUserDetails: function getUserDetails() {
      var _this2 = this;

      axios.get("/api/profile").then(function (_ref) {
        var data = _ref.data;
        _this2.userDetails = data;
      });
    }
  },
  created: function created() {
    this.getUserDetails();
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".widget-user .widget-user-header[data-v-3bfc0a86] {\n  background-position: center center;\n  background-size: cover;\n  height: 200px;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
          _c("h6", [_vm._v(_vm._s(_vm.$t("password")))])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
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
                  return _vm.pForm.onKeydown($event)
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
                        "is-invalid": _vm.pForm.errors.has("current_password")
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
                      class: { "is-invalid": _vm.pForm.errors.has("password") },
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
                          _vm.$set(_vm.pForm, "password", $event.target.value)
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
                      attrs: { type: "submit", disabled: _vm.pForm.busy }
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
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Password.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/Password.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Password.vue?vue&type=template&id=3bfc0a86&scoped=true& */ "./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true&");
/* harmony import */ var _Password_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Password.vue?vue&type=script&lang=js& */ "./resources/js/components/Password.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& */ "./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Password_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3bfc0a86",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Password.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Password.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Password.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Password.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& ***!
  \********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=style&index=0&id=3bfc0a86&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_style_index_0_id_3bfc0a86_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Password.vue?vue&type=template&id=3bfc0a86&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Password.vue?vue&type=template&id=3bfc0a86&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Password_vue_vue_type_template_id_3bfc0a86_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);