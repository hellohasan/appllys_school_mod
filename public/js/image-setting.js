(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/image-setting"],{

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



/***/ })

}]);