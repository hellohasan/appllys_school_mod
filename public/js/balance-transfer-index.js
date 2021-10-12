(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/balance-transfer-index"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Index",
  methods: {
    myTable: function myTable() {
      $("#myTable").DataTable().clear().destroy();
      $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        retrieve: true,
        destroy: true,
        ajax: {
          url: "/api/balance-transfer",
          type: "GET",
          headers: {
            Authorization: "Bearer " + this.$store.getters.currentUser.token
          }
        },
        columns: [{
          data: "DT_RowIndex"
        }, {
          data: "created_at"
        }, {
          data: "custom"
        }, {
          data: "from_account_id"
        }, {
          data: "amount",
          className: "bg-gray"
        }, {
          data: "from_charge"
        }, {
          data: "from_total",
          className: "bg-cyan"
        }, {
          data: "to_account_id"
        }, {
          data: "amount",
          className: "bg-gray"
        }, {
          data: "to_charge"
        }, {
          data: "to_total",
          className: "bg-cyan"
        }, {
          data: "action"
        }],
        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
            doc.defaultStyle.font = "SolaimanLipi";
            doc.styles.tableHeader.alignment = "left";
            doc.defaultStyle.alignment = "left";
            doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join("*").split("");
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
              doc.pageOrientation = "landscape";
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
      });
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.myTable();
    window.addEventListener("click", function (event) {
      var target = event.target;

      if (target && target.localName === "button" && target.dataset.id) {
        event.preventDefault();
        event.stopPropagation();
        var id = target.dataset.id;
        var action = target.dataset.action;

        if (action == "delete") {
          Swal.fire({
            title: _this.$t("confirm_title"),
            text: _this.$t("confirm_message"),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: _this.$t("confirm"),
            cancelButtonText: _this.$t("cancel")
          }).then(function (result) {
            if (result.isConfirmed) {
              axios["delete"]("/api/balance-transfer/".concat(id)).then(function (res) {
                Toast.fire({
                  icon: "success",
                  title: _this.$t("delete_message")
                });

                _this.myTable();
              });
            }
          });
        } else if (action == "show") {
          _this.$router.push("/balance-transfer/".concat(id, "/show"));
        }
      }

      return;
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************/
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
        title: _vm.$t("BalanceTransferList"),
        url: "/balance-transfer/create",
        icon: "fas fa-plus",
        text: _vm.$t("NewBalanceTransfer")
      }
    },
    [
      _c("div", { staticClass: "table-responsive" }, [
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
                _c("th", [_vm._v(_vm._s(_vm.$t("DateTime")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Custom")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("SenderAccount")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("SendingAmount")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("TransferCharge")) + " (+)")]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("TotalSend")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("ReceiveAccount")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("ReceivingAmount")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("ReceivingCharge")) + " (-)")]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("TotalReceive")))]),
                _vm._v(" "),
                _c("th", { staticClass: "not-export-col" }, [
                  _vm._v(_vm._s(_vm.$t("Action")))
                ])
              ])
            ])
          ]
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Accountant/BalanceTransfer/Index.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Accountant/BalanceTransfer/Index.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=38e775a0&scoped=true& */ "./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "38e775a0",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Accountant/BalanceTransfer/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true& ***!
  \*****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=38e775a0&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Accountant/BalanceTransfer/Index.vue?vue&type=template&id=38e775a0&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_38e775a0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);