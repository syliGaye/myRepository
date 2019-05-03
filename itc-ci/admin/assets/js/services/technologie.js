app.factory('TechnoFactory', ['$http', '$q', '$timeout', function($http, $q, $timeout){
    var factory = {


        technologies : false,
        getTechnologies : function(){
            var deferred = $q.defer() ;

            if(factory.technologies !== false){
                deferred.resolve(factory.technologies) ;
            } else{
                $http.get('php/technologie/getAllTechnologie.php')
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
        },


        consultants : false,
        getConsultants : function(){
            var deferred = $q.defer() ;

            if(factory.consultants !== false){
                deferred.resolve(factory.consultants) ;
            } else{
                $http.get('php/consultant/getConsutants.php')
                    .then(function(data){
                        factory.consultants = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.consultants) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },


        typeSession: false,
        getTypeSession : function(){
            var deferred = $q.defer() ;

            if(factory.typeSession !== false){
                deferred.resolve(factory.typeSession) ;
            } else{
                $http.get('php/typeSession/getTypeSessions.php')
                    .then(function(data){
                        factory.typeSession = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.typeSession) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },


        session: false,
        getSession : function(){
            var deferred = $q.defer() ;

            if(factory.session !== false){
                deferred.resolve(factory.session) ;
            } else{
                $http.get('php/session/getSessions.php')
                    .then(function(data){
                        factory.session = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.session) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },


        souscripteurByNotif: false,
        getSouscripteurByNotif: function(){
            var deferred = $q.defer() ;

            if(factory.souscripteurByNotif !== false){
                deferred.resolve(factory.souscripteurByNotif) ;
            } else{
                $http.get('php/notification/forMails.php')
                    .then(function(data){
                        factory.souscripteurByNotif = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.souscripteurByNotif) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },

        souscripteur: false,
        getSouscripteur: function(){
            var deferred = $q.defer() ;

            if(factory.souscripteur !== false){
                deferred.resolve(factory.souscripteur) ;
            } else{
                $http.get('php/souscripteur/getSouscripteurs.php')
                    .then(function(data){
                        factory.souscripteur = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.souscripteur) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },

        participant: false,
        getParticipant: function(){
            var deferred = $q.defer() ;

            if(factory.participant !== false){
                deferred.resolve(factory.participant) ;
            } else{
                $http.get('php/participant/getParticipants.php')
                    .then(function(data){
                        factory.participant = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.participant) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        },

        utilisateur: false,
        getUser: function(){
            var deferred = $q.defer() ;

            if(factory.utilisateur !== false){
                deferred.resolve(factory.utilisateur) ;
            } else{
                $http.get('php/compteUser/getUtilisateurs.php')
                    .then(function(data){
                        factory.utilisateur = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.utilisateur) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        }

        /*,

        getSouscripteurBySessionFormation: function(idFormation, idSession){
            var deferred = $q.defer();
            var souscripteurBySession = {};
            var sessionBySessionFormation = {} ;

            var sessionBySessionFormations = factory.getSession()
                .then(function(session){
                    angular.forEach(session, function(value, key){
                        if(value.formation === idFormation && value.typeSession === idSession){
                            sessionBySessionFormation = value ;
                        }
                    });
                    $timeout(function(){
                        deferred.resolve(sessionBySessionFormation) ;
                    }, 2000) ;
                }, function(msg){
                    deferred.reject('Erreur de connexion: '+msg) ;
                });
            return deferred.promise ;
        }*/
    } ;
    return factory ;
}]) ;