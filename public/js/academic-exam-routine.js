(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/academic-exam-routine"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_CustomSelectMultiple__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../globals/CustomSelectMultiple */ "./resources/js/components/globals/CustomSelectMultiple.vue");
/* harmony import */ var validatorjs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! validatorjs */ "./node_modules/validatorjs/src/validator.js");
/* harmony import */ var validatorjs__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(validatorjs__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "Routine",
  components: {
    CustomSelectMultiple: _globals_CustomSelectMultiple__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      basic: {},
      exam: '',
      subjects: {},
      form: new Form({
        exam_id: '',
        routine: [{
          date: '',
          subject_ids: [],
          start_time: '',
          end_time: ''
        }]
      }),
      errors: []
    };
  },
  methods: {
    submitRoutine: function submitRoutine() {
      var _this = this;

      var validation = new validatorjs__WEBPACK_IMPORTED_MODULE_1__(this.form, {
        'exam_id': ['required'],
        'routine': ['required', 'array'],
        'routine.*.date': ['required'],
        'routine.*.subject_ids': ['required', 'array'],
        'routine.*.start_time': ['required'],
        'routine.*.end_time': ['required']
      });
      this.errors = [];

      if (validation.passes()) {
        this.form.post('/api/academic-exam-routine-submit').then(function (res) {
          Toast.fire({
            icon: "success",
            text: _this.$t("success_message_create")
          });

          _this.$router.push("/academic-exam/".concat(res.data.custom, "/routine/show"));
        });
      } else {
        this.errors = validation.errors.all();
      }
    },
    addNew: function addNew() {
      this.form.routine.push({
        date: '',
        subject_ids: [],
        start_time: '',
        end_time: ''
      });
    },
    deleteRoutine: function deleteRoutine(index) {
      if (this.form.routine.length > 1) {
        this.form.routine.splice(index, 1);
      }
    },
    choiceStart: function choiceStart(index, event) {
      if (event.target.checked) {
        var start_time = this.form.routine[index].start_time;
        this.form.routine.forEach(function (e) {
          e.start_time = start_time;
        });
      }
    },
    choiceEnd: function choiceEnd(index, event) {
      if (event.target.checked) {
        var end_time = this.form.routine[index].end_time;
        this.form.routine.forEach(function (e) {
          e.end_time = end_time;
        });
      }
    },
    loadExamSubjectList: function loadExamSubjectList(custom, id) {
      var _this2 = this;

      axios.get("/api/academic-exam-routine/".concat(custom)).then(function (res) {
        _this2.subjects = res.data.subjects;
        _this2.exam = res.data.exam;
        _this2.form.exam_id = res.data.exam.id;
        setTimeout(function () {
          _this2.form.routine = res.data.routines;
        }, 3000);
      });
    }
  },
  created: function created() {
    this.loadExamSubjectList(this.$route.params.custom, this.$route.params.id);
    this.basic = this.$store.getters.basicData;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true& ***!
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
  return _c(
    "custom-card",
    {
      attrs: {
        title: _vm.$t("ExamRoutine"),
        url: "/academic-exam",
        text: _vm.$t("ExamList")
      }
    },
    [
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
        _c("hr"),
        _vm._v(" "),
        _c("div", { staticClass: "col-12" }, [
          Object.keys(this.errors).length
            ? _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-12" }, [
                  _c(
                    "div",
                    {
                      staticClass:
                        "alert alert-warning alert-dismissible fade show",
                      attrs: { role: "alert" }
                    },
                    [
                      _c("h4", { staticClass: "alert-heading" }, [
                        _vm._v("Warning!")
                      ]),
                      _vm._v(" "),
                      _c(
                        "ul",
                        { staticClass: "list-group" },
                        _vm._l(_vm.errors, function(error, e) {
                          return _c(
                            "li",
                            { key: e, staticClass: "list-group-item" },
                            [_vm._v(_vm._s(error[0]))]
                          )
                        }),
                        0
                      ),
                      _vm._v(" "),
                      _c(
                        "button",
                        {
                          staticClass: "close",
                          attrs: {
                            type: "button",
                            "data-dismiss": "alert",
                            "aria-label": "Close"
                          }
                        },
                        [
                          _c("span", { attrs: { "aria-hidden": "true" } }, [
                            _vm._v("×")
                          ])
                        ]
                      )
                    ]
                  )
                ])
              ])
            : _vm._e(),
          _vm._v(" "),
          _c(
            "form",
            {
              on: {
                submit: function($event) {
                  $event.preventDefault()
                  return _vm.submitRoutine($event)
                }
              }
            },
            [
              _c(
                "table",
                { staticClass: "table table-bordered table-striped" },
                [
                  _c("thead", [
                    _c("tr", [
                      _c("th", { attrs: { width: "12%" } }, [
                        _vm._v(_vm._s(_vm.$t("Date")))
                      ]),
                      _vm._v(" "),
                      _c("th", [_vm._v(_vm._s(_vm.$t("ExamSubjects")))]),
                      _vm._v(" "),
                      _c("th", { attrs: { width: "10%" } }, [
                        _vm._v(_vm._s(_vm.$t("StartTime")))
                      ]),
                      _vm._v(" "),
                      _c("th", { attrs: { width: "10%" } }, [
                        _vm._v(_vm._s(_vm.$t("EndTime")))
                      ]),
                      _vm._v(" "),
                      _c("th", { attrs: { width: "5%" } }, [
                        _vm._v(_vm._s(_vm.$t("Action")))
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "tbody",
                    _vm._l(_vm.form.routine, function(r, index) {
                      return _c("tr", { key: index }, [
                        _c("td", [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: r.date,
                                expression: "r.date"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              type: "date",
                              placeholder: _vm.$t("SelectDate"),
                              id: ""
                            },
                            domProps: { value: r.date },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(r, "date", $event.target.value)
                              }
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c(
                          "td",
                          [
                            _c("custom-select-multiple", {
                              attrs: {
                                options: _vm.subjects,
                                placeholder: _vm.$t("SelectMultiple")
                              },
                              model: {
                                value: r.subject_ids,
                                callback: function($$v) {
                                  _vm.$set(r, "subject_ids", $$v)
                                },
                                expression: "r.subject_ids"
                              }
                            })
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c("td", [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: r.start_time,
                                expression: "r.start_time"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              type: "time",
                              placeholder: _vm.$t("SelectTime"),
                              id: ""
                            },
                            domProps: { value: r.start_time },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(r, "start_time", $event.target.value)
                              }
                            }
                          }),
                          _vm._v(" "),
                          index == 0
                            ? _c("span", [
                                _c("div", { staticClass: "form-check" }, [
                                  _c("input", {
                                    staticClass: "form-check-input",
                                    attrs: {
                                      type: "checkbox",
                                      name: "check_start",
                                      id: "check_start" + index
                                    },
                                    on: {
                                      click: function($event) {
                                        return _vm.choiceStart(index, $event)
                                      }
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c(
                                    "label",
                                    {
                                      staticClass: "form-check-label",
                                      attrs: { for: "check_start" + index }
                                    },
                                    [_vm._v("Check for all")]
                                  )
                                ])
                              ])
                            : _vm._e()
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: r.end_time,
                                expression: "r.end_time"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              type: "time",
                              placeholder: _vm.$t("SelectTime"),
                              id: ""
                            },
                            domProps: { value: r.end_time },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(r, "end_time", $event.target.value)
                              }
                            }
                          }),
                          _vm._v(" "),
                          index == 0
                            ? _c("span", [
                                _c("div", { staticClass: "form-check" }, [
                                  _c("input", {
                                    staticClass: "form-check-input",
                                    attrs: {
                                      type: "checkbox",
                                      name: "check_end",
                                      id: "check_end" + index
                                    },
                                    on: {
                                      click: function($event) {
                                        return _vm.choiceEnd(index, $event)
                                      }
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c(
                                    "label",
                                    {
                                      staticClass: "form-check-label",
                                      attrs: { for: "check_end" + index }
                                    },
                                    [_vm._v("Check for all")]
                                  )
                                ])
                              ])
                            : _vm._e()
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "button",
                            {
                              staticClass: "btn btn-danger btn-sm",
                              attrs: { type: "button" },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  return _vm.deleteRoutine(index)
                                }
                              }
                            },
                            [
                              _c("i", { staticClass: "fas fa-trash-alt" }),
                              _vm._v(" " + _vm._s(_vm.$t("Delete")))
                            ]
                          )
                        ])
                      ])
                    }),
                    0
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "d-flex justify-content-end border-top" },
                [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-sm",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.addNew($event)
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fas fa-plus" }),
                      _vm._v(" " + _vm._s(_vm.$t("AddMore")) + "\n\t\t\t\t\t")
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "v-button",
                { staticClass: "mt-2", attrs: { loading: _vm.form.busy } },
                [_vm._v(_vm._s(_vm.$t("Submit")))]
              )
            ],
            1
          )
        ])
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Academic/Exam/Routine.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Routine.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Routine.vue?vue&type=template&id=119488fe&scoped=true& */ "./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true&");
/* harmony import */ var _Routine_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Routine.vue?vue&type=script&lang=js& */ "./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Routine_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "119488fe",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Academic/Exam/Routine.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Routine_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Routine.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Routine.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Routine_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Routine.vue?vue&type=template&id=119488fe&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Routine.vue?vue&type=template&id=119488fe&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Routine_vue_vue_type_template_id_119488fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);