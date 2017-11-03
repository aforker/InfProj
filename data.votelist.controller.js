(function() {
   'use strict';
   
   var myApp = angular.module('votelist');
   myApp.controller("dataControl", function($scope, $window, $http) {
      $scope.getNewAccountPage = function(){
         $window.location.href ="makeaccount.html";
      };
      
      $scope.newaccount = function(accountdetails) {
         var account = angular.copy(accountdetails);
         
         $http.post("newaccount.php", account)
            .then(function (response) {
               if (response.status == 200) {
                  if(response.data.status == 'error') {
                     alert( 'error: ' + response.data.message);
                  } else {
                     $window.location.href = "index.html";
                  }
               }else {
                  alert('unexpected error');
               }
            });
      };
      
      $scope.login = function(logininfo) {
         var info = angular.copy(logininfo);
         
         $http.post("login.php", info)
            .then(function (response) {
               if(response.status == 200) {
                  if(response.data.status == 'error') {
                     alert ('error: ' + response.data.message);
                  } else{
                     $window.location.href = "index.html";
                  }
               } else {
                  alert('unexpected error');
               }
            });
      };
      
      $scope.logout = function() {
          $http.post("logout.php")
              .then(function (response) {
              if (response.status == 200) {
                  if (response.data.status == 'error') {
                      alert ('error: ' + response);
                  } else {
                      //successful
                      $window.location.href ="index.html";
                  }
              } else {
                  alert('unexpected error');
              }
          });
      };
      
      $scope.loggedin = function() {
         $http.post("loggedin.php")
              .then(function (response) {
              if (response.status == 200) {
                  if (response.data.status == 'error') {
                      alert ('error: ' + response.data.message);
                  } else {
                      //successful
                      // return whether logged in or not
                      $scope.loggedin = response.data.loggedin;
                  }
              } else {
                  alert('unexpected error');
              }
          });            
      };
      
      $scope.setsessionvariable = function(attribute, value) {
         $http.post("setsessionvariable.php", {"attribute": attribute, "value":value})
              .then(function (response) {
              if (response.status == 200) {
                  if (response.data.status == 'error') {
                      alert ('error: ' + response.data.message);
                  } else {
                      //successful
                      return true;
                  }
              } else {
                  alert('unexpected error');
              }
          });            
      };   
      
      $scope.loadlists = function() {
         
         $http.post("loadlists.php")
            .then(function (response) {
               if(response.status == 200) {
                  if(response.data.status == 'error') {
                     alert ('error: ' + response.data.message);
                  } else {
                        alert('unexpected error');
                  }
               }
            });
      };
      // variables used in search bar
      $scope.query = {};
      $scope.queryBy = "$";
      });
   }) ();