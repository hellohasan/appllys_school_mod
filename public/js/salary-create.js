(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/salary-create"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_CustomSelect_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../globals/CustomSelect.vue */ "./resources/js/components/globals/CustomSelect.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "Create",
  components: {
    CustomSelect: _globals_CustomSelect_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      form: new Form({
        role_id: ""
      }),
      salaryForm: new Form({
        title: "",
        role_id: "",
        salaries: []
      }),
      btn: true,
      accounts: [],
      roleList: [{
        id: "all",
        text: this.$t("AllRole")
      }]
    };
  },
  watch: {
    "form.role_id": function formRole_id(val) {
      this.salaryForm.role_id = val;
    }
  },
  methods: {
    submitData: function submitData() {
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
          _this.salaryForm.post("/api/salary").then(function (res) {
            Toast.fire({
              icon: "success",
              text: _this.$t("success_message_create")
            });

            _this.$router.push("/salary/".concat(res.data.salary_id, "/show"));
          });
        }
      });
    },
    getTotal: function getTotal() {
      var total = 0;

      _.forEach(this.salaryForm.salaries, function (value, key) {
        var amount = value.amount == "" ? 0 : value.amount;
        total = parseInt(total) + parseInt(amount);
      });

      this.salaryForm.total = total;
      return total;
    },
    deleteItem: function deleteItem(index) {
      if (this.salaryForm.salaries.length > 1) {
        this.salaryForm.salaries.splice(index, 1);
      }
    },
    roleSubmit: function roleSubmit() {
      var _this2 = this;

      if (this.form.role_id != "") {
        this.form.post("/api/salary-finder").then(function (res) {
          _this2.salaryForm.salaries = [];
          var salaries = _this2.salaryForm.salaries;

          _.forEach(res.data, function (value, key) {
            salaries.push({
              user_id: value.id,
              name: value.name,
              scale: value.salary.salary_scale.title,
              scale_id: value.salary.salary_scale.id,
              amount: value.salary.salary_scale.amount,
              role_name: value.roles[0].name,
              account_id: ""
            });
          });

          _this2.btn = _this2.salaryForm.salaries.length ? false : true;
        });
      } else {
        Swal.fire({
          icon: "error",
          title: this.$t("error_alert_title"),
          text: this.$t("role_select_error"),
          showConfirmButton: false
        });
      }
    },
    loadRoleList: function loadRoleList() {
      var _this3 = this;

      axios.get("/api/load-role-list").then(function (_ref) {
        var data = _ref.data;
        var rolelist = _this3.roleList;

        _.forEach(data, function (value, key) {
          rolelist.push(value);
        });
      });
    },
    loadAccountList: function loadAccountList() {
      var _this4 = this;

      axios.get("/api/load-account-list").then(function (_ref2) {
        var data = _ref2.data;
        return _this4.accounts = data;
      });
    }
  },
  created: function created() {
    this.loadRoleList();
    this.loadAccountList();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************/
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
        title: _vm.$t("NewSalary"),
        url: "/salary",
        text: _vm.$t("SalaryList")
      }
    },
    [
      _c(
        "div",
        {
          directives: [
            {
              name: "show",
              rawName: "v-show",
              value: Object.keys(this.salaryForm.errors.errors).length,
              expression: "Object.keys(this.salaryForm.errors.errors).length"
            }
          ],
          staticClass: "alert alert-danger",
          attrs: { role: "alert" }
        },
        [
          _c("h4", { staticClass: "alert-heading" }, [
            _c("i", { staticClass: "fas fa-exclamation-triangle" }),
            _vm._v(" " + _vm._s(_vm.$t("Warning")) + ".!")
          ]),
          _vm._v(" "),
          _c(
            "ul",
            { staticClass: "list-group" },
            _vm._l(this.salaryForm.errors.errors, function(err, er) {
              return _c("li", { key: er, staticClass: "list-group-item" }, [
                _vm._v(_vm._s(err[0]))
              ])
            }),
            0
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "form",
        {
          staticClass: "border-bottom",
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.roleSubmit($event)
            }
          }
        },
        [
          _c(
            "div",
            { staticClass: "form-row" },
            [
              _c("form-group-input", {
                attrs: {
                  form: _vm.salaryForm,
                  col: "col-md-4",
                  name: "title",
                  label: _vm.$t("Title")
                },
                model: {
                  value: _vm.salaryForm.title,
                  callback: function($$v) {
                    _vm.$set(_vm.salaryForm, "title", $$v)
                  },
                  expression: "salaryForm.title"
                }
              }),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "form-group col-md-4" },
                [
                  _c("form-group-select", {
                    staticClass: "input-lg",
                    attrs: {
                      options: _vm.roleList,
                      label: _vm.$t("SelectRole"),
                      id: "role_id",
                      form: _vm.form
                    },
                    model: {
                      value: _vm.form.role_id,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "role_id", $$v)
                      },
                      expression: "form.role_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "form-group col-md-4" },
                [
                  _c("label", { attrs: { for: "btn" } }, [
                    _vm._v(_vm._s(_vm.$t("Search")))
                  ]),
                  _vm._v(" "),
                  _c(
                    "v-button",
                    {
                      attrs: { id: "btn", large: false, loading: _vm.form.busy }
                    },
                    [
                      _c("i", { staticClass: "fas fa-search" }),
                      _vm._v(" " + _vm._s(_vm.$t("Search")))
                    ]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("table", { staticClass: "table table-bordered table-striped" }, [
            _c("thead", [
              _c("tr", [
                _c("th", [_vm._v(_vm._s(_vm.$t("Name")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Role")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("salary_scale")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("amount")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("PayVia")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Action")))])
              ])
            ]),
            _vm._v(" "),
            _c(
              "tbody",
              _vm._l(_vm.salaryForm.salaries, function(item, index) {
                return _c("tr", { key: index }, [
                  _c("td", [_vm._v(_vm._s(item.name))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" " + _vm._s(item.role_name) + " ")]),
                  _vm._v(" "),
                  _c("td", [_vm._v(" " + _vm._s(item.scale) + " ")]),
                  _vm._v(" "),
                  _c("td", [
                    _c("div", { staticClass: "input-group" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: item.amount,
                            expression: "item.amount"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "number",
                          step: "0.001",
                          placeholder: _vm.$t("amount"),
                          name: "amount",
                          id: "amount"
                        },
                        domProps: { value: item.amount },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(item, "amount", $event.target.value)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("div", { staticClass: "input-group-append" }, [
                        _c(
                          "div",
                          {
                            staticClass: "btn btn-outline-danger",
                            attrs: { type: "button" }
                          },
                          [_vm._v(_vm._s(_vm.$t("BDT")))]
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("custom-select", {
                          attrs: {
                            options: _vm.accounts,
                            placeholder: _vm.$t("Select_One"),
                            name: "account_id"
                          },
                          model: {
                            value: item.account_id,
                            callback: function($$v) {
                              _vm.$set(item, "account_id", $$v)
                            },
                            expression: "item.account_id"
                          }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-outline-danger btn-sm",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            return _vm.deleteItem(index)
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
            ),
            _vm._v(" "),
            _c("tfoot", [
              _c("tr", [
                _c(
                  "td",
                  {
                    staticClass: "text-right font-weight-bold",
                    attrs: { colspan: "3" }
                  },
                  [_vm._v(_vm._s(_vm.$t("GrandTotal")))]
                ),
                _vm._v(" "),
                _c(
                  "td",
                  { staticClass: "font-weight-bold", attrs: { colspan: "3" } },
                  [_vm._v(_vm._s(_vm._f("withCurrency")(_vm.getTotal())))]
                )
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-primary btn-block font-weight-bold btn-lg",
              class: { "btn-loading": _vm.salaryForm.busy },
              attrs: { disabled: _vm.btn, type: "button" },
              on: { click: _vm.submitData }
            },
            [
              _c("i", { staticClass: "far fa-paper-plane" }),
              _vm._v(" " + _vm._s(_vm.$t("Submit")))
            ]
          )
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Create.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Create.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=3b7f4997&scoped=true& */ "./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3b7f4997",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Accountant/Salary/Create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=template&id=3b7f4997&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Salary/Create.vue?vue&type=template&id=3b7f4997&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_3b7f4997_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);