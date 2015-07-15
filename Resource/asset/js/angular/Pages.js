angular.module('Pages')
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('##').endSymbol('##');
    })

    .run(function($http) {
        $http.defaults.headers.common = { 'X-Requested-With' : 'XMLHttpRequest' };
    });
