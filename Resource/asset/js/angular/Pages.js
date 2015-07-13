angular.module('Pages')
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('##').endSymbol('##');
    });
