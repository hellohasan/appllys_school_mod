(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/salary-show"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "Show",
  data: function data() {
    return {
      salary: '',
      salaries: {},
      basic: {}
    };
  },
  methods: {
    printMe: function printMe(divName) {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _this.$htmlToPaper(divName);

              case 2:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    showSalary: function showSalary(custom) {
      var _this2 = this;

      axios.get("/api/salary/".concat(custom)).then(function (res) {
        _this2.salary = res.data;
        _this2.salaries = res.data.salaries;
      });
    }
  },
  created: function created() {
    this.showSalary(this.$route.params.custom);
    this.basic = this.$store.getters.basicData;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true& ***!
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
  return _c(
    "custom-card",
    {
      attrs: {
        title: _vm.$t("ShowSalary"),
        url: "/salary",
        text: _vm.$t("SalaryList")
      }
    },
    [
      _c("div", { attrs: { id: "printAble" } }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-12" }, [
            _c("div", { staticClass: "text-center" }, [
              _c("h3", [_vm._v(_vm._s(_vm.basic.name))]),
              _vm._v(" "),
              _c("h5", [_vm._v(_vm._s(_vm.basic.address))]),
              _vm._v(" "),
              _c("h5", [
                _vm._v(_vm._s(_vm.$t("Phone")) + ": " + _vm._s(_vm.basic.phone))
              ])
            ])
          ]),
          _vm._v(" "),
          _vm.salary != ""
            ? _c("div", { staticClass: "col-12 mt-1" }, [
                _c("div", { staticClass: "d-flex justify-content-around" }, [
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.$t("Title")) + ": " + _vm._s(_vm.salary.title)
                    )
                  ]),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.$t("CreateBy")) +
                        ": " +
                        _vm._s(_vm.salary.creator.name)
                    )
                  ]),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.$t("CreatedFor")) +
                        ": " +
                        _vm._s(_vm.salary.role.name) +
                        " " +
                        _vm._s(_vm.$t("Salary"))
                    )
                  ]),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.$t("CreatedAt")) +
                        ": " +
                        _vm._s(_vm._f("myDate")(_vm.salary.created_at))
                    )
                  ])
                ])
              ])
            : _vm._e(),
          _vm._v(" "),
          _vm.salaries.length
            ? _c("div", { staticClass: "col-12 mt-1" }, [
                _c(
                  "table",
                  { staticClass: "table table-striped table-bordered" },
                  [
                    _c("thead", [
                      _c("tr", [
                        _c("td", [_vm._v(_vm._s(_vm.$t("Custom")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("Name")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("salary_scale")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("amount")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("PayVia")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("PayAt")))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(_vm.$t("Withdrawal")) + "?")])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "tbody",
                      _vm._l(_vm.salaries, function(item, i) {
                        return _c("tr", { key: i }, [
                          _c("td", [_vm._v(_vm._s(item.custom))]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(item.user.name))]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(item.scale.title))]),
                          _vm._v(" "),
                          _c("td", [
                            _vm._v(_vm._s(_vm._f("withCurrency")(item.amount)))
                          ]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(item.account.name))]),
                          _vm._v(" "),
                          _c("td", [
                            _vm._v(_vm._s(_vm._f("myDate")(item.created_at)))
                          ]),
                          _vm._v(" "),
                          _c("td", [
                            item.is_attempt
                              ? _c(
                                  "label",
                                  { staticClass: "badge badge-success" },
                                  [_vm._v(_vm._s(_vm.$t("Lifted")))]
                                )
                              : _c(
                                  "label",
                                  { staticClass: "badge badge-warning" },
                                  [_vm._v(_vm._s(_vm.$t("Pending")))]
                                )
                          ])
                        ])
                      }),
                      0
                    ),
                    _vm._v(" "),
                    _c("tfoot", [
                      _c("tr", [
                        _c(
                          "td",
                          {
                            staticClass: "text-right",
                            attrs: { colspan: "3" }
                          },
                          [_vm._v(_vm._s(_vm.$t("GrandTotal")))]
                        ),
                        _vm._v(" "),
                        _c("td", { attrs: { colspan: "3" } }, [
                          _vm._v(
                            _vm._s(_vm._f("withCurrency")(_vm.salary.total))
                          )
                        ])
                      ])
                    ])
                  ]
                )
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("div", { staticClass: "col-12" }, [
            _c("div", { staticClass: "d-flex justify-content-around mt-5" }, [
              _c("div", { staticClass: "text-center" }, [
                _c("p", [
                  _vm._v("---------------------------------- "),
                  _c("br"),
                  _vm._v(" " + _vm._s(_vm.$t("HeadSign")))
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "text-center" }, [
                _c("p", [
                  _vm._v("---------------------------------- "),
                  _c("br"),
                  _vm._v(" " + _vm._s(_vm.$t("AccountantSign")))
                ])
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "btn btn-success",
          attrs: { type: "button" },
          on: {
            click: function($event) {
              return _vm.printMe("printAble")
            }
          }
        },
        [
          _c("i", { staticClass: "fas fa-print" }),
          _vm._v(" " + _vm._s(_vm.$t("Print")))
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Show.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Show.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Show.vue?vue&type=template&id=0d8bbfd8&scoped=true& */ "./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true&");
/* harmony import */ var _Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Show.vue?vue&type=script&lang=js& */ "./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0d8bbfd8",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Accountant/Salary/Show.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Show.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Show.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Show.vue?vue&type=template&id=0d8bbfd8&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Show.vue?vue&type=template&id=0d8bbfd8&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_0d8bbfd8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);