(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/subject-assign-new"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_CustomSelect_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../globals/CustomSelect.vue */ "./resources/js/components/globals/CustomSelect.vue");
/* harmony import */ var _globals_CustomSelectEmpty_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../globals/CustomSelectEmpty.vue */ "./resources/js/components/globals/CustomSelectEmpty.vue");
/* harmony import */ var validatorjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! validatorjs */ "./node_modules/validatorjs/src/validator.js");
/* harmony import */ var validatorjs__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(validatorjs__WEBPACK_IMPORTED_MODULE_2__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "New",
  components: {
    CustomSelect: _globals_CustomSelect_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
    CustomSelectEmpty: _globals_CustomSelectEmpty_vue__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  data: function data() {
    return {
      form: new Form({
        'session_id': '',
        'academic_class_id': '',
        'academic_class_type': '',
        'academic_section_id': '',
        'academic_group_id': '',
        'academic_group_section_id': '',
        'academic_department_id': '',
        'academic_year_id': ''
      }),
      sForm: new Form({
        subjects: []
      }),
      teachers: [],
      sessions: [],
      classes: [],
      sections: [],
      groups: [],
      group_sections: [],
      departments: [],
      department_years: [],
      errors: [],
      periods: []
    };
  },
  methods: {
    submitAssign: function submitAssign() {
      var _this = this;

      this.errors = [];
      var validation = new validatorjs__WEBPACK_IMPORTED_MODULE_2__(this.sForm, {
        'subjects.*.days': ['required', 'array'],
        'subjects.*.days.*.day_id': ['required'],
        'subjects.*.days.*.teacher_id': ['required'],
        'subjects.*.days.*.period_id': ['required']
      });

      if (validation.passes()) {
        var postData = _objectSpread(_objectSpread({}, this.form), this.sForm);

        axios.post('/api/submit-academic-class-subject-list', postData).then(function (res) {
          Toast.fire({
            icon: "success",
            text: _this.$t("success_message_create")
          });

          _this.$router.push("/subject-assign/".concat(res.data.custom, "/show"));
        });
      } else {
        this.errors = validation.errors.all(); //console.log(Object.keys(this.errors).length);
      }
    },
    submitTeacher: function submitTeacher() {
      var _this2 = this;

      this.errors = [];
      var validation = new validatorjs__WEBPACK_IMPORTED_MODULE_2__(this.form, {
        'session_id': ['required'],
        'academic_class_id': ['required'],
        'academic_class_type': ['required'],
        'academic_section_id': [{
          required_if: ['academic_class_type', 0]
        }],
        'academic_group_id': [{
          required_if: ['academic_class_type', 1]
        }],
        'academic_group_section_id': [{
          required_if: ['academic_class_type', 1]
        }],
        'academic_department_id': [{
          required_if: ['academic_class_type', 2]
        }],
        'academic_year_id': [{
          required_if: ['academic_class_type', 2]
        }]
      });

      if (validation.passes()) {
        this.form.post('/api/get-academic-class-subjects').then(function (res) {
          _this2.sForm.subjects = [];
          _this2.sForm.subjects = res.data.subjects;
          _this2.sForm.custom = res.data.custom;
        });
      } else {
        this.errors = validation.errors.all();
      }
    },
    choicePeriod: function choicePeriod(index, d, event) {
      if (event.target.checked) {
        var period_id = this.sForm.subjects[index].days[d].period_id;
        this.sForm.subjects[index].days.forEach(function (e) {
          e.period_id = period_id;
        });
      }
    },
    choiceTeacher: function choiceTeacher(index, d, event) {
      if (event.target.checked) {
        var teacher_id = this.sForm.subjects[index].days[d].teacher_id;
        this.sForm.subjects[index].days.forEach(function (e) {
          e.teacher_id = teacher_id;
        });
      }
    },
    deleteDay: function deleteDay(index, d) {
      this.sForm.subjects[index].days.splice(d, 1);
    },
    changeGroup: function changeGroup(e) {
      this.group_sections = [];

      if (e) {
        this.group_sections = _.find(this.groups, function (o) {
          return o.id == e;
        }).sections;
      }
    },
    changeDepartment: function changeDepartment(e) {
      this.department_years = [];

      if (e) {
        this.department_years = _.find(this.departments, function (o) {
          return o.id == e;
        }).sections;
      }
    },
    classChange: function classChange(e) {
      var _this3 = this;

      if (e) {
        axios.get("/api/load-class-all-details/".concat(e)).then(function (res) {
          _this3.form.academic_class_type = res.data.type;
          _this3.sections = [];
          _this3.groups = [];
          _this3.form.academic_group_id = '';
          _this3.form.academic_section_id = '';
          _this3.form.academic_group_section_id = '';
          _this3.form.academic_department_id = '';
          _this3.form.academic_year_id = '';
          _this3.group_sections = [];
          _this3.departments = [];
          _this3.department_years = [];
          _this3.sections = res.data.sections;
          _this3.groups = res.data.academic_groups;
          _this3.departments = res.data.academic_departments;
        });
      }
    },
    loadTeacherList: function loadTeacherList() {
      var _this4 = this;

      axios.get('/api/load-teacher-list').then(function (_ref) {
        var data = _ref.data;
        return _this4.teachers = data;
      });
    },
    loadAcademicSession: function loadAcademicSession() {
      var _this5 = this;

      axios.get('/api/load-active-academic-session').then(function (_ref2) {
        var data = _ref2.data;
        return _this5.sessions = data;
      });
    },
    loadClassList: function loadClassList() {
      var _this6 = this;

      axios.get("/api/load-class-list").then(function (res) {
        _this6.classes = res.data;
      });
    },
    loadPeriodList: function loadPeriodList() {
      var _this7 = this;

      axios.get("/api/load-period-list").then(function (res) {
        _this7.periods = res.data;
      });
    }
  },
  created: function created() {
    this.loadTeacherList();
    this.loadAcademicSession();
    this.loadClassList();
    this.loadPeriodList();
  }
});

/***/ }),

/***/ "./node_modules/validatorjs/src/lang sync recursive ^\\.\\/.*$":
/*!*********************************************************!*\
  !*** ./node_modules/validatorjs/src/lang sync ^\.\/.*$ ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./ar": "./node_modules/validatorjs/src/lang/ar.js",
	"./ar.js": "./node_modules/validatorjs/src/lang/ar.js",
	"./az": "./node_modules/validatorjs/src/lang/az.js",
	"./az.js": "./node_modules/validatorjs/src/lang/az.js",
	"./be": "./node_modules/validatorjs/src/lang/be.js",
	"./be.js": "./node_modules/validatorjs/src/lang/be.js",
	"./bg": "./node_modules/validatorjs/src/lang/bg.js",
	"./bg.js": "./node_modules/validatorjs/src/lang/bg.js",
	"./bs": "./node_modules/validatorjs/src/lang/bs.js",
	"./bs.js": "./node_modules/validatorjs/src/lang/bs.js",
	"./ca": "./node_modules/validatorjs/src/lang/ca.js",
	"./ca.js": "./node_modules/validatorjs/src/lang/ca.js",
	"./cs": "./node_modules/validatorjs/src/lang/cs.js",
	"./cs.js": "./node_modules/validatorjs/src/lang/cs.js",
	"./cy": "./node_modules/validatorjs/src/lang/cy.js",
	"./cy.js": "./node_modules/validatorjs/src/lang/cy.js",
	"./da": "./node_modules/validatorjs/src/lang/da.js",
	"./da.js": "./node_modules/validatorjs/src/lang/da.js",
	"./de": "./node_modules/validatorjs/src/lang/de.js",
	"./de.js": "./node_modules/validatorjs/src/lang/de.js",
	"./el": "./node_modules/validatorjs/src/lang/el.js",
	"./el.js": "./node_modules/validatorjs/src/lang/el.js",
	"./en": "./node_modules/validatorjs/src/lang/en.js",
	"./en.js": "./node_modules/validatorjs/src/lang/en.js",
	"./es": "./node_modules/validatorjs/src/lang/es.js",
	"./es.js": "./node_modules/validatorjs/src/lang/es.js",
	"./et": "./node_modules/validatorjs/src/lang/et.js",
	"./et.js": "./node_modules/validatorjs/src/lang/et.js",
	"./eu": "./node_modules/validatorjs/src/lang/eu.js",
	"./eu.js": "./node_modules/validatorjs/src/lang/eu.js",
	"./fa": "./node_modules/validatorjs/src/lang/fa.js",
	"./fa.js": "./node_modules/validatorjs/src/lang/fa.js",
	"./fi": "./node_modules/validatorjs/src/lang/fi.js",
	"./fi.js": "./node_modules/validatorjs/src/lang/fi.js",
	"./fr": "./node_modules/validatorjs/src/lang/fr.js",
	"./fr.js": "./node_modules/validatorjs/src/lang/fr.js",
	"./hr": "./node_modules/validatorjs/src/lang/hr.js",
	"./hr.js": "./node_modules/validatorjs/src/lang/hr.js",
	"./hu": "./node_modules/validatorjs/src/lang/hu.js",
	"./hu.js": "./node_modules/validatorjs/src/lang/hu.js",
	"./id": "./node_modules/validatorjs/src/lang/id.js",
	"./id.js": "./node_modules/validatorjs/src/lang/id.js",
	"./it": "./node_modules/validatorjs/src/lang/it.js",
	"./it.js": "./node_modules/validatorjs/src/lang/it.js",
	"./ja": "./node_modules/validatorjs/src/lang/ja.js",
	"./ja.js": "./node_modules/validatorjs/src/lang/ja.js",
	"./ka": "./node_modules/validatorjs/src/lang/ka.js",
	"./ka.js": "./node_modules/validatorjs/src/lang/ka.js",
	"./ko": "./node_modules/validatorjs/src/lang/ko.js",
	"./ko.js": "./node_modules/validatorjs/src/lang/ko.js",
	"./lt": "./node_modules/validatorjs/src/lang/lt.js",
	"./lt.js": "./node_modules/validatorjs/src/lang/lt.js",
	"./lv": "./node_modules/validatorjs/src/lang/lv.js",
	"./lv.js": "./node_modules/validatorjs/src/lang/lv.js",
	"./mk": "./node_modules/validatorjs/src/lang/mk.js",
	"./mk.js": "./node_modules/validatorjs/src/lang/mk.js",
	"./mn": "./node_modules/validatorjs/src/lang/mn.js",
	"./mn.js": "./node_modules/validatorjs/src/lang/mn.js",
	"./ms": "./node_modules/validatorjs/src/lang/ms.js",
	"./ms.js": "./node_modules/validatorjs/src/lang/ms.js",
	"./nb_NO": "./node_modules/validatorjs/src/lang/nb_NO.js",
	"./nb_NO.js": "./node_modules/validatorjs/src/lang/nb_NO.js",
	"./nl": "./node_modules/validatorjs/src/lang/nl.js",
	"./nl.js": "./node_modules/validatorjs/src/lang/nl.js",
	"./pl": "./node_modules/validatorjs/src/lang/pl.js",
	"./pl.js": "./node_modules/validatorjs/src/lang/pl.js",
	"./pt": "./node_modules/validatorjs/src/lang/pt.js",
	"./pt.js": "./node_modules/validatorjs/src/lang/pt.js",
	"./pt_BR": "./node_modules/validatorjs/src/lang/pt_BR.js",
	"./pt_BR.js": "./node_modules/validatorjs/src/lang/pt_BR.js",
	"./ro": "./node_modules/validatorjs/src/lang/ro.js",
	"./ro.js": "./node_modules/validatorjs/src/lang/ro.js",
	"./ru": "./node_modules/validatorjs/src/lang/ru.js",
	"./ru.js": "./node_modules/validatorjs/src/lang/ru.js",
	"./se": "./node_modules/validatorjs/src/lang/se.js",
	"./se.js": "./node_modules/validatorjs/src/lang/se.js",
	"./sl": "./node_modules/validatorjs/src/lang/sl.js",
	"./sl.js": "./node_modules/validatorjs/src/lang/sl.js",
	"./sq": "./node_modules/validatorjs/src/lang/sq.js",
	"./sq.js": "./node_modules/validatorjs/src/lang/sq.js",
	"./sr": "./node_modules/validatorjs/src/lang/sr.js",
	"./sr.js": "./node_modules/validatorjs/src/lang/sr.js",
	"./sv": "./node_modules/validatorjs/src/lang/sv.js",
	"./sv.js": "./node_modules/validatorjs/src/lang/sv.js",
	"./tr": "./node_modules/validatorjs/src/lang/tr.js",
	"./tr.js": "./node_modules/validatorjs/src/lang/tr.js",
	"./ua": "./node_modules/validatorjs/src/lang/ua.js",
	"./ua.js": "./node_modules/validatorjs/src/lang/ua.js",
	"./uk": "./node_modules/validatorjs/src/lang/uk.js",
	"./uk.js": "./node_modules/validatorjs/src/lang/uk.js",
	"./vi": "./node_modules/validatorjs/src/lang/vi.js",
	"./vi.js": "./node_modules/validatorjs/src/lang/vi.js",
	"./zh": "./node_modules/validatorjs/src/lang/zh.js",
	"./zh.js": "./node_modules/validatorjs/src/lang/zh.js",
	"./zh_TW": "./node_modules/validatorjs/src/lang/zh_TW.js",
	"./zh_TW.js": "./node_modules/validatorjs/src/lang/zh_TW.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./node_modules/validatorjs/src/lang sync recursive ^\\.\\/.*$";

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************/
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
    "card",
    {
      attrs: {
        title: _vm.$t("TeacherSubjectAssign"),
        icon: "fas fa-user-graduate"
      }
    },
    [
      _c(
        "form",
        {
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.submitTeacher($event)
            }
          }
        },
        [
          _c(
            "div",
            { staticClass: "form-row" },
            [
              _c(
                "div",
                { staticClass: "form-group col-6" },
                [
                  _c("label", { attrs: { for: "session_id" } }, [
                    _vm._v(_vm._s(_vm.$t("Academic_Session")))
                  ]),
                  _vm._v(" "),
                  _c("custom-select", {
                    attrs: {
                      options: _vm.sessions,
                      placeholder: _vm.$t("Select_One"),
                      name: "session_id"
                    },
                    model: {
                      value: _vm.form.session_id,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "session_id", $$v)
                      },
                      expression: "form.session_id"
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors.session_id
                    ? _c("div", { staticClass: "invalid-feedback" }, [
                        _vm._v(_vm._s(_vm.errors.session_id[0]))
                      ])
                    : _vm._e()
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "form-group col-6" },
                [
                  _c("label", { attrs: { for: "academic_class_id" } }, [
                    _vm._v(_vm._s(_vm.$t("Academic_Class")))
                  ]),
                  _vm._v(" "),
                  _c("custom-select", {
                    attrs: {
                      options: _vm.classes,
                      placeholder: _vm.$t("Select_One")
                    },
                    on: { change: _vm.classChange },
                    model: {
                      value: _vm.form.academic_class_id,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "academic_class_id", $$v)
                      },
                      expression: "form.academic_class_id"
                    }
                  }),
                  _vm._v(" "),
                  _vm.errors.academic_class_id
                    ? _c("div", { staticClass: "invalid-feedback" }, [
                        _vm._v(_vm._s(_vm.errors.academic_class_id[0]))
                      ])
                    : _vm._e()
                ],
                1
              ),
              _vm._v(" "),
              this.form.academic_class_type == "0"
                ? [
                    _c(
                      "div",
                      { staticClass: "form-group col-12" },
                      [
                        _c("label", { attrs: { for: "academic_section_id" } }, [
                          _vm._v(_vm._s(_vm.$t("Group_section")))
                        ]),
                        _vm._v(" "),
                        _c("custom-select-empty", {
                          attrs: {
                            options: _vm.sections,
                            placeholder: _vm.$t("Select_One")
                          },
                          model: {
                            value: _vm.form.academic_section_id,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "academic_section_id", $$v)
                            },
                            expression: "form.academic_section_id"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.academic_section_id
                          ? _c("div", { staticClass: "invalid-feedback" }, [
                              _vm._v(_vm._s(_vm.errors.academic_section_id[0]))
                            ])
                          : _vm._e()
                      ],
                      1
                    )
                  ]
                : _vm._e(),
              _vm._v(" "),
              this.form.academic_class_type == "1"
                ? [
                    _c(
                      "div",
                      { staticClass: "form-group col-6" },
                      [
                        _c("label", { attrs: { for: "academic_group_id" } }, [
                          _vm._v(_vm._s(_vm.$t("Academic_Group")))
                        ]),
                        _vm._v(" "),
                        _c("custom-select-empty", {
                          attrs: {
                            options: _vm.groups,
                            placeholder: _vm.$t("Select_One")
                          },
                          on: { change: _vm.changeGroup },
                          model: {
                            value: _vm.form.academic_group_id,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "academic_group_id", $$v)
                            },
                            expression: "form.academic_group_id"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.academic_group_id
                          ? _c("div", { staticClass: "invalid-feedback" }, [
                              _vm._v(_vm._s(_vm.errors.academic_group_id[0]))
                            ])
                          : _vm._e()
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "form-group col-6" },
                      [
                        _c(
                          "label",
                          { attrs: { for: "academic_group_section_id" } },
                          [_vm._v(_vm._s(_vm.$t("Group_section")))]
                        ),
                        _vm._v(" "),
                        _c("custom-select-empty", {
                          attrs: {
                            options: _vm.group_sections,
                            placeholder: _vm.$t("Select_One")
                          },
                          model: {
                            value: _vm.form.academic_group_section_id,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.form,
                                "academic_group_section_id",
                                $$v
                              )
                            },
                            expression: "form.academic_group_section_id"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.academic_group_section_id
                          ? _c("div", { staticClass: "invalid-feedback" }, [
                              _vm._v(
                                _vm._s(_vm.errors.academic_group_section_id[0])
                              )
                            ])
                          : _vm._e()
                      ],
                      1
                    )
                  ]
                : _vm._e(),
              _vm._v(" "),
              this.form.academic_class_type == "2"
                ? [
                    _c(
                      "div",
                      { staticClass: "form-group col-6" },
                      [
                        _c(
                          "label",
                          { attrs: { for: "academic_department_id" } },
                          [_vm._v(_vm._s(_vm.$t("Academic_Department")))]
                        ),
                        _vm._v(" "),
                        _c("custom-select-empty", {
                          attrs: {
                            options: _vm.departments,
                            placeholder: _vm.$t("Select_One")
                          },
                          on: { change: _vm.changeDepartment },
                          model: {
                            value: _vm.form.academic_department_id,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "academic_department_id", $$v)
                            },
                            expression: "form.academic_department_id"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.academic_department_id
                          ? _c("div", { staticClass: "invalid-feedback" }, [
                              _vm._v(
                                _vm._s(_vm.errors.academic_department_id[0])
                              )
                            ])
                          : _vm._e()
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "form-group col-6" },
                      [
                        _c("label", { attrs: { for: "academic_year_id" } }, [
                          _vm._v(_vm._s(_vm.$t("Department_year")))
                        ]),
                        _vm._v(" "),
                        _c("custom-select-empty", {
                          attrs: {
                            options: _vm.department_years,
                            placeholder: _vm.$t("Select_One")
                          },
                          model: {
                            value: _vm.form.academic_year_id,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "academic_year_id", $$v)
                            },
                            expression: "form.academic_year_id"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.academic_year_id
                          ? _c("div", { staticClass: "invalid-feedback" }, [
                              _vm._v(_vm._s(_vm.errors.academic_year_id[0]))
                            ])
                          : _vm._e()
                      ],
                      1
                    )
                  ]
                : _vm._e(),
              _vm._v(" "),
              _c("div", { staticClass: "form-group col-12" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary btn-lg btn-block",
                    attrs: {
                      type: "submit",
                      id: "button",
                      disabled: _vm.form.busy
                    }
                  },
                  [
                    _c("i", { staticClass: "fas fa-search" }),
                    _vm._v(" " + _vm._s(_vm.$t("ClassList")))
                  ]
                )
              ])
            ],
            2
          )
        ]
      ),
      _vm._v(" "),
      _c("hr"),
      _vm._v(" "),
      _vm.sForm.subjects.length
        ? _c("div", { staticClass: "row" }, [
            Object.keys(this.errors).length
              ? _c("div", { staticClass: "col-md-12" }, [
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
              : _vm._e(),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-12" }, [
              _c(
                "table",
                { staticClass: "table table-bordered table-striped" },
                [
                  _c("thead", [
                    _c("tr", [
                      _c("th", [_vm._v("Name")]),
                      _vm._v(" "),
                      _c("th", [_vm._v("Code")]),
                      _vm._v(" "),
                      _c("th", [_vm._v("Type")]),
                      _vm._v(" "),
                      _c("th", [_vm._v("Details")])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "tbody",
                    _vm._l(_vm.sForm.subjects, function(subject, index) {
                      return _c("tr", { key: index }, [
                        _c("td", [_vm._v(_vm._s(subject.subject_name))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(subject.subject_code))]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "label",
                            {
                              staticClass: "badge",
                              class: subject.subject_type
                                ? "badge-warning"
                                : "badge-success"
                            },
                            [
                              _vm._v(
                                _vm._s(
                                  subject.subject_type
                                    ? "Optional"
                                    : "Compulsory"
                                )
                              )
                            ]
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "table",
                            { staticClass: "table" },
                            [
                              _c("tr", [
                                _c("th", [_vm._v("Day")]),
                                _vm._v(" "),
                                _c("th", [_vm._v("Teacher")]),
                                _vm._v(" "),
                                _c("th", [_vm._v("Period")]),
                                _vm._v(" "),
                                _c("th", [_vm._v("Action")])
                              ]),
                              _vm._v(" "),
                              _vm._l(subject.days, function(day, d) {
                                return _c("tr", { key: d }, [
                                  _c("td", [_vm._v(_vm._s(day.day_name))]),
                                  _vm._v(" "),
                                  _c(
                                    "td",
                                    [
                                      _c("custom-select-empty", {
                                        attrs: {
                                          options: _vm.teachers,
                                          placeholder: _vm.$t("Select_One"),
                                          name: "teacher_id"
                                        },
                                        model: {
                                          value:
                                            _vm.sForm.subjects[index].days[d]
                                              .teacher_id,
                                          callback: function($$v) {
                                            _vm.$set(
                                              _vm.sForm.subjects[index].days[d],
                                              "teacher_id",
                                              $$v
                                            )
                                          },
                                          expression:
                                            "sForm.subjects[index].days[d].teacher_id"
                                        }
                                      }),
                                      _vm._v(" "),
                                      d == 0
                                        ? _c("span", [
                                            _c(
                                              "div",
                                              { staticClass: "form-check" },
                                              [
                                                _c("input", {
                                                  staticClass:
                                                    "form-check-input",
                                                  attrs: {
                                                    type: "checkbox",
                                                    name: "check_teacher",
                                                    id:
                                                      "check_teacher" +
                                                      d +
                                                      index
                                                  },
                                                  on: {
                                                    click: function($event) {
                                                      return _vm.choiceTeacher(
                                                        index,
                                                        d,
                                                        $event
                                                      )
                                                    }
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "form-check-label",
                                                    attrs: {
                                                      for:
                                                        "check_teacher" +
                                                        d +
                                                        index
                                                    }
                                                  },
                                                  [
                                                    _vm._v(
                                                      "Check it if all are same"
                                                    )
                                                  ]
                                                )
                                              ]
                                            )
                                          ])
                                        : _vm._e()
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "td",
                                    [
                                      _c("custom-select-empty", {
                                        attrs: {
                                          options: _vm.periods,
                                          placeholder: _vm.$t("Select_One"),
                                          name: "teacher_id"
                                        },
                                        model: {
                                          value:
                                            _vm.sForm.subjects[index].days[d]
                                              .period_id,
                                          callback: function($$v) {
                                            _vm.$set(
                                              _vm.sForm.subjects[index].days[d],
                                              "period_id",
                                              $$v
                                            )
                                          },
                                          expression:
                                            "sForm.subjects[index].days[d].period_id"
                                        }
                                      }),
                                      _vm._v(" "),
                                      d == 0
                                        ? _c("span", [
                                            _c(
                                              "div",
                                              { staticClass: "form-check" },
                                              [
                                                _c("input", {
                                                  staticClass:
                                                    "form-check-input",
                                                  attrs: {
                                                    type: "checkbox",
                                                    name: "check_period",
                                                    id:
                                                      "check_period" + d + index
                                                  },
                                                  on: {
                                                    click: function($event) {
                                                      return _vm.choicePeriod(
                                                        index,
                                                        d,
                                                        $event
                                                      )
                                                    }
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "form-check-label",
                                                    attrs: {
                                                      for:
                                                        "check_period" +
                                                        d +
                                                        index
                                                    }
                                                  },
                                                  [
                                                    _vm._v(
                                                      "Check it if all are same"
                                                    )
                                                  ]
                                                )
                                              ]
                                            )
                                          ])
                                        : _vm._e()
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c("td", [
                                    _c(
                                      "div",
                                      {
                                        staticClass: "btn btn-danger btn-sm",
                                        on: {
                                          click: function($event) {
                                            $event.preventDefault()
                                            return _vm.deleteDay(index, d)
                                          }
                                        }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fas fa-trash"
                                        }),
                                        _vm._v(" " + _vm._s(_vm.$t("Delete")))
                                      ]
                                    )
                                  ])
                                ])
                              })
                            ],
                            2
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
                "button",
                {
                  staticClass: "btn btn-primary btn-block btn-lg",
                  attrs: { disabled: _vm.sForm.busy },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.submitAssign($event)
                    }
                  }
                },
                [_vm._v(" Assign Subject Now")]
              )
            ])
          ])
        : _vm._e()
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Academic/SubjectAssign/New.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/Academic/SubjectAssign/New.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./New.vue?vue&type=template&id=28375c2f&scoped=true& */ "./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true&");
/* harmony import */ var _New_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./New.vue?vue&type=script&lang=js& */ "./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _New_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "28375c2f",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Academic/SubjectAssign/New.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_New_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./New.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_New_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./New.vue?vue&type=template&id=28375c2f&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/SubjectAssign/New.vue?vue&type=template&id=28375c2f&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_New_vue_vue_type_template_id_28375c2f_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);