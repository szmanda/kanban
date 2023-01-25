(self["webpackChunk"] = self["webpackChunk"] || []).push([["task_search"],{

/***/ "./assets/js/jquery.instantSearch.js":
/*!*******************************************!*\
  !*** ./assets/js/jquery.instantSearch.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var __webpack_provided_window_dot_jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
__webpack_require__(/*! core-js/modules/es.string.search.js */ "./node_modules/core-js/modules/es.string.search.js");
__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
__webpack_require__(/*! core-js/modules/es.string.trim.js */ "./node_modules/core-js/modules/es.string.trim.js");
__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/**
 * jQuery plugin for an instant searching.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
(function ($) {
  'use strict';

  String.prototype.render = function (parameters) {
    return this.replace(/({{ (\w+) }})/g, function (match, pattern, name) {
      return parameters[name];
    });
  };

  // INSTANTS SEARCH PUBLIC CLASS DEFINITION
  // =======================================

  var InstantSearch = function InstantSearch(element, options) {
    this.$input = $(element);
    this.$form = this.$input.closest('form');
    this.$preview = $('<ul class="search-preview list-group">').appendTo(this.$form);
    this.options = $.extend({}, InstantSearch.DEFAULTS, this.$input.data(), options);
    this.$input.keyup(this.debounce());
  };
  InstantSearch.DEFAULTS = {
    minQueryLength: 2,
    limit: 10,
    delay: 500,
    noResultsMessage: 'No results found',
    itemTemplate: '\
                <article class="post">\
                    <h2><a href="{{ url }}">{{ title }}</a></h2>\
                    <p class="post-metadata">\
                       <span class="metadata"><i class="fa fa-calendar"></i> {{ date }}</span>\
                       <span class="metadata"><i class="fa fa-user"></i> {{ author }}</span>\
                    </p>\
                    <p>{{ summary }}</p>\
                </article>'
  };
  InstantSearch.prototype.debounce = function () {
    var delay = this.options.delay;
    var search = this.search;
    var timer = null;
    var self = this;
    return function () {
      clearTimeout(timer);
      timer = setTimeout(function () {
        search.apply(self);
      }, delay);
    };
  };
  InstantSearch.prototype.search = function () {
    var query = $.trim(this.$input.val()).replace(/\s{2,}/g, ' ');
    if (query.length < this.options.minQueryLength) {
      this.$preview.empty();
      return;
    }
    var self = this;
    var data = this.$form.serializeArray();
    data['l'] = this.limit;
    $.getJSON(this.$form.attr('action'), data, function (items) {
      self.show(items);
    });
  };
  InstantSearch.prototype.show = function (items) {
    var $preview = this.$preview;
    var itemTemplate = this.options.itemTemplate;
    if (0 === items.length) {
      $preview.html(this.options.noResultsMessage);
    } else {
      $preview.empty();
      $.each(items, function (index, item) {
        $preview.append(itemTemplate.render(item));
      });
    }
  };

  // INSTANTS SEARCH PLUGIN DEFINITION
  // =================================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this);
      var instance = $this.data('instantSearch');
      var options = _typeof(option) === 'object' && option;
      if (!instance) $this.data('instantSearch', instance = new InstantSearch(this, options));
      if (option === 'search') instance.search();
    });
  }
  $.fn.instantSearch = Plugin;
  $.fn.instantSearch.Constructor = InstantSearch;
})(__webpack_provided_window_dot_jQuery);

/***/ }),

/***/ "./assets/task_search.js":
/*!*******************************!*\
  !*** ./assets/task_search.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js/jquery.instantSearch.js */ "./assets/js/jquery.instantSearch.js");
/* harmony import */ var _js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0__);
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  $('.search-field').instantSearch({
    delay: 100,
    itemTemplate: '\
                <div class="card">\
                    <h4><a href="{{ url }}">{{ title }}</a></h4>\
                </div>'
  }).keyup();
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js","vendors-node_modules_core-js_internals_add-to-unscopables_js-node_modules_core-js_internals_a-dd2802","vendors-node_modules_core-js_internals_object-set-prototype-of_js-node_modules_core-js_module-345aa2","vendors-node_modules_core-js_modules_es_string_iterator_js-node_modules_core-js_modules_es_st-a38065"], () => (__webpack_exec__("./assets/task_search.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QyxRQUFRLEdBQUcsSUFBSTFDLGFBQWEsQ0FBQyxJQUFJLEVBQUVFLE9BQU8sQ0FBQyxDQUFFO01BRXpGLElBQUlzQyxNQUFNLEtBQUssUUFBUSxFQUFFRSxRQUFRLENBQUN4QixNQUFNLEVBQUU7SUFDOUMsQ0FBQyxDQUFDO0VBQ047RUFFQTNCLENBQUMsQ0FBQ29ELEVBQUUsQ0FBQ0MsYUFBYSxHQUFHTCxNQUFNO0VBQzNCaEQsQ0FBQyxDQUFDb0QsRUFBRSxDQUFDQyxhQUFhLENBQUNDLFdBQVcsR0FBRzdDLGFBQWE7QUFFbEQsQ0FBQyxFQUFFOEMsb0NBQWEsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7O0FDekdxQjtBQUV0Q3ZELENBQUMsQ0FBQyxZQUFXO0VBQ1RBLENBQUMsQ0FBQyxlQUFlLENBQUMsQ0FDYnFELGFBQWEsQ0FBQztJQUNYN0IsS0FBSyxFQUFFLEdBQUc7SUFDVkUsWUFBWSxFQUFFO0FBQzFCO0FBQ0E7QUFDQTtFQUNRLENBQUMsQ0FBQyxDQUNETixLQUFLLEVBQUU7QUFDaEIsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2pxdWVyeS5pbnN0YW50U2VhcmNoLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy90YXNrX3NlYXJjaC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIGpRdWVyeSBwbHVnaW4gZm9yIGFuIGluc3RhbnQgc2VhcmNoaW5nLlxuICpcbiAqIEBhdXRob3IgT2xlZyBWb3JvbmtvdmljaCA8b2xlZy12b3JvbmtvdmljaEB5YW5kZXgucnU+XG4gKiBAYXV0aG9yIFlvbmVsIENlcnV0byA8eW9uZWxjZXJ1dG9AZ21haWwuY29tPlxuICovXG4oZnVuY3Rpb24gKCQpIHtcbiAgICAndXNlIHN0cmljdCc7XG5cbiAgICBTdHJpbmcucHJvdG90eXBlLnJlbmRlciA9IGZ1bmN0aW9uIChwYXJhbWV0ZXJzKSB7XG4gICAgICAgIHJldHVybiB0aGlzLnJlcGxhY2UoLyh7eyAoXFx3KykgfX0pL2csIGZ1bmN0aW9uIChtYXRjaCwgcGF0dGVybiwgbmFtZSkge1xuICAgICAgICAgICAgcmV0dXJuIHBhcmFtZXRlcnNbbmFtZV07XG4gICAgICAgIH0pXG4gICAgfTtcblxuICAgIC8vIElOU1RBTlRTIFNFQVJDSCBQVUJMSUMgQ0xBU1MgREVGSU5JVElPTlxuICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuXG4gICAgdmFyIEluc3RhbnRTZWFyY2ggPSBmdW5jdGlvbiAoZWxlbWVudCwgb3B0aW9ucykge1xuICAgICAgICB0aGlzLiRpbnB1dCA9ICQoZWxlbWVudCk7XG4gICAgICAgIHRoaXMuJGZvcm0gPSB0aGlzLiRpbnB1dC5jbG9zZXN0KCdmb3JtJyk7XG4gICAgICAgIHRoaXMuJHByZXZpZXcgPSAkKCc8dWwgY2xhc3M9XCJzZWFyY2gtcHJldmlldyBsaXN0LWdyb3VwXCI+JykuYXBwZW5kVG8odGhpcy4kZm9ybSk7XG4gICAgICAgIHRoaXMub3B0aW9ucyA9ICQuZXh0ZW5kKHt9LCBJbnN0YW50U2VhcmNoLkRFRkFVTFRTLCB0aGlzLiRpbnB1dC5kYXRhKCksIG9wdGlvbnMpO1xuXG4gICAgICAgIHRoaXMuJGlucHV0LmtleXVwKHRoaXMuZGVib3VuY2UoKSk7XG4gICAgfTtcblxuICAgIEluc3RhbnRTZWFyY2guREVGQVVMVFMgPSB7XG4gICAgICAgIG1pblF1ZXJ5TGVuZ3RoOiAyLFxuICAgICAgICBsaW1pdDogMTAsXG4gICAgICAgIGRlbGF5OiA1MDAsXG4gICAgICAgIG5vUmVzdWx0c01lc3NhZ2U6ICdObyByZXN1bHRzIGZvdW5kJyxcbiAgICAgICAgaXRlbVRlbXBsYXRlOiAnXFxcbiAgICAgICAgICAgICAgICA8YXJ0aWNsZSBjbGFzcz1cInBvc3RcIj5cXFxuICAgICAgICAgICAgICAgICAgICA8aDI+PGEgaHJlZj1cInt7IHVybCB9fVwiPnt7IHRpdGxlIH19PC9hPjwvaDI+XFxcbiAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3M9XCJwb3N0LW1ldGFkYXRhXCI+XFxcbiAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJtZXRhZGF0YVwiPjxpIGNsYXNzPVwiZmEgZmEtY2FsZW5kYXJcIj48L2k+IHt7IGRhdGUgfX08L3NwYW4+XFxcbiAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJtZXRhZGF0YVwiPjxpIGNsYXNzPVwiZmEgZmEtdXNlclwiPjwvaT4ge3sgYXV0aG9yIH19PC9zcGFuPlxcXG4gICAgICAgICAgICAgICAgICAgIDwvcD5cXFxuICAgICAgICAgICAgICAgICAgICA8cD57eyBzdW1tYXJ5IH19PC9wPlxcXG4gICAgICAgICAgICAgICAgPC9hcnRpY2xlPidcbiAgICB9O1xuXG4gICAgSW5zdGFudFNlYXJjaC5wcm90b3R5cGUuZGVib3VuY2UgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciBkZWxheSA9IHRoaXMub3B0aW9ucy5kZWxheTtcbiAgICAgICAgdmFyIHNlYXJjaCA9IHRoaXMuc2VhcmNoO1xuICAgICAgICB2YXIgdGltZXIgPSBudWxsO1xuICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XG5cbiAgICAgICAgcmV0dXJuIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGNsZWFyVGltZW91dCh0aW1lcik7XG4gICAgICAgICAgICB0aW1lciA9IHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHNlYXJjaC5hcHBseShzZWxmKTtcbiAgICAgICAgICAgIH0sIGRlbGF5KTtcbiAgICAgICAgfTtcbiAgICB9O1xuXG4gICAgSW5zdGFudFNlYXJjaC5wcm90b3R5cGUuc2VhcmNoID0gZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgcXVlcnkgPSAkLnRyaW0odGhpcy4kaW5wdXQudmFsKCkpLnJlcGxhY2UoL1xcc3syLH0vZywgJyAnKTtcbiAgICAgICAgaWYgKHF1ZXJ5Lmxlbmd0aCA8IHRoaXMub3B0aW9ucy5taW5RdWVyeUxlbmd0aCkge1xuICAgICAgICAgICAgdGhpcy4kcHJldmlldy5lbXB0eSgpO1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzO1xuICAgICAgICB2YXIgZGF0YSA9IHRoaXMuJGZvcm0uc2VyaWFsaXplQXJyYXkoKTtcbiAgICAgICAgZGF0YVsnbCddID0gdGhpcy5saW1pdDtcblxuICAgICAgICAkLmdldEpTT04odGhpcy4kZm9ybS5hdHRyKCdhY3Rpb24nKSwgZGF0YSwgZnVuY3Rpb24gKGl0ZW1zKSB7XG4gICAgICAgICAgICBzZWxmLnNob3coaXRlbXMpO1xuICAgICAgICB9KTtcbiAgICB9O1xuXG4gICAgSW5zdGFudFNlYXJjaC5wcm90b3R5cGUuc2hvdyA9IGZ1bmN0aW9uIChpdGVtcykge1xuICAgICAgICB2YXIgJHByZXZpZXcgPSB0aGlzLiRwcmV2aWV3O1xuICAgICAgICB2YXIgaXRlbVRlbXBsYXRlID0gdGhpcy5vcHRpb25zLml0ZW1UZW1wbGF0ZTtcblxuICAgICAgICBpZiAoMCA9PT0gaXRlbXMubGVuZ3RoKSB7XG4gICAgICAgICAgICAkcHJldmlldy5odG1sKHRoaXMub3B0aW9ucy5ub1Jlc3VsdHNNZXNzYWdlKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICRwcmV2aWV3LmVtcHR5KCk7XG4gICAgICAgICAgICAkLmVhY2goaXRlbXMsIGZ1bmN0aW9uIChpbmRleCwgaXRlbSkge1xuICAgICAgICAgICAgICAgICRwcmV2aWV3LmFwcGVuZChpdGVtVGVtcGxhdGUucmVuZGVyKGl0ZW0pKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgIC8vIElOU1RBTlRTIFNFQVJDSCBQTFVHSU4gREVGSU5JVElPTlxuICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuXG4gICAgZnVuY3Rpb24gUGx1Z2luKG9wdGlvbikge1xuICAgICAgICByZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHZhciAkdGhpcyA9ICQodGhpcyk7XG4gICAgICAgICAgICB2YXIgaW5zdGFuY2UgPSAkdGhpcy5kYXRhKCdpbnN0YW50U2VhcmNoJyk7XG4gICAgICAgICAgICB2YXIgb3B0aW9ucyA9IHR5cGVvZiBvcHRpb24gPT09ICdvYmplY3QnICYmIG9wdGlvbjtcblxuICAgICAgICAgICAgaWYgKCFpbnN0YW5jZSkgJHRoaXMuZGF0YSgnaW5zdGFudFNlYXJjaCcsIChpbnN0YW5jZSA9IG5ldyBJbnN0YW50U2VhcmNoKHRoaXMsIG9wdGlvbnMpKSk7XG5cbiAgICAgICAgICAgIGlmIChvcHRpb24gPT09ICdzZWFyY2gnKSBpbnN0YW5jZS5zZWFyY2goKTtcbiAgICAgICAgfSlcbiAgICB9XG5cbiAgICAkLmZuLmluc3RhbnRTZWFyY2ggPSBQbHVnaW47XG4gICAgJC5mbi5pbnN0YW50U2VhcmNoLkNvbnN0cnVjdG9yID0gSW5zdGFudFNlYXJjaDtcblxufSkod2luZG93LmpRdWVyeSk7XG4iLCJpbXBvcnQgJy4vanMvanF1ZXJ5Lmluc3RhbnRTZWFyY2guanMnO1xuXG4kKGZ1bmN0aW9uKCkge1xuICAgICQoJy5zZWFyY2gtZmllbGQnKVxuICAgICAgICAuaW5zdGFudFNlYXJjaCh7XG4gICAgICAgICAgICBkZWxheTogMTAwLFxuICAgICAgICAgICAgaXRlbVRlbXBsYXRlOiAnXFxcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwiY2FyZFwiPlxcXG4gICAgICAgICAgICAgICAgICAgIDxoND48YSBocmVmPVwie3sgdXJsIH19XCI+e3sgdGl0bGUgfX08L2E+PC9oND5cXFxuICAgICAgICAgICAgICAgIDwvZGl2PicsXG4gICAgICAgIH0pXG4gICAgICAgIC5rZXl1cCgpO1xufSk7Il0sIm5hbWVzIjpbIiQiLCJTdHJpbmciLCJwcm90b3R5cGUiLCJyZW5kZXIiLCJwYXJhbWV0ZXJzIiwicmVwbGFjZSIsIm1hdGNoIiwicGF0dGVybiIsIm5hbWUiLCJJbnN0YW50U2VhcmNoIiwiZWxlbWVudCIsIm9wdGlvbnMiLCIkaW5wdXQiLCIkZm9ybSIsImNsb3Nlc3QiLCIkcHJldmlldyIsImFwcGVuZFRvIiwiZXh0ZW5kIiwiREVGQVVMVFMiLCJkYXRhIiwia2V5dXAiLCJkZWJvdW5jZSIsIm1pblF1ZXJ5TGVuZ3RoIiwibGltaXQiLCJkZWxheSIsIm5vUmVzdWx0c01lc3NhZ2UiLCJpdGVtVGVtcGxhdGUiLCJzZWFyY2giLCJ0aW1lciIsInNlbGYiLCJjbGVhclRpbWVvdXQiLCJzZXRUaW1lb3V0IiwiYXBwbHkiLCJxdWVyeSIsInRyaW0iLCJ2YWwiLCJsZW5ndGgiLCJlbXB0eSIsInNlcmlhbGl6ZUFycmF5IiwiZ2V0SlNPTiIsImF0dHIiLCJpdGVtcyIsInNob3ciLCJodG1sIiwiZWFjaCIsImluZGV4IiwiaXRlbSIsImFwcGVuZCIsIlBsdWdpbiIsIm9wdGlvbiIsIiR0aGlzIiwiaW5zdGFuY2UiLCJmbiIsImluc3RhbnRTZWFyY2giLCJDb25zdHJ1Y3RvciIsIndpbmRvdyIsImpRdWVyeSJdLCJzb3VyY2VSb290IjoiIn0=