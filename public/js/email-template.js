(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/email-template"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _globals_Summernote__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../globals/Summernote */ "./resources/js/components/globals/Summernote.vue");
//
//
//
//
//
//
//
//
//
//
//
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
  name: "EmailTemplate",
  components: {
    Summernote: _globals_Summernote__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      form: new Form({
        content: ''
      })
    };
  },
  methods: {
    submitEmailTemplate: function submitEmailTemplate() {
      var _this = this;

      this.form.post('api/update-email-template').then(function () {
        Toast.fire({
          icon: 'success',
          title: _this.$t('success_message')
        });
      });
    },
    loadEmailTemplate: function loadEmailTemplate() {
      var _this2 = this;

      axios.get('/api/get-email-template').then(function (res) {
        return _this2.form.content = res.data;
      });
    }
  },
  mounted: function mounted() {
    this.loadEmailTemplate();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Summernote",
  props: {
    value: {
      "default": ''
    },
    autofocus: {},
    placeholder: {
      type: String,
      "default": null
    },
    height: {
      type: Number,
      "default": 100
    }
  },
  data: function data() {
    return {
      minHeight: false
    };
  },
  watch: {
    value: function value(val) {
      if (this.summernote.summernote('code') !== val) {
        //this.summernote.summernote("editor.rewind")
        this.summernote.summernote('code', val);
      }
    }
  },
  computed: {
    id: function id() {
      return "sn_" + Date.now();
    }
  },
  beforeDestroy: function beforeDestroy() {
    $("#" + this.id).summernote("destroy");
  },
  mounted: function mounted() {
    this.summernote = $("#" + this.id).summernote({
      height: this.height,
      minHeight: "100px",
      focus: typeof this.autofocus !== 'undefined',
      placeholder: this.placeholder,
      lineHeight: 20,
      toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']], ['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['table', ['table']], ['insert', ['picture', 'video']], ['view', ['fullscreen', 'codeview', 'help']]]
    });
    this.summernote.on('summernote.change', this.onChange);
    $("#" + this.id).next().find(".note-toolbar").find("[data-toggle=dropdown]").attr('onclick', '$(this).next().toggle()').next().attr('onclick', '$(this).toggle()');
  },
  methods: {
    onChange: function onChange(we) {
      this.$emit('input', we.target.value);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& ***!
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
  return _c("card", { attrs: { title: _vm.$t("Email_template") } }, [
    _c(
      "form",
      {
        attrs: { role: "form", method: "post" },
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.submitEmailTemplate($event)
          }
        }
      },
      [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-sm-12" }, [
            _c(
              "div",
              { staticClass: "form-group" },
              [
                _c("summernote", {
                  class: { "is-invalid": _vm.form.errors.has("content") },
                  attrs: { height: 320 },
                  model: {
                    value: _vm.form.content,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "content", $$v)
                    },
                    expression: "form.content"
                  }
                }),
                _vm._v(" "),
                _c("has-error", { attrs: { form: _vm.form, field: "content" } })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "form-group" },
              [
                _c("v-button", { attrs: { loading: _vm.form.busy } }, [
                  _c("i", { staticClass: "fas fa-cogs" }),
                  _vm._v(
                    " " + _vm._s(_vm.$t("update")) + "\n                    "
                  )
                ])
              ],
              1
            )
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& ***!
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
  return _c("textarea", {
    attrs: { id: _vm.id },
    domProps: { value: _vm.value },
    on: { change: _vm.onChange }
  })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& */ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&");
/* harmony import */ var _EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EmailTemplate.vue?vue&type=script&lang=js& */ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "2e791a55",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Settings/EmailTemplate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmailTemplate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Settings/EmailTemplate.vue?vue&type=template&id=2e791a55&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmailTemplate_vue_vue_type_template_id_2e791a55_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& */ "./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&");
/* harmony import */ var _Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Summernote.vue?vue&type=script&lang=js& */ "./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0065c7ea",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/globals/Summernote.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Summernote.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Summernote.vue?vue&type=template&id=0065c7ea&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/globals/Summernote.vue?vue&type=template&id=0065c7ea&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Summernote_vue_vue_type_template_id_0065c7ea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);