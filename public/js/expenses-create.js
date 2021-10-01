(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/expenses-create"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_CustomSelect_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../globals/CustomSelect.vue */ "./resources/js/components/globals/CustomSelect.vue");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        items: [{
          bill_item_id: "",
          amount: ""
        }],
        total: ""
      }),
      items: {},
      basic: {}
    };
  },
  methods: {
    expenseSubmit: function expenseSubmit() {
      var _this = this;

      this.form.post("/api/expenses").then(function (res) {
        Toast.fire({
          'icon': 'success',
          'message': _this.$t('success_message_create')
        });

        _this.$router.push("/expenses/".concat(res.data.custom, "/show"));
      });
    },
    addNew: function addNew() {
      this.form.items.push({
        bill_item_id: "",
        amount: ""
      });
    },
    deleteItem: function deleteItem(index) {
      if (this.form.items.length > 1) {
        this.form.items.splice(index, 1);
      }
    },
    getTotal: function getTotal() {
      var total = 0;

      _.forEach(this.form.items, function (value, key) {
        var amount = value.amount == "" ? 0 : value.amount;
        total = parseInt(total) + parseInt(amount);
      });

      this.form.total = total;
      return total;
    },
    loadBillItems: function loadBillItems() {
      var _this2 = this;

      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/api/load-office-bill-items").then(function (_ref) {
        var data = _ref.data;
        _this2.items = data;
      });
    }
  },
  created: function created() {
    this.loadBillItems();
    this.basic = this.$store.getters.basicData;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true& ***!
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
    "custom-card",
    {
      attrs: {
        title: _vm.$t("NewExpense"),
        url: "/expenses",
        text: _vm.$t("ExpenseList")
      }
    },
    [
      _c(
        "form",
        {
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.expenseSubmit($event)
            }
          }
        },
        [
          _c("div", { staticClass: "form-row" }, [
            _c("div", { staticClass: "col-md-12" }, [
              _c("div", { staticClass: "text-center" }, [
                _c("h3", [_vm._v(_vm._s(_vm.basic.name))]),
                _vm._v(" "),
                _c("h5", [_vm._v(_vm._s(_vm.basic.address))]),
                _vm._v(" "),
                _c("h6", [
                  _vm._v(
                    _vm._s(_vm.$t("Phone")) + ": " + _vm._s(_vm.basic.phone)
                  )
                ]),
                _vm._v(" "),
                _c("span", { staticClass: "border rounded p-2" }, [
                  _vm._v(_vm._s(_vm.$t("ExpenseMemo")))
                ])
              ]),
              _vm._v(" "),
              _c(
                "div",
                {
                  directives: [
                    {
                      name: "show",
                      rawName: "v-show",
                      value: Object.keys(this.form.errors.errors).length,
                      expression: "Object.keys(this.form.errors.errors).length"
                    }
                  ],
                  staticClass: "alert alert-danger",
                  attrs: { role: "alert" }
                },
                [
                  _c("h4", { staticClass: "alert-heading" }, [
                    _c("i", { staticClass: "fas fa-exclamation-triangle" }),
                    _vm._v(" Warring.!")
                  ]),
                  _vm._v(" "),
                  _c(
                    "ul",
                    { staticClass: "list-group" },
                    _vm._l(this.form.errors.errors, function(err, er) {
                      return _c(
                        "li",
                        { key: er, staticClass: "list-group-item" },
                        [_vm._v(_vm._s(err[0]))]
                      )
                    }),
                    0
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "d-flex justify-content-between border-bottom" },
                [
                  _c("h4", [_vm._v(_vm._s(_vm.$t("BillItem")))]),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-sm",
                      attrs: { type: "button" },
                      on: { click: _vm.addNew }
                    },
                    [
                      _c("i", { staticClass: "fas fa-plus" }),
                      _vm._v(" " + _vm._s(_vm.$t("Add New")))
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "table",
                { staticClass: "table table-bordered table-striped" },
                [
                  _c("thead", [
                    _c("tr", [
                      _c("th", [_vm._v(_vm._s(_vm.$t("Details")))]),
                      _vm._v(" "),
                      _c("th", { attrs: { width: "35%" } }, [
                        _vm._v(_vm._s(_vm.$t("amount")))
                      ]),
                      _vm._v(" "),
                      _c("th", { attrs: { width: "10%" } }, [
                        _vm._v(_vm._s(_vm.$t("Action")))
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "tbody",
                    _vm._l(_vm.form.items, function(item, index) {
                      return _c("tr", { key: index }, [
                        _c("td", [
                          _c(
                            "div",
                            { staticClass: "form-group" },
                            [
                              _c("custom-select", {
                                attrs: {
                                  options: _vm.items,
                                  placeholder: _vm.$t("Select_One"),
                                  name: "bill_item_id"
                                },
                                model: {
                                  value: item.bill_item_id,
                                  callback: function($$v) {
                                    _vm.$set(item, "bill_item_id", $$v)
                                  },
                                  expression: "item.bill_item_id"
                                }
                              })
                            ],
                            1
                          )
                        ]),
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
                  )
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6 offset-md-6" }, [
              _c("h4", [
                _vm._v(
                  _vm._s(_vm.$t("Total")) +
                    " : " +
                    _vm._s(_vm._f("withCurrency")(_vm.getTotal()))
                )
              ])
            ])
          ]),
          _vm._v(" "),
          _c("v-button", { attrs: { loading: _vm.form.busy } }, [
            _vm._v(_vm._s(_vm.$t("Save")))
          ])
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Accountant/Expenses/Create.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/Accountant/Expenses/Create.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=d53247b4&scoped=true& */ "./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "d53247b4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Accountant/Expenses/Create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=template&id=d53247b4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/Expenses/Create.vue?vue&type=template&id=d53247b4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_d53247b4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);