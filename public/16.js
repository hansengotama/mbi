(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helper_request__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../helper/request */ "./resources/helper/request.js");
/* harmony import */ var _helper_alert__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../helper/alert */ "./resources/helper/alert.js");
//
//
//
//
//
//
//
//
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
  props: ['accessToken'],
  data: function data() {
    return {
      formData: {
        name: ""
      },
      loading: false,
      selectedRegion: null
    };
  },
  mounted: function mounted() {
    this.setData();
  },
  components: {
    Panel: function Panel() {
      return __webpack_require__.e(/*! import() */ 0).then(__webpack_require__.bind(null, /*! ../../../../components/panel/_index */ "./resources/components/panel/_index.vue"));
    },
    RegionForm: function RegionForm() {
      return __webpack_require__.e(/*! import() */ 5).then(__webpack_require__.bind(null, /*! ../form/_index */ "./resources/views/page/region/form/_index.vue"));
    }
  },
  methods: {
    setData: function setData() {
      var data = this.$route.params.data;

      if (!data) {
        this.backToManagement();
        return false;
      }

      this.selectedRegion = data.id;
      this.formData.name = data.name;
      this.formData.district_id = data.district_id;
    },
    saveRegion: function saveRegion() {
      var _this = this;

      this.loading = true;
      _helper_request__WEBPACK_IMPORTED_MODULE_0__["default"].post('/api/region/update/' + this.selectedRegion, this.formData, this.accessToken).then(function (response) {
        _this.loading = false;

        if (response.data.success) {
          _helper_alert__WEBPACK_IMPORTED_MODULE_1__["default"].success();

          _this.$refs.form.resetForm();

          _this.backToManagement();
        } else _helper_alert__WEBPACK_IMPORTED_MODULE_1__["default"].error();
      });
    },
    backToManagement: function backToManagement() {
      this.$router.push({
        name: "Region Management"
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports
exports.push([module.i, "@import url(https://fonts.googleapis.com/css?family=Public+Sans&display=swap);", ""]);

// module
exports.push([module.i, ".orange[data-v-2b3b7134] {\n  color: #f77321;\n}\n.blue[data-v-2b3b7134] {\n  color: #0000f5;\n}\n.soft-blue[data-v-2b3b7134] {\n  color: #0076bd;\n}\n.red[data-v-2b3b7134] {\n  color: #f00;\n}\n.display-flex[data-v-2b3b7134] {\n  display: -webkit-box;\n  display: flex;\n}\n.display-block[data-v-2b3b7134] {\n  display: block;\n}\nhtml[data-v-2b3b7134],\nbody[data-v-2b3b7134] {\n  font-family: 'Public Sans', sans-serif !important;\n  font-size: 14px;\n}\nhtml[data-v-2b3b7134],\nbody[data-v-2b3b7134] {\n  width: 100%;\n  min-height: 100%;\n}\ninput[data-v-2b3b7134]:active,\ninput[data-v-2b3b7134]:focus,\nbutton[data-v-2b3b7134]:active,\nbutton[data-v-2b3b7134]:focus,\nselect[data-v-2b3b7134]:active,\nselect[data-v-2b3b7134]:focus {\n  outline: none;\n}\ninput.error[data-v-2b3b7134] {\n  border-color: #f00 !important;\n  margin-bottom: 5px;\n}\ntable[data-v-2b3b7134],\ntr[data-v-2b3b7134] {\n  width: 100%;\n}\ntable > tr > th[data-v-2b3b7134] {\n  padding-bottom: 12px;\n  text-transform: uppercase;\n  font-size: 14px;\n  font-weight: normal;\n  border-bottom: 2px solid #f0f0f0;\n}\ntable > tr > td[data-v-2b3b7134] {\n  padding: 10px 15px;\n  border-left: none;\n  border-right: none;\n}\n.table-container[data-v-2b3b7134] {\n  overflow-x: auto;\n}\n.text-center[data-v-2b3b7134] {\n  text-align: center;\n}\n.mt-1[data-v-2b3b7134] {\n  margin-top: 1em;\n}\n.mt-2[data-v-2b3b7134] {\n  margin-top: 2em;\n}\n.mt-3[data-v-2b3b7134] {\n  margin-top: 3em;\n}\n.mt-4[data-v-2b3b7134] {\n  margin-top: 4em;\n}\n.mt-5[data-v-2b3b7134] {\n  margin-top: 5em;\n}\n#edit-region[data-v-2b3b7134] {\n  padding-top: 15px;\n}\n.back-to-management[data-v-2b3b7134] {\n  padding-left: 15px;\n  color: #f77321;\n  font-weight: 700;\n  cursor: pointer;\n  margin-top: 1em;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--10-2!../../../../../node_modules/stylus-loader!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
    "div",
    { attrs: { id: "edit-region" } },
    [
      _c(
        "div",
        {
          staticClass: "back-to-management",
          on: {
            click: function($event) {
              return _vm.backToManagement()
            }
          }
        },
        [_c("i", { staticClass: "fa fa-arrow-left" }), _vm._v(" KEMBALI\n    ")]
      ),
      _vm._v(" "),
      _c(
        "panel",
        { attrs: { title: "Ubah Kecamatan" } },
        [
          _c(
            "template",
            { slot: "body" },
            [
              _c("region-form", {
                ref: "form",
                attrs: { formData: _vm.formData, loading: _vm.loading },
                on: { saveRegion: _vm.saveRegion }
              })
            ],
            1
          )
        ],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/helper/alert.js":
/*!***********************************!*\
  !*** ./resources/helper/alert.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  loading: function loading() {
    sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.showLoading();
    $('.swal2-html-container').show();
    $('.swal2-html-container').text('Mohon Tunggu');
  },
  success: function success() {
    sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.hideLoading();
    return sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.fire({
      title: 'Success!',
      icon: 'success',
      confirmButtonText: 'Ok',
      allowOutsideClick: false
    });
  },
  error: function error() {
    var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.hideLoading();
    return sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.fire({
      title: 'Error!',
      icon: 'error',
      text: message,
      confirmButtonText: 'Ok'
    });
  },
  confirmation: function confirmation(title, confirmText, cancelText) {
    return sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.fire({
      title: title,
      icon: 'warning',
      confirmButtonText: confirmText,
      cancelButtonText: cancelText,
      showCancelButton: true,
      showCloseButton: true
    });
  }
});

/***/ }),

/***/ "./resources/views/page/region/edit/_index.vue":
/*!*****************************************************!*\
  !*** ./resources/views/page/region/edit/_index.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_index.vue?vue&type=template&id=2b3b7134&scoped=true& */ "./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_index.vue?vue&type=script&lang=js& */ "./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& */ "./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "2b3b7134",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/views/page/region/edit/_index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& ***!
  \*****************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--10-2!../../../../../node_modules/stylus-loader!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=style&index=0&id=2b3b7134&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_2b3b7134_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=template&id=2b3b7134&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/region/edit/_index.vue?vue&type=template&id=2b3b7134&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_2b3b7134_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);