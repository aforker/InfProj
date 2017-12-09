(function () {
    "use strict";
    var myApp = angular.module("votelist");
    myApp.filter("trustHtml", function($sce) {
        return function(html) {
            return $sce.trustAsHtml(html);
        };
    });
} )();