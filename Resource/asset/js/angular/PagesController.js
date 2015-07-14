angular.module('Pages')
    .controller('PagesController', ['$scope', function(action, id, $scope) {
        console.log(action, id);
        switch (action){
            case 'delete':
                break;
            case 'download':
                $scope.id = id;
        }
    }]);
