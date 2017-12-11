(function() {
   'use strict';
   
   var myApp = angular.module('votelist',[]);
   myApp.controller("dataControl", function($scope, $window, $http) {
         //================================================================
         // gets userlist
         $scope.followers = null;
         $scope.userlists = null;
         $scope.listofusers = null;
         // gets all lists belonging to a user
         $http.get("getFollowers.php")
            .then(function (response) {
               $scope.followers = response.data.value;
               alert($scope.followers);
         });
         // gets all lists belonging to a user
         $http.get("loadusers.php")
            .then(function (response) {
               $scope.listofusers = response.data.value;
         });
         // gets all lists belonging to a user
         $http.get("getUserLists.php")
            .then(function (response) {
               $scope.userlists = response.data.value;
         });
            
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
               alert($scope.data);
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
               alert($scope.attributes.length);

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
         // get a single list
         $scope.getSingleList= function() {
               $http.post("getSingleList.php")
                   .then(function (response) {
                   if (response.status == 200) {
                       if (response.data.status == 'error') {
                           alert ('error: ' + response.data.message);
                       } else {
                           //successful
                           //$window.location.href ="index.html";
                       }
                  } else {
                     alert('unexpected error');
                  }
               });
         };      
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
                           $window.location.href ="chooseeditlist.html";
                       }
                   } else {
                       alert('unexpected error');
                   }
               });
         };
         //=================================================================   
         // add an item
         $scope.makeItem= function(item) {
               var itemDetails = angular.copy(item);
               var attributes = angular.copy($scope.attributes);
               var passinarray = [itemDetails, attributes];
               alert (attributes);
               $http.post("makeitem.php", passinarray )
                   .then(function (response) {
                   if (response.status == 200) {
                       if (response.data.status == 'error') {
                           alert ('error: ' + response.data.message);
                       } else {
                           //successful
                           //$window.location.href ="index.html";
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
         // assign account variable
         $scope.getAccountId = function() {
            $http.post("getaccountid.php")
               .then(function (response) {
                  if (response.status ==200) {
                     if (response.data.status == 'error') {
                        alert ( 'error: ' + response.data.message);
                     } else {
                        $scope.account_id = response.data.message;
                     }
                  }
               });
         };          
         //=================================================================
         //define a selected area
         var selectedArea = null;
         //function for setting a new area
         $scope.selectArea = function(newArea) {
            selectedArea = newArea;
            if(selectedArea === null) {
               alert("correctly set to null" + selectedArea);
            }
            
         };
         //filter
         $scope.areaFilter = function(list) {
           
            if(selectedArea === null) {
               //if none, all lists are good
               
               return true;
            } else {
               // if exists, check if account id is the same
               if(list.owner == $scope.account_id) {
                  return true;
               } else {
                  return false;
               }
            }
         };
         
         // switch buttons
         $scope.getAreaClass = function(area) {
            if((selectedArea == area) || (area == 'all' && selectedArea === null)){
               return "btn-primary";
            } else {
               return  "";
            }
         };
         //=================================================================
         //?????????????
         /*$scope.getListClass = function (selectedList) {
            if ((selectedList == list) || (selectedList == 'all' && selectedList === null)) {
               return "btn-primary";
            } else {
               return "";
            }
         };*/
         
         //=================================================================
         //pass list id to add items
         $scope.passListIdAdd = function(listchoice){
            var choicelistid = angular.copy(listchoice);
            $http.post("setlistid.php", choicelistid)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        alert ('success: ' + response.data.message);
                        $window.location.href ="makeitem.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
         };
         //=================================================================
         //pass list id to delete
         $scope.passListIdDelete = function(listchoice){
            var choicelistid = angular.copy(listchoice);
            $http.post("deleteList.php", choicelistid)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        alert ('success: ' + response.data.message);
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
         };
         //=================================================================
         //pass list id to edit
         $scope.passListIdEdit = function(listchoice){
            var choicelistid = angular.copy(listchoice);
            $http.post("setlistid.php", choicelistid)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        alert ('success: ' + response.data.message);
                        $window.location.href ="editList.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
         };
         //=================================================================
         // function to update a player
         $scope.updatePlayer = function(editlist) {
             var list = angular.copy(editlist);
             
             $http.post("updateitem.php", list)
                 .then(function (response) {
                 if (response.status == 200) {
                     if (response.data.status == 'error') {
                         alert ('error: ' + response.data.message);
                     } else {
                         //successful
                         //$window.location.href ="index.html";
                     }
                 } else {
                     alert('unexpected error');
                 }
             });
         };
         //=================================================================
         //set edit mode
         $scope.setEditMode = function(on, list) {
            if (on) {
                // put it in edit mode
                $scope.editlist = angular.copy(list);
                list.editMode = true;
            } else {
                // no editing
                list.editMode = false;
            }
         };
         //=================================================================
         // returns the editMode for the current item (or player)
         $scope.getEditMode = function(list) {
             return list.editMode;
         };
         //=================================================================
         //follow a user
         $scope.follow = function(username) {
            alert(username);
             var followed = angular.copy(username);           
             $http.post("followAUser.php", followed)
                 .then(function (response) {
                 if (response.status == 200) {
                     if (response.data.status == 'error') {
                         alert ('error: ' + response.data.message);
                     } else {
                         //successful
                         alert ('success: ' + response.data.message);
                         //$window.location.href ="index.html";
                     }
                 } else {
                     alert('unexpected error');
                 }
             });
         };
      });    
   }) ();