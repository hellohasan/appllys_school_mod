(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/academic-exam-show"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'Show',
  data: function data() {
    return {
      exam: [],
      basic: []
    };
  },
  methods: {
    examAssign: function examAssign(custom, id) {
      var _this = this;

      Swal.fire({
        title: this.$t("confirm_title"),
        text: this.$t("confirm_message"),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: this.$t("confirm"),
        cancelButtonText: this.$t("cancel")
      }).then(function (result) {
        if (result.isConfirmed) {
          axios.post('/api/academic-exam-assign', {
            custom: custom,
            id: id
          }).then(function (res) {
            _this.loadAcademicExamDetails();

            Toast.fire({
              icon: "success",
              text: _this.$t("success_message_create")
            });
          });
        }
      });
    },
    loadAcademicExamDetails: function loadAcademicExamDetails() {
      var _this2 = this;

      axios.get("/api/academic-exam/".concat(this.$route.params.custom)).then(function (res) {
        _this2.exam = res.data;
      });
    }
  },
  created: function created() {
    this.loadAcademicExamDetails();
    this.basic = this.$store.getters.basicData;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true& ***!
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
  return _c(
    "custom-card",
    {
      attrs: {
        title: _vm.$t("ShowExam"),
        url: "/academic-exam",
        text: _vm.$t("ExamList")
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
            ]),
            _vm._v(" "),
            _c("hr")
          ]),
          _vm._v(" "),
          _vm.exam != ""
            ? _c("div", { staticClass: "col-12 mt-1" }, [
                _c(
                  "table",
                  { staticClass: "table table-striped table-bordered" },
                  [
                    _c("tr", [
                      _c("th", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("Title")))
                      ]),
                      _vm._v(" "),
                      _c("th", [_vm._v(_vm._s(_vm.$t("Details")))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("Custom")))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.exam.custom))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("Academic_Session")))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.exam.session.duration))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("Title")))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.exam.title))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("DateRange")))
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(_vm._f("myDate")(_vm.exam.start_date)) +
                            " to " +
                            _vm._s(_vm._f("myDate")(_vm.exam.end_date))
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("CreateBy")))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.exam.creator.name))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("td", { staticClass: "text-right" }, [
                        _vm._v(_vm._s(_vm.$t("CreatedAt")))
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(_vm._f("myDate")(_vm.exam.created_at)))
                      ])
                    ])
                  ]
                )
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("div", { staticClass: "col-12" }, [
            _c("table", { staticClass: "table table-bordered table-striped" }, [
              _c("thead", [
                _c("tr", [
                  _c("th", [_vm._v(_vm._s(_vm.$t("AcademicDetails")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("TotalStudent")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("Published")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("Action")))])
                ])
              ]),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.exam.classes, function(list, i) {
                  return _c("tr", { key: i }, [
                    _c("td", [
                      _vm._v(
                        "\n\t\t\t\t\t\t\t\t" +
                          _vm._s(list.level.details.details) +
                          "\n\t\t\t\t\t\t\t"
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\n\t\t\t\t\t\t\t\t" +
                          _vm._s(_vm._f("students")(list.total_students)) +
                          "\n\t\t\t\t\t\t\t"
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "td",
                      [
                        list.is_assigned
                          ? [
                              _c(
                                "label",
                                { staticClass: "badge badge-success" },
                                [_vm._v("Assigned")]
                              )
                            ]
                          : [
                              _c(
                                "label",
                                { staticClass: "badge badge-warning" },
                                [_vm._v("Pending")]
                              )
                            ]
                      ],
                      2
                    ),
                    _vm._v(" "),
                    _c("td", [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-warning btn-sm",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              return _vm.examAssign(_vm.exam.custom, list.id)
                            }
                          }
                        },
                        [_vm._v("Assign Now")]
                      )
                    ])
                  ])
                }),
                0
              )
            ])
          ])
        ])
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Academic/Exam/Show.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Show.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Show.vue?vue&type=template&id=c25a51e0&scoped=true& */ "./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true&");
/* harmony import */ var _Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Show.vue?vue&type=script&lang=js& */ "./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "c25a51e0",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Academic/Exam/Show.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Show.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Show.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Show.vue?vue&type=template&id=c25a51e0&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Show.vue?vue&type=template&id=c25a51e0&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Show_vue_vue_type_template_id_c25a51e0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);