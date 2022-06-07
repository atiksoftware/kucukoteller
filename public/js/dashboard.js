/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/dashboard/left-sidebar.js":
/*!************************************************!*\
  !*** ./resources/js/dashboard/left-sidebar.js ***!
  \************************************************/
/***/ (() => {

// import Scrollbar from 'smooth-scrollbar';
// Scrollbar.init(document.querySelector('#left-sidebar-scrollable'));
(function () {
  var MD = 768;
  var trigger = document.querySelector('#left-sidebar-trigger');
  var navoverlay = document.querySelector('#navoverlay');
  var sidebar = document.querySelector('#left-sidebar');
  var header = document.querySelector('#header');
  var app = document.querySelector('#app');
  var showing = window.innerWidth > MD;

  var hideOnMobile = function hideOnMobile() {
    sidebar.classList.add('left-[-300px]');
    sidebar.classList.remove('left-0');
    navoverlay.classList.remove('w-full');
    navoverlay.classList.add('w-0');
    navoverlay.classList.add('opacity-0');
    showing = false;
  };

  var showOnMobile = function showOnMobile() {
    sidebar.classList.add('left-0');
    sidebar.classList.remove('left-[-300px]');
    navoverlay.classList.add('w-full');
    navoverlay.classList.remove('w-0');
    navoverlay.classList.remove('opacity-0');
    showing = true;
  };

  var hideOnDesktop = function hideOnDesktop() {
    sidebar.classList.remove('md:left-0');
    header.classList.remove('md:left-[300px]');
    app.classList.remove('md:pl-[300px]');
    showing = false;
  };

  var showOnDesktop = function showOnDesktop() {
    sidebar.classList.add('md:left-0');
    header.classList.add('md:left-[300px]');
    app.classList.add('md:pl-[300px]');
    showing = true;
  };

  trigger.addEventListener('click', function () {
    var screen_width = window.innerWidth;
    console.log(showing);

    if (screen_width < MD) {
      if (showing) {
        hideOnMobile();
      } else {
        showOnMobile();
      }
    } else {
      if (showing) {
        hideOnDesktop();
      } else {
        showOnDesktop();
      }
    }
  });
  navoverlay.addEventListener('click', function () {
    hideOnMobile();
  });
})();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************************************!*\
  !*** ./resources/js/dashboard/dashboard.js ***!
  \*********************************************/
__webpack_require__(/*! ./left-sidebar.js */ "./resources/js/dashboard/left-sidebar.js");
})();

/******/ })()
;