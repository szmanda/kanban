(self["webpackChunk"] = self["webpackChunk"] || []).push([["login"],{

/***/ "./assets/login.js":
/*!*************************!*\
  !*** ./assets/login.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
$(function () {
  var usernameEl = $('#username');
  var passwordEl = $('#password');

  // in a real application, the user/password should never be hardcoded
  // but for the demo application it's very convenient to do so
  if (!usernameEl.val() || 'jane_admin' === usernameEl.val()) {
    usernameEl.val('jane_admin');
    passwordEl.val('kitten');
  }
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js"], () => (__webpack_exec__("./assets/login.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoibG9naW4uanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUFBLENBQUMsQ0FBQyxZQUFXO0VBQ1QsSUFBSUMsVUFBVSxHQUFHRCxDQUFDLENBQUMsV0FBVyxDQUFDO0VBQy9CLElBQUlFLFVBQVUsR0FBR0YsQ0FBQyxDQUFDLFdBQVcsQ0FBQzs7RUFFL0I7RUFDQTtFQUNBLElBQUksQ0FBQ0MsVUFBVSxDQUFDRSxHQUFHLEVBQUUsSUFBSSxZQUFZLEtBQUtGLFVBQVUsQ0FBQ0UsR0FBRyxFQUFFLEVBQUU7SUFDeERGLFVBQVUsQ0FBQ0UsR0FBRyxDQUFDLFlBQVksQ0FBQztJQUM1QkQsVUFBVSxDQUFDQyxHQUFHLENBQUMsUUFBUSxDQUFDO0VBQzVCO0FBQ0osQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xvZ2luLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiQoZnVuY3Rpb24oKSB7XG4gICAgdmFyIHVzZXJuYW1lRWwgPSAkKCcjdXNlcm5hbWUnKTtcbiAgICB2YXIgcGFzc3dvcmRFbCA9ICQoJyNwYXNzd29yZCcpO1xuXG4gICAgLy8gaW4gYSByZWFsIGFwcGxpY2F0aW9uLCB0aGUgdXNlci9wYXNzd29yZCBzaG91bGQgbmV2ZXIgYmUgaGFyZGNvZGVkXG4gICAgLy8gYnV0IGZvciB0aGUgZGVtbyBhcHBsaWNhdGlvbiBpdCdzIHZlcnkgY29udmVuaWVudCB0byBkbyBzb1xuICAgIGlmICghdXNlcm5hbWVFbC52YWwoKSB8fCAnamFuZV9hZG1pbicgPT09IHVzZXJuYW1lRWwudmFsKCkpIHtcbiAgICAgICAgdXNlcm5hbWVFbC52YWwoJ2phbmVfYWRtaW4nKTtcbiAgICAgICAgcGFzc3dvcmRFbC52YWwoJ2tpdHRlbicpO1xuICAgIH1cbn0pO1xuIl0sIm5hbWVzIjpbIiQiLCJ1c2VybmFtZUVsIiwicGFzc3dvcmRFbCIsInZhbCJdLCJzb3VyY2VSb290IjoiIn0=