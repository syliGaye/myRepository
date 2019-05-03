
app.factory('FormationFactory', ['$http', '$q', '$timeout', function($http, $q, $timeout){
    var factory = {
        formations : false,
        getFormations : function(){
            var deferred = $q.defer() ;

            if(factory.formations !== false){
                deferred.resolve(factory.formations) ;
            } else{
                $http.get('php/formation/getFormation.php')
                    .then(function(data){
                        factory.formations = data.data.data ;
                        $timeout(function(){
                            deferred.resolve(factory.formations) ;
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