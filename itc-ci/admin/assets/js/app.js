'use strict'

var app = angular.module('itcAdminApp', [])
    .controller('AdminMainCtrl', ['$scope', 'TechnoFactory', 'FormationFactory', 'DomaineFactory', function($scope, TechnoFactory, FormationFactory, DomaineFactory){
        $scope.main = {
            title : 'ITC',
            description: 'Une application'
        };


        $scope.technology = TechnoFactory.getTechnologies()
            .then(function(technologies){
                $scope.technology = technologies ;
                //console.log(technologies) ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.formation = FormationFactory.getFormations()
            .then(function(formations){
                $scope.formation = formations ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.domaines = DomaineFactory.getDomaines()
            .then(function(domaines){
                $scope.domaines = domaines ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.consults = TechnoFactory.getConsultants()
            .then(function(consultant){
                $scope.consults = consultant ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.typeSessions = TechnoFactory.getTypeSession()
            .then(function(consultant){
                $scope.typeSessions = consultant ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.sessionsCours = TechnoFactory.getSession()
            .then(function(consultant){
                $scope.sessionsCours = consultant ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.souscripteurNotification = TechnoFactory.getSouscripteurByNotif()
            .then(function(consultant){
                $scope.souscripteurNotification = consultant ;
            }, function(msg){
                alert(msg) ;
            });


        $scope.souscripteurs = TechnoFactory.getSouscripteur()
            .then(function(souscripteur){
                $scope.souscripteurs = souscripteur ;
            },function(msg){alert(msg)});


        $scope.participants = TechnoFactory.getParticipant()
            .then(function(participant){
                $scope.participants = participant ;
            },function(msg){alert(msg)});


        $scope.users = TechnoFactory.getUser()
            .then(function(utilisateur){
                $scope.users = utilisateur ;
            }, function(msg){
                alert(msg) ;
            });

        $scope.rameneLigne = function(id){
            console.log(id) ;
        }
    }]);