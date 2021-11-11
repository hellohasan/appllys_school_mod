(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/academic-exam-index"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
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
__webpack_require__(/*! datatables.net-bs4/js/dataTables.bootstrap4.min */ "./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js");

__webpack_require__(/*! datatables.net-buttons-bs4/js/buttons.bootstrap4.min */ "./node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js");

__webpack_require__(/*! datatables.net-buttons/js/buttons.html5 */ "./node_modules/datatables.net-buttons/js/buttons.html5.js");

__webpack_require__(/*! datatables.net-buttons/js/buttons.colVis */ "./node_modules/datatables.net-buttons/js/buttons.colVis.js");

__webpack_require__(/*! datatables.net-buttons/js/buttons.print */ "./node_modules/datatables.net-buttons/js/buttons.print.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'Index',
  data: function data() {
    return {
      exams: {}
    };
  },
  methods: {
    loadExamList: function loadExamList() {
      var _this = this;

      axios.get("/api/academic-exam").then(function (res) {
        _this.exams = res.data;

        _this.myTable();
      });
    },
    myTable: function myTable() {
      this.$nextTick(function () {
        $('#myTable').DataTable({
          responsive: true,
          retrieve: true,
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          buttons: [{
            "extend": "copyHtml5",
            "text": "<i class='fas fa-copy'></i> Copy",
            "titleAttr": "Copy to clipboard",
            "className": "btn btn-secondary btn-sm",
            exportOptions: {
              columns: ":not(.not-export-col)"
            }
          }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Export as Excel",
            "className": "btn btn-success btn-sm",
            exportOptions: {
              columns: ":not(.not-export-col)"
            }
          }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Export as PDF",
            "className": "btn btn-danger btn-sm",
            exportOptions: {
              columns: ":not(.not-export-col)"
            },
            customize: function customize(doc) {
              doc.defaultStyle.font = 'SolaimanLipi';
              doc.styles.tableHeader.alignment = 'left';
              doc.defaultStyle.alignment = 'left';
              doc.styles.title = {
                color: 'red',
                fontSize: '25',
                alignment: 'center'
              };
              doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
              doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            }
          }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Export as CSV",
            "className": "btn btn-info btn-sm text-white",
            exportOptions: {
              columns: ":not(.not-export-col)"
            }
          }, {
            "extend": "print",
            "text": "<i class='fas fa-print'></i> Print",
            "titleAttr": "Print",
            "className": "btn btn-secondary btn-sm",
            exportOptions: {
              columns: ":not(.not-export-col)"
            }
          }, {
            "extend": "colvis",
            "text": "<i class='fas fa-print'></i> Column",
            "titleAttr": "Column Sort",
            "className": "btn btn-info btn-sm text-white",
            exportOptions: {
              columns: ":not(.not-export-col)"
            }
          }]
        });
      });
    }
  },
  created: function created() {
    this.loadExamList();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
        title: _vm.$t("ExamList"),
        url: "/academic-exam-create",
        text: _vm.$t("ExamList")
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
                _c("th", [_vm._v(_vm._s(_vm.$t("Custom")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Title")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("StartDate")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("EndDate")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Total")))]),
                _vm._v(" "),
                _c("th", [_vm._v(_vm._s(_vm.$t("Routine")))]),
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
              _vm._l(_vm.exams, function(exam, index) {
                return _c("tr", { key: index }, [
                  _c("td", [_vm._v(_vm._s(++index))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(exam.custom))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(exam.title))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm._f("myDate")(exam.start_date)))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm._f("myDate")(exam.end_date)))]),
                  _vm._v(" "),
                  _c("td", [
                    _vm._v(_vm._s(_vm._f("students")(exam.students_count)))
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "span",
                      {
                        staticClass: "badge cursor-pointer",
                        class: exam.is_routine
                          ? "badge-success"
                          : "badge-warning"
                      },
                      [_vm._v(_vm._s(exam.is_routine ? "Created" : "Pending"))]
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "span",
                      {
                        staticClass: "badge cursor-pointer",
                        class: exam.status ? "badge-success" : "badge-warning"
                      },
                      [_vm._v(_vm._s(exam.status ? "Complete" : "Pending"))]
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "div",
                      {
                        staticClass: "btn-group btn-group-sm",
                        attrs: { role: "group", "aria-label": "..." }
                      },
                      [
                        _c(
                          "router-link",
                          {
                            staticClass: "btn btn-sm btn-info",
                            attrs: {
                              to: "/academic-exam/" + exam.custom + "/routine"
                            }
                          },
                          [
                            _c("i", { staticClass: "fas fa-list-alt" }),
                            _vm._v(" Routine")
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "router-link",
                          {
                            staticClass: "btn btn-sm btn-primary",
                            attrs: {
                              to: "/academic-exam/" + exam.custom + "/show"
                            }
                          },
                          [
                            _c("i", { staticClass: "fas fa-eye" }),
                            _vm._v(" Show")
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-sm btn-danger",
                            attrs: { type: "button" }
                          },
                          [
                            _c("i", { staticClass: "fas fa-trash" }),
                            _vm._v(" Delete")
                          ]
                        )
                      ],
                      1
                    )
                  ])
                ])
              }),
              0
            )
          ]
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Academic/Exam/Index.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Index.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=7f7911cf&scoped=true& */ "./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7f7911cf",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Academic/Exam/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=7f7911cf&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Academic/Exam/Index.vue?vue&type=template&id=7f7911cf&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7f7911cf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);