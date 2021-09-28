(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/manage-account"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _directive_permission_permission__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../directive/permission/permission */ "./resources/js/directive/permission/permission.js");
/* harmony import */ var _helpers_myTableDom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../helpers/myTableDom */ "./resources/js/helpers/myTableDom.js");
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


/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ManageAccount",
  directives: {
    permission: _directive_permission_permission__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      form: new Form(_defineProperty({
        name: "",
        amount: "",
        isActive: "",
        bank_account: "",
        bank_branch: ""
      }, "isActive", "")),
      editMode: false,
      editId: null,
      lists: {}
    };
  },
  methods: {
    myTable: function myTable() {
      this.$nextTick(function () {
        $('#myTable').DataTable(_helpers_myTableDom__WEBPACK_IMPORTED_MODULE_1__["myTableDom"]);
      });
    },
    openMyModal: function openMyModal() {
      this.form.reset();
      this.form.clear();
      this.editMode = false;
      this.editId = null;
      $("#myModal").modal("show");
    },
    editAccount: function editAccount(list) {
      this.openMyModal();
      this.editMode = true;
      this.editId = list.id;
      this.form.fill(list);
    },
    createAccount: function createAccount() {
      var _this = this;

      this.form.post("/api/manage-accounts-store").then(function () {
        _this.loadManageAccount();

        _this.myTable();

        $("#myModal").modal("hide");
        Toast.fire({
          icon: "success",
          title: _this.$t("success_message_create")
        });
      });
    },
    updateAccount: function updateAccount() {
      var _this2 = this;

      this.form.put("/api/manage-accounts-update/".concat(this.editId)).then(function () {
        _this2.loadManageAccount();

        _this2.myTable();

        $("#myModal").modal("hide");
        Toast.fire({
          icon: "success",
          title: _this2.$t("success_message_update")
        });
      });
    },
    loadManageAccount: function loadManageAccount() {
      var _this3 = this;

      axios.get("/api/manage-accounts").then(function (res) {
        _this3.lists = res.data;

        _this3.myTable();
      });
    }
  },
  created: function created() {
    this.loadManageAccount();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true& ***!
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
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-12" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-header" }, [
          _c("h3", { staticClass: "card-title font-weight-bold" }, [
            _vm._v(_vm._s(_vm.$t("ManageAccount")))
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              directives: [
                {
                  name: "permission",
                  rawName: "v-permission",
                  value: ["manage-accounts-create"],
                  expression: "['manage-accounts-create']"
                }
              ],
              staticClass: "card-tools"
            },
            [
              _c(
                "button",
                {
                  staticClass: "btn btn-success btn-sm",
                  on: { click: _vm.openMyModal }
                },
                [
                  _c("i", { staticClass: "fas fa-plus fa-w" }),
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.$t("Add New")) +
                      "\n                    "
                  )
                ]
              )
            ]
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body table-responsive p-3" }, [
          _c(
            "table",
            {
              staticClass:
                "table table-bordered table-striped display dt-responsive nowrap",
              staticStyle: { width: "100%" },
              attrs: { id: "myTable" }
            },
            [
              _c("thead", [
                _c("tr", [
                  _c("th", [_vm._v(_vm._s(_vm.$t("SL")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("Name")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("amount")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("BankAccount")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("BankBranch")))]),
                  _vm._v(" "),
                  _c("th", [_vm._v(_vm._s(_vm.$t("Status")))]),
                  _vm._v(" "),
                  _c("th", { staticClass: "not-export-col" }, [
                    _vm._v(_vm._s(_vm.$t("Action")))
                  ])
                ])
              ]),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.lists, function(list, index) {
                  return _c("tr", { key: index }, [
                    _c("td", [_vm._v(_vm._s(++index))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(list.name))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(_vm._s(_vm._f("withCurrency")(list.amount)))
                    ]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(list.bank_account))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(list.bank_branch))]),
                    _vm._v(" "),
                    _c(
                      "td",
                      [
                        list.isActive
                          ? [
                              _c(
                                "span",
                                { staticClass: "badge badge-success" },
                                [_vm._v(_vm._s(_vm.$t("Activated")))]
                              )
                            ]
                          : [
                              _c(
                                "span",
                                { staticClass: "badge badge-warning" },
                                [_vm._v(_vm._s(_vm.$t("Deactivated")))]
                              )
                            ]
                      ],
                      2
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      [
                        list.id != 1
                          ? [
                              _c(
                                "button",
                                {
                                  directives: [
                                    {
                                      name: "permission",
                                      rawName: "v-permission",
                                      value: ["manage-accounts-edit"],
                                      expression: "['manage-accounts-edit']"
                                    }
                                  ],
                                  staticClass: "btn btn-primary btn-sm",
                                  on: {
                                    click: function($event) {
                                      return _vm.editAccount(list)
                                    }
                                  }
                                },
                                [
                                  _c("i", { staticClass: "far fa-edit" }),
                                  _vm._v(" " + _vm._s(_vm.$t("Edit")))
                                ]
                              )
                            ]
                          : _vm._e()
                      ],
                      2
                    )
                  ])
                }),
                0
              )
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "myModal",
          tabindex: "-1",
          "aria-labelledby": "myModalLabel",
          "aria-hidden": "true"
        }
      },
      [
        _c("div", { staticClass: "modal-dialog modal-dialog-centered" }, [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "h5",
                { staticClass: "modal-title", attrs: { id: "myModalLabel" } },
                [
                  _vm._v(
                    _vm._s(_vm.editMode ? _vm.$t("Update") : _vm.$t("Add New"))
                  )
                ]
              ),
              _vm._v(" "),
              _vm._m(0)
            ]),
            _vm._v(" "),
            _c(
              "form",
              {
                on: {
                  submit: function($event) {
                    $event.preventDefault()
                    _vm.editMode ? _vm.updateAccount() : _vm.createAccount()
                  },
                  keydown: function($event) {
                    return _vm.form.onKeydown($event)
                  }
                }
              },
              [
                _c(
                  "div",
                  { staticClass: "modal-body" },
                  [
                    _c("form-group-input", {
                      attrs: {
                        form: _vm.form,
                        name: "name",
                        label: _vm.$t("Name")
                      },
                      model: {
                        value: _vm.form.name,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "name", $$v)
                        },
                        expression: "form.name"
                      }
                    }),
                    _vm._v(" "),
                    _c("form-group-input", {
                      attrs: {
                        form: _vm.form,
                        type: "number",
                        name: "amount",
                        label: _vm.$t("amount")
                      },
                      model: {
                        value: _vm.form.amount,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "amount", $$v)
                        },
                        expression: "form.amount"
                      }
                    }),
                    _vm._v(" "),
                    _c("form-group-input", {
                      attrs: {
                        form: _vm.form,
                        type: "text",
                        name: "bank_account",
                        label: _vm.$t("BankAccount")
                      },
                      model: {
                        value: _vm.form.bank_account,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "bank_account", $$v)
                        },
                        expression: "form.bank_account"
                      }
                    }),
                    _vm._v(" "),
                    _c("form-group-input", {
                      attrs: {
                        form: _vm.form,
                        type: "text",
                        name: "bank_branch",
                        label: _vm.$t("BankBranch")
                      },
                      model: {
                        value: _vm.form.bank_branch,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "bank_branch", $$v)
                        },
                        expression: "form.bank_branch"
                      }
                    }),
                    _vm._v(" "),
                    _c("form-group-toggle", {
                      attrs: {
                        form: _vm.form,
                        id: "isActive",
                        label: _vm.$t("Publication_Status")
                      },
                      model: {
                        value: _vm.form.isActive,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "isActive", $$v)
                        },
                        expression: "form.isActive"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-secondary",
                      attrs: { type: "button", "data-dismiss": "modal" }
                    },
                    [
                      _vm._v(
                        _vm._s(_vm.$t("Close")) + "\n                        "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { disabled: _vm.form.busy, type: "submit" }
                    },
                    [
                      _vm._v(
                        "\n                            " +
                          _vm._s(
                            _vm.editMode ? _vm.$t("Update") : _vm.$t("Create")
                          ) +
                          "\n                        "
                      )
                    ]
                  )
                ])
              ]
            )
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "close",
        attrs: {
          type: "button",
          "data-dismiss": "modal",
          "aria-label": "Close"
        }
      },
      [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Accountant/ManageAccount.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/Accountant/ManageAccount.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true& */ "./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true&");
/* harmony import */ var _ManageAccount_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManageAccount.vue?vue&type=script&lang=js& */ "./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ManageAccount_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "ab50cbc4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Accountant/ManageAccount.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ManageAccount_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ManageAccount.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/ManageAccount.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ManageAccount_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/ManageAccount.vue?vue&type=template&id=ab50cbc4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ManageAccount_vue_vue_type_template_id_ab50cbc4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/helpers/myTableDom.js":
/*!********************************************!*\
  !*** ./resources/js/helpers/myTableDom.js ***!
  \********************************************/
/*! exports provided: myTableDom */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "myTableDom", function() { return myTableDom; });
var myTableDom = {
  "bDestroy": true,
  retrieve: true,
  dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  pageLength: 10,
  buttons: [{
    extend: "print",
    text: "<i class='fas fa-print'></i> Print",
    titleAttr: "Print",
    className: "btn btn-info btn-sm text-white",
    exportOptions: {
      columns: ":not(.not-export-col)"
    }
  }, {
    extend: "pdfHtml5",
    text: "<i class='fas fa-file-pdf'></i> PDF",
    titleAttr: "Export as PDF",
    className: "btn btn-success btn-sm",
    exportOptions: {
      columns: ":not(.not-export-col)"
    },
    customize: function customize(doc, config) {
      doc.defaultStyle.font = 'SolaimanLipi';
      doc.styles.tableHeader.alignment = 'left';
      doc.defaultStyle.alignment = 'left';
      doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
      doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
      var tableNode;

      for (var i = 0; i < doc.content.length; ++i) {
        if (doc.content[i].table !== undefined) {
          tableNode = doc.content[i];
          break;
        }
      }

      var rowIndex = 0;
      var tableColumnCount = tableNode.table.body[rowIndex].length;

      if (tableColumnCount > 6) {
        doc.pageOrientation = 'landscape';
      }
    }
  }, {
    extend: "excelHtml5",
    text: "<i class='fas fa-file-excel'></i> Excel",
    titleAttr: "Export as Excel",
    className: "btn btn-secondary btn-sm",
    exportOptions: {
      columns: ":not(.not-export-col)"
    }
  }, {
    extend: "copyHtml5",
    text: "<i class='fas fa-copy'></i> Copy",
    titleAttr: "Copy to clipboard",
    className: "btn btn-info btn-sm text-white",
    exportOptions: {
      columns: ":not(.not-export-col)"
    }
  }]
};

/***/ })

}]);