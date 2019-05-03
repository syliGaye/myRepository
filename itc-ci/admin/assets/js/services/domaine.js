
app.factory('DomaineFactory', ['$http', '$q', '$timeout', function($http, $q, $timeout){
    var factory = {
        domaines : false,
        getDomaines : function(){
            var deferred = $q.defer() ;

            if(factory.domaines !== false){
                deferred.resolve(factory.domaines) ;
            } else{
                $http.get('php/domaine/getDomaines.php')
                    .then(function(data){
                        factory.domaines = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.domaines) ;
                        }) ;
                    }, function(msg){
                        deferred.reject('Erreur de connexion') ;
                    });
            }
            return deferred.promise ;
        }
    } ;
    return factory ;
}]) ;