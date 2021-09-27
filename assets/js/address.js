"use strict";

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

var fetchRegionLocation = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee(region) {
    var _yield$axios$get, data;

    return regeneratorRuntime.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.prev = 0;
            _context.next = 3;
            return axios.get("".concat(php_base_url, "api.php?page=location&region=").concat(region));

          case 3:
            _yield$axios$get = _context.sent;
            data = _yield$axios$get.data;
            return _context.abrupt("return", data);

          case 8:
            _context.prev = 8;
            _context.t0 = _context["catch"](0);
            return _context.abrupt("return", {});

          case 11:
          case "end":
            return _context.stop();
        }
      }
    }, _callee, null, [[0, 8]]);
  }));

  return function fetchRegionLocation(_x) {
    return _ref.apply(this, arguments);
  };
}();

var unwrap = function unwrap(data) {
  return JSON.parse(JSON.stringify(data));
};

document.addEventListener('alpine:init', function () {
  Alpine.data('address', function () {
    return {
      all_location: {},

      get province_list() {
        var region = this.all_location[this.selected_region];
        if (region === undefined) return {};
        return region.province_list;
      },

      get municipality_list() {
        var province_list = this.province_list;
        var province = province_list[this.selected_province];
        if (province === undefined) return {};
        return province.municipality_list;
      },

      get barangay_list() {
        var municipality = this.municipality_list[this.selected_municipality];
        if (municipality === undefined) return [];
        return municipality.barangay_list;
      },

      get provinces() {
        return Object.keys(this.province_list);
      },

      get municipalities() {
        return Object.keys(this.municipality_list);
      },

      selected_region: '',
      selected_province: '',
      selected_municipality: '',
      selected_barangay: '',
      init: function init() {
        var _this = this;

        this.$watch('selected_region', /*#__PURE__*/function () {
          var _ref2 = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee2(selected) {
            return regeneratorRuntime.wrap(function _callee2$(_context2) {
              while (1) {
                switch (_context2.prev = _context2.next) {
                  case 0:
                    if (!(_this.all_location[selected] !== undefined)) {
                      _context2.next = 2;
                      break;
                    }

                    return _context2.abrupt("return");

                  case 2:
                    _context2.next = 4;
                    return fetchRegionLocation(selected);

                  case 4:
                    _this.all_location[selected] = _context2.sent;

                  case 5:
                  case "end":
                    return _context2.stop();
                }
              }
            }, _callee2);
          }));

          return function (_x2) {
            return _ref2.apply(this, arguments);
          };
        }());

        if (typeof php_region !== 'undefined') {
          this.all_location[php_region] = php_region_data;
          this.$nextTick(function () {
            _this.selected_region = php_region;
            if (typeof php_province !== 'undefined') _this.selected_province = php_province;
            if (typeof php_municipality !== 'undefined') _this.selected_municipality = php_municipality;
            if (typeof php_barangay !== 'undefined') _this.selected_barangay = php_barangay;
          });
        }
      }
    };
  });
});