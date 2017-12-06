(function() {
   'use strict';
   
   var myApp = angular.module('votelist',[]);
   myApp.controller("dataControl", function($scope, $window, $http) {
         //================================================================
         // redirects to new account page
         $scope.getNewAccountPage = function(){
            $window.location.href ="makeaccount.html";
         };
         //================================================================
         // populate lists on main page
         $http.get("loadlists.php")
            .then(function (response) {
               $scope.data = response.data.value;
         });   
         // get item   
         $scope.datatype = function(item) {
           return item.type;
         };
         //================================================================
         //dynamic add attributes
         $scope.attributes = [{id: 'attribute1'}];
         //add new item
         $scope.addNewAttribute = function(){
            var newAttributeNo = $scope.attributes.length+1;
            $scope.attributes.push({'id':'attribute'+ newAttributeNo});
            alert($scope.attributes[id]);
         };
         //delete existing attribute
         $scope.removeAttribute = function() {
            var lastAttribute = $scope.attributes.length-1;
            $scope.attributes.splice(lastAttribute);
         };
         // variables used in search bar
         $scope.query = {};
         $scope.queryBy = "$";
      
         //=================================================================
         // add a list
         $scope.saveList = function(listDetails) {
               var list = angular.copy(listDetails);
               
               $http.post("makelist.php", list)
                   .then(function (response) {
                   if (response.status == 200) {
                       if (response.data.status == 'error') {
                           alert ('error: ' + response.data.message);
                       } else {
                           //successful
                           alert (response.data.message);
                           $window.location.href ="makelist.php";
                       }
                   } else {
                       alert('unexpected error');
                   }
               });
         };
         //=================================================================   
         // add an item
         $scope.makeItem= function(itemDetails) {
               var item = angular.copy(itemDetails);
               
               $http.post("makeitem.php", item)
                   .then(function (response) {
                   if (response.status == 200) {
                       if (response.data.status == 'error') {
                           alert ('error: ' + response.data.message);
                       } else {
                           //successful
                           alert (response.data.message);
                           //$window.location.href ="makelist.php";
                       }
                   } else {
                       alert('unexpected error');
                   }
               });
         };
   
         //=================================================================
         // makes a new account
         $scope.newaccount = function(accountdetails) {
            var account = angular.copy(accountdetails);       
            $http.post("newaccount.php", account)
               .then(function (response) {
                  if (response.status == 200) {
                     if(response.data.status == 'error') {
                        alert( 'error: ' + response.data.message);
                     } else {
                        $window.location.href = "login.html";
                     }
                  }else {
                     alert('unexpected error');
                  }
               });
         };
         //=================================================================
         // Login        
           $scope.login = function(credentialDetails) {
               var credentials = angular.copy(credentialDetails);
               
               $http.post("login.php", credentials)
                   .then(function (response) {
                   if (response.status == 200) {
                       if (response.data.status == 'error') {
                           alert ('error: ' + response.data.message);
                       } else {
                           //successful
                           $window.location.href ="index.html";
                       }
                   } else {
                       alert('unexpected error');
                   }
               });
           };   
         //=================================================================
         // Logout            
         $scope.logout = function() {
             $http.post("logout.php")
                 .then(function (response) {
                 if (response.status == 200) {
                     if (response.data.status == 'error') {
                         alert ('error: ' + response.data.message);
                     } else {
                         //successful
                         $window.location.href ="index.html";
                     }
                 } else {
                     alert('unexpected error');
                 }
             });
         };
         //=================================================================
         //check if logged in
         $scope.isloggedin = function() {
            $http.post("isloggedin.php")
                 .then(function (response) {
                 if (response.status == 200) {
                     if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                     } else {
                         //successful
                         // return whether logged in or not
                        alert ('success: ' + response.data.message);
                        $scope.isloggedin = response.data.loggedin;
                     }
                 } else {
                     alert('unexpected error');
                 }
             });            
         };
         //=================================================================
         //set the session variable
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
         //=================================================================
         // get session variable
         $scope.getSessionVariable = function(attribute) {
            $http.post("getsessionvariable.php", attribute)
                 .then(function (response) {
                 if (response.status == 200) {
                     if (response.data.status == 'error') {
                         alert ('error: ' + response.data.message);
                     } else {
                         //successful
                         // return value of attribute
                         return response.data.value;
                     }
                 } else {
                     alert('unexpected error');
                 }
             });            
         };
         //=================================================================
         //?????????
         $scope.areaFilter = function(list) {
            if(selectedArea === null) {
               return true;
            } else {
               if(list.account_id == $scope.account_id) {
                  return true;
               } else {
                  return false;
               }
            }
         };
         //=================================================================
         //?????????????
         $scope.getAreaClass = function (area) {
            if ((selectedArea == area) || (area == 'all' && selectedArea === null)) {
               return "btn-primary";
            } else {
               return "";
            }
         };
         
         //=================================================================
         //pass list id
         $scope.passListId = function(listchoice){
            var choicelistid = angular.copy(listchoice);
            alert(choicelistid);
         };
      });    
   }) ();