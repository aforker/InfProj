(function() {
   'use strict';
   
   var myApp = angular.module('votelist');
   myApp.controller("dataControl", function($scope, $window) {
      $scope.getNewAccountPage = function(){
         $window.location.href ="makeaccount.html";
      };
      
      



        
      // variables used in search bar
      $scope.query = {};
      $scope.queryBy = "$";
      });
   }) ();