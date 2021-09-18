(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["test"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/DataTable.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/test/DataTable.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
__webpack_require__(/*! ../../helpers/datatable */ "./resources/js/helpers/datatable.js");


/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Datatable",
  mounted: function mounted() {
    this.myTable();
  },
  methods: {
    myTable: function myTable() {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()("#myTable").DataTable({
        responsive: true
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_Select2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../globals/Select2 */ "./resources/js/components/globals/Select2.vue");
/* harmony import */ var _globals_VSelect__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../globals/VSelect */ "./resources/js/components/globals/VSelect.vue");
/* harmony import */ var vue_bootstrap_toggle__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-bootstrap-toggle */ "./node_modules/vue-bootstrap-toggle/dist/index.js");
/* harmony import */ var vue_bootstrap_toggle__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_bootstrap_toggle__WEBPACK_IMPORTED_MODULE_2__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "TestComponent",
  components: {
    VSelect: _globals_VSelect__WEBPACK_IMPORTED_MODULE_1__["default"],
    Select2: _globals_Select2__WEBPACK_IMPORTED_MODULE_0__["default"],
    BootstrapToggle: vue_bootstrap_toggle__WEBPACK_IMPORTED_MODULE_2___default.a
  },
  data: function data() {
    return {
      selected: '',
      selected2: '',
      selected3: '',

      /*customs:[
          {id:1, text: 'Primary'},
          {id:2, text: 'Lower Secondary'},
          {id:3, text: 'Secondary'},
          {id:4, text: 'Higher Secondary'},
          {id:5, text: 'Higher & Graduation'},
          {id:6, text: 'Graduation'},
      ],*/
      customs: [],
      checked: false,
      checked2: true,
      checkOptions: {
        on: 'ENABLEr',
        off: 'DISABLEgg',
        onstyle: 'success',
        offstyle: 'danger',
        width: '50%'
      }
    };
  },
  methods: {
    loadCustoms: function loadCustoms() {
      var _this = this;

      axios.get('/api/roles').then(function (res) {
        //this.customs = data.map(x => ({id:x.id, text: x.name}))
        //this.customs = res.data;
        _this.customs = res.data.map(function (x) {
          return {
            id: x.id,
            text: x.name
          };
        });
      });
    }
  },
  created: function created() {
    this.loadCustoms();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
        title: _vm.$t("Admission_list"),
        url: "/admissions/add",
        text: _vm.$t("New_admission"),
        icon: "fas fa-plus"
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
                _c("th", [_vm._v("Name")]),
                _vm._v(" "),
                _c("th", [_vm._v("Position")]),
                _vm._v(" "),
                _c("th", [_vm._v("Office")]),
                _vm._v(" "),
                _c("th", [_vm._v("Age")]),
                _vm._v(" "),
                _c("th", [_vm._v("Start date")]),
                _vm._v(" "),
                _c("th", [_vm._v("Salary")])
              ])
            ]),
            _vm._v(" "),
            _c("tbody", [
              _c("tr", [
                _c("td", [_vm._v("Tiger Nixon")]),
                _vm._v(" "),
                _c("td", [_vm._v("System Architect")]),
                _vm._v(" "),
                _c("td", [_vm._v("Edinburgh")]),
                _vm._v(" "),
                _c("td", [_vm._v("61")]),
                _vm._v(" "),
                _c("td", [_vm._v("2011/04/25")]),
                _vm._v(" "),
                _c("td", [_vm._v("$320,800")])
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************/
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
    { attrs: { title: _vm.$t("app_title") } },
    [
      _c(
        "div",
        { staticClass: "form-group" },
        [
          _c("label", { attrs: { for: "select" } }, [_vm._v("Vue Select")]),
          _vm._v(" "),
          _c("select2", {
            attrs: { options: _vm.customs },
            model: {
              value: _vm.selected,
              callback: function($$v) {
                _vm.selected = $$v
              },
              expression: "selected"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "form-group" },
        [
          _c("label", { attrs: { for: "select" } }, [_vm._v("Vue Select")]),
          _vm._v(" "),
          _c("select2", {
            attrs: { options: _vm.customs },
            model: {
              value: _vm.selected2,
              callback: function($$v) {
                _vm.selected2 = $$v
              },
              expression: "selected2"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "form-group" },
        [
          _c("label", { attrs: { for: "select" } }, [_vm._v("Vue Select")]),
          _vm._v(" "),
          _c("select2", {
            attrs: { options: _vm.customs },
            model: {
              value: _vm.selected3,
              callback: function($$v) {
                _vm.selected3 = $$v
              },
              expression: "selected3"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("bootstrap-toggle", {
        attrs: { options: _vm.checkOptions, disabled: false },
        model: {
          value: _vm.checked,
          callback: function($$v) {
            _vm.checked = $$v
          },
          expression: "checked"
        }
      }),
      _vm._v(" "),
      _c("bootstrap-toggle", {
        attrs: { id: "custum2", disabled: false },
        model: {
          value: _vm.checked2,
          callback: function($$v) {
            _vm.checked2 = $$v
          },
          expression: "checked2"
        }
      }),
      _vm._v(" "),
      _c("pre", { staticClass: "code" }, [
        _vm._v("            "),
        _c("span", { domProps: { textContent: _vm._s(_vm.selected) } }),
        _vm._v("\n            "),
        _c("span", { domProps: { textContent: _vm._s(_vm.selected2) } }),
        _vm._v("\n            "),
        _c("span", { domProps: { textContent: _vm._s(_vm.selected3) } }),
        _vm._v("\n        ")
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/test/DataTable.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/test/DataTable.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DataTable.vue?vue&type=template&id=6f249472&scoped=true& */ "./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true&");
/* harmony import */ var _DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DataTable.vue?vue&type=script&lang=js& */ "./resources/js/components/test/DataTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "6f249472",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/test/DataTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/test/DataTable.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/test/DataTable.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./DataTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/DataTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./DataTable.vue?vue&type=template&id=6f249472&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/DataTable.vue?vue&type=template&id=6f249472&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_6f249472_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/test/test/test/TestComponent.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/test/test/test/TestComponent.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true& */ "./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true&");
/* harmony import */ var _TestComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TestComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TestComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "e92c8ace",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/test/test/test/TestComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TestComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./TestComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/test/test/TestComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TestComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true&":
/*!*************************************************************************************************************!*\
  !*** ./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true& ***!
  \*************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/test/test/test/TestComponent.vue?vue&type=template&id=e92c8ace&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TestComponent_vue_vue_type_template_id_e92c8ace_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);