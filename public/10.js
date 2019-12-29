(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helper_validator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../helper/validator */ "./resources/helper/validator.js");
/* harmony import */ var _helper_request__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../helper/request */ "./resources/helper/request.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: ['formData', 'loading', 'isEdit', 'accessToken'],
  data: function data() {
    return {
      error: {
        message: {
          name: "",
          close_age: "",
          buried_date: "",
          deceased_date: "",
          buried_at: "",
          type: "",
          photo_url: ""
        },
        "class": {
          name: "",
          close_age: "",
          buried_date: "",
          deceased_date: "",
          buried_at: "",
          type: "",
          photo_url: ""
        }
      },
      file: null
    };
  },
  computed: {
    selectedRegion: {
      get: function get() {
        return this.$store.getters["getSelectedRegion"];
      },
      set: function set(value) {
        this.$store.commit("setSelectedRegion", value);
      }
    }
  },
  methods: {
    validate: function () {
      var _validate = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var validate;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                validate = true; // if(!this.validateName()) validate = false
                // if(!this.validateCloseAge()) validate = false
                // if(!this.validateBuriedDate()) validate = false
                // if(!this.validateBuriedAt()) validate = false
                // if(!this.validateDeceasedDate()) validate = false
                // if(!this.validateType()) validate = false

                if (!this.validatePhotoUrl()) validate = false;

                if (!validate) {
                  _context.next = 5;
                  break;
                }

                _context.next = 5;
                return this.uploadImage();

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function validate() {
        return _validate.apply(this, arguments);
      }

      return validate;
    }(),
    uploadImage: function uploadImage() {
      var _this = this;

      var imageFile = new FormData();
      var filePath = this.selectedRegion.name + "/deceased";
      imageFile.append('file_path', filePath);
      imageFile.append('file', this.file);
      _helper_request__WEBPACK_IMPORTED_MODULE_2__["default"].post("/api/assets/upload", imageFile, this.accessToken).then(function (response) {
        if (response.data.status) _this.formData.photo_url = filePath;
      });
    },
    validateName: function validateName() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.name)) {
        validate = false;
        this.error["class"].name = "error";
        this.error.message.name = "Nama harus terisi";
      } else {
        this.error["class"].name = "";
        this.error.message.name = "";
      }

      return validate;
    },
    validateCloseAge: function validateCloseAge() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.close_age)) {
        validate = false;
        this.error["class"].close_age = "error";
        this.error.message.close_age = "Umur terakhir harus terisi";
      } else {
        this.error["class"].close_age = "";
        this.error.message.close_age = "";
      }

      return validate;
    },
    validateBuriedDate: function validateBuriedDate() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.buried_date)) {
        validate = false;
        this.error["class"].buried_date = "error";
        this.error.message.buried_date = " Tanggal pemakaman harus terisi";
      } else {
        this.error["class"].buried_date = "";
        this.error.message.buried_date = "";
      }

      return validate;
    },
    validateBuriedAt: function validateBuriedAt() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.buried_at)) {
        validate = false;
        this.error["class"].buried_at = "error";
        this.error.message.buried_at = " Tempat pemakaman harus terisi";
      } else {
        this.error["class"].buried_at = "";
        this.error.message.buried_at = "";
      }

      return validate;
    },
    validateDeceasedDate: function validateDeceasedDate() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.deceased_date)) {
        validate = false;
        this.error["class"].deceased_date = "error";
        this.error.message.deceased_date = " Tempat pemakaman harus terisi";
      } else {
        this.error["class"].deceased_date = "";
        this.error.message.deceased_date = "";
      }

      return validate;
    },
    validateType: function validateType() {
      var validate = true;

      if (_helper_validator__WEBPACK_IMPORTED_MODULE_1__["default"].required(this.formData.type)) {
        validate = false;
        this.error["class"].type = "error";
        this.error.message.type = " Tipe harus terisi";
      } else {
        this.error["class"].type = "";
        this.error.message.type = "";
      }

      return validate;
    },
    validatePhotoUrl: function validatePhotoUrl() {
      var validate = true;
      var dataType = [];
      if (this.file != null) dataType = this.file.type.split('/');

      if (!this.isEdit && this.file == null) {
        validate = false;
        this.error["class"].photo_url = "error";
        this.error.message.photo_url = " Foto harus terisi";
      } else if (this.file != null && dataType[0] != "image") {
        this.error["class"].photo_url = "error";
        this.error.message.photo_url = "File yang diupload harus berupa image";
      } else {
        this.error["class"].photo_url = "";
        this.error.message.photo_url = "";
      }

      return validate;
    },
    resetForm: function resetForm() {
      this.formData.name = "";
      this.formData.close_age = "";
      this.formData.buried_date = "";
      this.formData.deceased_date = "";
      this.formData.buried_at = "";
      this.formData.type = "";
      this.formData.photo_url = "";
      this.file = null;
    },
    setImage: function setImage(e) {
      this.file = e.target.files[0];
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports
exports.push([module.i, "@import url(https://fonts.googleapis.com/css?family=Public+Sans&display=swap);", ""]);

// module
exports.push([module.i, ".orange[data-v-1f0dc6fa] {\n  color: #f77321;\n}\n.blue[data-v-1f0dc6fa] {\n  color: #0000f5;\n}\n.soft-blue[data-v-1f0dc6fa] {\n  color: #0076bd;\n}\n.red[data-v-1f0dc6fa] {\n  color: #f00;\n}\n.display-flex[data-v-1f0dc6fa] {\n  display: -webkit-box;\n  display: flex;\n}\n.display-block[data-v-1f0dc6fa] {\n  display: block;\n}\nhtml[data-v-1f0dc6fa],\nbody[data-v-1f0dc6fa] {\n  font-family: 'Public Sans', sans-serif !important;\n  font-size: 14px;\n}\nhtml[data-v-1f0dc6fa],\nbody[data-v-1f0dc6fa] {\n  width: 100%;\n  min-height: 100%;\n}\ninput[data-v-1f0dc6fa]:active,\ninput[data-v-1f0dc6fa]:focus,\nbutton[data-v-1f0dc6fa]:active,\nbutton[data-v-1f0dc6fa]:focus,\nselect[data-v-1f0dc6fa]:active,\nselect[data-v-1f0dc6fa]:focus {\n  outline: none;\n}\ninput.error[data-v-1f0dc6fa] {\n  border-color: #f00 !important;\n  margin-bottom: 5px;\n}\ntable[data-v-1f0dc6fa],\ntr[data-v-1f0dc6fa] {\n  width: 100%;\n}\ntable > tr > th[data-v-1f0dc6fa] {\n  padding-bottom: 12px;\n  text-transform: uppercase;\n  font-size: 14px;\n  font-weight: normal;\n  border-bottom: 2px solid #f0f0f0;\n}\ntable > tr > td[data-v-1f0dc6fa] {\n  padding: 10px 15px;\n  border-left: none;\n  border-right: none;\n}\n.table-container[data-v-1f0dc6fa] {\n  overflow-x: auto;\n}\n.text-center[data-v-1f0dc6fa] {\n  text-align: center;\n}\n.mt-1[data-v-1f0dc6fa] {\n  margin-top: 1em;\n}\n.mt-2[data-v-1f0dc6fa] {\n  margin-top: 2em;\n}\n.mt-3[data-v-1f0dc6fa] {\n  margin-top: 3em;\n}\n.mt-4[data-v-1f0dc6fa] {\n  margin-top: 4em;\n}\n.mt-5[data-v-1f0dc6fa] {\n  margin-top: 5em;\n}\n.deceased-form[data-v-1f0dc6fa] {\n  margin: 1em;\n  margin-top: -1em;\n}\n.deceased-form > .form-container[data-v-1f0dc6fa] {\n  display: -webkit-box;\n  display: flex;\n  -webkit-box-align: center;\n          align-items: center;\n  margin-top: 2em;\n}\n.deceased-form > .form-container > .label[data-v-1f0dc6fa] {\n  -webkit-box-flex: 1;\n          flex: 1;\n}\n.deceased-form > .form-container > .label > i[data-v-1f0dc6fa] {\n  cursor: pointer;\n}\n.deceased-form > .form-container > .input-container[data-v-1f0dc6fa] {\n  -webkit-box-flex: 2;\n          flex: 2;\n}\n.deceased-form > .form-container > .input-container > select[data-v-1f0dc6fa],\n.deceased-form > .form-container > .input-container > input[data-v-1f0dc6fa] {\n  width: 100%;\n  box-shadow: 2px;\n  -webkit-box-shadow: 2px;\n  -moz-box-shadow: 2px;\n  border: 1px solid #eaeaea;\n  border-radius: 3px;\n  -webkit-border-radius: 3px;\n  -moz-border-radius: 3px;\n  padding: 6px 12px;\n  background: #fff;\n  -webkit-background: #fff;\n  -moz-background: #fff;\n}\n.deceased-form > .form-container > .input-container > input.error[data-v-1f0dc6fa] {\n  border: 1px solid #f00;\n  box-shadow: 2px;\n  -webkit-box-shadow: 2px;\n  -moz-box-shadow: 2px;\n}\n.deceased-form > .button-container[data-v-1f0dc6fa] {\n  margin-top: 2em;\n}\n.deceased-form > .button-container > button[data-v-1f0dc6fa] {\n  background: #f77321;\n  -webkit-background: #f77321;\n  -moz-background: #f77321;\n  border: none;\n  border-bottom: 3px solid #b8860b;\n  color: #fff;\n  padding: 5px 18px;\n  border-radius: 5px;\n  -webkit-border-radius: 5px;\n  -moz-border-radius: 5px;\n  text-transform: uppercase;\n  cursor: pointer;\n}\n.deceased-form > .button-container > .loading[data-v-1f0dc6fa] {\n  margin-left: -25px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--10-2!../../../../../node_modules/stylus-loader!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "deceased-form" }, [
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _c("i", {
          directives: [
            {
              name: "show",
              rawName: "v-show",
              value: _vm.isEdit,
              expression: "isEdit"
            }
          ],
          staticClass: "fa fa-eye"
        }),
        _vm._v(" Foto\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          class: _vm.error.class.photo_url,
          attrs: { type: "file", accept: "image/*" },
          on: {
            change: function($event) {
              return _vm.setImage($event)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.photo_url))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Nama\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.name,
              expression: "formData.name"
            }
          ],
          class: _vm.error.class.name,
          attrs: { type: "text", placeholder: "nama" },
          domProps: { value: _vm.formData.name },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "name", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.name))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Umur Terakhir\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.close_age,
              expression: "formData.close_age"
            }
          ],
          class: _vm.error.class.close_age,
          attrs: { type: "number", placeholder: "umur terakhir" },
          domProps: { value: _vm.formData.close_age },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "close_age", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.close_age))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Tanggal Pemakaman\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.buried_date,
              expression: "formData.buried_date"
            }
          ],
          class: _vm.error.class.buried_date,
          attrs: { type: "date", placeholder: "tanggal pemakanan" },
          domProps: { value: _vm.formData.buried_date },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "buried_date", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.buried_date))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Tempat Pemakaman\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.buried_at,
              expression: "formData.buried_at"
            }
          ],
          class: _vm.error.class.buried_at,
          attrs: { type: "text", placeholder: "tempat pemakaman" },
          domProps: { value: _vm.formData.buried_at },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "buried_at", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.buried_at))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Tanggal Meninggal\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.deceased_date,
              expression: "formData.deceased_date"
            }
          ],
          class: _vm.error.class.deceased_date,
          attrs: { type: "date", placeholder: "tanggal meninggal" },
          domProps: { value: _vm.formData.deceased_date },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "deceased_date", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.deceased_date))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "form-container" }, [
      _c("div", { staticClass: "label" }, [
        _vm._v("\n            Tipe\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-container" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.formData.type,
              expression: "formData.type"
            }
          ],
          class: _vm.error.class.type,
          attrs: { type: "text", placeholder: "tipe" },
          domProps: { value: _vm.formData.type },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.formData, "type", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("small", { staticClass: "red" }, [
          _vm._v(_vm._s(_vm.error.message.type))
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "button-container" }, [
      !_vm.loading
        ? _c(
            "button",
            {
              on: {
                click: function($event) {
                  return _vm.validate()
                }
              }
            },
            [_vm._v("simpan")]
          )
        : _c("div", { staticClass: "loading" }, [
            _c("img", {
              attrs: {
                src: __webpack_require__(/*! ../../../../../public/images/admin/loading.gif */ "./public/images/admin/loading.gif"),
                height: "30px"
              }
            })
          ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./public/images/admin/loading.gif":
/*!*****************************************!*\
  !*** ./public/images/admin/loading.gif ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/loading.gif?1d7626e6cbbdc02be15b16fa36add9ae";

/***/ }),

/***/ "./resources/helper/validator.js":
/*!***************************************!*\
  !*** ./resources/helper/validator.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  required: function required(value) {
    return value.length < 1 ? true : false;
  },
  requiredDate: function requiredDate(value) {
    return !moment__WEBPACK_IMPORTED_MODULE_0___default()(value).isValid();
  },
  endDate: function endDate(startDate, _endDate) {
    return !(startDate <= _endDate);
  },
  min: function min(value, _min) {
    return parseInt(value) < _min ? true : false;
  },
  onlyText: function onlyText(value) {
    var regex = /\d/;
    return regex.test(value);
  },
  emailFormat: function emailFormat(value) {
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return !regex.test(String(value).toLowerCase());
  },
  modulus: function modulus(value, multiples) {
    return value % multiples == 0 ? false : true;
  },
  onlyNumber: function onlyNumber(value) {
    var regex = /^[0-9]*$/;
    return !regex.test(value);
  }
});

/***/ }),

/***/ "./resources/views/page/deceased/form/_index.vue":
/*!*******************************************************!*\
  !*** ./resources/views/page/deceased/form/_index.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_index.vue?vue&type=template&id=1f0dc6fa&scoped=true& */ "./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_index.vue?vue&type=script&lang=js& */ "./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& */ "./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1f0dc6fa",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/views/page/deceased/form/_index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&":
/*!*******************************************************************************************************************!*\
  !*** ./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& ***!
  \*******************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--10-2!../../../../../node_modules/stylus-loader!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=style&index=0&id=1f0dc6fa&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_style_index_0_id_1f0dc6fa_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./_index.vue?vue&type=template&id=1f0dc6fa&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/page/deceased/form/_index.vue?vue&type=template&id=1f0dc6fa&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_1f0dc6fa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);