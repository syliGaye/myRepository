app.factory('ConsultantFactory', ['$scope', '$http', '$q', '$timeout', function($scope, $http, $q, $timeout){
    var factory = {
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
        }
    } ;
    return factory ;
}]);