"use strict";

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

document.addEventListener('alpine:init', function () {
  Alpine.data('productImagePreview', function () {
    return {
      status: 0,
      source: null,
      cropper: null,
      cropperConfig: {
        aspectRatio: 4 / 3,
        viewMode: 1 //Restrict the cropper to the image

      },
      croppedImage: null,
      getBlobAsync: function getBlobAsync() {
        var _this = this;

        return new Promise(function (resolve, reject) {
          if (_this.cropper === null) {
            reject('There still no data in cropper');
          } else {
            _this.cropper.getCroppedCanvas().toBlob(function (result) {
              resolve(result);
            });
          }
        });
      },
      cropImage: function cropImage() {
        var _this2 = this;

        console.log(this);
        this.$nextTick(function () {
          var imageEl = _this2.$refs.previewImage;
          _this2.cropper = new Cropper(imageEl, _this2.cropperConfig);
        });
      },
      cancel: function cancel() {
        this.cropper.destroy();
        this.cropper = null;
        this.source = null;
        this.status = 0;
        this.$refs.finalInput.files = null;
      },
      saveAsync: function saveAsync() {
        var _this3 = this;

        return _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee() {
          var blob, file, dt;
          return regeneratorRuntime.wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  _context.next = 2;
                  return _this3.getBlobAsync();

                case 2:
                  blob = _context.sent;
                  file = new File([blob], 'croppedImage.png');
                  dt = new DataTransfer();
                  dt.items.add(file);
                  _this3.$refs.finalInput.files = dt.files;
                  _this3.$refs.previewImageToBeUploaded.src = URL.createObjectURL(file);
                  _this3.status = 2;

                case 9:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }))();
      },
      preventIfHasFile: function preventIfHasFile(e) {
        if (this.source !== null) {
          e.preventDefault();
        }
      },
      previewFile: function previewFile(e) {
        var _e$target$files = _slicedToArray(e.target.files, 1),
            file = _e$target$files[0];

        if (file) {
          this.source = URL.createObjectURL(file);
          this.cropImage();
          this.status = 1;
        }
      }
    };
  });
  ClassicEditor.create(document.querySelector('#editor')).then(function (editor) {
    console.log(editor);
  })["catch"](function (error) {
    console.error(error);
  });
});