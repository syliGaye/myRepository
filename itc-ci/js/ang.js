'use strict'

var app = angular.module('itcApp', ['ngRoute'])

    .controller('itcCtrl', ['$scope', 'lesFactoris', function($scope, lesFactoris){
        $scope.lesSessions = lesFactoris.getAffichage()
            .then(function(donnees){
                $scope.lesSessions = donnees;
                console.log(donnees);
            }, function(msg){
                alert(msg) ;
            });

        $scope.sessionPrgm = lesFactoris.getSessionProgramme()
            .then(function(session){
                $scope.sessionPrgm = session;
                console.log(session);
            }, function(msg){
                alert(msg);
            });

        $scope.technology = lesFactoris.getTechnologies()
            .then(function(technologies){
                $scope.technology = technologies ;
                console.log(technologies) ;
            }, function(msg){
                alert(msg) ;
            });
    }])


    .factory('lesFactoris', ['$http', '$q', '$timeout', function($http, $q, $timeout){
        var factory = {
            affichUser: false,
            getAffichage: function(){
                var deferred = $q.defer();

                if(factory.affichUser !== false){
                    deferred.resolve(factory.affichUser);
                }
                else{
                    $http.get('admin/php/session/afficherFormation.php')
                        .then(function(response){
                            factory.affichUser = response.data.data;
                            $timeout(function(){
                                deferred.resolve(factory.affichUser);
                            });
                        },
                        function(){
                            deferred.reject('Erreur de connexion') ;
                        });
                }
                return deferred.promise;
            },
            sessionProgramme: false,
            getSessionProgramme: function(){
                var deferred = $q.defer();

                if(factory.sessionProgramme !== false){
                    deferred.resolve(factory.sessionProgramme);
                }
                else{
                    $http.get('admin/php/session/afficherFormation.php')
                        .then(function(response){
                            factory.sessionProgramme = response.data.data_1;
                            $timeout(function(){
                                deferred.resolve(factory.sessionProgramme);
                            });
                        },
                        function(){
                            deferred.reject('Erreur de connexion') ;
                        });
                }
                return deferred.promise;
            },
            technologies : false,
            getTechnologies : function(){
                var deferred = $q.defer() ;

                if(factory.technologies !== false){
                    deferred.resolve(factory.technologies) ;
                } else{
                    $http.get('admin/php/technologie/getAllTechnologie.php')
                        .then(function(data){
                            factory.technologies = data.data.data ;
                            $timeout(function(){
                                deferred.resolve(factory.technologies) ;
                            }) ;
                        }, function(msg){
                            deferred.reject('Erreur de connexion') ;
                        });
                }
                return deferred.promise ;
            }
        };
        return factory;
    }])
    /*.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider){
        $routeProvider
            .when('/lien', {templateUrl: 'lien.html'});
        $locationProvider.hashPrefix('');
        $locationProvider.html5Mode({
            enabled: false,
            requireBase: true
        });
    }])*/;