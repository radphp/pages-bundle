angular.module('Pages')
    .config(function($interpolateProvider, $locationProvider) {
        $interpolateProvider.startSymbol('##').endSymbol('##');
        $locationProvider.html5Mode(true).hashPrefix('!');
    })

    .run(function($http) {
        $http.defaults.headers.common = { 'X-Requested-With' : 'XMLHttpRequest' };
    });
